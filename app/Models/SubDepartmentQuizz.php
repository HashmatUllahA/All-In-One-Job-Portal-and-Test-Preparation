<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartmentQuizz extends Model
{
    protected $fillable = [
        'title', 'department_id','sub_department_id'
    ];
}
