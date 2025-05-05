<?php

namespace App\Http\Controllers;

use App\Models\Mark;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MarkController extends Controller
{
    /**
     * Display a listing of the marks.
     */
    public function index()
    {
        $marks = Mark::with(['student', 'course'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('marks.index', compact('marks'));
    }

    /**
     * Show the form for creating a new mark.
     */
    public function create()
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();
        
        return view('marks.create', compact('students', 'courses'));
    }

    /**
     * Store a newly created mark in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validation of the input data
            $validated = $request->validate([
                'student_id' => 'required|exists:students,id',
                'course_id' => 'required|exists:courses,id',
                'academic_assessment' => 'required|numeric|min:0|max:300',
                'written' => 'required|numeric|min:0|max:50',
                'practical' => 'required|numeric|min:0|max:40',
                'viva' => 'required|numeric|min:0|max:10',
                'gpa' => 'required|numeric|min:0|max:5',
                'grade' => 'required|string',
            ], [
                'student_id.required' => 'Please select a student',
                'course_id.required' => 'Please select a course',
                'academic_assessment.max' => 'Academic assessment cannot exceed 300 marks',
                'written.max' => 'Written exam cannot exceed 50 marks',
                'practical.max' => 'Practical cannot exceed 40 marks',
                'viva.max' => 'Viva cannot exceed 10 marks',
                'gpa.max' => 'GPA cannot exceed 5.00',
            ]);
    
            // Check if marks already exist for the student in the course
            if (Mark::where('student_id', $validated['student_id'])
                ->where('course_id', $validated['course_id'])
                ->exists()) {
                return back()
                    ->withInput()
                    ->with('error', 'Marks already exist for this student in the selected course.');
            }
    
            // Create new marks entry
            Mark::create($validated);
    
            return redirect()
                ->back()
                ->with('success', 'Marks added successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Collect validation errors and return them
            $errorMessages = implode('<br>', array_flatten($e->errors()));
            return back()
                ->withInput()
                ->with('error', $errorMessages);
        }
    }
    
    /**
     * Display the specified mark.
     */
    public function show($student_id)
    {
        $student = Student::with(['course', 'marks.course'])->findOrFail($student_id);
        $courses = Course::orderBy('name')->get();
        
        return view('central.marks.show', [
            'student' => $student,
            'courses' => $courses,
           
            'existing_marks' => $student->marks->keyBy('course_id') // For easy lookup
        ]);
    }

    /**
     * Show the form for editing the specified mark.
     */
    public function edit(Mark $mark)
    {
        $students = Student::orderBy('name')->get();
        $courses = Course::orderBy('name')->get();

        return view('marks.edit', compact('mark', 'students', 'courses'));
    }

    /**
     * Update the specified mark in storage.
     */
    public function update(Request $request, Mark $mark)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'course_id' => 'required|exists:courses,id',
            'academic_assessment' => 'required|numeric|min:0|max:30',
            'written' => 'required|numeric|min:0|max:40',
            'practical' => 'required|numeric|min:0|max:20',
            'viva' => 'required|numeric|min:0|max:10',
        ], [
            'student_id.required' => 'Please select a student',
            'course_id.required' => 'Please select a course',
            'academic_assessment.max' => 'Academic assessment cannot exceed 30 marks',
            'written.max' => 'Written exam cannot exceed 40 marks',
            'practical.max' => 'Practical cannot exceed 20 marks',
            'viva.max' => 'Viva cannot exceed 10 marks',
        ]);

        // Check if marks already exist for this student and course combination (excluding current record)
        $existingMark = Mark::where('student_id', $validated['student_id'])
            ->where('course_id', $validated['course_id'])
            ->where('id', '!=', $mark->id)
            ->first();

        if ($existingMark) {
            return back()
                ->withInput()
                ->withErrors(['duplicate' => 'Marks already exist for this student in the selected course.']);
        }

        $mark->update($validated);

        return redirect()
            ->route('marks.index')
            ->with('success', 'Marks updated successfully!');
    }

    /**
     * Remove the specified mark from storage.
     */
    public function destroy(Mark $mark)
    {
        $mark->delete();

        return redirect()
            ->route('marks.index')
            ->with('success', 'Marks deleted successfully!');
    }
}