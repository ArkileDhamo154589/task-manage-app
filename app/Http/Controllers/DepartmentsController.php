<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Session;

class DepartmentsController extends Controller
{

    // function __construct() 
    // {
    //     $this ->middleware('auth:api');
    // }
    // bellow is related to vue js crud
    public function getDepartments()
    {
        //with this we bring the latests
        return response()->json(Department::latest()->get());
    }


    public function storeDepartment(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'director_id' => ['required']
        ]);
        //we need our model
        Department::create([
            'user_id' => 1,
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);

        return response()->json('success');
    }

    public function updateDepartment(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'director_id' => ['required']
        ]);
        //we need to update it based on id
        Department::where('id', $id)->update([
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);

        return response()->json('success');
    }

    public function deleteDepartment($id)
    {
        Department::where('id', $id)->delete();

        return response()->json('success');
    }


    // bellow code is related to laravel crud
    public function index()
    {
        // all is a laravel function - it returns all the data of the model departments
        $departments = Department::all();
        //you can check if it works 
        // return $departments;
        return view('managment.departments.index', compact('departments'));
    }
    public function create()
    {
        //create the function 

        return view('managment.departments.create');
    }
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required'],
            'director_id' => ['required']
        ]);

        //we need our model
        Department::create([
            'user_id' => 1,
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);
        Session::flash('success-message', 'Department Created Successfully!!');
        return redirect('/');
    }
    //we take the id from the url 
    public function edit($id)
    {
        $department = Department::find($id);

        return view('managment.departments.edit', compact('department'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'director_id' => ['required']
        ]);
        //we updte the director id and name
        Department::where('id', $id)->update([
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);
        Session::flash('success-message', 'Department Updated Successfully!!');
        return redirect()->route('departmentsIndex');
    }
    public function delete(Request $request, $id)
    {

        Department::where('id', $id)->delete([
            'director_id' => $request->director_id,
            'name' => $request->name,
        ]);
        Session::flash('success-message', 'Department Deleted Successfully!!');
        return redirect()->route('departmentsIndex');
    }
}
