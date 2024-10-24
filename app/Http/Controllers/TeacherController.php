<?php

namespace App\Http\Controllers;

use App\Models\Student;

class TeacherController extends Controller
{
    public function index()
    {
        $students = Student::all(); // Fetch all students
        return view('teacher.home', compact('students'));
    }
}
