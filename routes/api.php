<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * @author LiangXiaoye <github.com/LiangSir-67>
 */
Route::group(['prefix' => 'userinfo'],function (){
    Route::post('changepassword','UserInfo\UserController@changePassword'); //修改密码
    Route::post('changephone','UserInfo\UserController@changePhone');   //修改电话号码
    Route::get('getuserinfo','UserInfo\UserController@getUserInfo');    //获取用户信息
});

Route::group(['prefix' => 'stuadmin'],function (){
    Route::post('writeinfo','StuAdmin\StuAdminController@writeInfo');
});
