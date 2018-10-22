<?php
namespace App;
use App\Http\Controllers\ShopController;
use App\shop;
use App\Http\Controllers\Shop_catagoryController;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','rememberToken','status','shop_id','status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //设置关联
    public function Shop(){
        return $this->belongsTo(shop::class,'shop_id','id');
    }


}
