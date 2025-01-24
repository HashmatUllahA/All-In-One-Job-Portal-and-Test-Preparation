<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubDepartmentQuizz;
use App\Models\Department;
use App\Models\SubDepartment;
use App\Models\SubDepartmentQuizzQuestion;
use App\Models\SubDepartmentQuizzQuestionOption;
class SubDepartmentQuizController extends Controller
{
    public function createQuiz(Request $request)
    {
        // dd($request);
        $request->validate([
            'title' => 'required|string|max:255',
            'department_id' => 'required',
            'sub_department_id' => 'required',
        ]);

        $quiz = SubDepartmentQuizz::create([
            'title' => $request->title,
            'department_id' => $request->department_id,
            'sub_department_id' => $request->sub_department_id,
        ]);

        return response()->json([
            'message' => 'Quiz created successfully!',
            'quiz' => $quiz
        ], 201);
    }

    public function getDepartmentQuizzes(Request $request)
    {
        if ($request->department_id != null && $request->sub_department_id == null) {
            $quizzes = SubDepartmentQuizz::where('department_id', $request->department_id)
                ->get();
        } elseif ($request->department_id != null && $request->sub_department_id != null) {
            $quizzes = SubDepartmentQuizz::where('department_id', $request->department_id)
                ->where('sub_department_id', $request->sub_department_id)
                ->get();
        } else {
            $quizzes = SubDepartmentQuizz::get();
        }
    
        return response()->json($quizzes);
    }

    public function deleteDepartmentQuiz($quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        
        if ($quiz) {
            $questions = QuizQuestion::where('quiz_id', $quiz_id)->get();
            foreach ($questions as $question) {
                QuestionOption::where('question_id', $question->id)->delete();
                $question->delete();
            }
            $quiz->delete();
            return response()->json([
                'message' => 'Quiz and its questions deleted successfully!'
            ]);
        } else {
            return response()->json([
                'message' => 'Quiz not found!'
            ], 404);
        }
    }

    public function getDepartmentForQuizzes(){
        

        $departmentInfo = Department::get();
        // dd($departmentInfo);
        return response()->json($departmentInfo);
    }

    public function getSubDepartmentForQuizze($departmentId){
        $subDepartmentInfo = SubDepartment::where('department_id', $departmentId)->get();
        return response()->json($subDepartmentInfo);

    }

    public function CreatQuestion(Request $request)
    {
        $validatedData = $request->validate([
            'question' => 'required|string|max:255',
            'options' => 'required|array',
            'options.*.option' => 'required|string|max:255',
            'selectedOption' => 'nullable|integer',
            'marks' => 'nullable|integer',
            'quiz_id' => 'required|integer|exists:sub_department_quizzs,id' 
        ]);
    
        // Create the question
        $question = SubDepartmentQuizzQuestion::create([
            'question' => $validatedData['question'],
            'quiz_id' => $validatedData['quiz_id'],
            'marks' => $validatedData['marks']
        ]);
    
        // Create the options
        foreach ($validatedData['options'] as $index => $optionData) {
            $isCorrect = ($index == $validatedData['selectedOption']);
            SubDepartmentQuizzQuestionOption::create([
                'question_id' => $question->id,
                'option' => $optionData['option'],
                'is_correct' => $isCorrect
            ]);
        }
    
        return response()->json([
            'message' => 'Question and options saved successfully!'
        ]);
    }
    
    public function GetQuestion($quizId){
        $Quiz = SubDepartmentQuizz::where('id', $quizId)->first();
        $Qquestions = SubDepartmentQuizzQuestion::with('options')->where('quiz_id',$quizId)->get();
        // dd($Qquestions);
        return response()->json(['Qquestions' => $Qquestions , 'Quiz' => $Quiz]);
    }

    public function deleteQuestion($questionId)
    {
        
        $question = SubDepartmentQuizzQuestion::find($questionId);
        // dd($question);
        if ($question) {
            SubDepartmentQuizzQuestionOption::where('question_id', $questionId)->delete();
            $question->delete();

            return response()->json([
                'message' => 'Question and its options deleted successfully!'
            ]);
        } else {
            return response()->json([
                'message' => 'Question not found!'
            ], 404);
        }
    }
}
