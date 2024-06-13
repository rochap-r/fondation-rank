<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TinyMceController extends Controller
{
    public function upload_tinymce_image()
    {
        $file=request()->file('file');
        if (!Storage::disk('public')->exists('tinymce_uploads')) {
            Storage::disk('public')->makeDirectory('tinymce_uploads');
        }
        $path=$file->store('tinymce_uploads','public');
        return response()->json(['location'=>"/storage/$path"]);
    }


    public function upload_tinymce_posts_image()
    {
        $file=request()->file('file');
        if (!Storage::disk('public')->exists('tinymce_posts_uploads')) {
            Storage::disk('public')->makeDirectory('tinymce_posts_uploads');
        }
        $path=$file->store('tinymce_posts_uploads','public');
        return response()->json(['location'=>"/storage/$path"]);
    }

    public function upload_tinymce_events_image()
    {
        $file=request()->file('file');
        if (!Storage::disk('public')->exists('tinymce_events_uploads')) {
            Storage::disk('public')->makeDirectory('tinymce_events_uploads');
        }
        $path=$file->store('tinymce_events_uploads','public');
        return response()->json(['location'=>"/storage/$path"]);
    }
}
