<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class detail_transaksi extends Model
{
    protected $table='detail_transaksi'; 
    protected $fillable=['id_transaksi','id_barang','nama_barang','harga','qty','subtotal','pembeli'];
    public $timestamps=false;
    protected $primaryKey='id_detail';
   
}
