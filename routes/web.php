<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\subjectMcqsController;
use App\Http\Controllers\SubjectQuizController;
use App\Http\Controllers\TestSyllabusController;
use App\Http\Controllers\advanceQuerryController;
use App\Http\Controllers\Auth\AuthRegisterController;
use App\Http\Controllers\pastPaperController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\McqsPageController;
use App\Http\Controllers\SubDepartmentController;
use App\Http\Controllers\SubDepartmentQuizController;
use App\Http\Controllers\BookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::post('/auth-register', [AuthRegisterController::class, 'AuthRegister']);
Route::post('/auth-login', [AuthRegisterController::class, 'login']);

Route::get('auth/{provider}', [AuthRegisterController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [AuthRegisterController::class, 'handleProviderCallback']);
Route::post('/department', [DepartmentController::class, 'store']);



Route::post('/upload-past-paper/{departmentId}',[pastPaperController::class,'store']);
Route::get('/get-past-paper/{departmentId}',[pastPaperController::class,'getpastPaper']);
Route::delete('/delete-past-paper/{id}',[pastPaperController::class,'deletePastPaper']);
Route::get('/fetch-past-paper-forUser',[pastPaperController::class,'getPastPaperForUser']);
Route::get('/department-for-past-paper',[pastPaperController::class,'getDepartmentForPastPaper']);
Route::get('/get-pastPaper-toDepartment/{departmentId}',[pastPaperController::class,'getPastPapertoDepartment']);

// Route::delete('/delete-past-paper/{id}', 'YourController@deletePastPaper');
Route::get('/fetch-image', [JobController::class, 'show']);
Route::get('/fetch-jobs-forUser', [JobController::class, 'getJobsForUser']);
Route::get('/get-subDepartemnt-for-subdepartment', [JobController::class, 'getdepartmetnForSubdepartment']);

Route::get('/fetchDepartmentForMcqs', [subjectMcqsController::class, 'fetchDepartmentForSubject']);
Route::get('/select-SubjectFor-Mcqs-Question/{sub_department_id}', [subjectMcqsController::class, 'selectSubjectFormcqsQuestion']);
Route::post('/submit-subject-mcqs', [subjectMcqsController::class, 'saveSubjectMcqs']);
Route::get('/fetch-subject-Mcqs', [subjectMcqsController::class, 'fetchSubjectMcqs']);
Route::get('/edit-subject-mcqs/{questionId}', [subjectMcqsController::class, 'EditSubjectMcqs']);

Route::put('/update-subject-mcqs/{id}', [subjectMcqsController::class, 'updateSubjectMcqs']);
Route::get('/get-subject-for-mcqs-questions/{subDepartmentId}', [subjectMcqsController::class, 'fetchSubjectForMcqsQuestion']);


Route::delete('/delete-subject-mcqs/{questionId}', [subjectMcqsController::class, 'deleteSubjectMcqs']);
Route::post('/import-subject-mcqs',[subjectMcqsController::class, 'importSubjectMcqs']);
Route::post('/department', [DepartmentController::class, 'store']);
Route::get('/getDepartmentData', [DepartmentController::class, 'getDepartmentData']);
Route::put('/department/{id}', [DepartmentController::class, 'updateDepartment']);
Route::delete('/department/{id}', [DepartmentController::class, 'destroy']);

Route::get('/fetch-sub-department-mcqs-forUser', [subjectMcqsController::class, 'fetchdepartmentmcqsForUser']);
Route::get('/get-subject-mcqs/{subject}', [subjectMcqsController::class, 'subjectMcqsForUser']);
Route::post('/addsubject', [SubjectController::class, 'storeSubject']);
Route::get('/getDepartmentDataForSubject', [SubjectController::class, 'getDepartmentForSubject']);
Route::get('/getSubject', [SubjectController::class, 'getSubjectRecord']);
Route::put('/updateSubject/{id}', [SubjectController::class, 'updatesubject']);
Route::delete('/deletesubject/{id}', [SubjectController::class, 'destroy']);
Route::get('/fetchDepartmentForSubjectQuiz', [SubjectQuizController::class, 'fetchDepartmentForSubjectQuiz']);
Route::get('/selectSubjectForSubjectQuiz', [SubjectQuizController::class, 'selectSubjectForSubjectQuiz']);
Route::post('/saveQuiz', [SubjectQuizController::class, 'saveQuiz']);
Route::get('/fetchQuiz', [SubjectQuizController::class, 'fetchQuiz']);
Route::put('/updateQuiz/{id}', [SubjectQuizController::class, 'updateQuiz']);
Route::delete('/deleteQuiz/{id}', [SubjectQuizController::class, 'deleteQuiz']);

// Route::get('/fetchQuizForCreationMcqs', [SubjectQuizController::class, 'fetchQuizForCreationMcqs']);
// Route::post('/createSubjectQuizMcqs', [SubjectQuizController::class, 'createSubjectQuizMcqs']);
// Route::get('/fetchSubjectQuizMcqs', [SubjectQuizController::class, 'fetchSubjectQuizMcqs']);
// Route::put('/updateQuizMcqs/{id}', [SubjectQuizController::class, 'updateQuizMcqs']);
// Route::delete('/deleteSubjectQuizmcqs/{id}', [SubjectQuizController::class, 'deleteSubjectQuizmcqs']);
Route::get('/multitable', [SubjectQuizController::class, 'fetchtables']);




///////////////////////////////////////////////////  start   test syllabus Quiz //////////////////

Route::get('/fetchDepForSyllabus', [TestSyllabusController::class, 'fetchDepartment']);
Route::post('/submit-department-syllabus', [TestSyllabusController::class, 'submiDemartmentSyllabus']);

Route::get('/fetchSyllabusdata', [TestSyllabusController::class, 'fetchSyllabusData']);
Route::get('/edit-department-syllabus/{departmentId}', [TestSyllabusController::class, 'editDepartmentSyllabus']);
Route::post('/update-department-syllabus/{departmentId}', [TestSyllabusController::class, 'updateDepartmentSyllabus']);
Route::delete('/delete-user-department-syllabus/{id}', [TestSyllabusController::class, 'DeleteDepartmentSyllabus']);

///////////////////////////////////////////////////  start   advance query //////////////////

// Route::get('/getdepartmaentData', [advanceQuerryController::class, 'getData']);
// Route::get('/edit-data/{id}', [advanceQuerryController::class, 'editData']);
// Route::put('/update-department/{id}', [advanceQuerryController::class, 'updateDepartment']);

Route::get('/fetch-Department-for-home', [DepartmentController::class, 'fetchDepartmentForHome']);

Route::get('/fetch-subjects/{departmentId}', [subjectMcqsController::class,'getSubjects']);

Route::get('/fetch-subjectMcqs-ByDeprtment/{departmentId}/{subjectId}', [subjectMcqsController::class,'SubjectmsqcByDepartment']);
Route::get('/fetch-department-syllabus/{departmentId}',[TestSyllabusController::class,'getSallabus']);
Route::get('/get-department-name/{DepartmentId}', [DepartmentController::class, 'getDepartmentName']);
Route::get('/fetch-department-subject/{DepartmentId}', [DepartmentController::class, 'getDepartmentSubject']);
Route::get('/fetch-mcqs-by-subject/{subjectNname}/{DepartmentId}', [DepartmentController::class, 'getMcqsBySubject']);
Route::get('/get-department-Syllabus/{DepartmentId}', [DepartmentController::class, 'getDepartmentSyllabus']);
Route::get('/fetch-all-department-mcqs/{DepartmentId}', [DepartmentController::class, 'getAllDepartmentMcqs']);
Route::get('/search-mcqs-question/{question}', [DepartmentController::class, 'searchMcqsQuestion']);

Route::post('/submit-job', [JobController::class, 'SubmitJob']);
Route::get('/get-jobs', [JobController::class, 'GetJobs']);
Route::get('/edit-job/{jobId}', [JobController::class, 'EditJob']);
Route::post('/update-job/{jobId}', [JobController::class, 'UpdateJob']);
Route::delete('/delete-job/{jobId}', [JobController::class, 'deleteJob']);
Route::get('/download-pdf/{filePath}', [JobController::class, 'downloadPDF'])->name('download.pdf');
Route::get('/tp-newJobs', [JobController::class, 'getNowJobs']);


Route::post('/logout', [AuthRegisterController::class,'logout'])->name('logout');
Route::get('/get-user-info', [AuthRegisterController::class,'GetUserInfo'])->middleware('auth');
// Route::get('/get-user-info', 'YourController@GetUserInfo')->middleware('auth');

// Route::get('/fetch-departments', [DepartmentController::class, 'fetchDepartmentsforUserpage']);


Route::post('/save-sub-department', [SubDepartmentController::class, 'saveSubDepartment']);
Route::get('/get-sub-department/{DepartmentId}', [SubDepartmentController::class, 'getSubDepartment']);
Route::get('/get-subDepartemnt-for-subject/{DepartmentId}', [SubDepartmentController::class, 'getSubDepartemntForSubject']);
Route::get('/get-subDepartemnt-for-mcqs/{DepartmentId}', [SubDepartmentController::class, 'getSubDepartemntFormcqs']);


Route::post('/create-quiz', [SubDepartmentQuizController::class, 'createQuiz']);
Route::get('/get-department-quizzes', [SubDepartmentQuizController::class, 'getDepartmentQuizzes']);
Route::delete('/delete-department-quiz/{quiz_id}', [SubDepartmentQuizController::class, 'deleteDepartmentQuiz']);

Route::get('/get-department-for-quizzes', [SubDepartmentQuizController::class, 'getDepartmentForQuizzes']);
Route::get('/get-sub-department-for-quizzes/{departmentId}', [SubDepartmentQuizController::class, 'getSubDepartmentForQuizze']);

Route::post('/create-questions', [SubDepartmentQuizController::class, 'CreatQuestion']);
Route::get('/get-questions/{quizId}', [SubDepartmentQuizController::class, 'GetQuestion']);
Route::delete('/delete-question/{questionId}', [SubDepartmentQuizController::class, 'deleteQuestion']);

Route::get('/get-sub-department-forUser-mcqs/{departmentId}', [SubDepartmentController::class, 'getSubDepartmentForUserMcqs']);

Route::get('/get-subDepartemnt-for-book/{DepartmentId}', [BookController::class, 'getSubDepartemntForBook']);
Route::post('/add-new-book', [BookController::class, 'addNewBook']);
Route::get('/get-all-books', [BookController::class, 'getAllBooks']);
Route::delete('/delete-book/{bookid}', [BookController::class, 'deleteBook']);
Route::get('/preview-book/{id}', [BookController::class, 'previewBook']);

Route::get('/fetch-sub-department-pastpaper-forUser', [pastPaperController::class, 'fetchDepartmentForPastPaperForUser']);
Route::get('/get-subdepartment-for-PastPaper/{DepartmentId}', [pastPaperController::class, 'FetchSudepartment']);

Route::post('/save-contect-message', [BookController::class, 'storeContactMessage']);
Route::get('/all-messages', [BookController::class, 'usermessages']);
Route::post('/message-reply/{messageId}', [BookController::class, 'replymessage']);




Route::get('/{any}', function () {
    return view('welcome');
})->where('any', '.*');
