<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //测试方法

    /**
     * @author LiangXiaoye <github.com/LiangSir-67>
     * @param $a
     * @param $b
     * @return mixed
     */
    public function test($a,$b){
        return $a+$b;
    }
}
