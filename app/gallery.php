<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    protected $table='gallery'; 
    protected $fillable=['nama_barang','foto_barang'];
    public $timestamps=false;
    protected $primaryKey='id';
    public $incrementing = false;
}
