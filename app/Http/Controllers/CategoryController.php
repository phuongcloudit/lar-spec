<?php

namespace App\Http\Controllers;
use App\Model\Category;
use App\Model\Post;
use App\Model\Image;

use Illuminate\Http\Request;

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
    //          $posts = Post::where('category_id',$id)->get();
    //          $cat = Category::find($id);
    //           return view('category.show', compact('posts'),compact('cat'));
    //       }
    //      return view('errors.404');
    // }
    public function getSingle($slug){
        $category = Category::all();
        $cate = Category::where('slug', '=', $slug)->first();
        if($category){
            $posts = Post::where('category_id',$cate->id)->get();
            $cat = Category::find($cate->id);
             return view('category.show', compact('posts'),compact('cat'));
         }
        return view('errors.404');
        
    }
}