<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Models\Post;
use App\Models\Image;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class PostController extends Controller
{
    public function index(Request $request): View
    {
        return view('post.index');
    }

    /**
     * Display the specified resource.
     */
    // public function show($id): View
    // {   
    //     $post = Post::with(["category","images"])->find($id);
    //     $categories = Category::all();
    //     return view('post.show')->withPost($post)->withCategories($categories);
    // }

    public function getSingle($slug){
        $post = Post::with(["category","images"])->where('slug', '=', $slug)->first();
        $categories = Category::all();

        $people = DB::table('donates')->where('state', '=', '1')->count();
        $money_donate = DB::table("donates")->where('state', '=', '1')->sum('money');
        // echo $money_total;
        // $images = Image::where('post_id', $post->id)->get();
        return view('post.single',compact('people','money_donate'))->withPost($post)->withCategories($categories);
        
    }
}
