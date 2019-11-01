<?php

namespace App\Http\Controllers;

use App\Time;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use phpDocumentor\Reflection\Types\Boolean;

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
        /*
        Om in de view in javascript het op te halen
        var dates = {!! json_encode($searchedDate->toArray(), JSON_HEX_TAG) !!};
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
        return $this->getDataAndChartIndex();
    }

    private function getDataAndChartIndex()
    {
        //Standard values filters
        $searchedTask = 0;
        $searchedGroup = -1;

        if(request()->has('date'))
        {
            //DATE
            $carbonDate = Carbon::parse(request()->date);
            $searchedDate = $carbonDate->toDateString();

            //QUERY
            $query = Auth::user()->times();
            $query->whereDate('start_time', $searchedDate);

            //Check if task filter is signed
            if(request()->taskFilter != 0)
            {
                $searchedTask = request()->taskFilter;
                $query->where('task_id', $searchedTask);
            }

            //Check if group filter is signed
            if(request()->groupFilter != -1)
            {
                $searchedGroup = request()->groupFilter;
                $query->where('group_id', $searchedGroup);
            }

            $times = $query->orderBy('start_time', 'desc')->get();
        }
        else
        {
            $searchedDate = Carbon::now()->toDateString();
            $times = Auth::user()->times()->whereDate('start_time', $searchedDate)->orderBy('start_time', 'desc')->get();
        }

        $tasks = Auth::user()->tasks()->select('id', 'name')->get();
        $groups = Auth::user()->groups()->get();

        //=============================CHART AREA==========================================
        //time->diffrence
         //datatable voor lavacharts

         //table aanmaken
         $stocksTable = \Lava::DataTable();
         //eesrte naam column toevoegen
         $stocksTable->addStringColumn('Day of Month');
         //total alle goed gemaakte array
         $shovedStocksArray = [];
         $finalStocksArray = ['Total:'];

         //alle categorien aanmaken
        foreach ($tasks as $task)
        {
            $stocksTable->addNumberColumn($task->name);
            array_push($finalStocksArray, 0);
        }

        //door alle tijden gaan om hiervan de taak in de juiste vakje te zetten
        foreach ($times as $time )
         {
            $timeString = date('H.i', strtotime($time->diffrence));
            $resultArray = ['Total:'];

            foreach ($tasks as $task)
            {
                if($task->name == $time->task->name)
                {
                    array_push($resultArray, $timeString);
                }
                else
                {
                    array_push($resultArray, 0);
                }
            }

            //mulit array zetten
            array_push($shovedStocksArray, $resultArray);
         }

         //dd($shovedStocksArray);
         //dd($finalStocksArray);

         for ($i=0; $i < count($shovedStocksArray); $i++)
         {
            for ($j=1; $j < count($shovedStocksArray[$i]); $j++)
            {
                $finalStocksArray[($j)] += $shovedStocksArray[$i][$j];
            }
         }

         //dd($finalStocksArray);


         $stocksTable->addRow($finalStocksArray);



         \Lava::BarChart('Population', $stocksTable, [
             'isStacked' => true,
             'height' => 400,
             'title' => 'The total hours spend today in Hours.Minuts'
         ]);

        //=============================CHART END AREA======================================

         return view('home', compact('times','tasks','groups','stocksTable','searchedDate', 'searchedTask', 'searchedGroup'));
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
        else
        {
            return $this->getDataAndChartIndex();
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
