<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects=Project::latest()->orderBy('id','DESC')->paginate(6);
        return view('projects.index',['projects'=>$projects]);
    }

    public function show(string $slug)
    {
        $project=Project::where('slug', $slug)->firstOrFail();
        return view('projects.show',['project'=>$project]);
    }
}
