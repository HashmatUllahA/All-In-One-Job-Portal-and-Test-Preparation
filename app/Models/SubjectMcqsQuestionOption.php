<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubjectMcqsQuestionOption extends Model
{
    // use HasFactory;
    protected $fillable = ['question_id', 'option', 'is_correct'];
}
