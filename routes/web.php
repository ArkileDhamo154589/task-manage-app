<?php

use App\Http\Controllers\DepartmentsController;
use Illuminate\Support\Facades\Route;
//Import Controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use Laratrust\Http\Controllers\RolesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| we create route using controller , [we declare controller using [] ] we also put ::class and we call the function dashboard
| We create a route get (because we want a movement).we will give a name tou our route , everything that we will change the name ill be unique
| 
|
*/

Route::get('/' , [HomeController::class, 'dashboard']);
Route::get('departments/index' , [DepartmentsController::class, 'index'])->name('departmentsIndex');
Route::get('departments/create' ,[DepartmentsController::class , 'create'])->name('departmentsCreate');
Route::post('departments/store' ,[DepartmentsController::class , 'store'])->name('departmentsStore');
//we create the route for edit (with {id}) we declare the id of the department or anything that we edit
Route::get('departments/edit/{id}' ,[DepartmentsController::class , 'edit'])->name('departmentsEdit');
Route::post('departments/update/{id}' ,[DepartmentsController::class , 'update'])->name('departmentsUpdate');
Route::post('departments/delete/{id}' ,[DepartmentsController::class , 'delete'])->name('departmentsDelete');

Route::get('roles/index', [RoleController::class, 'index'])->name('rolesIndex');
Route::get('roles/create', [RoleController::class, 'create'])->name('rolesCreate');
Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('rolesEdit');
Route::post('roles/delete/{id}' , [RoleController::class , 'delete'])->name('rolesDelete');
Route::post('roles/update/{id}', [RoleController::class, 'update'])->name('rolesUpdate');
Route::post('roles/store', [RoleController::class, 'store'])->name('rolesStore');

//permissions controllers
Route::get('permissions/index' , [PermissionController::class , 'index'])->name('permissionsIndex');
Route::get('permissions/create' , [PermissionController::class , 'create'])->name('permissionsCreate');
Route::post('permissions/store' , [PermissionController::class, 'store'])->name('permissionStore');
Route::get('permissions/edit/{id}', [PermissionController::class, 'edit'])->name('permissionsEdit');
Route::post('permissions/update/{id}', [PermissionController::class, 'update'])->name('permissionUpdate');
Route::post('permissions/delete/{id}' , [PermissionController::class , 'delete'])->name('permissionDelete');

//users controllers
Route::get('users/index' , [UsersController::class, 'index'])->name('usersIndex');




