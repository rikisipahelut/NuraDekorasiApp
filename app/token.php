<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class token extends Model
{
    //
    protected $table='token'; 
    protected $fillable=['email','token'];
    public $timestamps=false;
    public $incrementing = false;
    protected $primaryKey='email';
}
