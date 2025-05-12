<?php

namespace App\Http\Controllers;
use App\Models\Student;
use Illuminate\Http\Request;

class ResultController extends Controller
{
  public function result(Request $request)
    {
        $rollNo = $request->input('roll_no');
        $registrationNo = $request->input('registration_no');
        $student = null;

        if ($rollNo && $registrationNo) {
            $student = Student::with('marks', 'branch', 'course')
                ->where('roll_no', $rollNo)
                ->where('registration_no', $registrationNo)
                ->first();
        }

        return view('central.result.result', [
            'student' => $student,
            'roll_no' => $rollNo,
            'registration_no' => $registrationNo
        ]);
    }
}
