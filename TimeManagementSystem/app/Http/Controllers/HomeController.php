<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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
        if(!request()->date)
        {
            $times = Auth::user()->times()->whereDate('start_time',Carbon::now()->toDateString())->get();
        }
        else
        {
            $times = Auth::user()->times()->whereDate('start_time', $request->date);
        }

        $tasks = Auth::user()->tasks()->select('id', 'name')->get();
        $groups = Auth::user()->groups()->get();

        /*
        Om in de view in javascript het op te halen
        var dates = {!! json_encode($datesCollect->toArray(), JSON_HEX_TAG) !!};
        */

        // $datesCollect = collect();

        // $dateCounter = 0;

        // //alle dates voor in de dropdown
        // foreach ($times as $time)
        // {
        //     $date = $time->start_time->toDateString();

        //     if(!$datesCollect->contains($date))
        //     {
        //         $datesCollect->put($dateCounter, ['date' => $date]);
        //         $dateCounter++;
        //     }
        // }

        // $datesCollect = $datesCollect->sortByDesc('date');

        //datatable voor lavacharts
        $stocksTable = \Lava::DataTable();

        $stocksTable->addDateColumn('Day of Month')
                    ->addNumberColumn('Projected')
                    ->addNumberColumn('Offical');

        $stocksTable->addRow(['2019-10-10', 90, 80]);
        $stocksTable->addRow(['2019-10-11', 80, 200]);
        $stocksTable->addRow(['2019-10-12', 70, 30]);

        \Lava::AreaChart('Population', $stocksTable, [
            'title' => 'population growth',
            'legend' => ['position' => 'in']
        ]);

        return view('home', compact('times','tasks','groups','stocksTable'));
    }

    public function logout()
    {
        Auth::logout();
        return view('auth.login');
    }

    #region CRUD
    public function store()
    {
        if(request()->has('timeForm'))
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
