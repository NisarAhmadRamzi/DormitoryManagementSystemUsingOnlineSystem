<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComplaintResource;
use App\Models\Complaint;
use Illuminate\Http\Request;


class ComplaintController extends Controller
{
    public function __construct()
    {
            $this->middleware('permission:complaint update', ['only'=>['edit', 'update']]);
            $this->middleware('permission:complaint view', ['only'=>['index', 'show']]);
            $this->middleware('permission:complaint create', ['only'=>['create', 'store']]);
            $this->middleware('permission:complaint delete', ['only'=>['destroy', 'trash', 'delete', 'restore']]);
            }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all complaints and return as a resource collection.
        return ComplaintResource::collection(Complaint::all());
    }

    /**
     * Store a newly created complaint in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data.
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id', // Ensure the student exists.
            'description' => 'required|string|max:500', // Validate the complaint description.
            'status' => 'in:Pending,Resolved', // Optional, validate status if provided.
        ]);

        // Create a new complaint.
        $complaint = Complaint::create($validatedData);

        // Return the created complaint as a resource.
        return new ComplaintResource($complaint);
    }

    /**
     * Display the specified complaint.
     * 
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function show(Complaint $complaint)
    {
        // Return the specific complaint as a resource.
        return new ComplaintResource($complaint);
    }

    /**
     * Update the specified complaint in the database.
     * 
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complaint $complaint)
    {
        // Validate the incoming request data.
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id', // Ensure the student exists.
            'description' => 'required|string|max:500', // Validate the complaint description.
            'status' => 'in:Pending,Resolved', // Optional, validate status if provided.
        ]);

        // Update the complaint with validated data.
        $complaint->update($validatedData);

        // Return the updated complaint as a resource.
        return new ComplaintResource($complaint);
    }

    /**
     * Remove the specified complaint from the database.
     * 
     * @param \App\Models\Complaint $complaint
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complaint $complaint)
    {
        // Delete the complaint.
        $complaint->delete();

        // Return a successful response.
        return response()->json(['message' => 'Complaint deleted successfully.'], 200);
    }
}
