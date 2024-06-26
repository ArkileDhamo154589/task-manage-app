<?php

use App\Http\Controllers\ApiController;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DepartmentsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('storeDepartment', [DepartmentsController::class, 'storeDepartment']);
Route::get('getDepartments', [DepartmentsController::class, 'getDepartments']);
Route::post('updateDepartment/{id}', [DepartmentsController::class, 'updateDepartment']);
Route::post('deleteDepartment/{id}', [DepartmentsController::class, 'deleteDepartment']);

Route::get('getAllDepartments', [ApiController::class, 'getAllDepartments']);
Route::get('getAllRoles', [ApiController::class, 'getAllRoles']);
Route::get('getAllPermissions', [ApiController::class, 'getAllPermissions']);