<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//添加商家分类;
Route::get('/shop_catagory/add','Shop_catagoryController@add')->name('catagory');
Route::post('/shop_catagory/saveadd','shop_catagoryController@saveadd')->name('shop_catagory.saveadd');
//商家列表
Route::get('/shop_catagory/index','Shop_catagoryController@index')->name('shopcatagory.index');
//删除商家列表
Route::get('/shop_catagory/destroy/{catagory}','Shop_catagoryController@destroy')->name('shop_catagory.destroy');
//修改
Route::get('/shopcatagory/edit/{catagory}','Shop_catagoryController@edit')->name('shop_catagory.edit');
Route::post('/shopcatagory/update/{catagory}','Shop_catagoryController@update')->name('shop_catagory.update');
//商家信息表
Route::resource('shop','ShopController');
//商家账号
Route::resource('user','UserController');
Route::get('/user/edit/{shops}','UserController@edit')->name('user.edit');
Route::post('/user/update/{shops}','UserController@update')->name('user.update');
//登录
Route::get('login','SessionController@login')->name('login');
//验证
Route::post('login','SessionController@store')->name('login');
//注销
Route::delete('logout','SessionController@logout')->name('logout');
//管理员
Route::get('admin_change','AdminController@change')->name('admin.change');
Route::post('admin_change','AdminController@change_save')->name('admin.change');
Route::resource('admin','AdminController');
//商家账号的修改状态
Route::get('/shop_user/{shop_user}','userController@status')->name('shop_user.status');
//重置商家密码

Route::get('/user/reset/{user}','UserController@reset')->name('user.reset');
Route::post('shop_user_save','UserController@reset_save')->name('user.reset_save');
//菜品分类
Route::resource('menucategory','MenuCategoryController');
//菜品
Route::resource('menu','MenuController');