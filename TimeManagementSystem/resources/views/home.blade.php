@extends('layouts.basic-layout')

@section('title', "Dashboard")

@section('head')
    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }

        #playbutton
        {
            cursor: pointer;
            padding: 0;
            border: none;
            background: none;
        }

        #timeform
        {
            padding: 0.5rem;
            line-height: 2;
        }
        #alternate:focus, #alternate:focus
        {
            outline: none;
        }

        #alternate
        {
            cursor: default;
        }

        #datepicker
        {
            cursor: pointer;
        }
    </style>

    <link rel="stylesheet" href="http://davidwalsh.name/dw-content/jquery-ui-css/custom-theme/jquery-ui-1.7.2.custom.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.7.2/jquery-ui.min.js"></script>
    <script type="text/javascript">
        var start = true;

        function record()
        {
            var elem;

            if(start)
            {
                document.getElementById("playimage").src = "/images/stop.png";
                elem = document.getElementById("start");
            }
            else
            {
                document.getElementById("playimage").src = "/images/start.png";
                elem = document.getElementById("end");
            }

            start = !start;

            //Dit was een fucking kut werk, maar werkt eindelijk
            Number.prototype.AddZero= function(b,c)
            {
                var  l= (String(b|| 10).length - String(this).length)+1;
                return l> 0? new Array(l).join(c|| '0')+this : this;
            }

            var d = new Date(),
            localDateTime= [d.getFullYear(),
                        (d.getMonth()+1).AddZero(),
                        d.getDate().AddZero()].join('-') +'T' +
                    [d.getHours().AddZero(),
                        d.getMinutes().AddZero()].join(':');
            elem.value = localDateTime;
        }
    </script>
    <script>
        //HAAT ME LEVEN
        //$datesCollect ophalen
        // //array maken van objecten lijst
        // var result = Object.keys(dates).map(function(key)
        // {
        //     return [Number(key), dates[key]];
        // });
        // var availableDates = [];

        // //datums formatteren en in array zetten
        // for (let i = 0; i < result.length; i++)
        // {
        //     var formatDate = new Date(result[i][1].date);
        //     var formatter = formatDate.getDate() + "-" + (formatDate.getMonth() + 1) + "-" + formatDate.getFullYear()
        //     availableDates.push(formatter);
        // }

        var date = {!! json_encode($searchedDate, JSON_HEX_TAG) !!};
        //console.log(date);

        $(function ()
        {
            $('#datepicker').datepicker({
                format: "dd-mm-yyyy",
                autoclose: 1,
                todayHighlight: 1,
                firstDay: 1,
                altField: "#alternate",
                altFormat: "DD, d MM, yy",
                minDate: -365,
                maxDate: new Date()
            });

            $('#datepicker').datepicker().datepicker("setDate", new Date(date));

        });

    </script>
@endsection

@section('content')

    @if (session('status'))
        <div class="notification is-danger" role="alert">
                {{ session('status') }}
        </div>
    @endif

    {{-- <div class="notification is-success">
            <button class="delete"></button>
            You succesful logged in.
    </div> --}}
    <p>
        <h1 class="title">Dashboard</h1>

        <div class="level box has-background-light">
            <div class="level-left">
                <div class="level-item"></div>

                <div class="level-item">
                    <button id="playbutton"><img id="playimage" src="/images/start.png" width="150px" onclick="record()"></button>
                </div>
            </div>

            <div class="level-right">
                <div class="level-item">
                <form id="timeform" method="POST" action="/home">
                    <label class="label" >Add time</label>
                    @csrf
                    <div class="field is-grouped">

                            <div class="control">
                                <div class="select">
                                    <select name="task_id" value="{{ old('task') }}" required>
                                        <option selected>Select task</option>
                                        @foreach ($tasks as $task)
                                            <option value="{{$task->id}}">{{$task->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="control">
                                <div class="select">
                                    <select name="group_id" value="{{ old('group') }}" required>
                                        <option selected>Select group</option>
                                        <option value="0">Prive</option>
                                        @foreach ($groups as $group)
                                            <option value="{{$group->id}}">{{$group->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                    </div>

                    <div class="field">
                        <p class="control">
                            Till <input id="start" type="datetime-local" class="input" name="start_time" value="{{ old('start') }}" required autocomplete="start">
                        </p>
                    </div>

                    <div class="field">
                        <p class="control">
                            From <input id="end" type="datetime-local" class="input" name="end_time" value="{{ old('end') }}" required autocomplete="end">
                        </p>
                    </div>

                    <div class="field">
                        <div class="control">
                            <button type="submit" name="timeForm" class="button is-link">Save</button>
                        </div>
                    </div>

                    @if ($errors->any())
                    <div class="notification is-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </form>
                </div>
                <div class="level-item"></div>

            </div>
        </div>

        {{-- Dropdown keuze datum gedeelte --}}
        <div class="box level">
            <div class="level-left">
                <div class="level-item">
                    <p><strong><input style="border:none;" class="title is-5" type="text" id="alternate" value="12-12-2019" size="30" readonly="readonly"></strong></p>
                </div>
            </div>

            <div class="level-right">

                <form id="searchForm" method="POST" action="/home"><div class="field is-grouped">
                @csrf
                    <div class="lelvel-item">
                        <input onchange="this.form.submit()" type="text" class="input is-rounded" name="date" id="datepicker" readonly="readonly" size="12" value="12-12-2019">
                    </div>

                    <div class="lelvel-item">
                        <div class="select is-rounded">

                            <select onchange="this.form.submit()" name="taskFilter" value="{{ old('taskFilter') }}">
                                <option value="0">All tasks</option>
                                @foreach ($tasks as $task)
                                    @if ($task->id == $searchedTask)
                                        <option selected value="{{$task->id}}">{{$task->name}}</option>
                                    @else
                                        <option value="{{$task->id}}">{{$task->name}}</option>
                                    @endif
                                @endforeach
                            </select>

                        </div>
                    </div>

                <div class="lelvel-item">
                        <div class="select is-rounded">

                            <select onchange="this.form.submit()" name="groupFilter" value="{{ old('groupFilter') }}">

                                <option value="-1">All groups</option>

                                @if ($searchedGroup == 0)
                                    <option selected value="0">Prive</option>
                                @else
                                    <option value="0">Prive</option>
                                @endif

                                @foreach ($groups as $group)

                                    @if ($group->id == $searchedGroup)
                                        <option selected value="{{$group->id}}">{{$group->name}}</option>
                                    @else
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endif

                                @endforeach

                            </select>

                        </div>
                    </div>
                </div></form>

            </div>
        </div>

        {{-- Grafiek --}}
        <div class="box" id="pop_div"></div>
        @barchart('Population', 'pop_div')

        @if ($times->count())
            <table class="table is-hoverable is-fullwidth">
                <tbody class="box">
            @foreach ($times as $time)
                        <tr>
                            <td style="border:none;"><strong>{{$time->task->name}}</strong></td>

                            @if ($time->group_id == 0)
                                <td style="border:none;">Prive</td>
                            @else
                                <td style="border:none;"><a href="#">
                                {{$time->group->name}}
                                </a></td>
                            @endif

                            <td style="width:100%; border:none;">{{$time->diffrence}}<i>uur</i></td>
                            <td style="border:none;">{{$time->start_time->format('H:i')}}</td>
                            <td style="border:none;">{{$time->end_time->format('H:i')}}</td>
                            <td style="border:none;"><a class="button is-light" href="/home/{{$time->id}}/edit">Edit</a></td>
                            <td style="border:none;"><form method="POST" action="/home/{{$time->id}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="button is-danger">Delete</button>
                            </form></td>
                        </tr>

            @endforeach
                </tbody>
            </table>
        @endif
    </p>


@endsection
