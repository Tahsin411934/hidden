<?php

// app/Http/Controllers/CourseController.php
namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;
use App\Models\Branch;
use App\Models\Category;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::latest()->get();
        $categories = Category::all();
       
        return view('central.courses.index', compact('courses', 'categories'));
    }

    public function showtable()
    {
        $divisions = Division::orderBy('name')->get(['id', 'name']);
        $branches = Branch::leftJoin('divisions', 'branches.division_id', '=', 'divisions.id')
            ->leftJoin('districts', 'branches.district_id', '=', 'districts.id')
            ->select(
                'branches.*',
                'divisions.name as division_name',
                'divisions.id as division_id',
                'districts.name as district_name',
                'districts.id as district_id'
            )
            ->get();
        
        return view('central.courses.assign-courses', compact('divisions', 'branches'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('central.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // 2MB max
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('course_images', 'public');
            $validated['image'] = $path;
        }

        // Create the course
        Course::create($validated);

        return response()->json(['success' => true]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50|unique:courses,code,'.$course->id,
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // 2MB max
        ]);
    
        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if it exists
            if ($course->image) {
                Storage::delete('public/'.$course->image);
            }
            
            // Store new image
            $imagePath = $request->file('image')->store('course_images', 'public');
            $validated['image'] = $imagePath;
        } else {
            // Keep the existing image if no new image was uploaded
            $validated['image'] = $course->image;
        }
    
        $course->update($validated);
    
        return redirect()->route('courses.index')
                        ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->route('courses.index')
                        ->with('success', 'Course deleted successfully.');
    }
}