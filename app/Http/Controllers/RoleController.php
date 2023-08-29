<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index (){
        $roles = Role::all();

        return $roles;
    }

    public function create(Request $request){
        $role = new Role();


        $role->lable = $request->label;
        $role->save();
    }

    public function delete($id){
        $role = Role::find($id);

        $role->delete();
    }
}
