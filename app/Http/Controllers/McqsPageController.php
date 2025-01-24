<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Log;
class McqsPageController extends Controller
{
    public function fetchDepartments()
    {
        try {
            $departments = Department::get();
            return response()->json($departments);
        } catch (\Exception $e) {
            Log::error('Error fetching departments: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    
}
