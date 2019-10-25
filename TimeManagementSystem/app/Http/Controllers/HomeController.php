<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $times = Auth::user()->times;
        $tasks = Auth::user()->tasks;
        $groups = Auth::user()->groups;

        return view('home', compact('times','tasks','groups'));
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    #region CRUD
    public function store()
    {
        $time = request()->validate([
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'task_id' => ['required'],
            'group_id' => ['required']
        ]);

        $time = collect($time)->put('user_id', Auth::user()->id);
        $time = $time->put('date', date("Y-m-d"));

        //haat me leven met al deze date types
        $time->put('start_time', strtotime(request()->start_time));
        $time->put('end_time', strtotime(request()->end_time));

        Time::create($time->all());

        return redirect('/home');
    }

    public function show(Time $time)
    {

    }

    public function edit(Time $home)
    {
        if($home->user_id == Auth::user()->id)
        {
            $time = $home;
            $tasks = Auth::user()->tasks;
            $groups = Auth::user()->groups;

            return view('home_edit', compact('time','tasks','groups'));
        }
        else
        {
            return redirect('/home');
        }
    }

    public function update(Time $home)
    {
        $home->update(request()->validate([
            'date' => ['required', 'date'],
            'start_time' => ['required', 'date'],
            'end_time' => ['required', 'date'],
            'task_id' => ['required'],
            'group_id' => ['required']
        ]));

        return redirect('/home');
    }

    public function destroy(Time $home)
    {
        if($home->user_id == Auth::user()->id)
        {
            $home->delete();
        }

        return redirect('/home');
    }
    #endregion
}
