<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestController extends Controller
{
    public function azure(Request $request)
    {
        return view("azure");
    }

    public function upload(Request $request)
    {
        $path = $request->file('file')->store('test', 'azure');
        dd($path);
    }

    public function filesFromAzure()
    {
        $path = 'test';
        // Get the Larvel disk for Azure
        $disk = Storage::disk('azure');
        // List files in the container path
        $files = $disk->files($path);
        // create an array to store the names, sizes and last modified date
        $list = array();
        // Process each filename and get the size and last modified date
        foreach($files as $file) {
                $size = $disk->size($file);
                $modified = $disk->lastModified($file);
                $modified = date("Y-m-d H:i:s", $modified);
                $filename = "$path/$file";
                $item = array(
                        'name' => $filename,
                        'size' => $size,
                        'modified' => $modified,
                );
                array_push($list, $item);
        }
        $results = json_encode($list, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        return response($results)->header('content-type', 'application/json');
    }

    public function previewFile(Request $request)
    {
        $file = $request->file;
        $filename = "$file";
        $disk = Storage::disk('azure');
        if (!$disk->exists($filename))
        {
            abort(404);
        }
        $contents = $disk->get($filename);
        return response($contents)->header('content-type', 'image/jpeg');
    }
}
