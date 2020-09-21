<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EquipmentBorrowList extends Model
{
    protected $table = "equipment_borrow_list";
    public $timestamps = true;
    protected $primaryKey = "id";
}
