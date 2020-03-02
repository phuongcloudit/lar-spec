<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Image;
use App\Models\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller {

    // public function show($id) {
    //     // if($category){
    //     //     $category = Category::all();
    //     //     $posts = Post::where('category_id',$id)->get();
    //     //     $cat = Category::find($category->id);
    //     //     $images = Image::where('post_id', $post->id)->get();
    //     //     return view('category.show', compact('posts'),compact('cat'));
    //     //  }


    //     $category = Category::all();

    //      if($category){
    //         $cats = Category::with(['posts'])->find($id);
    //         return view('category.show', compact('cats'));
    //      }
    //      return view('errors.404');
    // }


    public function getSingle($slug){
        $category = Category::all();
        $cate = Category::where('slug', '=', $slug)->first();
        if($category){
            $posts = Post::with('images')->where('category_id',$cate->id)->get();
            $cat = Category::find($cate->id);
            // var_dump($posts);
             return view('category.single', compact('posts'),compact('cat'));;
         }
        return view('errors.404');
        
    }
}