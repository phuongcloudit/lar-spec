<?php
namespace MrTaiw\MediaManager;

use File;
use Image;
use MrTaiw\MediaManager\events\ImageWasUploaded;
use Storage;
use Auth;
use Illuminate\Support\Str;
class MediaManager
{
    public static function listItem($directory)
    {
        $directory = $directory;
        if(!Storage::disk('public')->has($directory)):
            Storage::disk('public')->makeDirectory($directory);
        endif;
        return array_merge(MediaManager::getDirectory($directory),MediaManager::getFiles($directory));
    }


    public static function makeFolder($path, $name)
    {
        $path = $path;
        $name = Str::slug($name);
        Storage::disk('public')->makeDirectory($path . '/' . $name);
    }

    public static function getDirectory($directory = '/uploads')
    {
        $result      = [];        
        $directories = Storage::disk('public')->directories($directory);
        foreach ($directories as $dir) {
            $result[] = [
                'type'     => 'dir',
                'path'     => $dir,
                'basename' => basename($dir),
                'filename' => basename($dir),
                'last_modified' => Storage::disk('public')->lastModified($dir)
            ];
        }
        $collection = collect($result);
        $sorted = $collection->sortByDesc('last_modified');
        $result = $sorted->toArray();
        return $result;
    }

    public static function getFiles($directory)
    {
        $result = [];
        $files  = Storage::disk('public')->files($directory);
        foreach ($files as $file) {
            $tmp = [
                'type'      => 'file',
                'path'      => $file,
                'basename'  => File::basename($file),
                'extension' => File::extension($file),
                'filename'  => File::name($file),
                'file'      => asset('storage/' . $file),
                'thumbnail'     => self::get_file($file, 'thumbnail'),     
                "last_modified"  => Storage::disk('public')->lastModified($file)
            ];
            if(in_array(strtolower($tmp['extension']),config('twmm.videotypes', []))):
                $tmp['thumbnail'] = asset('images/video-type.jpg');
            endif;
            $result[] = $tmp;
        }
        $collection = collect($result);
        $sorted = $collection->sortByDesc('last_modified');
        $result = $sorted->toArray();
        return $result;
    }



    public static function get_file($file, $size = false)
    {
        if ($size) {
            $ext       = File::extension($file);
            $file_path = File::dirname($file);
            $file_path = $file_path=="."?"uploads/{$size}/":"uploads/{$size}/".$file_path;
            $file_path = $file_path. '/' . FIle::name($file) .  '.' . $ext;
            if(File::exists(public_path($file_path)))
                return asset($file_path);
        }
        return asset('storage/' . $file);
    }

    public static function deleteItem($path)
    {
        $file_name = File::dirname($path) . '/' . FIle::name($path);
        $ext       = File::extension($path);

        Storage::disk('public')->delete($path);
        $sizes = \Config::get('twmm.sizes');
        $files[] = $path;
        foreach ($sizes as $size_path => $size_attr) {
            $directory =  "uploads/{$size_path}/".$path; 
            File::delete(public_path($directory));
            $files[] =  $directory;
        }
    }

    public static function deletePath($path)
    {
        $files  = Storage::disk('public')->files($path);
        if($files):
            return ['status' => 'error', 'msg'  =>  "Can not delete folder exists file!"];
        else:
            //Xóa thư mục Storage
            Storage::disk('public')->deleteDirectory($path);
            // Xóa các thư mục resize
            $sizes = \Config::get('twmm.sizes');
            foreach ($sizes as $size_path => $size_attr) {
                $directory =  "/uploads/{$size_path}/".$path;
                File::deleteDirectory(public_path($directory."/"));
            }
            return ['status' => 'success'];
        endif;
    }


    public static function Upload($file, $path)
    {
        if (File::isDirectory(storage_path('app/public/' . $path))) {

            $filename = Str::slug(str_replace('.' . $file->getClientOriginalExtension(), '', $file->getClientOriginalName()));

            if (File::exists(storage_path('app/public/' . $path) . '/' . $filename . '.' . $file->getClientOriginalExtension())) {
                $filename = $filename . '-' . time();
            }
            $newname = $filename . '.' . $file->getClientOriginalExtension();
            $file->storeAs($path, $newname, 'public');

            //save video
            if(in_array(strtolower($file->getClientOriginalExtension()),config('twmm.videotypes', []))):
                if (!File::isDirectory(public_path('storage') . '/' . $path)) {
                    mkdir(public_path('storage') . '/' . $path);
                }
                $file->move(public_path('storage') . '/' . $path, $newname);
                return url('storage/' . $path . '/' . $newname);
            endif;

            event(new ImageWasUploaded(Storage::disk('public')->getAdapter()->getPathPrefix() . '/' . $newname));

            $sizes = \Config::get('twmm.sizes');

            foreach ($sizes as $size_path => $size_attr) {
                self::handle_size($file, $path, $size_path, $newname, $size_attr);
            }

            return url('storage/' . $path . '/' . $newname);
        }
        return false;
    }

    public static function handle_size($file, $path, $size_path, $filename, $size = array('width' => 50, 'height' => 50))
    {
        $directory = "/uploads/{$size_path}/".$path;
        if (!File::isDirectory($directory)) {
            File::makeDirectory(public_path($directory), $mode = 0777, true, true);
        }

        $handle_size = $directory . "/".  $filename;
        $ratio       = $size['width'] / $size['height'];    
        $image       = Image::make($file->getRealPath());        
        $image_ratio = $image->height() / $image->width();
        if ($ratio > $image_ratio) {
            $image->resize(null, $size['height'], function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $image->resize($size['width'], null, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        $image->crop($size['width'], $size['height'])->save(public_path($handle_size));
    }
}
