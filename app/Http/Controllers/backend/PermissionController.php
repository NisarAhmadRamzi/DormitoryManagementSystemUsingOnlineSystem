<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;


class PermissionController extends Controller
{
    public function _construct()
{
        $this->middleware('permission:permission update', ['only'=>['edit', 'update']]);
        $this->middleware('permission:permission view', ['only'=>['index', 'show']]);
        $this->middleware('permission:permission create', ['only'=>['create', 'store']]);
        $this->middleware('permission:permission delete', ['only'=>['destroy', 'trash', 'delete', 'restore']]);
        }


    public function show(string $id)
        {
            // Retrieve the role with its permissions or fail if not found
            $role = Role::with('permissions')->findOrFail($id);

            // Format the response to return role and permissions details
            return response()->json([
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => $role->permissions->map(function ($permission) {
                    return [
                        'id' => $permission->id,
                        'name' => $permission->name,
                    ];
                }),
            ]);
        }



        public function update(Request $request, string $id)
        {
            // Validate the incoming request
            $request->validate([
                'permissions' => 'required|array', // Ensure permissions are an array
                'permissions.*' => 'exists:permissions,id', // Ensure each permission ID exists
            ]);
        
            // Retrieve the role by ID or fail if not found
            $role = Role::findOrFail($id);
        
            // Update the permissions for the role
            $role->permissions()->sync($request->permissions);
        
            // Refresh the role's relationships to get updated data
            $role->load('permissions');
        
            // Return a success response
            return response()->json([
                'message' => 'Permissions updated successfully',
                'role' => [
                    'id' => $role->id,
                    'name' => $role->name,
                    'permissions' => $role->permissions->map(function ($permission) {
                        return [
                            'id' => $permission->id,
                            'name' => $permission->name,
                        ];
                    }),
                ],
            ]);
        }
        



//  public function update(Request $request, string $id)
// {
//     // Validate the incoming request
//     $request->validate([
//         'name' => 'required|array', // Ensure permissions are an array
//          // Ensure each permission ID exists
//     ]);

//     // Retrieve the role by ID or fail if not found
//     $role = Role::findOrFail($id);

//     // Update the permissions for the role
//     $role->permissions()->sync($request->permissions);

//     // Return a success response
//     return response()->json([
//         'message' => 'Permissions updated successfully',
//         'role' => [
//             'id' => $role->id,
//             'name' => $role->name,
//             'permissions' => $role->permissions->map(function ($permission) {
//                 return [
//                     'id' => $permission->id,
//                     'name' => $permission->name,
//                 ];
//             }),
//         ],
//     ]);
// }
}
