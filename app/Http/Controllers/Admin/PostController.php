<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostsRequest;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Model\Category;
use App\Model\Post;
use App\Model\User;
use App\Model\Image;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        $posts = Post::all();
        // $posts = Post::with('category')->get();
        return view('admin.post.index')->withCategories($categories)->withPosts($posts);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::pluck('name', 'id');
        return view('admin.post.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request): RedirectResponse
    {
        $post = Post::create($request->only(['title', 'category_id', 'donate_money', 'donate_day_end','content']));
        
        // $request->validate([
        //     'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        // $this->validate($request, [
        //     'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        // ]);
    
    
        if($request->hasfile('images'))
        {
            foreach($request->file('images') as $file)
            {
                $name=$file->getClientOriginalName();
                $file->move(public_path().'/images/', $name);  
                // $data[] = $name;  
                $file= new Image();
                $file->image_name=$name;
                $file->post_id=$post->id;
                $file->save();

            }
        }

        return redirect()->route('admin.post.edit', $post)->with('success', 'Your post has been successfully added');
  

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
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::pluck('name', 'id');
        return view('admin.post.edit')->withPost($post)->withCategories($categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function update(Request $request, $id)
    {
        // $post = Post::update($request->only(['title', 'category_id', 'donate_money', 'donate_day_end','content']));

        // return redirect()->route('admin.posts.edit', $post)->with('success','Post Updated sucessfully');
        request()->validate([
            'title' => 'required|max:255'
        ]);
        Post::find($id)->update($request->all());
        return redirect()->route('admin.post.edit', $id)->with('success','Post Updated sucessfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::find($id)->delete();
        return redirect()->route('admin.post.index')->with('success','A Post deleted successfully');
    }

    
}