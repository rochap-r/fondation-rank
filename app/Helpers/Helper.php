<?php

use App\Models\Post;
use App\Models\Event;
use App\Models\Project;
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


if (!function_exists('events')){
    function events(){
        $events=Event::latest()->where('approved',1)->where('readable',1)->orderBy('id','DESC')->take(4)->get();
        return $events;
    }
}