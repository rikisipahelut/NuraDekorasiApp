<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class pengguna extends Model
{
    protected $table='pengguna'; 
    protected $fillable=['nama_pengguna','alamat_pengguna','no_tlp_pengguna','username','password','hak_akses','aktivasi'];
    public $timestamps=false;
    protected $primaryKey='id_detail';
}
