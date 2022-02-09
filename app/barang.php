<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class barang extends Model
{
    protected $table='barang'; 
    protected $fillable=['id_barang','nama_barang','harga_barang','ketersediaan_barang','foto_barang'];
    public $timestamps=false;
    protected $primaryKey='id_barang';
    public $incrementing = false;
}
