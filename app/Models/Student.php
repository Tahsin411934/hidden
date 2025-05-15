<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'father_name',
        'date_of_birth',
        'mother_name',
        'phone_number',
        'tana',
        'vill',
        'district',
        'course_id',
        'address',
        'session',
        'image',
        'year',
        'signature',
        'status',
        'registration_no',
        'roll_no',
        'branc_code'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branc_code', 'id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function marks()
    {
        return $this->hasMany(Mark::class);
    }

    public function getAverageMarksAttribute()
    {
        return $this->marks()->avg('total_obtain_marks');
    }
}