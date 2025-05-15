<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mark extends Model
{
    use HasFactory;

    protected $fillable = [
        'student_id', 
        'course_id', 
        'academic_assessment', 
        'written', 
        'practical', 
        'viva', 
        'grade', 
        'gpa'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function getTotalObtainMarksAttribute()
    {
        return $this->academic_assessment + $this->written + $this->practical + $this->viva;
    }
}