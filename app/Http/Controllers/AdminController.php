<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminController extends Controller
{
    public function index(){
        if(Gate::allows('is_admin', auth()->user() )){

                foreach(User::get() as $user){
                    $allcount[] = $user->posts->count();
                }
            
                return view('admin.index',['posts'=>Post::count(),
                                        'comments'=>Comment::count(),
                                        'replies'=>CommentReply::count(),
                                        'users'=>User::get(),
                                        'allcount'=>$allcount,
                                        ]);
        }
        else{
            // UserController::showuserposts(auth()->user()->id);
            return redirect(url('/user/post/display/'.auth()->user()->id));
        }
    }
}
