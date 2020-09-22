<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = "user_info";
    public $timestamps = true;
    protected $primaryKey = "id";

    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $user_id
     * @return mixed
     */
    public static function selectUserInfo($user_id){
        try {
            return UserInfo::where('user_id',$user_id) -> get();
        }catch (\Exception $e){
            logError("获取信息失败！",[$e -> getMessage()]);
        }

    }

    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $user_id
     * @param $old_phone
     * @param $new_phone
     * @return \Illuminate\Http\JsonResponse
     */
    public static function updatePhone($user_id,$old_phone,$new_phone){
        try {
            $data = UserInfo::selectUserInfo($user_id);
            if (strcmp($data[0] -> phone,$old_phone) == 0){
                UserInfo::where('user_id',$user_id) -> update([
                    'phone' => $new_phone
                ]);
                return json_success("修改电话成功！",null,200);
            }else{
                return json_success("修改电话失败！",null,100);
            }
        }catch (\Exception $e){
            logError("修改用户电话失败！",$e -> getMessage());
        }
    }
}
