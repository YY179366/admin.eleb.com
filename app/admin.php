<?php

namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
class admin extends Authenticatable
{
    protected $fillable = ['name','email','password','updated_at','created_at','rememberToken'];


    use Notifiable;
    use HasRoles;
    protected $guard_name = 'web'; // or whatever guard you want to use
}
