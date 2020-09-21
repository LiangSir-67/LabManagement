<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Approval extends Model
{
    protected $table = "approval";
    public $timestamps = true;
    protected $primaryKey = "approval_id";
}
