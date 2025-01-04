<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

// class PermissionMiddleware
// {
//     /**
//      * Handle an incoming request.
//      *
//      * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//      */

//      // Handle an incoming request, check if the user has the necessary permissions
//     public function handle(Request $request, Closure $next, ...$permission): Response
// {
//     // If the user is not logged in (no user found), abort with a 401 (Unauthorized) status
//     if ($request->user() === null) {
//         // abort(401); // Abort the request, as the user is not authorized
//         abort(403, 'You do not have permission to access this resource.');
// }

//     // If the logged-in user's role has any of the required permissions
//     // This checks using the `hasAnyPermissions` method from the Role model
//     if ($request->user()->role->hasAnyPermission($permission)) {
//         // If the user has the required permission(s), allow the request to proceed to the next middleware or controller
//         return $next($request);
//     }

//     // If the user does not have the required permissions, abort with a 401 (Unauthorized) status
//     return response()->json(['message' => 'User not have these permission'], 401); // User lacks permissions, so the request is denied
// }
// }


// class PermissionMiddleware
// {
//     public function handle($request, Closure $next)
//     {
//         $user = Auth::user();

//         if (!$user) {
//             return response()->json(['message' => 'User not authenticated'], 401);
//         }

//         if (!$user->role) {
//             return response()->json(['message' => 'User has no role assigned'], 403);
//         }

//         // Add your permission logic here
        

//         return $next($request);
//     }
// }

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */

     public function handle($request, Closure $next, ...$permission): Response   {
        // If the user is not logged in (no user found), abort with a 401 (Unauthorized) status
        if ($request->user() === null) {
            abort(401, 'Unauthorized: User not logged in.');
        }
        
        if ($request->user()->role === null) {
            abort(403, 'Forbidden: User does not have a role assigned.');
        }
        
        if (!$request->user()->role->hasAnyPermission($permission)) {
            abort(403, 'Forbidden: User does not have the required permissions.');
        }
        return $next($request);

        // If the user is not logged in, it aborts with a 401 Unauthorized status.
        // If the user does not have a role, it aborts with a 403 Forbidden status.
        // If the user does not have the required permissions, it aborts with a 403 Forbidden status.
        // If all conditions are met, the request proceeds to the next step.
        //     }
}}
        
         