<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct()
{
        $this->middleware('permission:user update', ['only'=>['edit', 'update']]);
        $this->middleware('permission:user view', ['only'=>['index', 'show']]);
        $this->middleware('permission:user create', ['only'=>['create', 'store']]);
        $this->middleware('permission:user delete', ['only'=>['destroy', 'trash', 'delete', 'restore']]);
        }
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Retrieve paginated users with their profiles and roles
    $users = User::with('profile', 'role')->paginate(10);

    // Return users as a resource collection
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
            'profile_pic' => 'nullable'
        ]);

        $user = new user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_role = $request->role;
        $user->save();

        $file = $request->file('profile_pic');
        $path = $file ? $file->store('uploads', 'public') : null;
        $profile = new Profile();
        $profile->profile_pic = $path;
        $profile->user_id = $user->id;
        $profile->save();

        return UserResource::make($user);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Find the user with related data or fail
        $user = User::with('profile', 'role')->findOrFail($id);
    
        // Return the user as a resource
        return new UserResource($user);
    }
    


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validate incoming data
        $fields = $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min:4',
            'cpassword'=>'required|same:password',
            'role' => 'required', // Ensure a role is provided
            'profile_pic' => 'nullable'
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->user_role = $request->role;
        $user->save();

        $file = $request->file('profile_pic');
        $path = $file ? $file->store('uploads', 'public') : null;
        $profile = new Profile();
        $profile->profile_pic = $path;
        $profile->user_id = $user->id;
        $profile->save();

        return UserResource::make($user);
;

        


        // Find the user by ID
        // $user = User::findOrFail($id);

        // Update the user with new data
        // if (isset($fields['name'])) $user->name = $fields['name'];
        // if (isset($fields['email'])) $user->email = $fields['email'];
        // if (isset($fields['password'])) $user->password = Hash::make($fields['password']);
        // if (isset($fields['role'])) $user->user_role = $fields['role'];
        // $user->save();


        //second method
        // $user = User::findOrFail($id);
        // $user->update($fields);

        // Return the updated user as a resource
        // return UserResource::make($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Find the user or fail
    $user = User::findOrFail($id);

    // Delete the user's profile if it exists
    if ($user->profile) {
        Storage::disk('public')->delete($user->profile->profile_pic); // Delete profile picture from storage
        $user->profile()->delete(); // Delete profile record
    }

    // Delete the user
    $user->delete();

    // Return a success response
    return response()->json(['message' => 'User deleted successfully'], 200);
}

}
//new methods


// public function store(Request $request)
// {
//     // Validate request data
//     $fields = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email', // Ensure unique emails
//         'password' => 'required|min:4',
//         'cpassword' => 'required|same:password',
//         'role' => 'required|string',
//         'profile_pic' => 'nullable|image|max:2048', // Validate profile picture
//     ]);

//     try {
//         // Create user
//         $user = new User();
//         $user->name = $fields['name'];
//         $user->email = $fields['email'];
//         $user->password = Hash::make($fields['password']);
//         $user->user_role = $fields['role'];
//         $user->save();

//         // Handle profile picture upload
//         $path = null;
//         if ($request->hasFile('profile_pic')) {
//             $file = $request->file('profile_pic');
//             $path = $file->store('uploads', 'public');
//         }

//         // Create profile
//         $profile = new Profile();
//         $profile->profile_pic = $path;
//         $profile->user_id = $user->id;
//         $profile->save();

//         // Return response
//         return response()->json([
//             'message' => 'User created successfully',
//             'user' => new UserResource($user),
//         ], 201);

//     } catch (\Exception $e) {
//         // Handle errors
//         return response()->json([
//             'message' => 'Failed to create user',
//             'error' => $e->getMessage(),
//         ], 500);
//     }
// }



// public function update(Request $request, $id)
// {
//     // Validate input fields
//     $fields = $request->validate([
//         'name' => 'required',
//         'email' => 'required|email',
//         'password' => 'nullable|min:4', // Password can be nullable on update
//         'cpassword' => 'nullable|same:password', // cpassword must match if password is updated
//         'role' => 'required',
//         'profile_pic' => 'nullable|image|max:2048', // Ensure profile_pic is a valid image
//     ]);

//     // Find the user
//     $user = User::findOrFail($id);
//     $user->name = $request->name;
//     $user->email = $request->email;
    
//     // Update password only if provided
//     if ($request->filled('password')) {
//         $user->password = Hash::make($request->password);
//     }

//     $user->user_role = $request->role;
//     $user->save();

//     // Handle profile picture update
//     if ($request->hasFile('profile_pic')) {
//         $file = $request->file('profile_pic');

//         // Find the existing profile
//         $profile = Profile::where('user_id', $user->id)->first();

//         if ($profile) {
//             // Delete the old profile picture if it exists
//             if ($profile->profile_pic && Storage::disk('public')->exists($profile->profile_pic)) {
//                 Storage::disk('public')->delete($profile->profile_pic);
//             }

//             // Store the new profile picture
//             $path = $file->store('uploads', 'public');
//             $profile->profile_pic = $path;
//             $profile->save();
//         } else {
//             // Create a new profile record if none exists
//             $path = $file->store('uploads', 'public');
//             $profile = new Profile();
//             $profile->profile_pic = $path;
//             $profile->user_id = $user->id;
//             $profile->save();
//         }
//     }

//     return response()->json([
//         'message' => 'Profile updated successfully',
//         'user' => new UserResource($user),
//     ]);
// }







//---------------------
// public function update(Request $request, $id)
// {
//     // Validate incoming data
//     $fields = $request->validate([
//         'name' => 'required|string|max:255',
//         'email' => 'required|email|unique:users,email,' . $id, // Exclude current user from unique check
//         'password' => 'nullable|min:4', // Password is optional
//         'cpassword' => 'nullable|same:password', // Confirm password only if provided
//         'role' => 'required|exists:roles,name', // Ensure role exists
//         'profile_pic' => 'nullable|image|max:2048', // Limit profile_pic size and type
//     ]);

//     // Find user or fail
//     $user = User::findOrFail($id);

//     // Update user fields
//     $user->name = $fields['name'];
//     $user->email = $fields['email'];

//     // Update password only if provided
//     if (!empty($fields['password'])) {
//         $user->password = Hash::make($fields['password']);
//     }

//     $user->user_role = $fields['role'];
//     $user->save();

//     // Handle profile picture
//     if ($request->hasFile('profile_pic')) {
//         $file = $request->file('profile_pic');
//         $path = $file->store('uploads', 'public');

//         // Update or create profile
//         $profile = Profile::updateOrCreate(
//             ['user_id' => $user->id], // Match on user_id
//             ['profile_pic' => $path] // Update profile_pic
//         );
//     }

//     // Return updated user resource
//     return new UserResource($user);
// }
// ----------------------------
