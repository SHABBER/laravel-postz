<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     
     */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['index','create','update','edit']]);
    }

    public function index()
    {
        // $posts = auth()->user()->posts()->get();
        $posts = Post::latest()->paginate(5);
        
        return view('post.display-all', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('post.post-create', ['categories'=>Category::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(['title'=>'required',
                            'body'=>'required',
                            'user_id'=>'required',]);

        // dd($request);
        // $input = $request->all();
        // $input['post-image'] = $_FILES['file'];
        // dd($request);

        $input = $request->all();

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            $input['post_image']=$name;
        }
        
        // dd($input);
        Post::create($input)->categories()->attach($request->categories);



        Session::flash('message', 'Created successfully');
        Session::flash('action', 'create');
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {  
        $post = Post::find($post->id);
        // dd($post);
        return view('blog-post', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        $categories = Category::all();
        return view('post.post-edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        // dd($request,$post);

        $request->validate(['title'=>'required',
                            'body'=>'required',
                            'user_id'=>'required',]);

        $input = $request->all();

        if($file = $request->file('file')){
            $name = time().$file->getClientOriginalName();
            $file->move('images',$name);
            if($post->post_image)
            unlink('../public/images/'.pathinfo($post->post_image)['basename']);
            $input['post_image']=$name;
        }
        

        // auth()->user()->posts()->find($post->id)->update($input);
        $post->update($input);
        
        $post->categories()->sync($request->categories);

        Session::flash('message', 'Updated successfully');
        Session::flash('action', 'update');
        return redirect(route('posts.index'));



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post= Post::findOrFail($id);
        if($post->post_image)
            unlink('../public/images/'.pathinfo($post->post_image)['basename']);
        $post->delete();

        Session::flash('message', 'Deleted successfully');
        Session::flash('action', 'delete');


        return redirect(route('posts.index'));
        // return "working";

    }

    public function searchpost(Request $request){
        // $result = DB::select("SELECT title FROM posts
        // WHERE title LIKE '%:key%'
        //     or body LIKE '%:key%';");
        // $key = $request->key;
        $result = Post::select('id','title')->Where('title', 'like', '%' . $request->key . '%')->limit(3)->get();


        // dd($result)
        $data = '<ul class="list-group">';
        foreach($result as $post){
            $data = $data."<li class='list-group-item'><a href=".route("posts.show",$post->id).">".$post->title."</a></li>";
        }
        $data .= '</ul>';
        // dd($result);
        // return $result;
        // return $request;
        return response()->json(array('msg'=> $data), 200);

    }


}
