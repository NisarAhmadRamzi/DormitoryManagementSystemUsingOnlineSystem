<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use Illuminate\Http\Request;


class StudentController extends Controller
{
    public function _construct()
{
        $this->middleware('permission:student update', ['only'=>['edit', 'update']]);
        $this->middleware('permission:student view', ['only'=>['index', 'show']]);
        $this->middleware('permission:student create', ['only'=>['create', 'store']]);
        $this->middleware('permission: student delete', ['only'=>['destroy', 'trash', 'delete', 'restore']]);
        }
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
            'name' => ['required', 'string', 'max:255'], // Name is required, should be a string, max length 255
            'f_name' => ['required', 'string', 'max:255'], // Father's name is required
            'last_name' => ['required', 'string', 'max:255'], // Last name is required
            'from' => ['required', 'string', 'max:255'], // Place of origin is required
            'dob' => ['required', 'date', 'before:today'], // Date of birth should be before today
            'id_number' => ['required', 'integer', 'digits_between:1,20'], // National ID number, must be an integer
            'academic_info' => ['nullable', 'string'], // Academic information is optional
            'phone' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'], // Phone number must be 10-15 digits
            'registration_date' => ['required', 'date'], // Registration date is required
            'registration_deadline' => ['required', 'date', 'after_or_equal:registration_date'], // Deadline must be on/after registration date
            'gender' => ['required', 'in:Male,Female,Other'], // Must be Male, Female, or Other
            'user_id' => ['required', 'exists:users,id'], // Must reference an existing user ID
            'room_id' => ['nullable', 'exists:rooms,id'], // If provided, must reference an existing room ID
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
        $validatedData =$request->validate([
            'name' => ['required', 'string', 'max:255'], // Name is required, should be a string, max length 255
            'f_name' => ['required', 'string', 'max:255'], // Father's name is required
            'last_name' => ['required', 'string', 'max:255'], // Last name is required
            'from' => ['required', 'string', 'max:255'], // Place of origin is required
            'dob' => ['required', 'date', 'before:today'], // Date of birth should be before today
            'id_number' => ['required', 'integer', 'digits_between:1,20'], // National ID number, must be an integer
            'academic_info' => ['nullable', 'string'], // Academic information is optional
            'phone' => ['required', 'string', 'regex:/^[0-9]{10,15}$/'], // Phone number must be 10-15 digits
            'registration_date' => ['required', 'date'], // Registration date is required
            'registration_deadline' => ['required', 'date', 'after_or_equal:registration_date'], // Deadline must be on/after registration date
            'gender' => ['required', 'in:Male,Female,Other'], // Must be Male, Female, or Other
            'user_id' => ['required', 'exists:users,id'], // Must reference an existing user ID
            'room_id' => ['nullable', 'exists:rooms,id'], // If provided, must reference an existing room ID
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
