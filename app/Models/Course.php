<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['name', 'code','category_id','image'];
    
    public function branchCourses()
    {
        return $this->hasMany(BranchCourse::class, 'course_code', 'code');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}