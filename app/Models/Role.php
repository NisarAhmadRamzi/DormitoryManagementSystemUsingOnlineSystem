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
        // If the input $permissions is an array (multiple permissions)
        if (is_array($permissions)) {
            // Loop through each permission in the array
            foreach ($permissions as $permission) {
                // If the role has the permission, return true
                if ($this->hasPermission($permission)) {
                    return true;
                }
            }
        } else {
            // If the input $permissions is not an array (single permission)
            // Check if the role has the permission, return true if so
            if ($this->hasPermission($permissions)) {
                return true;
            }
        }
        // If none of the permissions match, return false
        return false;
    }

    // Define a method to check if the role has a specific permission
    public function hasPermission($permission)
    {
        // Check if the role's associated permissions contain the given permission name
        // If it finds a permission with the given name, return true
        if ($this->permissions()->where('name', $permission)->first()) {
            return true;
        }
        // If no matching permission is found, return false
        return false;
    }
}
