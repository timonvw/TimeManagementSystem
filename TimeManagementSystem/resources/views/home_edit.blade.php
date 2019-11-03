@extends('layouts.basic-layout')

@section('title', "Time edit")

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
@endsection

@section('content')

    <p>
        <h1 class="title">Time edit</h1>

        <form class="box" method="POST" action="/home/{{$time->id}}">
            <label class="label" >Task and group</label>

            @method('PATCH')
            @csrf
            <div class="field is-grouped">

                    <div class="control">
                        <div class="select">
                            <select name="task_id" value="{{ old('task') }}" required>
                                <option>Select task</option>
                                @foreach ($tasks as $task)
                                    @if ($task->id == $time->task_id)
                                        <option selected value="{{$task->id}}">{{$task->name}}</option>
                                    @else
                                        <option value="{{$task->id}}">{{$task->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="control">
                        <div class="select">
                            <select name="group_id" value="{{ old('group') }}" required>
                                <option selected>Select group</option>
                                    @if ($time->group_id == 0)
                                        <option selected value="0">Prive</option>
                                    @else
                                        <option value="0">Prive</option>
                                    @endif
                                @foreach ($groups as $group)
                                    @if ($group->id == $time->group_id)
                                        <option selected value="{{$group->id}}">{{$group->name}}</option>
                                    @else
                                        <option value="{{$group->id}}">{{$group->name}}</option>
                                    @endif

                                @endforeach
                            </select>
                        </div>
                    </div>

            </div>

            <div class="field">
                <p class="control">
                    Date <input id="date" type="date" class="input" name="date" value="{{$time->date}}" required autocomplete="start">
                </p>
            </div>

            <div class="field">
                <p class="control">
                    Till <input id="start" type="datetime" class="input" name="start_time" value="{{$time->start_time}}" required autocomplete="start">
                </p>
            </div>

            <div class="field">
                <p class="control">
                    From <input id="end" type="datetime" class="input" name="end_time" value="{{ $time->end_time }}" required autocomplete="end">
                </p>
            </div>

            <div class="field">
                <div class="control">
                    <button type="submit" class="button is-link">Update time</button>
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
    </p>
    <a href="/home" class="button is-link">Back</a>


@endsection
