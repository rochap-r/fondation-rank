<?php

use App\Models\Post;
use App\Models\About;
use App\Models\Event;
use App\Models\Project;
use App\Models\Category;
use Illuminate\Support\Str;
if (! function_exists('helper_function')) {
    function helper_function() {
        // Votre logique ici
    }
}

if (!function_exists('words')){
    function words($value,$length=15, $end="..."){
        return Str::words(strip_tags($value),$length,$end);
    }
}

if (!function_exists('LatestPosts')){
    function LatestPosts(){
        return Post::latest()->where('approved',1)->with(['author','image','category'])->orderBy('id','DESC')->take(5)->get();
    }

}

if (!function_exists('Projects')){
    function Projects(){
        return Project::latest()->orderBy('id','DESC')->take(5)->get();
    }

}

/**
 * categories globales
 */

if (!function_exists('categories')) {
    function categories()
    {
        return Category::withCount('posts')->orderBy('posts_count')->get();
    }
}



if (!function_exists('events')){
    function events(){
        $events=Event::latest()->where('approved',1)->where('readable',1)->orderBy('id','DESC')->take(4)->get();
        return $events;
    }
}

if (!function_exists('abouts')){
    function abouts(){
        $abouts=About::where('approved',1)->orderBy('id','ASC')->take(10)->get();
        
        return $abouts;
    }
}