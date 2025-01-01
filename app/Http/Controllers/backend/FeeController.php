<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\FeeResource;
use App\Models\Fee;
use Illuminate\Http\Request;


class FeeController extends Controller
{
    public function __construct()
{
        $this->middleware('permission:fee update', ['only'=>['edit', 'update']]);
        $this->middleware('permission:fee view', ['only'=>['index', 'show']]);
        $this->middleware('permission:fee create', ['only'=>['create', 'store']]);
        $this->middleware('permission:fee delete', ['only'=>['destroy', 'trash', 'delete', 'restore']]);
        }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fees = Fee::with('student')->paginate(10); // Paginate with related student
        return FeeResource::collection($fees);
    }

    /**
     * Store a newly created fee.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:paid,pending,overdue',
            'due_date' => 'required|date',
            'paid_at' => 'nullable|date',
        ]);

        $fee = Fee::create($validated);

        return new FeeResource($fee);
    }

    /**
     * Display the specified fee.
     */
    public function show(Fee $fee)
    {
        $fee->load('student');
        return new FeeResource($fee);
    }

    /**
     * Update the specified fee.
     */
    public function update(Request $request, Fee $fee)
    {
        $validated = $request->validate([
            'student_id' => 'required|exists:students,id',
            'amount' => 'required|numeric|min:0',
            'status' => 'required|string|in:paid,pending,overdue',
            'due_date' => 'required|date',
            'paid_at' => 'nullable|date',
        ]);

        $fee->update($validated);

        return new FeeResource($fee);
    }

    /**
     * Remove the specified fee.
     */
    public function destroy(Fee $fee)
    {
        $fee->delete();

        return response()->json(['message'=>'deleted successfully!!!']);
    }
}
