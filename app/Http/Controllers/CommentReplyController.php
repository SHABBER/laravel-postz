<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\CommentReply;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentReplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $reply = Comment::findOrFail($id)->commentReplies;
        $post = Comment::findOrFail($id)->post;
        return view('post.comments.comment-replies', ['replies'=>$reply, 'post'=>$post]);
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
        $comment = Comment::findOrFail($id);
        $comment->commentReplies()->save(
                        CommentReply::create([
                            'author'=>$user->name,
                            'email'=>$user->email,
                            'body'=>$request->body,
                            'comment_id'=>$comment->id
                        ]));

        return back();
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
        $reply = CommentReply::findOrFail($id);
        if($reply->is_active == 0)
            $reply->update(['is_active'=>1]);
        else
            $reply->update(['is_active'=>0]);
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
        $reply = CommentReply::findOrFail($id);
        $reply->delete();
        return back();
    }

    public function ajaxUpdate(Request $request)
    {
        $reply = CommentReply::findOrFail($request->id);
        if($reply->is_active == 0){
            $reply->update(['is_active'=>1]);
            return response()->json(['act'=>'Unapprove'],200);
        }
        else{
            $reply->update(['is_active'=>0]);
            return response()->json(['act'=>'Approve'],200);
        }
        // return back();
    }
}
