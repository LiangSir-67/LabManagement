<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabOperationRecord extends Model
{
    protected $table = "lab_operation_records";
    public $timestamps = true;
    protected $primaryKey="from_id";

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
//        $work_id = Auth -> id;
        $work_id = '1011002';
        $data = self::selectUserInfo($work_id);
        //查询当前用户是否存在
        if (count($data)){
            return json_success("当前用户已存在！",null,100);
        }else{
            //插入操作
            $form_id = 'D'.date("ymdis");
            LabOperationRecord::insert([
                'form_id' => $form_id,
                'work_id' => '1011002',
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
}
