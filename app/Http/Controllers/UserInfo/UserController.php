<?php

namespace App\Http\Controllers\UserInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfo\ChangePasswordRequest;
use App\Http\Requests\UserInfo\ChangePhoneRequest;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 用户修改密码
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param Request $request
     *      ['work_id'] => 工号
     *      ['old_password'] => 旧密码
     *      ['new_password'] => 新密码
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request){
        $old_password = $request['old_password'];
        $new_password = $request['new_password'];
        $result = User::updatePassword($old_password,$new_password);
        return $result;
    }


    /**
     * 用户修改电话
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param Request $request
     *      ['work_id'] => 工号
     *      ['old_phone'] => 旧电话号码
     *      ['new_phone'] => 新电话号码
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePhone(ChangePhoneRequest $request){
        $old_phone = $request['old_phone'];
        $new_phone = $request['new_phone'];
        $result = UserInfo::updatePhone($old_phone,$new_phone);
        return $result;
    }

    /**
     * 获取用户个人信息
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserInfo(){
        return User::getUserInfo();
    }
}
