<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
class JobController extends Controller
{
    // public function SubmitJob(Request $request) {
    //     $request->validate([
    //         'jobTitle' => 'required|string',
    //         'province' => 'required',
    //         'applyWebsite' => 'required|string',
    //         'zone' => 'required|string',
    //         'start_date' => 'required|date',
    //         'last_Date' => 'required|date',
    //         'File' => 'required|file|mimes:pdf|max:2048',
    //     ]);
    
    //     $file = $request->file('File');
    //     $fileName = time() . '_' . $file->getClientOriginalName(); // Adding timestamp to avoid conflicts
    //     $filePath = $file->storeAs('Job', $fileName);
    
    //     // Save data to database
    //     $job = new Job();
    //     $job->job_title = $request->jobTitle;
    //     $job->province = $request->province;
    //     $job->apply_on_website = $request->applyWebsite;
    //     $job->zone = $request->zone;
    //     $job->start_date = $request->start_date;
    //     $job->last_Date = $request->last_Date;
    //     $job->apply_url = $request->apply_link;
    //     $job->file_path = $filePath; 
    //     $job->file_type = $file->getClientOriginalExtension();
    //     $job->advertisement_file = $file->getClientOriginalName();
    //     $job->save();
    
    //     return response()->json(['message' => 'Job uploaded successfully'], 200);
    // }
    public function SubmitJob(Request $request) {
        $request->validate([
            'jobTitle' => 'required|string',
            'province' => 'required',
            'applyWebsite' => 'required|string',
            'zone' => 'required|string',
            'start_date' => 'required|date',
            'last_Date' => 'required|date',
            'File' => 'required|file|mimes:pdf,jpg,jpeg,png|max:2048',
        ]);
    
        $file = $request->file('File');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/Job', $fileName);
        $fileUrl = Storage::url($filePath);
    
        $job = new Job();
        $job->job_title = $request->jobTitle;
        $job->province = $request->province;
        $job->apply_on_website = $request->applyWebsite;
        $job->zone = $request->zone;
        $job->start_date = $request->start_date;
        $job->last_Date = $request->last_Date;
        $job->apply_url = $request->apply_link;
        $job->file_path = $fileUrl;  // Store the URL instead of the file path
        $job->file_type = $file->getClientOriginalExtension();
        $job->advertisement_file = $file->getClientOriginalName();
        $job->save();
    
        return response()->json(['message' => 'Job uploaded successfully'], 200);
    }
    

    public function GetJobs() {
        $jobs = Job::get();
       
        return response(['jobs' => $jobs], 200);
    }
    

    public function EditJob($jobId){
        $editRecord = Job::where('id', $jobId)->first();
        
        return response()->json($editRecord);
    }

    public function UpdateJob(Request $request, $jobId) {
        $job = Job::find($jobId);
        if (!$job) {
            return response()->json(['error' => 'Job not found'], 404);
        }
    
        $request->validate([
            'job_title' => 'required|string',
            'province' => 'required|string',
            'zone' => 'required|string',
            'apply_on_website' => 'required|string',
            'start_date' => 'required|date',
            'last_Date' => 'required|date',
            'AdvertisementFile' => 'nullable|file|mimes:pdf|max:2048',
        ]);
    
        // Update job fields
        $job->job_title = $request->input('job_title');
        $job->province = $request->input('province');
        $job->zone = $request->input('zone');
        $job->apply_on_website = $request->input('apply_on_website');
        $job->apply_url = $request->input('apply_url');
        $job->start_date = $request->input('start_date');
        $job->last_Date = $request->input('last_Date');
    
        // Handle file upload
        if ($request->hasFile('AdvertisementFile')) {
            // Delete old file if exists
            if ($job->file_path && Storage::exists($job->file_path)) {
                Storage::delete($job->file_path);
            }
    
            // Store new file
            $file = $request->file('AdvertisementFile');
            $fileName = time() . '_' . $file->getClientOriginalName(); // Adding timestamp to avoid conflicts
            $filePath = $file->storeAs('public/Job', $fileName);
            $job->file_path = $filePath;
            $job->file_type = $file->getClientOriginalExtension();
            $job->advertisement_file = $file->getClientOriginalName();
        }
    
        $job->save();
    
        return response()->json(['message' => 'Job updated successfully']);
    }
    
    
    public function deleteJob($jobId)
    {
        try {
            $job = Job::findOrFail($jobId); // Find the job by ID
            // Delete associated file if exists
            if ($job->file_path && Storage::exists($job->file_path)) {
                Storage::delete($job->file_path);
            }
            $job->delete(); // Delete the job
            return response()->json(['message' => 'Job deleted successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete job'], 500);
        }
    }

    public function downloadPDF($filePath) {
        // Get the file name from the file path
        $fileName = basename($filePath);
    
        // Get the file's MIME type
        $mimeType = Storage::mimeType($filePath);
    
        // Get the contents of the file
        $fileContents = Storage::get($filePath);
    
        // Return a response with the file contents and appropriate headers
        return response($fileContents)
            ->header('Content-Type', $mimeType)
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');
    }

    public function show()
    {
        dd('ss');
        // Assuming $filename is provided or you retrieve it from somewhere
        $filename = 'pk.png';

        // Build the path to the image file
        $path = storage_path('app/images/' . $filename);

        // Check if the file exists in storage
        if (!Storage::exists($path)) {
            abort(404);
        }

        // Return the image file as a response
        return response()->file($path);
    }

    public function getJobsForUser()
    {
        $jobs = Job::all();
    //    dd($jobs);
        return response(['jobs' => $jobs], 200);
    }

    public function getdepartmetnForSubdepartment(){
        $departments = Department::get();
        return response(['departmentRecordForSubdepartment' => $departments], 200);

    }
    public function getNowJobs() {
        $newJobs = Job::orderBy('created_at', 'desc')->take(10)->get();
        
        return response()->json($newJobs);
    }
    
}
