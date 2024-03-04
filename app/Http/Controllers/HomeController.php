<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        // dd($posts);
        // $categories = Category::all();
        // dd($posts, $categories);
        return view('home', compact('posts'));
        // return view('home', ['posts'=>$posts,'categories'=>'categories']);

    }

    public function testapi(){
        return ['result'=>'worked'];
    }

    public function testeditapi($request){
        return $request;
    }
}
