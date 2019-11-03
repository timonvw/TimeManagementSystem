@extends('layouts.basic-layout')

@section('title', "Tasks")

@section('content')
    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }
    </style>

    <h1 class="title">Tasks</h1>

    <form class="box has-background-light" method="POST" action="/tasks">
        @csrf

        <label class="label" for="name">{{ __('Add a task') }}</label>
        <div class="field is-grouped">
            <p class="control is-expanded">
                    <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="task name">
            </p>
            <p class="control">
                <button type="submit" class="button is-link">{{ __('Add') }}</button>
            </p>
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
    <br>

    @if ($tasks->count())
        @foreach ($tasks as $task)
            <table class="table is-hoverable is-fullwidth">
                <tbody>
                    <tr class="box">
                        <td style="width:100%; border:none;"><strong>{{$task->name}}</strong></td>
                        <td style="border:none;"><a class="button is-light" href="/tasks/{{$task->id}}/edit">Edit</a></td>
                        <td style="border:none;">
                                <form method="POST" action="/tasks/{{$task->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger">Delete</button>
                                </form></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    @else
        <div class="box has-text-centered">
            <h6 class="title is-6">No <strong>tasks</strong> found.</h6>
        </div>
    @endif

@endsection
