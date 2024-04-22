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
    public function store(Request $request){
        $request->validate([
            'name' => ['required'], 
            'display_name' =>['required'],
            'description' => ['required'],
        ]);
        Permission::create([
            'name' => $request->name,
            'display_name'=> $request->display_name,
            'description' => $request->description
        ]);
        Session::flash('succes-message', 'Permissions Has been Create');
        return redirect()->route('permissionsindex');
    }
}
