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
     * 查询指定的用户
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $work_id  工号
     * @return mixed
     */
    public static function selectUserInfo(){
//        $work_id = Auth -> id;
        $work_id = '1011001';
        try {
            return User::where('work_id',$work_id) -> get();
        }catch (\Exception $e){
            logError("获取信息失败！",[$e -> getMessage()]);
        }
    }

    /**
     * 修改用户密码
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $old_password 旧密码
     * @param $new_password 新密码
     * @return \Illuminate\Http\JsonResponse
     */
    public static function updatePassword($old_password,$new_password){
        //        $work_id = Auth -> id;
        $work_id = '1011001';

        $data = self::selectUserInfo();
        if (count($data)){
            try {
                if (password_verify($old_password,$data[0] -> password) == 1){
                    //修改密码
                    User::where('work_id',$work_id) -> update([
                        'password' => bcrypt($new_password)
                    ]);
                    return json_success("修改密码成功！",null,200);
                }else{
                    //返回失败
                    return json_fail("修改密码失败！",null,100);
                }
            }catch (\Exception $e){
                logError("修改密码失败！",[$e -> getMessage()]);
            }
        }else{
            return json_fail("该用户不存在！",null,100);
        }

    }

    /**
     * 获取用户个人信息
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $id   工号
     * @return \Illuminate\Http\JsonResponse
     */
    public static function getUserInfo(){
        //        $work_id = Auth -> id;
        $work_id = '1011001';

        $data = User::join('user_info','user_info.user_id','=','user.work_id')
            -> join('permissions','permissions.permission_id','=','user.permission_id')
            -> where('user.work_id',$work_id)
            -> select('user_info.name','permissions.type','user.work_id','user_info.email','user_info.phone')
            -> get();
        if (count($data)){
            $result = [
                'name' => $data[0] -> name,
                'type' => $data[0] -> type,
                'work_id' => $data[0] -> work_id,
                'email' => $data[0] -> email,
                'phone' => $data[0] -> phone
            ];
            return json_success("获取个人信息成功！",$result,200);
        }else{
            return json_fail("获取个人信息失败！",null,100);
        }
    }
}













































