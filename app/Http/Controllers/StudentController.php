<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Branch;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\BranchCourse;
class StudentController extends Controller
{
    // Display a listing of students
    public function index()
    { 
         $students = Student::whereIn('status', ['panding'])
        ->with('branch', 'course')
        ->get();
        $branches = Branch::all();
        $courses = Course::all();
        return view('branch.index', compact('students', 'branches', 'courses'));
    }
    public function branchPandingStudent()
    {  
        $branch = session('branch');
        $branch_id = $branch['id'];
        $students = Student::whereIn('status', ['panding'])
        ->where('branc_code', $branch_id)
        ->with('branch', 'course')
        ->get();
        
        
        return view('branch.students.panding', compact('students'));
    }

    public function verifyStudents(){
        $students = Student::whereIn('status', ['active'])
                   ->with('branch', 'course')
                   ->get();
        $branches = Branch::all();
        $courses = Course::all();
        return view('branch.students',compact('students', 'branches', 'courses'));
    }
    public function Students() {
        $students = Student::whereIn('status', ['active', 'completed'])
                   ->with('branch', 'course')
                   ->get();
        $branches = Branch::all();
        $courses = Course::all();
        return view('central.students.index', compact('students', 'branches', 'courses'));
    }
    // Show the form for creating a new student
    public function create()
    {   
        $branch = session('branch');
        $branch_id = $branch['id'];
      
        $courses = BranchCourse::with('course')->where('branch_code', $branch_id)->get();

        return view('branch.create', compact('courses'));
    }

    // Store a newly created student
    public function store(Request $request)
    { 
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'father_name' => 'nullable|string|max:100',
            'branc_code' => 'nullable|max:100',
            'mother_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'tana' => 'nullable|string|max:100',
            'vill' => 'nullable|string|max:100',
            'course_id' => 'nullable|max:100',
            'address' => 'nullable|string|max:255',
            'session' => 'nullable|string|max:50',
            'year' => 'nullable|string|max:10',
            'status' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        // Create student without image/signature initially
        $student = Student::create($validatedData);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students/images', 'public');
            $student->update(['image' => $imagePath]);
        }

        // Handle signature upload
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('students/signatures', 'public');
            $student->update(['signature' => $signaturePath]);
        }

        return redirect()->back()->with('success', 'Student created successfully.');
    }
    public function verify(Student $student)
    {
        if ($student->status === 'active') {
            return response()->json(['message' => 'Student already active'], 400);
        }
    
      
    
        try {
            // Get latest registration number (numeric part only)
            $latestReg = Student::whereNotNull('registration_no')
                ->orderByRaw('CAST(registration_no AS UNSIGNED) DESC')
                ->first();
    
            $latestRoll = Student::whereNotNull('roll_no')
                ->orderByRaw('CAST(roll_no AS UNSIGNED) DESC')
                ->first();
    
            // Generate new values
            $newRegistrationNo = $latestReg
                ? str_pad(((int)$latestReg->registration_no) + 1, 4, '0', STR_PAD_LEFT)
                : '1111';
    
            $newRollNo = $latestRoll
                ? ((int)$latestRoll->roll_no) + 1
                : 1;
    
            // Update student record
            $student->update([
                'status' => 'active',
                'registration_no' => $newRegistrationNo,
                'roll_no' => $newRollNo
            ]);
    
        
    
            return response()->json([
                'message' => 'Student active successfully!',
                'registration_no' => $newRegistrationNo,
                'roll_no' => $newRollNo
            ]);
    
        } catch (\Exception $e) {
            \DB::rollBack();
            return response()->json([
                'message' => 'Failed to verify student: ' . $e->getMessage()
            ], 500);
        }
    }
    

    public function verifyAll()
{
    // Get all unactive students
    $unactiveStudents = Student::where('status', '!=', 'active')->get();

    if ($unactiveStudents->isEmpty()) {
        return response()->json(['message' => 'No unactive students found'], 400);
    }

    try {
        // Get latest registration and roll numbers
        $latestReg = Student::whereNotNull('registration_no')
            ->orderByRaw('CAST(registration_no AS UNSIGNED) DESC')
            ->first();

        $latestRoll = Student::whereNotNull('roll_no')
            ->orderByRaw('CAST(roll_no AS UNSIGNED) DESC')
            ->first();

        $baseRegNo = $latestReg ? (int)$latestReg->registration_no : 1110;
        $baseRollNo = $latestRoll ? (int)$latestRoll->roll_no : 0;

        // Verify all students with sequential numbers
        foreach ($unactiveStudents as $index => $student) {
            $student->update([
                'status' => 'active',
                'registration_no' => str_pad($baseRegNo + $index + 1, 4, '0', STR_PAD_LEFT),
                'roll_no' => $baseRollNo + $index + 1
            ]);
        }

        return response()->json([
            'message' => 'All students active successfully!',
            'count' => $unactiveStudents->count()
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Failed to verify students: ' . $e->getMessage()
        ], 500);
    }
}
    // Display a specific student
    public function show(Student $student)
    {
        return view('students.show', compact('student'));
    }

    // Show the form for editing a student
    public function edit(Student $student)
    {
        return view('students.edit', compact('student'));
    }

    // Update a student
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:100',
            'father_name' => 'nullable|string|max:100',
            'mother_name' => 'nullable|string|max:100',
            'phone_number' => 'nullable|string|max:20',
            'tana' => 'nullable|string|max:100',
            'vill' => 'nullable|string|max:100',
            'name_of_course' => 'nullable|string|max:150',
            'address' => 'nullable|string|max:255',
            'session' => 'nullable|string|max:50',
            'year' => 'nullable|string|max:10',
            'status' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);

        $student->update($validatedData);

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('students/images', 'public');
            $student->update(['image' => $imagePath]);
        }

        // Handle signature upload
        if ($request->hasFile('signature')) {
            $signaturePath = $request->file('signature')->store('students/signatures', 'public');
            $student->update(['signature' => $signaturePath]);
        }

        return redirect()->route('students.index')->with('success', 'Student updated successfully.');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
