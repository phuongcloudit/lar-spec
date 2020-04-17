<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\Models\Post;
use App\Models\User;
use App\Models\Image;
use App\Models\Category;
use App\Models\Donate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\PostsRequest;
use Carbon\Carbon;
// use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = new Post;
        if($request->has("category_name")){
            $category = Category::where("slug", $request->category_name)->first();
            if($category)
                $posts = $posts->where("category_id",$category->id);
        }
        $limit = $request->limit?$request->limit:20;
        $posts = $posts->orderby("updated_at","DESC")->paginate($limit);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post;
        $categories = Category::pluck('name', 'id');
        return view('admin.posts.create')->withPost($post)->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        $data = $request->only("category_id","date","title","slug","content","status");
        $post   =   Post::create($data);
        return redirect()->route('admin.posts.edit', $post)->with('success','Post created sucessfully');
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
    public function edit(Post $post){
        $categories = Category::pluck('name', 'id');
        return view('admin.posts.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(PostsRequest $request, Post $post)
    {
        $data = $request->only("category_id","date","title","slug","content","status");
        $post->update($data);
        return redirect()->route('admin.posts.edit', $post)->with('success','Post Updated sucessfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        try {
            $post->delete();
            return redirect()->route('admin.categories.index')->with('success','A post deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.categories.index')->with('error','Cannot delete post!');
        }
    }
}