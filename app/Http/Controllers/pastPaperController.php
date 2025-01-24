<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PastPaper;
use App\Models\Department;
use App\Models\SubDepartment;

use Illuminate\Support\Facades\Storage;
class pastPaperController extends Controller
{
    
    public function store(Request $request, $DepartmentId) {
        // dd( $request->selected_sub_department_id);
        $request->validate([
            'paperTitle' => 'required|string',
            'paperDate' => 'required|date',
            // 'testCenter' => 'required|string',
            'file' => 'required|file|mimes:pdf|max:2048',
            'selected_sub_department_id' => 'required',
            
        ]);
    
        // Store the file
        $file = $request->file('file');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/PastPapers', $fileName);
        $fileUrl = Storage::url($filePath);
    
        // Save data to the database
        $pastPaper = new PastPaper();
        $pastPaper->title = $request->paperTitle;
        $pastPaper->test_date = $request->paperDate;
        $pastPaper->test_center = $request->testCenter;
        $pastPaper->file_path = $fileUrl;  // Store the URL instead of just the filename
        $pastPaper->file_type = $file->getClientOriginalExtension();
        $pastPaper->original_name = $file->getClientOriginalName();
        $pastPaper->department_id = $DepartmentId;
        $pastPaper->sub_department_id = $request->selected_sub_department_id;
        $pastPaper->save();
    
        return response()->json(['message' => 'Past paper uploaded successfully'], 200);
    }
    public function getpastPaper($departmentId){
        // dd($departmentId);
        $papers = PastPaper::where('department_id', $departmentId)->get();
        // dd($papers);
        return response(['pastpapers' => $papers], 200);
    }
    public function deletePastPaper($id) {
        $pastPaper = PastPaper::findOrFail($id);
    
        // Delete the file from storage
        if (Storage::exists($pastPaper->file_path)) {
            Storage::delete($pastPaper->file_path);
        }
    
        // Delete the record from the database
        $pastPaper->delete();
    
        return response()->json(['message' => 'Past paper deleted successfully'], 200);
    }

    public function getPastPaperForUser(Request $request){
        if($request->sub_department_id != null){
            $selectedSubdepartmentInfo = SubDepartment::where('id', $request->sub_department_id)->first();
            $papers = PastPaper::where('sub_department_id' ,$request->sub_department_id )->get();
            return response(['pastpapers' => $papers , 'selectedSubdepartmentInfo' => $selectedSubdepartmentInfo], 200);
        }
        else{
            $papers = PastPaper::get();
            return response(['pastpapers' => $papers], 200);
        }
      
    }

    public function getDepartmentForPastPaper(){
        $deparmentRecord = Department::get();
        return response(['deparmentRecord' => $deparmentRecord], 200);
    }
    
    public function getPastPapertoDepartment($departmentId){
        $papers = PastPaper::where('Department_id', $departmentId)->get();
        // dd($papers);
        return response(['departmentPastPapers' => $papers], 200);
    }

    public function fetchDepartmentForPastPaperForUser(Request $request) {
        // Fetching the parameters from the request
        // dd($request);
        $subDepartmentId = $request->input('sub_department_id');
        // $subDepartmentId = $request->input('sub_department_subject_id');
    
        $departmentinfo = SubDepartment::where('id', $subDepartmentId)->first();
        $subdepartmentpapers = PastPaper::where('sub_department_id', $subDepartmentId)->get();
        dd($subdepartmentpapers);
    
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

    public function FetchSudepartment($DepartmentId){
        $Subdepartments = SubDepartment::where('department_id', $DepartmentId)->get();
        // dd($Subdepartments);
        return response($Subdepartments);
    }
    
}
