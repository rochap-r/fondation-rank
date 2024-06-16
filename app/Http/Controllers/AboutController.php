<?php

namespace App\Http\Controllers;

use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(string $slug)
    {
        $about=About::where('slug',$slug)->firstOrFail();
        return view('about',['about'=>$about]);
    }
}
