<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'code', 'category_id', 'image'];
    
    public function branchCourses()
    {
        return $this->hasMany(BranchCourse::class, 'course_code', 'code');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'course_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_courses', 'course_code', 'branch_id');
    }
}