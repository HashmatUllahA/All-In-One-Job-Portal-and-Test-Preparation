<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\TestSyllabus;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TestSyllabusController extends Controller
{
    
    public function fetchDepartment()
    {

        try {
            $DepartmentData = Department::get();
                        return response()->json($DepartmentData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function submiDemartmentSyllabus(Request $request){
        // dd($request);
        $validatedData = $request->validate([
            'Department_id' => 'required',
            'description' => 'required',
            'marks' => 'required',
        ]);
    
        // Find existing syllabus record for the Department_id
        // $existingSyllabus = TestSyllabus::where('Department_id', $validatedData['Department_id'])->first();
    
        // if ($existingSyllabus) {
            
        //     $existingSyllabus->update([
        //         'description' => $validatedData['description'],
        //         'marks' => $validatedData['marks'],
        //     ]);
        //     // dd($existingSyllabus);
        //     return ['message' => 'Syllabus Updated'];
        // }
    
        // If no existing record, create a new one
        TestSyllabus::create([
            'Department_id' => $validatedData['Department_id'],
            'description' => $validatedData['description'],
            'marks' => $validatedData['marks'],
        ]);
    
        return ['message' => 'Syllabus Created successfully!'];
    }
    
    public function fetchSyllabusData()
    {

        try {
            $syllabusData = TestSyllabus::with('Department')->get();

            // dd($syllabusData);
                        return response()->json($syllabusData);
        } catch (\Exception $e) {
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function getData(){
        $data = Department::get();
        // dd($data);
        return response()->json($data);
    }
    public function getSallabus($departmentId){
        $DepartmentSyllabus = TestSyllabus::where('Department_id',$departmentId)->get();
        return response()->json($DepartmentSyllabus);
    }


    public function editDepartmentSyllabus($departmentId) {
        try {
            // Try to find the department syllabus by department ID
            $departmentSyllabus = TestSyllabus::findOrFail($departmentId);
            
            // If found, return it
            return response()->json($departmentSyllabus);
        } catch (ModelNotFoundException $exception) {
            // If not found, return an error response
            return response()->json(['error' => 'No department syllabus found for the given ID'], 404);
        }
    }
    
    public function updateDepartmentSyllabus(Request $request, $id) {
        // dd($request);
        $departmentSyllabus = TestSyllabus::findOrFail($id);
    
        // Update the department syllabus attributes
        $departmentSyllabus->description = $request->input('description');
        $departmentSyllabus->marks = $request->input('marks');
        // Add more fields as needed...
    
        // Save the changes
        $departmentSyllabus->save();
    
        // Optionally, return a response indicating success
        return response()->json(['message' => 'Department syllabus updated successfully']);
    }
    
    
   public function DeleteDepartmentSyllabus($id)
   {
    // dd($id);
    try {
        $syllabus = TestSyllabus::findOrFail($id); // Find the user by ID
        $syllabus->delete(); // Delete the user
        return response()->json(['message' => 'syllabys deleted successfully']);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Failed to delete syllabys'], 500);
    }
}
}
