<?php

namespace App\Http\Controllers;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    public function index(){
        $permissions = Permission::all();
        return view('managment.permissions.index' , compact('permissions'));
    }
    public function create(){
        return view('managment.permissions.create');
    }
        public function store(Request $request)
        {
            if($request->permission_type == 'basic') {
                $request->validate([
                    'name'          => 'required|unique:permissions,name',
                    'display_name'  => 'required|unique:permissions,display_name',
                    'description'   => 'required',
                ]);

                Permission::create([
                    'name'          => $request->name,
                    'display_name'  => $request->display_name,
                    'description'   => $request->description,
                ]);

                Session::flash('success-message', 'Permission created successfully!');
            } else if($request->permission_type == 'crud') {
                $request->validate([
                    'resource'      => 'required',
                ]);

                $crud = $request->crudSelected;
                $duplicateCount = 0;

                if(count($crud) > 0) {
                    foreach($crud as $item) {
                        $name           = strtolower($request->resource) . '-' . strtolower($item);
                        $display_name   = ucwords($request->resource . ' ' . $item);
                        $description    = ucwords($request->resource . ' ' . $item);

                        if (!Permission::where('name', $name)->exists() && !Permission::where('display_name', $display_name)->exists()) {
                            Permission::create([
                                'name'          => $name,
                                'display_name'  => $display_name,
                                'description'   => $description,
                            ]);
                        } else {
                            $duplicateCount++;
                        }
                    }

                    if ($duplicateCount > 0) {
                        Session::flash('error-message', "Permissions not registered because already exist. $duplicateCount duplicates found.");
                    } else {
                        Session::flash('success-message', 'Permissions created successfully!');
                    }
                }
            }

            return redirect()->route('permissionsIndex');
        }

            public function update(Request $request, $id)
            {
                $request->validate([
                    'name'          => 'required|unique:permissions,name,' . $id,
                    'display_name'  => 'required|unique:permissions,display_name,' . $id,
                    'description'   => 'required',
                ]);

                Permission::where('id', $id)->update([
                    'name'          => $request->name,
                    'display_name'  => $request->display_name,
                    'description'   => $request->description,
                ]);

                Session::flash('success-message', 'Permission updated successfully!');
                return redirect()->route('permissionsIndex');
            }



  
 
    public function delete($id)
    {
        Permission::where('id', $id)->delete();
        Session::flash('success-message', 'Permission deleted successfully!');
        return redirect()-> route('permissionsIndex');
    }


    public function edit($id)
    {
        $permission = Permission::find($id);
        return view ('managment.permissions.edit' , compact('permission'));
    }
}
