<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;

class DepartmentsController extends Controller
{
    public function index()
    {
        // all is a laravel function - it returns all the data of the model departments
        $departments = Department::all();
        //you can check if it works 
        // return $departments;
        return view('managment.departments.index', compact('departments'));
    }
    public function create(){
        //create the function 

        return view ('managment.departments.create');

    }
    public function store(Request $request){
        
        //we need our model
        Department::create([
            'user_id' => 1,
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);

        return redirect('/');
    }
    //we take the id from the url 
    public function edit($id){
        $department = Department::find($id);

        return view('managment.departments.edit' , compact('department'));
    }
    public function update(Request $request ,$id)
    {
        //we updte the director id and name
        Department::where('id' , $id)->update([
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);
        return redirect()->route('departmentsIndex');
    }
}
