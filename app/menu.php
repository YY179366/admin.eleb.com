<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class menu extends Model
{
    //添加允许修改和赋值的字段
    protected $fillable = [
        'goods_name',
        'rating',
        'shop_id',
        'category_id',
        'goods_price',
        'description',
        'month_sales',
        'rating_count',
        'tips',
        'satisfy_count',
        'satisfy_rate',
        'goods_img',
        'status',
    ];
    //关联菜品分类和菜品
    public function menucategory()
    {
        return $this->belongsTo('App\MenuCategory','category_id','id');
    }

    //关联菜品和商家信息
    public function Shops()
    {
        return $this->belongsTo('App\Shops','shop_id','id');
    }
}
