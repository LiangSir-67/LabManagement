<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApprovalStatus extends Model
{
    protected $table = "approval_status";
    public $timestamps = true;
    protected $primaryKey = "id";
}
