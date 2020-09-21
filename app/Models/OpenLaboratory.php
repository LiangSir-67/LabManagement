<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OpenLaboratory extends Model
{
    protected $table = "open_laboratory";
    public $timestamps = true;
    protected $primaryKey = "form_id";
}
