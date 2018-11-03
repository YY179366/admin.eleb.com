<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shop extends Model
{
//设置权限
    protected $fillable = ['shop_category_id','shop_name','shop_img','shop_rating','brand','on_time','fengniao','bao','piao','zhun','start_send','send_cost','notice','discount','status','created_at','updated_at'];

    //关联店铺分类
    public function Shop_category(){
        return $this->belongsTo(shop_catagory::class,'shop_category_id','id');
    }

    //关联用户名
    public function user(){
        return $this->belongsTo(user::class,'shop_id','id');
    }

}
