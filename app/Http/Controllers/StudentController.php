<?php


namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use Auth;
class StudentController extends Controller
{
    // Update student details
    
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->update($request->only(['name', 'subject', 'marks']));
        return response()->json(['success' => 'Student updated successfully.']);
    }

    // Delete a student
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();
        return response()->json(['success' => 'Student deleted successfully.']);
    }

    // Add a new student or update if already exists
    public function store(Request $request)
    {
        $teacherId = Auth::guard('teacher')->id();
       // dd($teacherId);
        // Check if student with same name and subject exists
        $existingStudent = Student::where('name', $request->name)
                                  ->where('subject', $request->subject)
                                  ->first();

        if ($existingStudent) {
            // If student exists, update the marks
            $existingStudent->marks = $request->marks;
            $existingStudent->save();
            return response()->json(['success' => 'Marks updated successfully for existing student.']);
        } else {
            // If student does not exist, create a new one
            Student::create([
                'name' => $request->name,
                'subject' => $request->subject,
                'marks' => $request->marks,
                'teacher_id' => $teacherId, // Associate the student with the teacher
            ]);
            return response()->json(['success' => 'New student added successfully.']);
        }
    }

    public function show($id)
    {
        $student = Student::findOrFail($id); // Find the student by ID or fail
        return response()->json($student);   // Return the student data as JSON
    }
}
