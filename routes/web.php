<?php

use App\Http\Controllers\DepartmentsController;
use Illuminate\Support\Facades\Route;
//Import Controller
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;



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

Route::get('users/index' , [UsersController::class, 'index'])->name('usersIndex');

