<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PermissionController extends Controller
{
    //
    public function index(){
        return view("admin.authorization.permissions" , ['permissions'=>Permission::all()]);
    }

    public function store(Request $request){
        $request->validate(['name'=>'required','slug'=>'required']);
        Permission::create(['name'=>$request->name, 'slug'=>$request->slug]);
        Session::flash('permissionadd','Successfully added');
        return back();
    }

    public function destroy($id){
        $per = Permission::findOrFail($id);
        $per->delete();
        Session::flash('permissiondelete','Successfully deleted');
        return back();
    }

    public function edit($id){
        return view('admin.authorization.permission-display',['permission' => Permission::findOrFail($id)]);
    }

    public function update(Request $request, Permission $permission){
        // dd($request->permissions, $id);
        $request->validate(['name'=>'required','slug'=>'required']);



        if($permission->name !== $request->name OR $permission->slug !== $request->slug){
            // return "worked";
            $permission->update(['name'=>$request->name , 'slug'=>$request->slug ]);
            return back();
        }
        // else{
        //     return 'didnt work';
        // }
        
    }

}
