<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(5);
        return view('admin.user.all-users', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('user.display', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // dd(($request));

        $request->validate(['name'=>'required',
                            'email'=>'required',
                            'password'=> 'confirmed']);

        $input = $request->all();

        if($file = $request->file('file')){
            $name = $file->getClientOriginalName();
            $file->move('images',$name);
            $input['avatar']='/images/'.$name;
        }
        else
        {
            $input['avatar']=auth()->user()->avatar;
        }
        $data = ['name'=>$input['name'], 'email'=>$input['email'], 'avatar'=>$input['avatar']];
        if(trim($request->password)!=null){
            if(trim($request->password)<8)
            throw ValidationException::withMessages(['password' => 'Password must be greater than 8 character']);
            $data['password'] = $request->password;

        }
        // dd($request, $input, $data);
        auth()->user()->update($data);
        // $user->posts()->whereId(23)->update(['title'=>'doneee'])

        Session::flash('update-message', 'Updated successfully');
        
        
        return redirect(route('user.profile',$id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::findOrFail($id);
        $user->delete();

        Session::flash('delete-message', 'deleted successfully');
        
        return redirect(route('users.index'));
    }

    public function profileshow($id){
        
        

        $user = User::findOrFail($id);
        return view('admin.user.profile',compact('user'));
    }


    public function showuserposts($id){

    $user = User::findOrFail($id);
    $posts = $user->posts;
    $roles = Role::all();
    return view('admin.user.profile-post', compact('user','posts','roles'));
    }

    public function userRolesUpdate(Request $request, $id){
        // dd($id,$request->roles);
        User::findOrFail($id)->roles()->sync($request->roles);
        Session::flash('update-message', 'updated successfully');
        return back();
    }



    public function getUserPreview($id){

        $user = User::findOrFail($id);

        // return response()->json($user->toArray(),200);
        return $user;

    }


    public function testjqgrid(){
        $user = User::get();
        return $user;
    }
   
 

}
