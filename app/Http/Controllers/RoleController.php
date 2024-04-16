<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function index()
    {

        $roles = Role::all();
        return view('managment.roles.index', compact('roles'));
    }
    public function create()
    {

        return view('managment.roles.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'display_name' => ['required'],
            'description' => ['required']
        ]);
        Role::create([
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description
        ]);
        Session::flash('succes-message', 'roles Has benn succesfull create');
        return redirect()->route('rolesIndex');
    }
      
        public function edit($id)
        {
            $roles = Role::find($id);
            return view('managment.roles.edit', compact('roles'));
        }

        public function delete($id)
        {
            Role::where('id', $id)->delete();
            Session::flash('succes-message', 'roles Has been delete succesfull');
            return redirect()->route('rolesIndex');
        }
        public function update(Request $request, $id)
        {
            $request->validate([
                'name' => ['required'],
                'display_name' => ['required'],
                'description' => ['required']
            ]);
            Role::where('id',$id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description
            ]);

            Session::flash('succes-message', 'roles Has benn succesfull updated');
            return redirect()->route('rolesIndex');
        }
        
        
}
