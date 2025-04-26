<?php

namespace App\Http\Controllers;
use App\Models\Student;
use App\Models\Branch;
use App\Models\Course;
use App\Models\Signature;

use Illuminate\Http\Request;

class PrintController extends Controller
{
    public function admitCard($id)
    {
        // Fetch student data (example - adjust to your actual model)
        $student = Student::with(['branch', 'course'])->findOrFail($id);
        
        $signature = Signature::where('branch', 'admin')->first();
        $branchsignature = Signature::where('branch', $student->branc_code)->first();
        $exam_controller_signature = $signature ? $signature->signature_image_path : 'branch/signatures/alt.png';
        $institute_head_signature = $branchsignature ? $branchsignature->signature_image_path : 'branch/signatures/alt.png';

        return view('central.admit-card.admit-card', [
            'student' => $student,
            'institute_head_signature' => $institute_head_signature,
            'exam_controller_signature' => $exam_controller_signature
        ]);
    }
    public function registrationCard($id)
    {
        // Fetch student data (example - adjust to your actual model)
        $student = Student::with(['branch', 'course'])->findOrFail($id);
        
        $signature = Signature::where('branch', 'admin')->first();
        $branchsignature = Signature::where('branch', $student->branc_code)->first();
        $exam_controller_signature = $signature ? $signature->signature_image_path : 'branch/signatures/alt.png';
        $institute_head_signature = $branchsignature ? $branchsignature->signature_image_path : 'branch/signatures/alt.png';

        return view('central.registration-card.index', [
            'student' => $student,
            'institute_head_signature' => $institute_head_signature,
            'exam_controller_signature' => $exam_controller_signature
        ]);
    }

    
    public function admitCardpdf($id)
    {
        // Fetch student data (example - adjust to your actual model)
        $student = Student::with(['branch', 'course'])->findOrFail($id);
        
        $signature = Signature::where('branch', 'admin')->first();
        $branchsignature = Signature::where('branch', $student->branc_code)->first();
        $exam_controller_signature = $signature ? $signature->signature_image_path : 'branch/signatures/alt.png';
        $institute_head_signature = $branchsignature ? $branchsignature->signature_image_path : 'branch/signatures/alt.png';

        return view('central.admit-card.admit-card-pdf', [
            'student' => $student,
            'institute_head_signature' => $institute_head_signature,
            'exam_controller_signature' => $exam_controller_signature
        ]);
    }
    public function students(){
        $students = Student::whereIn('status', ['active'])
        ->with('branch', 'course')
        ->get();
        $branches = Branch::all();
        $courses = Course::all();
        return view('central.admit-card.students', compact('students', 'branches', 'courses'));
    }
}
