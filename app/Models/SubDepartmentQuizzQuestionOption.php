<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubDepartmentQuizzQuestionOption extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'option', 'is_correct'];
    
    public function question()
    {
        return $this->belongsTo(SubDepartmentQuizzQuestion::class, 'question_id');
    }
}
