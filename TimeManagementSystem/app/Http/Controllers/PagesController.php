<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class PagesController extends Controller
{
    public function home()
    {

        $projects = Project::all();


        return view('welcome', compact('projects'));
    }

    public function about()
    {
        return view("about");
    }
}
