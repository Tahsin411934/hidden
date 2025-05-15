<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Notice;
use App\Models\Mark;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Student statistics
        $totalStudents = Student::count();
        
        $studentStats = [
            'active' => Student::where('status', 'active')->count(),
            'pending' => Student::where('status', 'panding')->count(),
            'completed' => Student::where('status', 'completed')->count(),
            'total' => $totalStudents,
        ];

        // Recent pending students with branch and course
        $recentPendingStudents = Student::with(['branch', 'course'])
            ->where('status', 'panding')
            ->latest()
            ->take(5)
            ->get();

        // Branch statistics with active students only
        $branches = Branch::withCount(['students' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('students_count', 'desc')
            ->get();

        // Top courses with active students
        $topCourses = Course::withCount(['students' => function($query) {
                $query->where('status', 'active');
            }])
            ->orderBy('students_count', 'desc')
            ->take(5)
            ->get();

        // Recent notices
        $recentNotices = Notice::latest()
            ->take(5)
            ->get();

        // Top performing students (with at least one mark)
        $topPerformers = Student::with(['branch', 'marks'])
            ->has('marks')
            ->withAvg('marks', 'total_obtain_marks')
            ->orderBy('marks_avg_total_obtain_marks', 'desc')
            ->take(5)
            ->get();

        return view('dashboard', [
            'studentStats' => $studentStats,
            'recentPendingStudents' => $recentPendingStudents,
            'branches' => $branches,
            'topCourses' => $topCourses,
            'recentNotices' => $recentNotices,
            'topPerformers' => $topPerformers,
            'totalStudents' => $totalStudents
        ]);
    }

   public function branchDashboard() {
    $branch = session('branch');
    $branch_id = $branch['id'];
    
    $activestudents = Student::where('status', 'active')
        ->where('branc_code', $branch_id)
        ->with('branch', 'course')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
        
    $pandingstudents = Student::where('status', 'panding')
        ->where('branc_code', $branch_id)
        ->with('branch', 'course')
        ->orderBy('created_at', 'desc')
        ->limit(5)
        ->get();
        
    $students = Student::whereIn('status', ['active','completed'])
        ->where('branc_code', $branch_id)
        ->with('branch', 'course')
        ->count();
        
    $totalActive = Student::where('status', 'active')
        ->where('branc_code', $branch_id)
        ->count();
        
    $totalPending = Student::where('status', 'panding')
        ->where('branc_code', $branch_id)
        ->count();
        
    return view('branch.dashboard', compact(
        'activestudents',
        'pandingstudents',
        'students',
        'totalActive',
        'totalPending'
    ));
}
}