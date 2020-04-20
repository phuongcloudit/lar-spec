<?php

namespace MrTaiw\MediaManager\controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use MediaManager;
use Auth;
use Storage;
use Carbon\Carbon;
class MediaManagerController extends Controller
{

    public function __construct()
    {

    }

    public function getList(Request $request)
    {
        
        $folder = $request->input('path') ?: '';
        $data   = MediaManager::listItem($folder);
        return response()->json($data);
    }

    public function delete(Request $request)
    {   
        if(!Auth::check()):
             return response()->json(['status' => 'error','msg'=>'Permission denny!']);
        endif;
        $path = $request->input('path') ?: '';
        if ($request->has('type') && $request->input('type') == 'folder') {
            $response = MediaManager::deletePath($path);
            
        } else {
             $response =  MediaManager::deleteItem($path);
        }
        return  response()->json($response);
    }

    public function makeFolder(Request $request)
    {
        if ($request->has('name') && !empty($request->input('name'))) {
            $path = $request->input('path') ?: '';
            MediaManager::makeFolder($path, (string)$request->input('name'));
            return response()->json(['status' => 'success']);
        }
        return response()->json(['status' => 'error']);
    }

    public function postUpload(Request $request)
    {
        if ($request->hasFile('file')) {
            $path = $request->input('path') ?: '';
            $file = $request->file('file');

            $mimetypes = config('twmm.mimetypes', []);
            $maxsize   = config('twmm.maxfilesize', '10000');
            if(in_array($file->getClientOriginalExtension(),config('twmm.videotypes', []))):
                $maxsize   = config('twmm.maxvideosize', '100000000');
            endif;
            $rules = array(
                'file' => 'mimes:' . implode($mimetypes, ',') . '|required|max:' . $maxsize,
            );

            $validator = $this->validate($request, $rules);
            $return = MediaManager::Upload($file, $path);
            if (!$return) {
                echo 'false';
            } else {
                echo 'true';
            }
        }
    }
}
