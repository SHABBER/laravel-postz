<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::all();
        return view('post.comments.comment-display',compact('comments'));
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
    public function store(Request $request, $id)
    {
        $request->validate(['body'=>'required']);

        $user = Auth::user();
        $post = Post::findOrFail($id);
        $post->comments()->save(Comment::create([
                                        'author'=>$user->name,
                                        'email'=>$user->email,
                                        'body'=>$request->body,
                                        'post_id'=>$post->id
                                    ]));
        Session::flash('commented', 'Comment submitted, waiting for approval');
        
        return redirect(url('/posts/'.$id.'#commentform'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $comment = Comment::findOrFail($id);
        if($comment->is_active == 0)
            $comment->update(['is_active'=>1]);
        else
            $comment->update(['is_active'=>0]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->delete();
        return back();
    }


    /**
    * @method ajaxUpdate()
    *
    * @uses uses ajax to update the is_active status 
    *
    * @author Toufiq
    *
    * @param Request request
    * 
    * @return json response
    *
    */
    public function ajaxUpdate(Request $request)
    {
        $comment = Comment::findOrFail($request->id);
        // return response();
        if($comment->is_active == 0){
            $comment->update(['is_active'=>1]);
            return response()->json(['act'=>'Unapprove'],200);
        }
        else{
            $comment->update(['is_active'=>0]);
            return response()->json(['act'=>'Approve'],200);
        }
            
        
    }
    
}
