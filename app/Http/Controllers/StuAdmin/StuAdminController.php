<?php

namespace App\Http\Controllers\StuAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StuAdmin\WriteInfoRequest;
use App\Models\LabOperationRecord;
use Illuminate\Http\Request;

class StuAdminController extends Controller
{
    /**
     * 学生负责人填报实验室运行记录表
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param Request $request
     *      ['weeks'] =>    周次
     *      ['professional_classes'] => 专业班级
     *      ['student_name'] => 学生姓名
     *      ['number'] =>   人数
     *      ['class_name'] =>   课程名称
     *      ['class_type'] =>   课程类型
     *      ['teacher_name'] => 教师姓名
     *      ['device_run_condition'] => 设备运行状况
     *      ['note'] => 备注
     * @return \Illuminate\Http\JsonResponse
     */
    public function writeInfo(WriteInfoRequest $request){
        $weeks = $request['weeks'];
        $p_classes = $request['professional_classes'];
        $s_name = $request['student_name'];
        $s_number = $request['number'];
        $c_name = $request['class_name'];
        $c_type = $request['class_type'];
        $t_name = $request['teacher_name'];
        $drc = $request['device_run_condition'];
        $note = $request['note'];
//        dd($request['']);
        $result =LabOperationRecord::writeInfo(
            $weeks,
            $p_classes,
            $s_name,
            $s_number,
            $c_name,
            $c_type,
            $t_name,
            $drc,
            $note);
        return $result;
    }

    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkAllForm(){
        return LabOperationRecord::checkAllForm();
    }

    public function checkFormByFormId(Request $request){
        $form_id = $request['form_id'];
        return LabOperationRecord::checkFormByFormId($form_id);
    }
}
