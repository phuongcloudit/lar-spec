<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\Category;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     * 
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $category = Category::all()->first();
        // $category = Category::with('posts')->get();
        // var_dump($category);
        $posts = Post::where('category_id',$category->id)->get();
        return view('pages.top', compact('posts'));

    }
}
