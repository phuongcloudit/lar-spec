<?php

namespace App\Http\Controllers;
use App\Model\Category;
use App\Model\Post;
use App\Model\Image;

use Illuminate\Http\Request;

class CategoryController extends Controller {

    public function show(Category $category, $id) {
        if($category){
            $category = Category::all();
            $posts = Post::where('category_id',$id)->get();
            $cat = Category::find($category->id);
            $images = Image::where('post_id', $post->id)->get();
            return view('category.show', compact('posts'),compact('cat'));
         }
         return view('errors.404');
    }
}