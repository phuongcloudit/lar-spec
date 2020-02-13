<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\Category;
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
    public function show($id): View
    {   
        $post = Post::find($id);

        $current = Carbon::now();
        $day_in = $post->donate_date_end;
        // $interval = date_diff($current, $day_in);

        $categories = Category::all();
        return view('post.show')->withPost($post)->withCategories($categories);
    }
    public function day_left(){
    }
  
}
