@extends('layouts.basic-layout')

@section('title', "Dashboard")

@section('content')

    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }
    </style>

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
                            <td style="border:none;"><a class="button is-light">Edit</a></td>
                            <td style="border:none;"><a class="button is-danger">Delete</a></td>
                        </tr>

            @endforeach
                </tbody>
            </table>
        @endif
    </p>

@endsection
