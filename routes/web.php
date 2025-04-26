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

use Illuminate\Http\Request;



Route::resource('signatures', SignatureController::class);
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
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
});

Route::post('/admit-card/bulk-print', [PrintController::class, 'bulkPrint'])->name('admit-print.bulk');
// Course Resource Routes
Route::resource('courses', CourseController::class);

// BranchCourse Resource Routes
Route::resource('branch-courses', BranchCourseController::class);
Route::get('/branch/assign-course', [CourseController::class, 'showtable']);
Route::get('/branch/assign-course/{branch_code}', [BranchCourseController::class, 'showCourseList']);

Route::post('/students/{student}/verify', [StudentController::class, 'verify'])->name('students.verify');
Route::post('/students/verify-all', [StudentController::class, 'verifyAll'])
    ->name('students.verify-all');

Route::resource('students', StudentController::class);

Route::get('/branch/panding/students', [StudentController::class, 'branchPandingStudent'])->middleware('branch.auth');
Route::get('/branch/active/students', [StudentController::class, 'branchActiveStudent'])->middleware('branch.auth');
Route::get('/branch/all/students', [StudentController::class, 'branchAllStudent'])->middleware('branch.auth');
Route::get('/branch/profile/{student_id}', [StudentController::class, 'branchshow'])->name('Branchstudents.show')->middleware('branch.auth');
Route::get('/branch/student/profile/{student_id}', [StudentController::class, 'branchStudentShow'])->name('Branchstudent.show')->middleware('branch.auth');

Route::get('/central/active/students', [StudentController::class, 'verifyStudents']);
Route::get('/central/students', [StudentController::class, 'Students']);



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
