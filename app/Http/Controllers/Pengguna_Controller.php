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

class Pengguna_Controller extends Controller
{
    public function home(){
        $tb_barang = barang::all();
        $tb_harga = harga::all();
        // =====Notifikasi====
        if(session('id_transaksi')){
            $id_transaksi=session('id_transaksi');
            $notif = DB::table('detail_transaksi')
            ->select('id_transaksi')
            ->where('id_transaksi','=',$id_transaksi)
            ->count();
        }else{
            $notif=null;
        }
       
        return view('pengguna.home_pengguna')->with(['tb_barang'=>$tb_barang,'tb_harga'=>$tb_harga,'notif'=>$notif]);
    }
    
    public function detail_transaksi(Request $request){
        // =====================Stok======================================
        // dd($request);
        $stok = DB::table('barang')
          ->select('ketersediaan_barang')->where('id_barang',$request->id_barang)
          ->get();

        $pinjam=DB::table('transaksi')
                ->join('detail_transaksi','transaksi.id_transaksi','=','detail_transaksi.id_transaksi')
                ->select('transaksi.id_transaksi','detail_transaksi.id_barang','transaksi.tgl_pemasangan','transaksi.tgl_selesai')
                ->where('transaksi.tgl_selesai','>',date("Y-m-d"))
                ->where('detail_transaksi.id_barang','=',$request->id_barang)
                ->count();
        $sisa_stok = $stok[0]->ketersediaan_barang - $pinjam;  
        if($request->qty>$sisa_stok){
            return redirect('/pengguna/home')->with('status','Maaf Sisa Stok = '.$sisa_stok);
        }
        // =====================EndStok======================================

        $tb_harga = DB::table('harga')
            ->select('id','id_barang','kategori','ukuran','harga')
            ->where([
                ['id_barang','=',$request->id_barang],
                ['kategori','=',$request->kategori],
                ['ukuran','=',$request->ukuran],
            ])
            ->get();
        // dd($tb_harga);
        
        $tb_barang = DB::table('barang')
            ->select('nama_barang')->where('id_barang',$request->id_barang)
            ->get();
            // {{dd($tb_barang);}}
            
            $tb_harga=$tb_harga[0];
            $tb_barang=$tb_barang[0];
     
            if(!session('id_transaksi')){
                // id transaksi Increment
                $db = DB::table('detail_transaksi')
                ->max('id_transaksi');
                $parsing = (int) substr($db,4,3);
                $parsing++;
                $char="TR-";
                $id_transaksi=$char.sprintf("%03s",$parsing);
                // ==========================
               
                session(['id_transaksi'=>$id_transaksi]);
                $id_transaksi=session('id_transaksi');
    
            }else{
              
                $id_transaksi=session('id_transaksi');
            }
            

        detail_transaksi::create([
            'id_transaksi'=>$id_transaksi,
            'id_barang'=>$tb_harga->id_barang,
            'nama_barang'=>$tb_barang->nama_barang.' '.$tb_harga->kategori.' '.$tb_harga->ukuran,
            'harga'=>$tb_harga->harga,
            'qty'=>$request->qty,
            'subtotal'=>$tb_harga->harga*$request->qty,
            'pembeli'=>'pengguna'
        ]);
        
        return redirect('/pengguna/home');
    }
    public function data_detail_transaksi(){
        if(session('id_transaksi')){
            $id_transaksi =session('id_transaksi');
            $tb_detail_transaksi = DB::table('detail_transaksi')
            ->select('id_detail','id_transaksi','id_barang','nama_barang','harga','qty','subtotal','pembeli')
            ->where('id_transaksi',$id_transaksi)
            ->get();
        }else{
            $tb_detail_transaksi=null;
        }
        // =====Notifikasi====
        if(session('id_transaksi')){
            $id_transaksi=session('id_transaksi');
                $notif = DB::table('detail_transaksi')
                ->select('id_transaksi')
                ->where('id_transaksi','=',$id_transaksi)
                ->count();
            if($notif == 0){
                session()->forget('id_transaksi');
            }
        }else{
            $notif=null;
        }
       
        return view('pengguna.data_detail_transaksi')->with(['tb_detail_transaksi'=>$tb_detail_transaksi,'notif'=>$notif]);
    }
    public function transaksi(Request $request){
        $request->validate([
            'id_transaksi'=>'required',
            'nama_pelanggan'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required',
            'tgl_pemasangan'=>'required',
            'tgl_selesai'=>'required',
            'bayar'=>'required',
            'grandtotal'=>'required',
            'bukti_transfer'=>'mimes:jpeg,png,jpg|max:2048',
        ]);
        date_default_timezone_set('Asia/Makassar');
        $sisa_pembayaran=$request->grandtotal-$request->bayar;
        // if($sisa_pembayaran>0){
        //     $status='belum lunas';
        // }else{
        //     $status='lunas';
        // }
            $status = 'pending';
        // ================Upload Bukti Transfer=====================

            $foto= explode('.',$request->bukti_transfer->getClientOriginalName());
            $foto=$foto[0];
            $foto_name = $foto.'-'.time().'.'.$request->bukti_transfer->extension();
            $request->bukti_transfer->move(public_path('image/bukti_transfer'),$foto_name);
        // ================
            $username = session('username');
        transaksi::create([
            'id_transaksi'=>$request->id_transaksi,
            'tgl_transaksi'=>date("Y-m-d-h-i-s"),
            'username'=>$username,
            'nama_pelanggan'=>$request->nama_pelanggan,
            'alamat'=>$request->alamat,
            'no_telp'=>$request->no_telp,
            'tgl_pemasangan'=>$request->tgl_pemasangan,
            'tgl_selesai'=>$request->tgl_selesai,
            'grand_total'=>$request->grandtotal,
            'bayar'=>$request->bayar,
            'sisa_pembayaran'=>$sisa_pembayaran,
            'status'=>$status,
            'bukti_bayar'=>$foto_name
        ]);
        if(session('id_transaksi')==$request->id_transaksi){
            // session()->flush();
            session()->forget('id_transaksi');
        }
        return redirect('/pengguna/home')->with('status','transaksi berhasil');
    }
    public function history_transaksi(){
        if (session('username')){
            $username =session('username');
            $history = DB::table('transaksi')
            ->select('id_transaksi','tgl_transaksi','nama_pelanggan','alamat','no_telp','tgl_pemasangan','tgl_selesai','grand_total','bayar','sisa_pembayaran','status')
            ->where('username','=',$username)
            ->get();
            return view('pengguna.history_transaksi')->with(['history'=>$history]);
        }else{
            return view('pengguna.history_transaksi');
        }
        
    }
    public function destroy_detail_transaksi(detail_transaksi $detail_transaksi){
        // {{dd($detail_transaksi);}}
        $data = detail_transaksi::where('id_detail',$detail_transaksi->id_detail);
        $data->forceDelete();
        return redirect('/pengguna/data_detail_transaksi')->with('status','data detail berhasil dihapus');
    }
    public function gallery(){
        $tb_gallery = gallery::all();
        return view('pengguna.gallery')->with(['tb_gallery'=>$tb_gallery]);
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
         // =====Notifikasi====
         if(session('id_transaksi')){
            $id_transaksi=session('id_transaksi');
                $notif = DB::table('detail_transaksi')
                ->select('id_transaksi')
                ->where('id_transaksi','=',$id_transaksi)
                ->count();
            if($notif == 0){
                session()->forget('id_transaksi');
            }
        }else{
            $notif=null;
        }

        return view('pengguna.pembayaran')->with(['id_transaksi'=>$id_transaksi,'grandtotal'=>$grandtotal,'notif'=>$notif]);
    }
    
}
