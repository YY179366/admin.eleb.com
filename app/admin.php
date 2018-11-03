<?php

namespace App;
use Illuminate\Foundation\Auth\user as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class admin extends Authenticatable
{
    protected $fillable = ['name','email','password','updated_at','created_at','rememberToken'];
}
