<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Devfaysal\BangladeshGeocode\Models\Division;
use Devfaysal\BangladeshGeocode\Models\District;
use Devfaysal\BangladeshGeocode\Models\Upazila;

class Branch extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_name',
        'email',
        'address',
        'upazila_id',
        'district_id',
        'division_id',
        'phone',
        'regional_director',
        'login_username',
        'password_hash',
        'is_active'
    ];

    protected $hidden = [
        'password_hash'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
    
    public function district()
    {
        return $this->belongsTo(District::class);
    }
    
    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class, 'branc_code', 'id');
    }

    public function branchCourses()
    {
        return $this->hasMany(BranchCourse::class);
    }

    public function activeCourses()
    {
        return $this->belongsToMany(Course::class, 'branch_courses')
                   ->wherePivot('is_active', true);
    }
}