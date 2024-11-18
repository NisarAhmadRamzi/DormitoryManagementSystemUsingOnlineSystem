<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch all students and return them as a resource collection
        return StudentResource::collection(Student::all());
    }

    /**
     * Store a newly created student in storage.
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'phone' => 'required|string|max:15',
            'academic_info' => 'nullable|string',
            'room_id' => 'required|exists:rooms,id',
        ]);

        // Create a new student record
        $student = Student::create($validatedData);

        // Return the created student as a resource
        return new StudentResource($student);
    }

    /**
     * Display the specified student.
     */
    public function show(Student $student)
    {
        // Return the specified student as a resource
        return new StudentResource($student);
    }

    /**
     * Update the specified student in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Validate incoming request data
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'dob' => 'required|date',
            'gender' => 'required|in:Male,Female,Other',
            'phone' => 'required|string|max:15',
            'academic_info' => 'nullable|string',
            'room_id' => 'required|exists:rooms,id',
        ]);

        // Update the student record
        $student->update($validatedData);

        // Return the updated student as a resource
        return new StudentResource($student);
    }

    /**
     * Remove the specified student from storage.
     */
    public function destroy(Student $student)
    {
        // Delete the student record
        $student->delete();

        // Return a success response
        return response()->json(['message' => 'Student deleted successfully.'], 200);
    }
}
