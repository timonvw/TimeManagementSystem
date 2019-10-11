<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Time;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    #region CRUD
    public function store()
    {
        $validated = request()->validate([
            'title' => ['required', 'min:3', 'max:30'],
            'description' => ['required', 'min:3', 'max:200']
        ]);

        Time::create($validated);

        return redirect('/projects');
    }

    public function show(Time $time)
    {
        return view('projects.show', compact('time'));
    }

    public function edit(Time $time)
    {
        return view('projects.edit', compact('time'));
    }

    public function update(Time $time)
    {
        $time->update(request(['title', 'description']));

        return redirect('/projects');
    }

    public function destroy(Time $time)
    {
        $time->delete();

        return redirect('/projects');
    }
    #endregion
}
