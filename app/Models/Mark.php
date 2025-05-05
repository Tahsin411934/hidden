<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 'course_id', 'academic_assessment', 
        'written', 'practical', 'viva', 'grade', 'gpa'
    ];

    // Relationship with student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relationship with course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Calculate total marks (accessor)
    public function getTotalObtainMarksAttribute()
    {
        return $this->academic_assessment + $this->written + $this->practical + $this->viva;
    }
}