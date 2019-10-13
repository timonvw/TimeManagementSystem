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

    <form class="box" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label class="label" for="email">{{ __('Task name') }}</label>
            <div class="control">
                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">{{ __('Add') }}</button>
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

    @if (Auth::user()->tasks->count())
        @foreach (Auth::user()->tasks as $task)
            <table class="table is-hoverable is-fullwidth">
                <tbody>
                    <tr class="box">
                        <td style="width:100%; border:none;"><strong>{{$task->name}}</strong></td>
                        <td style="border:none;"><a class="button is-light">Edit</a></td>
                        <td style="border:none;"><a class="button is-danger">Delete</a></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    @endif

@endsection
