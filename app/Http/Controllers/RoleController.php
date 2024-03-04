<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Post;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Null_;

class RoleController extends Controller
{
    
    public function index(){
        $roles = Role::all();
        return view("admin.authorization.roles", compact('roles'));
    }

    public function store(Request $request){
        $request->validate(['rolename'=>'required','roleslug'=>'required']);
        // dd($request);
        Role::create(['name'=>$request->rolename, 'slug'=>$request->roleslug]);
        Session::flash('roleadd','Successfully added');
        return back();
    }

    public function destroy($id)
    {
        $role= Role::findOrFail($id);
        $role->delete();
        Session::flash('roledelete','Successfully deleted');
        return back();


        // Session::flash('message', 'Deleted successfully');
        // Session::flash('action', 'delete');

        // return redirect(route('posts.index'));
    }

    public function edit($id){
        return view('admin.authorization.role-display',['role' => Role::findOrFail($id), 'permissions'=>Permission::all()]);
    }

    public function update(Request $request, Role $role){
        // dd($request->permissions, $id);
        $request->validate(['name'=>'required','slug'=>'required']);



        if($role->name !== $request->name OR $role->slug !== $request->slug OR $role->permissions != $request->permissions){
            // return "worked";
            $role->update(['name'=>$request->name , 'slug'=>$request->slug ]);

                $role->permissions()->sync($request->permissions);
            


            return back();
        }
        else{
            return 'didnt work';
        }
        
    }
}
