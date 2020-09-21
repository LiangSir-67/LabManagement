<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabOperationRecord extends Model
{
    protected $table = "lab_operation_records";
    public $timestamps = true;
    protected $primaryKey = "form_id";
}
