<?php

use App\Http\Controllers\backend\AuthController;
use App\Http\Controllers\backend\ComplaintController;
use App\Http\Controllers\backend\FeeController;
use App\Http\Controllers\backend\PermissionController;
use App\Http\Controllers\backend\RoleController;
use App\Http\Controllers\backend\RoomController;
use App\Http\Controllers\backend\StudentController;
use App\Http\Controllers\backend\UserController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



// Route::post('login',[AuthController::class, 'login']);

// Route::middleware('auth:sanctum')->group(function(){
//     Route::post('logout',[AuthController::class, 'logout']);
// });

Route::post('/admin-login', [AuthController::class, 'adminLogin']);
Route::post('/member/login', [AuthController::class, 'memberLogin']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');



Route::apiResource('permission', PermissionController::class);
   Route::middleware('auth:sanctum')->group(function(){ 

        Route::apiResource('roles', RoleController::class);
        Route::apiResource('users', UserController::class);
        Route::apiResource('rooms', RoomController::class);
        Route::apiResource('students', StudentController::class);
        Route::apiResource('complaints', ComplaintController::class);
        Route::apiResource('fees', FeeController::class);
});





