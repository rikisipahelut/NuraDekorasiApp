<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// Penambahan untuk Auth
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class auth extends Model implements AuthenticatableContract
{
 
    use Authenticatable;
    protected $table='pengguna';
    // protected $fillable=['USERNAME','PASSWORD','HAK_AKSES'];
    public $timestamps=false;
    protected $primaryKey ='id_pengguna';

    // penambahan untuk auth
    protected $guard='login';
    protected $guarded =[];
}
