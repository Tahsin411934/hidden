<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\BranchCourseController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\PrintController;
use App\Http\Controllers\MarkController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;


use App\Http\Controllers\CategoryController;


Route::resource('signatures', SignatureController::class);

  Route::get('/', [HomepageController::class, 'Home']);
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/user/make', [RegisteredUserController::class, 'create']);
    Route::post('register', [RegisteredUserController::class, 'store']);
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/student/profile/{student_id}', [StudentController::class, 'showCentralStudent'])->name('show.student');
    Route::resource('signatures', SignatureController::class);
    // Route::get('/admid-card/{id}', [PrintController::class, 'admitCard'])->name('admit-print.page');
    Route::get('/students/admid-card/generate', [PrintController::class, 'students'])->name('admit-print.page');
    Route::post('/admit-card/{id}', [PrintController::class, 'admitCard'])
    ->name('admit-print.page');
    Route::post('/registration-card/{id}', [PrintController::class, 'registrationCard'])
    ->name('registration-print.page');
    Route::get('/admit-card-pdf/{id}', [PrintController::class, 'admitCardpdf'])
    ->name('admit-print-pdf.page');
    Route::get('/central/panding/students', [StudentController::class, 'index']);
    Route::get('/central/branch/students', [StudentController::class, 'branchWise']);
    Route::get('/central/active/students', [StudentController::class, 'verifyStudents']);
    Route::get('/central/students', [StudentController::class, 'Students']);
    Route::get('/branch/pending-students/{branch_id}', [StudentController::class, 'branch_wise_panding_students']);
    Route::get('/branch/active-students/{branch_id}', [StudentController::class, 'branch_wise_active_students']);
    Route::get('/branch/students/{branch_id}', [StudentController::class, 'branch_wise_all_students']);
    Route::resource('categories', CategoryController::class);
    Route::get('/all/categories', [CategoryController::class, 'showList']);

    // MARKS
    Route::get('/students/marks/entry', [StudentController::class, 'MarksStudents']);
    Route::get('/marks/manage', [StudentController::class, 'manageMarksStudents']);
    Route::get('/marks/manage/{id}', [MarkController::class, 'manageMarks'])->name('mark.manage');
    Route::resource('marks', MarkController::class)->middleware('auth');

    // result 
   // Routes (routes/web.php)
Route::get('/result', [ResultController::class, 'result'])->name('result');
Route::post('/result', [ResultController::class, 'result']);
});


// Frontend
 // result 
Route::get('/students/result', [ResultController::class, 'Studentresult'])->name('student-result');
Route::post('/students/result', [ResultController::class, 'Studentresult']);
//galary
Route::get('/gallery', function () {
    return view('frontend.pages.gallary');
 });
Route::get('/about-us', function () {
    return view('frontend.pages.about-us');
 });
Route::get('/contact-us', function () {
    return view('frontend.pages.contact-us');
 });


Route::resource('notices', NoticeController::class);
Route::get('/recent/notice', [NoticeController::class, 'frontendindex']);

Route::post('/admit-card/bulk-print', [PrintController::class, 'bulkPrint'])->name('admit-print.bulk');
// Course Resource Routes
Route::resource('courses', CourseController::class);

// BranchCourse Resource Routes
Route::resource('branch-courses', BranchCourseController::class);
Route::get('/branch/assign-course', [CourseController::class, 'showtable']);
Route::get('/branch/search', [CourseController::class, 'searchBranch']);
Route::get('/branch/assign-course/{branch_code}', [BranchCourseController::class, 'showCourseList']);

Route::post('/students/{student}/verify', [StudentController::class, 'verify'])->name('students.verify');
Route::post('/students/verify-all', [StudentController::class, 'verifyAll'])
    ->name('students.verify-all');
Route::post('/branchstudents/verify-all/{branch_id}', [StudentController::class, 'verifyAllBranchStudents'])
    ->name('students.verifyAllBranchStudents');

Route::resource('students', StudentController::class);

Route::get('/branch/panding/students', [StudentController::class, 'branchPandingStudent'])->middleware('branch.auth');
Route::get('/branch/active/students', [StudentController::class, 'branchActiveStudent'])->middleware('branch.auth');
Route::get('/branch/all/students', [StudentController::class, 'branchAllStudent'])->middleware('branch.auth');
Route::get('/branch/profile/{student_id}', [StudentController::class, 'branchshow'])->name('Branchstudents.show')->middleware('branch.auth');
Route::get('/branch/student/profile/{student_id}', [StudentController::class, 'branchStudentShow'])->name('Branchstudent.show')->middleware('branch.auth');





Route::resource('branches', BranchController::class);
Route::get('all-branch', [BranchController::class, 'showtable'])->name('branches.table');
// Authentication routes
Route::get('branch/login', [BranchController::class, 'showLoginForm']);
Route::post('branch/login', [BranchController::class, 'login'])->name('branch.login');
Route::get('branch/dashboard', [BranchController::class, 'dashboard'])->name('branch.dashboard')->middleware('branch.auth');
Route::post('/branch/logout', [BranchController::class, 'logout'])
     ->name('branches.logout');
// Public route (no middleware)
Route::get('/public', function() {
    return "This is a public page - anyone can see it";
});

// Protected route (requires branch auth)
Route::get('/protected', function() {
    return "This is a protected page - only authenticated branches can see it";
})->middleware('branch.auth');


// all branches
Route::get('/branch/signatures/create', [SignatureController::class, 'branchcreate'])->name('branchsignatures.create');
Route::post('branch/signatures', [SignatureController::class, 'branchstore'])->name('branchsignatures.store');











Route::get('/get-districts/{division_id}', function ($division_id) {
    $districts = District::where('division_id', $division_id)
                ->orderBy('name')
                ->get(['id', 'name', 'bn_name']);
    return response()->json($districts);
})->name('get-districts');

Route::get('/get-upazilas/{district_id}', function ($district_id) {
    $upazilas = Upazila::where('district_id', $district_id)
                ->orderBy('name')
                ->get(['id', 'name', 'bn_name']);
    return response()->json($upazilas);
})->name('get-upazilas');





require __DIR__.'/auth.php';