<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubDepartment;
class SubDepartmentController extends Controller
{
    public function saveSubDepartment(Request $request){
        $validatedData = $request->validate([
            'department_id' => 'required|integer',
            'title' => 'required|string|max:255',
            'bps_skill' => 'required|string|max:255',
        ]);
    
        // Create a new SubDepartment instance
        $subDepartment = new SubDepartment();
        $subDepartment->department_id = $validatedData['department_id'];
        $subDepartment->title = $validatedData['title'];
        $subDepartment->bps_skill = $validatedData['bps_skill'];
        $subDepartment->save();
    
        // Return success response
        return response()->json(['message' => 'SubDepartment added successfully', 'data' => $subDepartment]);
    }
    
    public function getSubDepartment($DepartmentId){
        $subdepartemnts = SubDepartment::where('department_id', $DepartmentId)->get();
        return response()->json($subdepartemnts);
    }
    public function getSubDepartemntForSubject($DepartmentId){
        // dd($DepartmentId);
        $subdepartemnts = SubDepartment::where('department_id', $DepartmentId)->get();
        return response()->json($subdepartemnts);
    }
    public function getSubDepartemntFormcqs($DepartmentId){
        // dd($DepartmentId);
        $subdepartemnts = SubDepartment::where('department_id', $DepartmentId)->get();
        return response()->json($subdepartemnts);
    }

    public function getSubDepartmentForUserMcqs($departmentId){
        $subdepartemnts = SubDepartment::where('department_id', $departmentId)->get();
        return response()->json($subdepartemnts);
    }
}
