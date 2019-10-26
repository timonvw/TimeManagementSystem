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
    </style>

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

        <div class="level">
            <div class="level-left">
                <div class="level-item">
                    <button id="playbutton"><img id="playimage" src="/images/start.png" width="150px" onclick="record()"></button>
                </div>
            </div>

            <div class="level-right">
                <form class="box" method="POST" action="/home">
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
                            <button type="submit" class="button is-link">Save</button>
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
        </div>

        {{-- Grafiek --}}
        <div class="box" id="pop_div"></div>
        @areachart('Population', 'pop_div')

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
