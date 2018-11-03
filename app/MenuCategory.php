<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    protected $fillable=['name','created_at','shop_id','updated_at','type_accumulation','description','is_selected'];

    public function User()
    {
        return $this->belongsTo(User::class, 'id','shop_id');
    }
}
