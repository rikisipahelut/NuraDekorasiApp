<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Pengguna_Controller;
use App\Http\Controllers\Guest_Controller;
use App\Http\Controllers\Auth_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::middleware('admin')->group(function(){
// ========================Admin=====================================
Route::get('/admin/dashboard',[Admin_Controller::class,'dashboard']);
Route::get('/admin/daftar_barang',[Admin_Controller::class,'daftar_barang']);
Route::get('/admin/data_pengguna',[Admin_Controller::class,'data_pengguna']);
Route::get('/admin/form_tambah_barang',[Admin_Controller::class,'form_tambah_barang']);
Route::post('/admin/form_tambah_barang',[Admin_Controller::class,'store_barang']);
Route::get('/admin/form_ubah_barang/{barang}',[Admin_Controller::class,'ubah_barang']);
Route::patch('/admin/update_barang/{barang}',[Admin_Controller::class,'update_barang']);
Route::delete('/admin/hapus_barang/{barang}',[Admin_Controller::class,'destroy_barang']);
Route::get('/admin/daftar_harga',[Admin_Controller::class,'daftar_harga']);
Route::get('/admin/form_tambah_harga/{barang}',[Admin_Controller::class,'form_tambah_harga']);
Route::post('/admin/form_tambah_harga',[Admin_Controller::class,'store_harga']);
Route::get('/admin/form_transaksi',[Admin_Controller::class,'form_transaksi']);
Route::post('/admin/detail_transaksi',[Admin_Controller::class,'detail_transaksi']);
Route::post('/admin/transaksi',[Admin_Controller::class,'transaksi']);
Route::delete('/admin/hapus_transaksi/{transaksi}',[Admin_Controller::class,'destroy_transaksi']);
Route::get('/admin/form_ubah_harga/{harga}',[Admin_Controller::class,'ubah_harga']);
Route::patch('/admin/update_harga/{harga}',[Admin_Controller::class,'update_harga']);
Route::delete('/admin/hapus_harga/{harga}',[Admin_Controller::class,'destroy_harga']);
Route::delete('/admin/hapus_detail_transaksi/{detail_transaksi}',[Admin_Controller::class,'destroy_detail_transaksi']);
Route::get('/admin/data_transaksi',[Admin_Controller::class,'data_transaksi']);
Route::get('/admin/data_detail_transaksi/{id_transaksi}',[Admin_Controller::class,'data_detail_transaksi']);
Route::patch('/admin/konfirm_transaksi/{id_transaksi}',[Admin_Controller::class,'update_transaksi']);
Route::get('/admin/logout',[Auth_Controller::class,'logout']);
Route::post('/admin/cetak_pdf',[Admin_Controller::class,'cetak_pdf']);
Route::post('/admin/ganti_password',[Auth_Controller::class,'ganti_password']);
Route::get('/admin/form_gallery',[Admin_Controller::class,'form_gallery']);
Route::post('/admin/tambah_gallery',[Admin_Controller::class,'tambah_gallery']);
Route::get('/admin/details_gallery',[Admin_Controller::class,'details_gallery']);
Route::delete('/admin/hapus_gallery/{id}',[Admin_Controller::class,'destroy_gallery']);
Route::get('/admin/form_pembayaran',[Admin_Controller::class,'form_pembayaran']);
});

Route::middleware('pengguna')->group(function(){
// ==========================Pengguna=======================================================
Route::get('/pengguna/home',[Pengguna_Controller::class,'home']);
Route::post('/pengguna/detail_transaksi',[Pengguna_Controller::class,'detail_transaksi']);
Route::get('/pengguna/data_detail_transaksi',[Pengguna_Controller::class,'data_detail_transaksi']);
Route::post('/pengguna/transaksi',[Pengguna_Controller::class,'transaksi']);
Route::get('/pengguna/history_transaksi',[Pengguna_Controller::class,'history_transaksi']);
Route::delete('/pengguna/hapus_detail_transaksi/{detail_transaksi}',[Pengguna_Controller::class,'destroy_detail_transaksi']);
Route::post('/pengguna/ganti_password',[Auth_Controller::class,'ganti_password']);
Route::get('/pengguna/gallery',[pengguna_Controller::class,'gallery']);
Route::get('/pengguna/form_pembayaran',[pengguna_Controller::class,'form_pembayaran']);
});

// ==========================Guest==========================================================
Route::get('/',[Guest_Controller::class,'home']);
Route::post('/guest/daftar_akun',[Guest_Controller::class,'daftar_akun']);
Route::post('/guest/login',[Auth_Controller::class,'login']);
Route::get('/gallery',[Guest_Controller::class,'gallery']);

// ==========================EMAIL==========
Route::post('/lupa_password',[Guest_Controller::class,'send_password']);
Route::get('/aktifasi/{email}/{token}',[Auth_Controller::class,'aktivasi']);



