<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    protected $fillable = ['username','password','tel','rememberToken','created_at','updated_at','status'];
}
