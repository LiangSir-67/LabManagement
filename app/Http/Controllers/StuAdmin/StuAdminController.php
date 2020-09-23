<?php

namespace App\Http\Controllers\StuAdmin;

use App\Http\Controllers\Controller;
use App\Models\LabOperationRecord;
use Illuminate\Http\Request;

class StuAdminController extends Controller
{
    public function writeInfo(Request $request){
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
}
