<?php

namespace App\Http\Controllers\UserInfo;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserInfo\ChangePasswordRequest;
use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePassword(Request $request){
        $work_id = $request['work_id'];
        $old_password = $request['old_password'];
        $new_password = $request['new_password'];
        $result = User::updatePassword($work_id,$old_password,$new_password);
        return $result;
    }


    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function changePhone(Request $request){
        $user_id = $request['work_id'];
        $old_phone = $request['old_phone'];
        $new_phone = $request['new_phone'];
        $result = UserInfo::updatePhone($user_id,$old_phone,$new_phone);
        return $result;
    }

    public function getUserInfo(){

    }
}
