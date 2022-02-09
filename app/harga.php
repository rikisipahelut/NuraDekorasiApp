<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class harga extends Model
{
    protected $table='harga';
    protected $fillable=['id_barang','kategori','ukuran','harga'];
    public $timestamps=false;
    // protected $primaryKey='id';
    // public $incrementing = false;
}
