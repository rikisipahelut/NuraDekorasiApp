<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use App\harga;
use App\detail_transaksi;
use App\transaksi;
use App\gallery;
use Illuminate\Support\Facades\DB; //ini untuk query builder
use Illuminate\Http\UploadedFile; //ini untuk upload file
use PDF; // menggunakan DOMPdf yang sudah di import dari composser

class Admin_Controller extends Controller
{
    public function dashboard(){
        $jan= \App\Http\Controllers\Admin_Controller::count_bulan('1');
        $feb= \App\Http\Controllers\Admin_Controller::count_bulan('2');
        $mar= \App\Http\Controllers\Admin_Controller::count_bulan('3');
        $apr= \App\Http\Controllers\Admin_Controller::count_bulan('4');
        $mei= \App\Http\Controllers\Admin_Controller::count_bulan('5');
        $jun= \App\Http\Controllers\Admin_Controller::count_bulan('6');
        $jul= \App\Http\Controllers\Admin_Controller::count_bulan('7');
        $agu= \App\Http\Controllers\Admin_Controller::count_bulan('8');
        $sep= \App\Http\Controllers\Admin_Controller::count_bulan('9');
        $okt= \App\Http\Controllers\Admin_Controller::count_bulan('10');
        $nov= \App\Http\Controllers\Admin_Controller::count_bulan('11');
        $des= \App\Http\Controllers\Admin_Controller::count_bulan('12');
        return view('admin.dashboard_admin')->with([
            'jan'=>$jan,
            'feb'=>$feb,
            'mar'=>$mar,
            'apr'=>$apr,
            'mei'=>$mei,
            'jun'=>$jun,
            'jul'=>$jul,
            'agu'=>$agu,
            'sep'=>$sep,
            'okt'=>$okt,
            'nov'=>$nov,
            'des'=>$des
            ]);
    }
    public function daftar_barang(){
        $tb_barang = barang::all();
        return view('admin.daftar_barang_admin')->with(['tb_barang'=>$tb_barang]);
    }
    public function data_pengguna(){
        return view('admin.data_pengguna');
    }
    public function form_tambah_barang(){
        return view('admin.form_tambah_barang');
    }
    public function store_barang(Request $request){
        
        $user=DB::table('barang')
            ->where('nama_barang',$request->nama_barang)
            ->first();
        if($user){
            return redirect('/admin/form_tambah_barang')->with('status','Tidak Bisa Ditambahkan Nama Barang Sudah ada !');
        }
        // ^ baru ditambahkan tanggal 12/7/2021
        if(!empty($request->foto_barang)){
            $request->validate([
                'nama_barang'=>'required',
                // 'harga_barang'=>'required',
                'ketersediaan_barang'=>'required',
                'foto_barang'=>'mimes:jpeg,png,jpg|max:2048'
            ]);
            $foto= explode('.',$request->foto_barang->getClientOriginalName());
            $foto=$foto[0];
            $foto_name = $foto.'-'.time().'.'.$request->foto_barang->extension();
            $request->foto_barang->move(public_path('image/foto_barang'),$foto_name);
        }else{
            $request->validate([
                'nama_barang'=>'required',
                // 'harga_barang'=>'required',
                'ketersediaan_barang'=>'required'
            ]);
            $foto_name=null;
        }
        
        // id barang Increment
        $db = DB::table('barang')
            ->max('id_barang');
        $parsing = (int) substr($db,4,3);
        $parsing++;
        $char="BRG-";
        $id_barang=$char.sprintf("%03s",$parsing);
        // ==========================
        barang::create([
            'id_barang'=>$id_barang,
            // 'PASSWORD'=>bcrypt($request->password),
            'nama_barang'=>$request->nama_barang,
            // 'harga_barang'=>$request->harga_barang,
            'ketersediaan_barang'=>$request->ketersediaan_barang,
            'foto_barang'=>$foto_name
        ]);
        return redirect('/admin/form_tambah_barang')->with('status','Data Barang berhasil ditambahkan!');
    }
    public function ubah_barang(barang $barang){
        return view('admin.form_ubah_barang')->with(['barang'=>$barang]);
    }
    public function update_barang(Request $request,barang $barang){
        $user=DB::table('barang')
            ->where('nama_barang',$request->nama_barang)
            ->first();
        if($user){
            return redirect('/admin/form_ubah_barang/'.$barang->id_barang)->with('status','Tidak Bisa Diubah Nama Barang Sudah ada !');
        }
        // ^ baru ditambahkan tanggal 12/7/2021
        //Validasi
        $request->validate([
            'nama_barang'=>'required',
            // 'harga_barang'=>'required',
            'ketersediaan_barang'=>'required'
        ]);
        if(empty($request->foto_barang)){
            $foto_name=$barang->foto_barang;
        }else{
            $request->validate([
                'foto_barang'=>'mimes:jpeg,png,jpg|max:2048'
            ]);
            $foto= explode('.',$request->foto_barang->getClientOriginalName());
            $foto=$foto[0];
            $foto_name = $foto.'-'.time().'.'.$request->foto_barang->extension();
            $request->foto_barang->move(public_path('image/foto_barang'),$foto_name);
        }
        barang::where('id_barang',$barang->id_barang)
                ->update([
                    'id_barang'=>$request->id_barang,
                    'nama_barang'=>$request->nama_barang,
                    // 'harga_barang'=>$request->harga_barang,
                    'ketersediaan_barang'=>$request->ketersediaan_barang,
                    'foto_barang'=>$foto_name
                ]);
        return redirect('/admin/daftar_barang')->with('status','Barang dengan ID '.$barang->id_barang.' berhasil diubah !');

    }
    public function destroy_barang(barang $barang){
        $data = barang::where('id_barang',$barang->id_barang);
        $data->forceDelete();
        return redirect('/admin/daftar_barang')->with('status','Barang Dengan ID:'.$barang->id_barang.' berhasil dihapus!');
    }
    public function daftar_harga(){
        $tb_harga = harga::all();
        return view('admin.daftar_harga_admin')->with(['tb_harga'=>$tb_harga]);
    }
    public function form_tambah_harga(barang $barang){
        return view('admin.form_tambah_harga')->with(['barang'=>$barang]);
    }
    public function store_harga(Request $request){
        // {{dd($request);}}
        $request->validate([
            'id_barang'=>'required',
            'kategori'=>'required',
            'ukuran'=>'required',
            'harga_barang'=>'required',
        ]);
        harga::create([
            'id_barang'=>$request->id_barang,
            // 'PASSWORD'=>bcrypt($request->password),
            'kategori'=>$request->kategori,
            // 'harga_barang'=>$request->harga_barang,
            'ukuran'=>$request->ukuran,
            'harga'=>$request->harga_barang
        ]);
        return redirect('/admin/daftar_barang')->with('status','Harga Barang berhasil ditambahkan!');

    }
    public function form_transaksi(){
        // isi dari dropdown
        $tb_join=DB::table('barang')
                ->join('harga','barang.id_barang','=','harga.id_barang')
                ->select('barang.id_barang','barang.nama_barang','harga.kategori','harga.ukuran','harga.id','harga.harga')
                ->get();
        //============================== 
        // if(!isset($_SESSION['id_transaksi'])){
        if(!session('id_transaksi')){
            // id transaksi Increment
            $db = DB::table('detail_transaksi')
            ->max('id_transaksi');
            $parsing = (int) substr($db,4,3);
            $parsing++;
            $char="TR-";
            $id_transaksi=$char.sprintf("%03s",$parsing);
            // ==========================
            // $_SESSION['id_transaksi']=$id_transaksi;
            session(['id_transaksi'=>$id_transaksi]);
            $id_transaksi=session('id_transaksi');

        }else{
            // $id_transaksi=$_SESSION['id_transaksi'];
            $id_transaksi=session('id_transaksi');
        }
        // {{dd($id_transaksi);}}
        // =======================================================
        $tb_detail_transaksi = detail_transaksi::all()->where('id_transaksi',$id_transaksi);
     
        return view('admin.form_transaksi')->with(['tb_join'=>$tb_join,'id_transaksi'=>$id_transaksi,'tb_detail_transaksi'=>$tb_detail_transaksi]);
    }
    public function detail_transaksi(Request $request){
        $tb_join=DB::table('barang')
        ->join('harga','barang.id_barang','=','harga.id_barang')
        ->select('barang.id_barang','barang.nama_barang','harga.kategori','harga.ukuran','harga.id','harga.harga')
        ->where('id',$request->id_harga)
        ->get();
        
        // {{dd($request);}}
        
        $tb_join=$tb_join[0];
        // {{dd($tb_join);}}

        detail_transaksi::create([
            'id_transaksi'=>$request->id_transaksi,
            'id_barang'=>$tb_join->id_barang,
            'nama_barang'=>$tb_join->nama_barang.' '.$tb_join->kategori.' '.$tb_join->ukuran,
            'harga'=>$tb_join->harga,
            'qty'=>$request->qty,
            'subtotal'=>$tb_join->harga*$request->qty,
            'pembeli'=>'admin'
        ]);
        // return view('/admin/form_transaksi');
        return redirect('/admin/form_transaksi');

        // {{dd($tb_join);}}
    }
    public function transaksi(Request $request){
        // {{dd($request);}}
        $request->validate([
            'id_transaksi'=>'required',
            'nama_pelanggan'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'tgl_pemasangan'=>'required',
            'tgl_selesai'=>'required',
            'bayar'=>'required',
            'grandtotal'=>'required',
        ]);
        date_default_timezone_set('Asia/Makassar');
        $sisa_pembayaran=$request->grandtotal-$request->bayar;
        if($sisa_pembayaran>0){
            $status='belum lunas';
        }else{
            $status='lunas';
        }
        transaksi::create([
            'id_transaksi'=>$request->id_transaksi,
            'tgl_transaksi'=>date("Y-m-d-h-i-s"),
            'username'=>'Admin',
            'nama_pelanggan'=>$request->nama_pelanggan,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
            'tgl_pemasangan'=>$request->tgl_pemasangan,
            'tgl_selesai'=>$request->tgl_selesai,
            'grand_total'=>$request->grandtotal,
            'bayar'=>$request->bayar,
            'sisa_pembayaran'=>$sisa_pembayaran,
            'status'=>$status,
            'bukti_bayar'=>'-'
        ]);
        if(session('id_transaksi')==$request->id_transaksi){
            // session()->flush();
            session()->forget('id_transaksi');
        }
        return redirect('/admin/dashboard')->with('status','transaksi berhasil');
    }
    public function ubah_harga(harga $harga){
        $tb_harga=DB::table('harga')
        ->select('id','id_barang','kategori','ukuran','harga')
        ->where('id',$harga->id)
        ->get();
        // $tb_harga = harga::all()->where('id',$harga->id);
        return view('admin.form_ubah_harga')->with(['tb_harga'=>$tb_harga]);
    }
    public function update_harga(Request $request, harga $harga){
            
        harga::where('id',$harga->id)
                ->update([
                    'id_barang'=>$request->id_barang,
                    'kategori'=>$request->kategori,
                    // 'harga_barang'=>$request->harga_barang,
                    'ukuran'=>$request->ukuran,
                    'harga'=>$request->harga_barang
                ]);
        return redirect('/admin/daftar_harga')->with('status','Harga Berhasil di Ubah');
    }
    public function destroy_harga(harga $harga){
        $data = harga::where('id',$harga->id);
        $data->forceDelete();
        return redirect('/admin/daftar_harga')->with('status','Harga Barang Dengan ID:'.$harga->id.' berhasil dihapus!');
    }
    public function destroy_detail_transaksi(detail_transaksi $detail_transaksi){
        // {{dd($detail_transaksi);}}
        $data = detail_transaksi::where('id_detail',$detail_transaksi->id_detail);
        $data->forceDelete();
        return redirect('/admin/form_transaksi');
    }
    public function data_transaksi(){
        $tb_data_transaksi = transaksi::all();
        // {{dd($tb_data_transaksi);}}
        return view('admin.data_transaksi')->with(['tb_data_transaksi'=>$tb_data_transaksi]);
    }
    public function data_detail_transaksi($id_transaksi){
        $tb_detail_transaksi=DB::table('detail_transaksi')
        ->select('id_detail','id_transaksi','id_barang','nama_barang','harga','qty','subtotal','pembeli')
        ->where('id_transaksi',$id_transaksi)
        ->get();
        // $tb_detail_transaksi=detail_transaksi::all()->where('id_transaksi',$id_transaksi);
        return view('admin.data_detail_transaksi')->with(['tb_detail_transaksi'=>$tb_detail_transaksi]);
        
    }
    public function update_transaksi(transaksi $id_transaksi){
        
        $tb_transaksi = $id_transaksi;

        if($tb_transaksi->sisa_pembayaran>0){
            $status='belum lunas';
        }else{
            $status='lunas';
        }

        if ($tb_transaksi->status =='belum lunas'){
            transaksi::where('id_transaksi',$tb_transaksi->id_transaksi)
                ->update([
                    'id_transaksi'=>$tb_transaksi->id_transaksi,
                    'tgl_transaksi'=>$tb_transaksi->tgl_transaksi,
                    'nama_pelanggan'=>$tb_transaksi->nama_pelanggan,
                    'alamat'=>$tb_transaksi->alamat,
                    'no_telp'=>$tb_transaksi->no_telp,
                    'tgl_pemasangan'=>$tb_transaksi->tgl_pemasangan,
                    'tgl_selesai'=>$tb_transaksi->tgl_selesai,
                    'grand_total'=>$tb_transaksi->grand_total,
                    'bayar'=>$tb_transaksi->bayar + $tb_transaksi->sisa_pembayaran,
                    'sisa_pembayaran'=>0,
                    'status'=>'lunas',
                    'bukti_bayar'=>$tb_transaksi->bukti_bayar,
                ]);
                return redirect('/admin/data_transaksi')->with('status','id_transaksi '.$tb_transaksi->id_transaksi.' Berhasil dikonfirmasi');
        }else{           
            transaksi::where('id_transaksi',$tb_transaksi->id_transaksi)
            ->update([
                'id_transaksi'=>$tb_transaksi->id_transaksi,
                'tgl_transaksi'=>$tb_transaksi->tgl_transaksi,
                'nama_pelanggan'=>$tb_transaksi->nama_pelanggan,
                'alamat'=>$tb_transaksi->alamat,
                'no_telp'=>$tb_transaksi->no_telp,
                'tgl_pemasangan'=>$tb_transaksi->tgl_pemasangan,
                'tgl_selesai'=>$tb_transaksi->tgl_selesai,
                'grand_total'=>$tb_transaksi->grand_total,
                'bayar'=>$tb_transaksi->bayar,
                'sisa_pembayaran'=>$tb_transaksi->sisa_pembayaran,
                'status'=>$status,
                'bukti_bayar'=>$tb_transaksi->bukti_bayar
                ]);
                return redirect('/admin/data_transaksi')->with('status','id_transaksi '.$tb_transaksi->id_transaksi.' Berhasil dikonfirmasi');
            }
    }
    public function cetak_pdf(Request $request){
        
        $tb_transaksi = DB::table('transaksi')
            ->select('id_transaksi','tgl_transaksi','nama_pelanggan','alamat','no_telp','tgl_pemasangan','tgl_selesai'
                        ,'grand_total','bayar','sisa_pembayaran','status','bukti_bayar')
            ->where('tgl_transaksi','like',"$request->bulan_tahun".'%')
            ->get();
        // $pdf = PDF::loadview('admin/cetak_pdf',['tb_transaksi'=>$tb_transaksi,'bulan'=>$request->bulan_tahun]);
        // return $pdf->download('Laporan-Transaksi-'.$request->bulan_tahun);
        // return $pdf->stream();
        // return view('admin/cetak_pdf')->with(['tb_transaksi'=>$tb_transaksi]);
        $jan= \App\Http\Controllers\Admin_Controller::count_bulan('1');
        $feb= \App\Http\Controllers\Admin_Controller::count_bulan('2');
        $mar= \App\Http\Controllers\Admin_Controller::count_bulan('3');
        $apr= \App\Http\Controllers\Admin_Controller::count_bulan('4');
        $mei= \App\Http\Controllers\Admin_Controller::count_bulan('5');
        $jun= \App\Http\Controllers\Admin_Controller::count_bulan('6');
        $jul= \App\Http\Controllers\Admin_Controller::count_bulan('7');
        $agu= \App\Http\Controllers\Admin_Controller::count_bulan('8');
        $sep= \App\Http\Controllers\Admin_Controller::count_bulan('9');
        $okt= \App\Http\Controllers\Admin_Controller::count_bulan('10');
        $nov= \App\Http\Controllers\Admin_Controller::count_bulan('11');
        $des= \App\Http\Controllers\Admin_Controller::count_bulan('12');
            
        return view('admin/cetak_pdf')->with([
            'jan'=>$jan,
            'feb'=>$feb,
            'mar'=>$mar,
            'apr'=>$apr,
            'mei'=>$mei,
            'jun'=>$jun,
            'jul'=>$jul,
            'agu'=>$agu,
            'sep'=>$sep,
            'okt'=>$okt,
            'nov'=>$nov,
            'des'=>$des,
            'tb_transaksi'=>$tb_transaksi,
            'bulan'=>$request->bulan_tahun
        ]);
    }
    public function destroy_transaksi(transaksi $transaksi){
        // dd($transaksi);
        $data = transaksi::where('id_transaksi',$transaksi->id_transaksi);
        $data->forceDelete();
        return redirect('/admin/data_transaksi')->with('status','id_transaksi '.$transaksi->id_transaksi.' berhasil dihapus !!');
    }

    public function form_gallery(){
        return view('admin.form_gallery');
    }
    public function tambah_gallery(Request $request){
        $request->validate([
            'nama_barang'=>'required',
            'foto_barang'=>'mimes:jpeg,png,jpg|max:2048|required'
        ]);
        $foto= explode('.',$request->foto_barang->getClientOriginalName());
        $foto=$foto[0];
        $foto_name = $foto.'-'.time().'.'.$request->foto_barang->extension();
        $request->foto_barang->move(public_path('image/foto_barang'),$foto_name);

        gallery::create([
           'nama_barang'=>$request->nama_barang,
           'foto_barang'=>$foto_name
        ]);

        return redirect('/admin/form_gallery')->with('status','data gallery berhasil ditambahkan');
    }
    public function details_gallery(){
        $tb_gallery = gallery::all();
        return view('admin.details_gallery')->with(['tb_gallery'=>$tb_gallery]);
    }
    public function destroy_gallery(gallery $id){
        $data = gallery::where('id',$id->id);
        $data->forceDelete();
        return redirect('/admin/details_gallery')->with('status','Gallery Dengan ID:'.$id->id.' berhasil dihapus!');
    }
    public function form_pembayaran(Request $request){
        if(session('id_transaksi')){
            $id_transaksi = session('id_transaksi');
            $tb_detail_transaksi = DB::table('detail_transaksi')
            ->select('id_detail','id_transaksi','id_barang','nama_barang','harga','qty','subtotal','pembeli')
            ->where('id_transaksi',$id_transaksi)
            ->get();

            $sum_details_transaksi = DB::table('detail_transaksi')
            ->select('subtotal', DB::raw('SUM(subtotal) as grandtotal'))
            ->where('id_transaksi','=',$id_transaksi)
            ->get();

            $grandtotal = $request->hari_sewa * $sum_details_transaksi[0]->grandtotal;
            // dd($grandtotal);
        }else{
            $tb_detail_transaksi=null;
        }

        return view('admin.pembayaran')->with(['id_transaksi'=>$id_transaksi,'grandtotal'=>$grandtotal]);
    }
    public function count_bulan($bulan){
        $data=DB::table('transaksi')
        // ->join('kapal','kontener.KD_KAPAL','=','kapal.KD_KAPAL')
        ->select(DB::raw('sum(grand_total) as jumlah'))
        ->whereMonth('tgl_transaksi',$bulan)
        ->whereYear('tgl_transaksi',date('Y'))
        ->get();
        // fungsi untuk SUM Transaksi per bulan

        return $data[0]->jumlah;
    }
}
