<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event_prize extends Model
{
//设置权限
    protected $fillable = ['events_id','name','description','member_id','updated_at'];

    //设置关联
    public function Event(){
        return $this->belongsTo(event::class,'events_id','id');
    }
}
