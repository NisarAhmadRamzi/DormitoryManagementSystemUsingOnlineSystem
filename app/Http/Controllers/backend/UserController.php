<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return UserResource::collection($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        $fields = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
            'cpassword'=>'required|same:password',
            'role' => 'required', // Ensure a role is provided
        ]);

        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_role = $request->role;
        $user->save();
        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $role = User::findOrFail($id);
        return UserResource::make($role);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $fields = $request->validate([
            'name' => 'sometimes|required',
            'email' => 'sometimes|required|email',
            'password' => 'nullable|min:4',
            'role' => 'sometimes|required', // Role is optional but validated if present
        ]);

        //second method
        // $user = User::findOrFail($id);
        // $user->update($fields);


        // Find the user by ID
        $user = User::findOrFail($id);

        // Update the user with new data
        if (isset($fields['name'])) $user->name = $fields['name'];
        if (isset($fields['email'])) $user->email = $fields['email'];
        if (isset($fields['password'])) $user->password = Hash::make($fields['password']);
        if (isset($fields['role'])) $user->user_role = $fields['role'];

        $user->save();

        // Return the updated user as a resource
        return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return response()->json(['message'=>'User deleted successfully !!!'],200);
    }
}
