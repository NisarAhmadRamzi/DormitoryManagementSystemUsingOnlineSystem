<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use App\Models\Role;
use Illuminate\Http\Request;



class RoleController extends Controller
{
    public function _construct()
    {
            $this->middleware('permission:role update', ['only'=>['edit', 'update']]);
            $this->middleware('permission:role view', ['only'=>['index', 'show']]);
            $this->middleware('permission:role create', ['only'=>['create', 'store']]);
            $this->middleware('permission:role delete', ['only'=>['destroy', 'trash', 'delete', 'restore']]);
            }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $role = Role::all();
        return RoleResource::collection($role);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    
    {
        
        $field = $request->validate([
            'name' => 'required'
        ]);
        Role::create($field);

        return RoleResource::collection(Role::all());
    }

    /**
     * Display the specified resource.
     */

  
        // In your RoleController.php

        

        

    public function show(string $id)
    {
        $role = Role::findOrFail($id);
        return  RoleResource::make($role);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $field = $request->validate([
            'name'=> 'required',
        ]);
        $role=Role::findOrFail($id);
        $role->update($field);
        return RoleResource::make($role);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return response()->json(['message' => 'Role deleted successfully.'], 200);
    }
}
