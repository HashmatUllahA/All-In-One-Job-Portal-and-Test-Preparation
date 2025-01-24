<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectQuiz extends Model
{
    use HasFactory;
    protected $fillable = ['Department_id', 'subject_id', 'title', 'time'];

    public function Department()
    {
        return $this->belongsTo(Department::class, 'Department_id');
    }

    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
