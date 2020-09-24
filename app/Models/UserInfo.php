<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = "user_info";
    public $timestamps = true;
    protected $primaryKey = "id";

    /**
     * 查询指定的用户
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $user_id  工号
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
     * 修改用户电话号码
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $old_phone    旧电话号码
     * @param $new_phone    新电话号码
     * @return \Illuminate\Http\JsonResponse
     */
    public static function updatePhone($old_phone,$new_phone){
//        $work_id = auth('api') -> user() -> work_id;
        $user_id = '1011001';
        $data = UserInfo::selectUserInfo($user_id);
        if (count($data)){
            try {
                if (strcmp($data[0] -> phone,$old_phone) == 0){
                    UserInfo::where('user_id',$user_id) -> update([
                        'phone' => $new_phone
                    ]);
                    return json_success("修改电话成功！",null,200);
                }else{
                    return json_fail("修改电话失败！",null,100);
                }
            }catch (\Exception $e){
                logError("修改用户电话失败！",$e -> getMessage());
            }
        }else{
            return json_fail("该用户不存在！",null,100);
        }
    }
}
