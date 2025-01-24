<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubDepartment;
use App\Models\BookImage;
use App\Models\Book;
use App\Models\ContectUs;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{
    public function getSubDepartemntForBook($DepartmentId){
        // dd($DepartmentId);
        $subdepartemnts = SubDepartment::where('department_id', $DepartmentId)->get();
        return response()->json($subdepartemnts);
    }

    public function addNewBook(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'department_id' => 'required',
            'sub_department_id' => 'required',
            'title' => 'required|string|max:255',
            'file_type' => 'required|string|max:255',
            'original_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'book_file' => 'required|file',
            'book_image' => 'required|file',
        ]);

        // Handle book file upload
        if ($request->hasFile('book_file')) {
            $file = $request->file('book_file');
            $fileName = $this->generateUniqueFileName($file);
            $filePath = $file->storeAs('public/bookinfo', $fileName);
        } else {
            return response()->json(['message' => 'Book file is required'], 422);
        }

        // Handle book image upload
        if ($request->hasFile('book_image')) {
            $imageFile = $request->file('book_image');
            $imageName = $this->generateUniqueFileName($imageFile);
            $imagePath = $imageFile->storeAs('public/bookinfo', $imageName);
        } else {
            return response()->json(['message' => 'Book image is required'], 422);
        }

        // Create a new Book instance
        $book = new Book();
        $book->department_id = $validatedData['department_id'];
        $book->sub_department_id = $validatedData['sub_department_id'];
        $book->title = $validatedData['title'];
        $book->file_type = $validatedData['file_type'];
        $book->original_name = $validatedData['original_name'];
        $book->file_path = Storage::url($filePath); // Store public URL for file path
        $book->description = $validatedData['description'];
        $book->save();

        // Create a new BookImage instance
        $bookImage = new BookImage();
        $bookImage->book_id = $book->id;
        $bookImage->file_type = $validatedData['file_type'];
        $bookImage->image_name = $imageName;
        $bookImage->image_path = Storage::url($imagePath); // Store public URL for image path
        $bookImage->save();

        return response()->json(['message' => 'Book and image added successfully'], 200);
    }

    /**
     * Generate a unique filename for storing files.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string
     */
    private function generateUniqueFileName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $fileName = sha1(time().uniqid()).'.'.$extension;
        return $fileName;
    }

    public function getAllBooks()
    {
        $allBooks = Book::with('images')->get();
        return response()->json($allBooks);
    }
    

    public function deleteBook($bookid)
{
    // Find the book by ID
    $book = Book::with('images')->find($bookid);

    if (!$book) {
        return response()->json(['message' => 'Book not found'], 404);
    }

    foreach ($book->images as $image) {
        // Delete the image file from storage
        Storage::delete(str_replace('/storage/', 'public/', $image->image_path));
        // Delete the image record from the database
        $image->delete();
    }

    // Delete the book file from storage
    Storage::delete(str_replace('/storage/', 'public/', $book->file_path));

    // Delete the book record from the database
    $book->delete();

    return response()->json(['message' => 'Book and images deleted successfully'], 200);
}

public function previewBook($id)
{
    // Find the book by ID
    $book = Book::find($id);

    if (!$book) {
        return response()->json(['message' => 'Book not found'], 404);
    }

    // Optionally, return a view or redirect to the file path
    return redirect()->away($book->file_path); // Redirect to the book's file path
}

public function storeContactMessage(Request $request)
{
    // Validate incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string',
        'email' => 'required|email',
        'city' => 'required|string',
        'message' => 'required|string',
        'mobileNumber' => 'nullable|string'
    ]);

    // Store the validated data
    $contactMessage = ContectUs::create([
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'city' => $validatedData['city'],
        'message' => $validatedData['message'],
        'mobile_number' => $validatedData['mobileNumber']
    ]);

    return response()->json(['message' => 'Message sent successfully'], 200);
}

    public function usermessages(){
        $messages = ContectUs::orderBy('id', 'desc')->get();
    return response()->json($messages);
        
    }

    public function replyMessage($messageId) {
        $message = ContectUs::find($messageId);
        if ($message) {
            $message->reply = 1;
            $message->save();
            return response()->json(['status' => 'success'], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Message not found'], 404);
        }
    }
    
}
