<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event_member extends Model
{
    //设置关联
    public function Event(){
        return $this->belongsTo(event::class,'events_id','id');
    }

    //设置用户管理
    public function Shop_user(){
        return $this->belongsTo(User::class,'member_id','id');
    }
}
