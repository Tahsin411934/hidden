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
        'mother_name',
        'phone_number',
        'tana',
        'vill',
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
        return $this->belongsTo(Branch::class, 'branc_code'); // Fixed relationship syntax
    }

public function course()
{
    return $this->belongsTo(Course::class,'course_id');
}
}
