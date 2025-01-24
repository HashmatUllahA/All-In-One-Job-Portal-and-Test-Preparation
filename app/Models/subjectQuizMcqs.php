<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subjectQuizMcqs extends Model
{
    use HasFactory;
    protected $fillable = [
        'quiz_id',
        'Question',
        'OptionA',
        'OptionB',
        'OptionC',
        'OptionD',
        'correctOption',
    ];
    // public function SubjectQuiz(){
    //     {
    //         return $this->belongsTo(SubjectQuiz::class, 'Quiz_id');
    //     }
    // }
    public function quiz()
    {
        return $this->belongsTo(SubjectQuiz::class, 'quiz_id');
    }
}
