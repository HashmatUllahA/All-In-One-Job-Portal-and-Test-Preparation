<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMcqsQuestion extends Model
{
    // use HasFactory;

    protected $fillable = ['department_id','sub_department_id','subject_id', 'question', 'explanation'];

    public function options()
    {
        return $this->hasMany(SubjectMcqsQuestionOption::class, 'question_id');
    }
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id');
    }
}
