<?php

namespace App\Http\Controllers;
use App\Models\Department;
use App\Models\Subject;
use App\Models\SubjectQuiz;
use App\Models\subjectQuizMcqs;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\SubjectMcqsImport;
use Illuminate\Validation\ValidationException;
class SubjectQuizController extends Controller
{
    public function fetchDepartmentForSubjectQuiz(){
        try {
            $departmantRercord = Department::get();
            // dd($DepartmentData);
                        return response()->json($departmantRercord);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    public function selectSubjectForSubjectQuiz(Request $request){
        $department = $request->input('selected_department');
        
        if (!empty($department)) {
            $subjectRectrecord = Subject::where('Department_id', $department)->get();
    
            // dd($subjects);
            return response()->json($subjectRectrecord);
        } else {
            return response()->json('error','department error');
            
        }
    }
    public function saveQuiz(Request $request)
{
    $validatedData = $request->validate([
        'selected_department' => 'required',
        'selected_subject' => 'required',
        'title' => 'required|string',
        'time' => 'required|integer',
    ]);
// dd($validatedData);
    // Create a new quiz with additional fields
    $subjectQuiz = SubjectQuiz::create([
        'Department_id' => $validatedData['selected_department'],
        'subject_id' => $validatedData['selected_subject'],
        'title' => $validatedData['title'],
        'time' => $validatedData['time'],
    ]);

    return response()->json($subjectQuiz, 201);
}
// public function import(Request $request)
//     {
//         try {
//             $file = $request->file('excel_file');
//             Excel::import(new SubjectMcqsImport, $file);

//             return response()->json(['message' => 'Data imported successfully']);
//         } catch (ValidationException $e) {
//             return response()->json(['errors' => $e->errors()], 422);
//         } catch (\Exception $e) {
//             // Handle other exceptions
//             return response()->json(['error' => $e->getMessage()], 500);
//         }
//     }

public function fetchQuiz()
{
    try {
        $QuizRercord = SubjectQuiz::with('Department','Subject')->get();
        // dd($QuizRercord); // Check if this prints the data
        return response()->json(['QuizRercord' => $QuizRercord]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'An error occurred'], 500);
    }
}
public function updateQuiz(Request $request , $id){
    // dd($id, $request->all());
    $request->validate([
        'title' => 'required|string|max:255',
        
    ]);
    $savaQuiz = SubjectQuiz::findOrFail($id);
    $savaQuiz->title = $request->input('title');
    
    $savaQuiz->save();

    return response()->json($savaQuiz, 200);
}
public function deleteQuiz($id)
    {
        try {
            $user = SubjectQuiz::findOrFail($id); // Find the user by ID
            $user->delete(); // Delete the user
            return response()->json(['message' => 'User deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete user'], 500);
        }
    }

//     public function fetchQuizForCreationMcqs()
// {
//     try {
//         $fetchQuizForCreationMcqs = SubjectQuiz::get();
//         // dd($QuizRercord); // Check if this prints the data
//         return response()->json(['fetchQuizForCreationMcqs' => $fetchQuizForCreationMcqs]);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'An error occurred'], 500);
//     }
// }

    // public function createSubjectQuizMcqs(Request $request)
    // {

    //     $validatedData = $request->validate([
    //         'selected_quiz' => 'required',
    //         'Question' => 'required|string',
    //         'OptionA' => 'required|string',
    //         'OptionB' => 'required|string',
    //         'OptionC' => 'required|string',
    //         'OptionD' => 'required|string',
    //         'correctOption' => 'required|string',
    //     ]);
    //     // dd($validatedData);
    //     // Create a new quiz with additional fields
    //     $subjectQuizmcqs = subjectQuizMcqs::create([
    //         'quiz_id' => $validatedData['selected_quiz'],
    //         'Question' => $validatedData['Question'],
    //         'OptionA' => $validatedData['OptionA'],
    //         'OptionB' => $validatedData['OptionB'],
    //         'OptionC' => $validatedData['OptionC'],
    //         'OptionD' => $validatedData['OptionD'],
    //         'correctOption' => $validatedData['correctOption'],
    //     ]);
    
    //     return response()->json($subjectQuizmcqs, 201);
        
    // }
//     public function fetchSubjectQuizMcqs()
// {
//     try {
//         $subjectQuizMcqs = SubjectQuizMcqs::with('quiz')->get();
//         // dd($subjectQuizMcqs);
//         return response()->json(['subjectQuizMcqs' => $subjectQuizMcqs]);
//     } catch (\Exception $e) {
//         return response()->json(['error' => 'An error occurred'], 500);
//     }
// }

// public function updateQuizMcqs(Request $request , $id){
//     // dd($id, $request->all());
//     $request->validate([
//         'Question' => 'required|string|max:255',
//         'OptionA' => 'required|string',
//         'OptionB' => 'required|string',
//         'OptionC' => 'required|string',
//         'OptionD' => 'required|string',
//         'correctOption' => 'required|string',
//     ]);
//     $savarMcqs = SubjectQuizMcqs::findOrFail($id);
//     $savarMcqs->Question = $request->input('Question');
//     $savarMcqs->OptionA = $request->input('OptionA');
//     $savarMcqs->OptionB = $request->input('OptionB');
//     $savarMcqs->OptionC = $request->input('OptionC');
//     $savarMcqs->OptionD = $request->input('OptionD');
//     $savarMcqs->correctOption = $request->input('correctOption');
//     $savarMcqs->save();

//     return response()->json($savarMcqs, 200);
// }

// public function deleteSubjectQuizmcqs($id)
//     {
//         try {
//             $user = SubjectQuizMcqs::findOrFail($id); // Find the user by ID
//             $user->delete(); // Delete the user
//             return response()->json(['message' => 'User deleted successfully']);
//         } catch (\Exception $e) {
//             return response()->json(['error' => 'Failed to delete user'], 500);
//         }
//     }

  
//     public function fetchtables()
// {
//     $tablesdata = DB::table('departments')
//                     ->join('subjects', 'departments.id', '=', 'subjects.Department_id')
//                     ->join('subject_quizzes', 'departments.id', '=', 'subject_quizzes.Department_id')
//                     ->select('departments.title', 'subjects.subject_name', 'subject_quizzes.title')
//                     ->where('subject_quizzes.title' ,'maths quiz')
//                     ->get();

//     // dd($tablesdata);
//     return response()->json(['tablesdata' => $tablesdata]);
// }

    

}
