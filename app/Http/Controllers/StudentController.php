<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
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
    public function branchAllStudent()
    {  
        $branch = session('branch');
        $branch_id = $branch['id'];
        $students = Student::whereIn('status', ['active','completed'])
        ->where('branc_code', $branch_id)
        ->with('branch', 'course')
        ->get();
        
        
        return view('branch.students.allStudent', compact('students'));
    }
    public function branchActiveStudent()
    {  
        $branch = session('branch');
        $branch_id = $branch['id'];
        $students = Student::whereIn('status', ['active'])
        ->where('branc_code', $branch_id)
        ->with('branch', 'course')
        ->get();
        
        
        return view('branch.students.activeStudent', compact('students'));
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
    
        \DB::beginTransaction();
    
        try {
            // Get branch info from session (with validation)
           
            $branch_id = $student->branc_code;
            $year = date('y'); // Last 2 digits of current year
    
            // Get latest roll number and increment
            $latestRoll = Student::whereNotNull('roll_no')
                ->orderByRaw('CAST(roll_no AS UNSIGNED) DESC')
                ->first();
            
            $newRollNo = $latestRoll ? ((int)$latestRoll->roll_no) + 1 : 1;
    
            // Generate registration number: branch_id + year + padded roll_no
            $newRegistrationNo = $branch_id . $year . str_pad($newRollNo, 4, '0', STR_PAD_LEFT);
    
            // Update student
            $student->update([
                'status' => 'active',
                'registration_no' => $newRegistrationNo,
                'roll_no' => $newRollNo
            ]);
    
            \DB::commit();
    
            return response()->json([
                'message' => 'Student activated successfully!',
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
        // Get all inactive students (more correct term than "unactive")
        $inactiveStudents = Student::where('status', '!=', 'active')->get();
    
        if ($inactiveStudents->isEmpty()) {
            return response()->json(['message' => 'No inactive students found'], 400);
        }
    
        \DB::beginTransaction();
    
        try {
            // Get branch info from session
            
            $year = date('y'); // Current year in 2 digits
    
            // Get the highest roll number
            $latestRoll = Student::whereNotNull('roll_no')
                ->orderByRaw('CAST(roll_no AS UNSIGNED) DESC')
                ->first();
            $currentRoll = $latestRoll ? (int)$latestRoll->roll_no : 0;
    
            // Process all students
            foreach ($inactiveStudents as $student) {
                $currentRoll++;
                
                $student->update([
                    'status' => 'active',
                    'registration_no' => $student->branc_code . $year . str_pad($currentRoll, 4, '0', STR_PAD_LEFT),
                    'roll_no' => $currentRoll
                ]);
            }
    
            \DB::commit();
    
            return response()->json([
                'message' => 'Students activated successfully!',
               
            ]);
    
        } catch (\Exception $e) {
            \DB::rollBack();
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
    public function branchshow($student_id)
    {
        $students = Student::whereIn('status', ['active', 'completed'])
            ->where('id', $student_id)
            ->with('branch', 'course')
            ->firstOrFail();
    
        return view('branch.students.show', compact('students'));
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
            'course_id' => 'nullable|exists:courses,id',
            'address' => 'nullable|string|max:255',
            'session' => 'nullable|string|max:50',
            'year' => 'nullable|string|max:10',
            'status' => 'nullable|string|max:20',
            'registration_no' => 'nullable|string|max:50',
            'roll_no' => 'nullable|string|max:50',
            'branc_code' => 'nullable|string|max:50',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'signature' => 'nullable|image|mimes:jpeg,png,jpg|max:1024',
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($student->image && Storage::disk('public')->exists($student->image)) {
                Storage::disk('public')->delete($student->image);
            }
            
            $imagePath = $request->file('image')->store('students/images', 'public');
            $validatedData['image'] = $imagePath;
        }
    
        // Handle signature upload
        if ($request->hasFile('signature')) {
            // Delete old signature if exists
            if ($student->signature && Storage::disk('public')->exists($student->signature)) {
                Storage::disk('public')->delete($student->signature);
            }
            
            $signaturePath = $request->file('signature')->store('students/signatures', 'public');
            $validatedData['signature'] = $signaturePath;
        }
    
        $student->update($validatedData);
    
        return redirect()->back()->with('success', 'Student updated successfully.');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully.');
    }
}
