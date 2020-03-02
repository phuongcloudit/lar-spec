<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Session;

class CategoryController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth:admin');
    // }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $categories = Category::all();
        return view('admin.category.index')->withCategories($categories);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // request()->validate([
        //     'name' => 'required|max:255'
        // ]);
        // Category::create($request->all());
        // return redirect()->route('admin.category.index')->with('success','Category created sucessfully');
            

        $this->validate($request, array(
            'name'=> 'required|max:255',
            'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
        ));
        $cat = new Category;
        $cat->name = $request->name;
        $cat->slug = $request->slug;
        $cat->description = $request->description;
        $cat->save();
        Session::flash('success','Category created sucessfully');
        return redirect()->route('admin.category.index');
   
   
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
        $cat = Category::find($id);
        return view('admin.category.edit', compact('cat'));
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
        $cat = Category::find($id);
        if ($request->input('slug') == $cat->slug){
            $this->validate($request, array(
                'slug' => 'required',
            ));
        } else{
            $this->validate($request, array(
                'name' => 'required|max:255',
                'slug' => 'required|alpha_dash|min:5|max:255|unique:posts,slug',
            ));
        }
        $cat->name = $request->name;
        $cat->slug = $request->slug;
        $cat->description = $request->description;
        $cat->save();
        return redirect()->route('admin.category.index')->with('success','Category Updated sucessfully');
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Category::find($id)->delete();
        return redirect()->route('admin.category.index')->with('success','A category deleted successfully');
    }
}
