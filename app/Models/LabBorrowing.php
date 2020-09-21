<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LabBorrowing extends Model
{
    protected $table = "lab_borrowing";
    public $timestamps = true;
    protected $primaryKey = "form_id";
}
