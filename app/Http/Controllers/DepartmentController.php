<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Subject;
use App\Models\SubjectMcqs;
use App\Models\TestSyllabus;
use App\Models\SubjectMcqsQuestion;
use App\Models\SubjectMcqsQuestionOption;
class DepartmentController extends Controller
{
    public function store(Request $request)
{
    $validatedData = $request->validate([
        'title' => 'required|string|unique:departments|max:255',
    ]);

    try {
        $department = Department::create($validatedData);
        return response()->json(['message' => 'Department added successfully', 'data' => $department]);
    } catch (\Exception $e) {
        return response()->json(['error' => 'This department already exists'], 422);
    }
}

    
    public function getDepartmentData()
    {

        try {
            $DepartmentData = Department::get();
                        return response()->json($DepartmentData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $department = Department::findOrFail($id);
        $department->title = $request->input('title');
        $department->save();

        return response()->json($department, 200);
    }
    public function destroy($id)
    {
        $department = Department::findOrFail($id);
        $department->delete();

        return response()->json(['message' => 'Department deleted successfully'], 200);
    }

    public function fetchDepartmentForHome()
    {
        try {
            $departmentRecords = Department::with('subjects')->get();
            return response()->json($departmentRecords);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    
    public function getDepartmentName($DepartmentId){
        $departmentName = Department::where('id', $DepartmentId)->pluck('title');
        // dd($departmentName);
        return response()->json($departmentName);
    }
    public function getDepartmentSubject($DepartmentId){
        $DepartmentSubject = Subject::where('Department_id', $DepartmentId)->get();
        // dd($DepartmentSubject);
        return response()->json($DepartmentSubject);
    }
    
    public function getMcqsBySubject($subjectName , $DepartmentId){
        // dd($DepartmentId);
        $subject = Subject::where('subject_name', $subjectName)->first();
        
        if($subject){
            $subject_mcqs = SubjectMcqsQuestion::with('options')->
            where('subject_id', $subject->id)->where('department_id', $DepartmentId)->get();
            return response()->json($subject_mcqs);
        } else {
            return response()->json('error' , 'subject is not found !');
        }
    }
    public function getDepartmentSyllabus($DepartmentId){
        $Syllabus = TestSyllabus::where('Department_id', $DepartmentId)->get();
        if($Syllabus){
            return response()->json($Syllabus);
        }
        else{
            return response()->json('error' , 'department id not found !');


        }
    }
    public function getAllDepartmentMcqs($DepartmentId)
    {
        // dd($DepartmentId);
        $mcqs = SubjectMcqsQuestion::with('options')->where('department_id', $DepartmentId)->get();
        // dd($mcqs);
        return response()->json($mcqs);
    }

    public function searchMcqsQuestion($question){
        $question = SubjectMcqsQuestion::with('options')->where('Question', 'LIKE', "%$question%")->get();
        // dd($question);
        return response()->json($question);


    }

 

    
}
