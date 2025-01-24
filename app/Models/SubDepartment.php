<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartment extends Model
{
    // use HasFactory;
    protected $fillable = [
        'title', 'department_id', 'bps_skill'
    ];

    public function subject()
    {
        return $this->hasMany(Subject::class, 'sub_department_id');
    }
}
