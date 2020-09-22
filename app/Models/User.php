<?php

namespace App\Models;


use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Notifiable;
use mysql_xdevapi\Exception;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends \Illuminate\Foundation\Auth\User implements JWTSubject,Authenticatable
{
    use Notifiable;

    public $table = 'user';

    protected $rememberTokenName = NULL;

    protected $guarded = [];

    protected $hidden = [
        'password',
    ];

    public function getJWTCustomClaims()
    {
        return [];
    }
    public function getJWTIdentifier()
    {
        return self::getKey();
    }

    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $work_id
     * @return mixed
     */
    public static function selectUserInfo($work_id){
        try {
            return User::where('work_id',$work_id) -> get();
        }catch (\Exception $e){
            logError("获取信息失败！",[$e -> getMessage()]);
        }

    }

    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $work_id
     * @param $old_password
     * @param $new_password
     * @return \Illuminate\Http\JsonResponse
     */
    public static function updatePassword($work_id,$old_password,$new_password){
        try {
            $data = self::selectUserInfo($work_id);
            if (password_verify($old_password,$data[0] -> password) == 1){
                //修改密码
                User::where('work_id',$work_id) -> update([
                    'password' => bcrypt($new_password)
                ]);
                return json_success("修改密码成功",null,200);
            }else{
                //返回失败
                return json_success("修改密码失败",null,100);
            }
        }catch (\Exception $e){
            logError("修改密码失败！",[$e -> getMessage()]);
        }
    }


}
