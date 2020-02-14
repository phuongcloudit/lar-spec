<?php

namespace App\Http\Controllers;

use App\Model\Post;
use App\Model\Image;
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
        $categories = Category::all();

        $images = Image::where('post_id', $post->id)->get();
        return view('post.show')->withPost($post)->withCategories($categories)->withImages($images);
    }
}
