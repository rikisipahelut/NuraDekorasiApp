<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\barang;
use App\harga;
use App\detail_transaksi;
use App\transaksi;
use App\gallery;
use App\pengguna;
use App\token;
use Illuminate\Support\Facades\DB; //ini untuk query builder
use Illuminate\Http\UploadedFile; //ini untuk upload file
// use Mail;
use Illuminate\Support\Facades\Mail;
use App\Mail\NuraEmail; //ini dari make:email

class Guest_Controller extends Controller
{
    public function home(){
        $tb_barang = barang::all();
        $tb_harga = harga::all();
       
        return view('home.home_guest')->with(['tb_barang'=>$tb_barang,'tb_harga'=>$tb_harga]);
    }
    public function daftar_akun(Request $request){
        $find_email=DB::table('pengguna')
        ->where('username',$request->email)
        ->first();
        if($find_email){
            return redirect('/')->with('status','Email anda sudah terdaftar');
        }

        $token = csrf_token();
        // dd($token);
        $request->validate([
            'nama'=>'required',
            'alamat'=>'required',
            'no_telp'=>'required|max:12',
            'email'=>'required',
            'password'=>'required|min:6',
            'konfirm'=>'required|same:password',
        ]);
       $user = pengguna::create([
            'nama_pengguna'=>$request->nama,
            'alamat_pengguna'=>$request->alamat,
            'no_tlp_pengguna'=>$request->no_telp,
            'username'=>$request->email,
            'password'=>$request->password,
            'hak_akses'=>'user',
            'aktivasi'=>0
        ]);
        $aktivasi = token::create([
            'email'=>$request->email,
            'token'=>$token
        ]);
        $tipe ='aktivasi';
        $this->send_email($request->email,$request->nama,$token,$tipe);
        

        return redirect('/')->with('status','akun anda berhasil ditambahkan silakan melakukan login');
    }
    public function send_email($email,$nama,$token,$tipe){
        // $data=[
        //     'subject'=>'Verifikaksi Akun',
        //     'email'=>'rikisipahelut@gmail.com',
        //     'content'=>'ini coba'];
        // $kirim = Mail::send('email-template',$data, function($message) use ($data){
        //     $message->to($data['email'])->subject($data['subject']);
        // });
      
        // return back()->with(['message' => 'Email successfully sent!']);
        Mail::to($email)->send(new NuraEmail($email,$nama,$token,$tipe));
 
		return "Email telah dikirim";
    }
    public function send_password(Request $request){
        $find=DB::table('pengguna')
        ->where('username',$request->username)
        ->first();
        // dd($find);
        $email = $find->username;
        $nama = $find->nama_pengguna;
        $token = $find->password;
        $tipe= 'lupa_password';
        Mail::to($email)->send(new NuraEmail($email,$nama,$token,$tipe));
 
		return redirect('/')->with('status','Email Terkirim Silakan Cek Email Anda');
    }

    public function gallery(){
        $tb_gallery = gallery::all();
        return view('home.gallery')->with(['tb_gallery'=>$tb_gallery]);
    }

    public function getAllApi(){
        $data = barang::all();
        return response()->json(
            [
                "message"=>"200",
                "data" => $data
            ]
        );
    }
    
}
