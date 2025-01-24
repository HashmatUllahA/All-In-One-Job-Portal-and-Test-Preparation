<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestSyllabus extends Model
{
    use HasFactory;
    protected $fillable = [
        'Department_id',
        'description',
        'marks',
        // 'syllabus_image',
       
    ];
    public function Department(){
        return $this->belongsTo(Department::class, 'Department_id');
    }
}
