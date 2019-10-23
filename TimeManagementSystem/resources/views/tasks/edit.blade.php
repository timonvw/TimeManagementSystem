@extends('layouts.basic-layout')

@section('title', "Task edit")

@section('content')
    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }
    </style>

    <h1 class="title">Task edit</h1>

<form class="box" method="POST" action="/tasks/{{$task->id}}">
        @method('PATCH')
        @csrf

        <label class="label" for="name">{{ __('Task name') }}</label>
        <div class="field is-grouped">
            <p class="control is-expanded">
            <input id="name" type="text" class="input" name="name" value="{{$task->name}}" required autocomplete="name">
            </p>
            <p class="control">
                <button type="submit" class="button is-link">{{ __('Update task') }}</button>
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
    <a href="/tasks" class="button is-link">Back</a>
@endsection
