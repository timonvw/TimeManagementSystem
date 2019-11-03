<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;

class PagesController extends Controller
{
    public function index()
    {

        $projects = Project::all();


        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view("projects.create");
    }

    public function store()
    {
        $validated = request()->validate([
            'title' => ['required', 'min:3', 'max:30'],
            'description' => ['required', 'min:3', 'max:200']
        ]);

        Project::create($validated);

        return redirect('/projects');
    }

    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Project $project)
    {
        $project->update(request(['title', 'description']));

        return redirect('/projects');
    }

    public function destroy(Project $project)
    {
        $project->delete();

        return redirect('/projects');
    }
}
