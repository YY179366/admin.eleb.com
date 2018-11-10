<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['title','content','signup_start','signup_end','prize_date','signup_num','is_prize','created_at','updated_at'];
}
