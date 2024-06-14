<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        //$events=Event::latest()->where('approved',1)->orderBy('id','DESC')->take(4)->get();
        $events=Event::latest()->orderBy('id','DESC')->take(4)->get();
        return view('home',['events'=>$events]);
    }
}
