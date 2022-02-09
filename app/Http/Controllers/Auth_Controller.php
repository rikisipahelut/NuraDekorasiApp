<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; //ini untuk query builder
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\pengguna;

class Auth_Controller extends Controller
{
    public function login(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $user=DB::table('pengguna')
        ->where('username',$request->username)
        ->where('password',$request->password)
        ->first();

        // {{dd($user);}}

        if($user and $user->aktivasi==1){
            if ($user->hak_akses=="admin") {
                Auth::guard('login')->loginUsingId($user->id_pengguna);
                session(['gotodashboardadmin'=>true,'name'=>$user->nama_pengguna,'username'=>$user->username]);
                return redirect('/admin/dashboard');
            }
            if ($user->hak_akses=="user") {
                Auth::guard('login')->loginUsingId($user->id_pengguna);
                session(['gotodashboardpengguna'=>true,'name'=>$user->nama_pengguna,'username'=>$user->username]);
                return redirect('/pengguna/home');
            }            
        }else{
            return back()->with('status','Login Gagal / Belum Aktivasi Akun');
        }
    }
    public function logout(Request $request){
        $request->session()->flush();
        return redirect('/');
    }
    public function aktivasi($email,$token){

        $aktivasi=DB::table('token')
        ->where('email',$email)
        ->where('token',$token)
        ->first();
        if($aktivasi){
            pengguna::where('username',$email)
            ->update([
                'aktivasi'=>1,
            ]);
        }

        // return 'aktivasi '.$email.' Token '.$token.' Berhasil';
        return redirect('/')->with('status','silakan login');
    }
    public function ganti_password(Request $request){
        $request->validate([
            'password_baru'=>'required',
            'password_lama'=>'required'
        ]);
        $user=DB::table('pengguna')
        ->where('username',session('username'))
        ->first();
        if ($request->password_lama != $request->password_baru) {
            if ($request->password_lama == $user->password) {
                pengguna::where('username',$user->username)
                ->update([
                    'password'=>$request->password_baru,
                ]);
                if($user->hak_akses == "user"){
                    return redirect('/pengguna/home')->with('status','Password Berhasil diganti');
                }else{
                    return redirect('/admin/dashboard')->with('status','Password Berhasil diganti');
                }
            }else {
                if($user->hak_akses == "user"){
                    return redirect('/pengguna/home')->with('status','Ganti Password Gagal !!!');
                }else{
                    return redirect('/admin/dashboard')->with('status','Ganti Password Gagal !!!');
                }
            }
        }else{
            if($user->hak_akses == "user"){

                return redirect('/pengguna/home')->with('status','Gagal Password Sama !!!');
            }else{
                return redirect('/admin/dashboard')->with('status','Gagal Password Sama !!!');

            }
        }

        // dd($user);
        
        

    }
}
