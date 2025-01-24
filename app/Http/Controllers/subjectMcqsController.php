<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Subject;

use App\Models\SubjectMcqsQuestion;
use App\Models\SubjectMcqsQuestionOption;
use App\Models\SubDepartment;

use App\Imports\SubjectMcqsImport;

use Maatwebsite\Excel\Facades\Excel;
class subjectMcqsController extends Controller
{
    public function fetchDepartmentForSubject(){
        try {
            $departmantRercord = Department::get();
            // dd($DepartmentData);
                        return response()->json($departmantRercord);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    public function selectSubjectFormcqsQuestion($sub_department_id){
            $subjectRectrecord = Subject::where('sub_department_id', $sub_department_id)->get();
            if($subjectRectrecord){
                return response()->json($subjectRectrecord);

            }
         else {
            return response()->json('error','department error');
            
        }
    }

    public function saveSubjectMcqs(Request $request)
{
    // dd($request);
    // Validate the incoming request
    $request->validate([
        'subject_id' => 'required|exists:subjects,id',
        'Question' => 'required|string',
        'options' => 'required|array',
        'options.*.text' => 'required|string',
        'options.*.is_correct' => 'required|boolean',
        'explanation' => 'nullable|string',
        'selected_department' => 'required|exists:departments,id', // Added validation for selected_department
    ]);

    // Check the value of selected_department
    // dd($request->selected_department);

    // Create the MCQ question
    $question = SubjectMcqsQuestion::create([
        'department_id' => $request->selected_department,
        'subject_id' => $request->subject_id,
        'question' => $request->Question,
        'explanation' => $request->explanation,
        'sub_department_id' => $request->sub_department_selected_id,
    ]);

    // Create the MCQ options
    foreach ($request->options as $option) {
        SubjectMcqsQuestionOption::create([
            'question_id' => $question->id,
            'option' => $option['text'],
            'is_correct' => $option['is_correct'],
        ]);
    }

    // Return success response
    return response()->json(['message' => 'MCQ added successfully!'], 201);
}


        public function fetchSubjectMcqs(Request $request){
            // dd($request);
            if($request->department_id != null && $request->sub_department_id == null && $request->subject_id == null ){
                $subject_mcqs_questions = SubjectMcqsQuestion::with('options','subject')
                ->where('department_id', $request->department_id)->get();
                return response()->json($subject_mcqs_questions);
            }
            elseif( $request->department_id != null && $request->sub_department_id != null && $request->subject_id == null){
                $subject_mcqs_questions = SubjectMcqsQuestion::with('options','subject')
                ->where('department_id', $request->department_id)
                ->where('sub_department_id', $request->sub_department_id)->get();
                return response()->json($subject_mcqs_questions);
            }
            elseif( $request->department_id != null && $request->sub_department_id != null && $request->subject_id != null){
                // dd('subject not null');
                $subject_mcqs_questions = SubjectMcqsQuestion::with('options','subject')
                ->where('department_id', $request->department_id)
                ->where('sub_department_id', $request->sub_department_id)->where('subject_id', $request->subject_id)->get();
                return response()->json($subject_mcqs_questions);
            }
            else{
                $subject_mcqs_questions = SubjectMcqsQuestion::with('options','subject')->get();
                return response()->json($subject_mcqs_questions);
            }
                
        }

        // public function updateSubjectMcqs(Request $request, $questionId) {
        //     $question = SubjectMcqsQuestion::findOrFail($questionId);
        //     $question->question = $request->question;
        //     $question->explanation = $request->explanation;
        //     $question->save();
        
        //     foreach ($request->options as $optionData) {
        //         $option = SubjectMcqsQuestionOption::findOrFail($optionData['id']);
        //         $option->option = $optionData['option'];
        //         $option->is_correct = $optionData['is_correct'] ? 1 : 0;
        //         $option->save();
        //     }
        
        //     return response()->json(['message' => 'MCQ updated successfully!']);
        // }

        public function updateSubjectMcqs(Request $request, $id) {
            $subjectMcqsQuestion = SubjectMcqsQuestion::findOrFail($id);
        
            // Update the question itself if needed
            $subjectMcqsQuestion->question = $request->input('question');
            $subjectMcqsQuestion->explanation = $request->input('explanation');
        
            // Update options
            $options = $request->input('options');
            foreach ($options as $optionData) {
                $option = SubjectMcqsQuestionOption::findOrFail($optionData['id']);
                $option->option = $optionData['option'];
                $option->is_correct = $optionData['is_correct'];
                $option->save();
            }
        
            // Save the updated question
            $subjectMcqsQuestion->save();
        
            return response()->json(['message' => 'MCQs updated successfully']);
        }
        

        public function deleteSubjectMcqs($questionId)
        {
            $question = SubjectMcqsQuestion::findOrFail($questionId);
            
            if (!$question) {
                return response()->json(['error' => 'Question not found'], 404);
            }
        
            $options = SubjectMcqsQuestionOption::where('question_id', $questionId)->get();
            foreach ($options as $option) {
                $option->delete();
            }
            $question->delete();
            return response()->json(['message' => 'MCQ deleted successfully'], 200);
        }
        

        public function importSubjectMcqs(Request $request)
        {
            {
                try {
                    $file = $request->file('excel_file');
                    // dd($file);
                    Excel::import(new SubjectMcqsImport, $file);
        
                    return response()->json(['message' => 'Data imported successfully']);
                } catch (ValidationException $e) {
                    return response()->json(['errors' => $e->errors()], 422);
                } catch (\Exception $e) {
                    // Handle other exceptions
                    return response()->json(['error' => $e->getMessage()], 500);
                }
        }
    }

           

        public function SubjectmsqcByDepartment($departmentId, $subjectId)
        {
            // dd($subjectId);
            $department = Department::findOrFail($departmentId);
            $subjectMcqs = SubjectMcqs::where('Department_id', $departmentId)
                                        ->where('subject_id', $subjectId)
                                        ->get();
            
            return response()->json([
                'departmentTitle' => $department->title,
                'subjectMCQs' => $subjectMcqs
            ]);
        }
        public function getSubjects($departmentId)
        {
            $DepatmentSubject =  Subject::where('Department_id', $departmentId)->get();
            // dd($DepatmentSubject);
            return response()->json($DepatmentSubject);
        }

            


        public function subjectMcqsForUser(Request $request, $subject) {
            $subject = Subject::where('subject_name', $subject)->first();
        
            if ($subject) {
                // Retrieve the page parameter from the request
                $mcqs = SubjectMcqsQuestion::with('options')->where('subject_id', $subject->id)->paginate(10);
                return response()->json(['subject' => $subject, 'mcqs' => $mcqs]);
            } else {
                return response()->json(['error' => 'Subject not found'], 404);
            }
        }
        public function getMcqsBySubject($subjectName) {
            $questions = SubjectMcqsQuestion::with('options')
                          ->whereHas('subject', function ($query) use ($subjectName) {
                              $query->where('subject_name', $subjectName);
                          })->paginate(10);
            
            return response()->json([
                'subject' => ['subject_name' => $subjectName],
                'mcqs' => $questions
            ]);
        }
        
        
        public function fetchDepartmentMcqsForUser(Request $request) {
            // Fetching the parameters from the request
            $subDepartmentId = $request->input('sub_department_id');
            $subDepartmentSubjectId = $request->input('sub_department_subject_id');
        
            $departmentinfo = SubDepartment::where('id', $subDepartmentId)->first();
            $subdepartmentSubject = Subject::where('sub_department_id', $subDepartmentId)->get();
        
            if ($subDepartmentId != null && $subDepartmentSubjectId == null) {
                if ($departmentinfo) {
                    $mcqs = SubjectMcqsQuestion::with('options')
                        ->where('sub_department_id', $subDepartmentId)
                        ->paginate(10);
                    return response()->json([
                        'departmentinfo' => $departmentinfo,
                        'mcqs' => $mcqs,
                        'subdepartmentSubject' => $subdepartmentSubject
                    ]);
                } else {
                    return response()->json(['error' => 'Department not found'], 404);
                }
            } elseif ($subDepartmentId != null && $subDepartmentSubjectId != null) {
                $mcqs = SubjectMcqsQuestion::with('options')
                    ->where('sub_department_id', $subDepartmentId)
                    ->where('subject_id', $subDepartmentSubjectId)
                    ->paginate(10);
                return response()->json([
                    'departmentinfo' => $departmentinfo,
                    'mcqs' => $mcqs,
                    'subdepartmentSubject' => $subdepartmentSubject
                ]);
            } else {
                return response()->json(['error' => 'Invalid parameters'], 400);
            }
        }
        

        public function fetchSubjectForMcqsQuestion($subDepartmentId){
            $subjects = Subject::where('sub_department_id', $subDepartmentId)->get();
            return response()->json($subjects);
        }
        
}

