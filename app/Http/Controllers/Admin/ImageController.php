<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
Use App\Models\Image;
// Use Image;
use Validator,Redirect,Response,File;
use Intervention\Image\Exception\NotReadableException;


 
 
class ImageController extends Controller
{
    public function index()
    {
      return view('admin.image.index');
    }
    
    public function save(Request $request)
    {
        request()->validate([
              'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        
        if ($files = $request->file('images')) {
            
            // for save original image
            $ImageUpload = Image::make($files);
            $originalPath = 'public/uploads/';
            $ImageUpload->save($originalPath.time().$files->getClientOriginalName());
            
            // for save thumnail image
            $thumbnailPath = 'public/uploads/thumbnail/';
            $ImageUpload->resize(250,125);
            $ImageUpload = $ImageUpload->save($thumbnailPath.time().$files->getClientOriginalName());
        
            $photo = new Photo();
            $photo->photo_name = time().$files->getClientOriginalName();
            $photo->save();
          }
        
          $image = Photo::latest()->first(['images']);
          return Response()->json($image);
    }

    public function destroy($id){
      $del = Image::find($id);
      Storage::delete($del->path);
      $del->delete();
      return redirect;
    }
}