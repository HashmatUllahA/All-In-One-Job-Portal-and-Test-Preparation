<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;
    protected $fillable = ['subject_name', 'Department_id', 'sub_department_id'];

    public function Department()
    {
        return $this->belongsTo(Department::class, 'Department_id');
    }

    public function subdepartment()
    {
        return $this->belongsTo(SubDepartment::class, 'sub_department_id');
    }

    
}
