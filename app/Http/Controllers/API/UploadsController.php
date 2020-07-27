<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate(['file' => 'required|file']);
        $file = $request->file('file');

        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

        $path = $file->hashName('temps');
        $disk = Storage::disk('public');
        $disk->put(
            'temps', $file
        );
         $url = $path;

        return response()->json(compact('path', 'name', 'ext', 'url'));
    }
}
