<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Subject;

class SubjectController extends Controller
{
    public function getDepartmentForSubject()
    {

        try {
            $DepartmentData = Department::get();
                        return response()->json($DepartmentData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function storeSubject(Request $request)
    {
        // dd($request);
        $validatedData = $request->validate([
            'subject_name' => 'required',
            'Department_id' => 'required',
            'sub_department_id' => 'required',
        ]);
    
        try {
            $SubjectRecord = Subject::create($validatedData);
            return response()->json(['message' => 'subject added successfully', 'data' => $SubjectRecord]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'some thinks error exists'], 422);
        }
    }
    public function getSubjectRecord(Request $request)
{
    if ($request->department_id != null && $request->sub_department_id == null) {
        $SubjectRecord = Subject::with('department', 'subdepartment')
            ->where('department_id', $request->department_id)
            ->get();
    } elseif ($request->department_id != null && $request->sub_department_id != null) {
        $SubjectRecord = Subject::with('department', 'subdepartment')
            ->where('department_id', $request->department_id)
            ->where('sub_department_id', $request->sub_department_id)
            ->get();
    } else {
        $SubjectRecord = Subject::with('department', 'subdepartment')->get();
    }

    return response()->json($SubjectRecord);
}





    public function updatesubject(Request $request, $id)
    {
        $request->validate([
            'subject_name' => 'required|string|max:255',
        ]);
        // dd($request);
        $SubjectRecord = Subject::findOrFail($id);
        $SubjectRecord->subject_name = $request->input('subject_name');
        $SubjectRecord->save();

        return response()->json($SubjectRecord, 200);
    }

    public function destroy($id)

    {
        // dd($id);
        $SubjectRecord = Subject::findOrFail($id);
        $SubjectRecord->delete();

        return response()->json(['message' => 'Department deleted successfully'], 200);
    }
}
