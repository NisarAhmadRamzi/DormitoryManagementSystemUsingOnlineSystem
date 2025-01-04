<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Role extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users()
    {
        return $this->hasMany(User::class, 'user_role', 'id'); // 'user_role' is the foreign key in the users table
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission', 'role_id', 'permission_id');
    }
    

    // Define a method that checks if the role has any of the given permissions
    public function hasAnyPermission($permissions)
{
    $permissions = (array) $permissions; // Ensure it's always an array
    foreach ($permissions as $permission) {
        if ($this->hasPermission($permission)) {
            return true;
        }
    }
    return false;
}


    // Define a method to check if the role has a specific permission
    public function hasPermission($permission)
    {
        // Check if the role's associated permissions contain the given permission name
        // If it finds a permission with the given name, return 

        $this->load('permissions');
        if ($this->permissions->contains('name', $permission)) {
            return true;
        }

        // If no matching permission is found, return false
        return false;
    }
}
