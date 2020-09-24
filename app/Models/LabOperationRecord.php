<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\Array_;

class LabOperationRecord extends Model
{
    protected $table = "lab_operation_records";
    public $timestamps = true;

    /**
     * 查询当前用户是否存在
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $work_id
     * @return mixed
     */
    public static function selectUserInfo($work_id){
        try {
            return LabOperationRecord::where('work_id',$work_id) -> get();
        }catch (\Exception $e){
            logError("获取信息失败！",[$e -> getMessage()]);
        }
    }

    /**
     * 实验室运行记录表的填报
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $weeks        周次
     * @param $p_classes    专业班级
     * @param $s_name       学生姓名
     * @param $s_number     人数
     * @param $c_name       课程名称
     * @param $c_type       课程类型
     * @param $t_name       任课教师
     * @param $drc          设备运行情况
     * @param $note         备注
     * @return \Illuminate\Http\JsonResponse
     */
    public static function writeInfo($weeks,$p_classes,$s_name,$s_number,$c_name,$c_type,$t_name,$drc,$note){
//        $work_id = auth('api') -> user() -> work_id;
        $work_id = '1011001';
        $data = self::selectUserInfo($work_id);
        //查询当前用户是否存在
        if (count($data)){
            return json_fail("当前用户已存在！",null,100);
        }else{
            //插入操作
            $form_id = 'D'.date("ymdis");
            LabOperationRecord::insert([
                'form_id' => $form_id,
                'work_id' => '1011001',
                'weeks' => $weeks,
                'professional_classes' => $p_classes,
                'student_name' => $s_name,
                'number' => $s_number,
                'class_name' => $c_name,
                'class_type' => $c_type,
                'teacher_name' => $t_name,
                'device_run_condition' => $drc,
                'note' => $note
            ]);
            return json_success("插入成功！",null,200);
        }
    }

    /**
     * 查询所有的实验室运行记录表
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @return \Illuminate\Http\JsonResponse
     */
    public static function checkAllForm(){
        $result = LabOperationRecord::all();
        return count($result)?
            json_success("成功",$result,200)
            : json_fail("无数据！",null,100);
    }

    /**
     * 查看指定的实验室运行记录表
     * @author LiangXiaoye <github.com/LiangSir-67>
     */
    public static function checkFormByFormId($form_id){
        $result = LabOperationRecord::where('form_id',$form_id) -> get();
        return count($result)?
            json_success("成功",$result,200)
            :json_fail("失败",null,100);
    }

    /**
     * 修改实验室运行记录表
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $form_id  表单编号
     * @param $weeks    周次
     * @param $p_classes    专业班级
     * @param $s_name   学生姓名
     * @param $s_number 人数
     * @param $c_name   课程名称
     * @param $c_type   课程类型
     * @param $t_name   教师姓名
     * @param $drc  设备运行状况
     * @param $note 备注
     * @return \Illuminate\Http\JsonResponse
     */
    public static function updateFormByFormId($form_id,$weeks,$p_classes,$s_name,$s_number,$c_name,$c_type,$t_name,$drc,$note){
        $data = LabOperationRecord::where('form_id',$form_id) -> get();
        $creat_time = strtotime($data[0] -> created_at);
        $now_time = date(time());
        $interval_time = $now_time - $creat_time;
        $one_hour = 60*60*24;
        if ($interval_time <= $one_hour){
            if (count($data)){
                try {
                    LabOperationRecord::
                    where('form_id',$form_id)
                        -> update([
                            'work_id' => '1011001',
                            'weeks' => $weeks,
                            'professional_classes' => $p_classes,
                            'student_name' => $s_name,
                            'number' => $s_number,
                            'class_name' => $c_name,
                            'class_type' => $c_type,
                            'teacher_name' => $t_name,
                            'device_run_condition' => $drc,
                            'note' => $note
                        ]);
                    $data = LabOperationRecord::where('form_id',$form_id) -> get();
                    return json_success("修改成功",$data,200);
                }catch (\Exception $e){
                    return json_fail("修改失败",null,100);
                }
            }else{
                return json_fail("该用户不存在",null,100);
            }
        }else{
            return json_fail("时间已超过24小时，修改失败！",null,100);
        }
    }
}
