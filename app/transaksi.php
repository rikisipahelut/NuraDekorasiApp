<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class transaksi extends Model
{
    protected $table='transaksi'; 
    protected $fillable=['id_transaksi','tgl_transaksi','username','nama_pelanggan','alamat','no_telp','tgl_pemasangan','tgl_selesai','grand_total','bayar','sisa_pembayaran','status','bukti_bayar'];
    public $timestamps=false;
    protected $primaryKey='id_transaksi';
    public $incrementing = false;
}
