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
@endsection

@section('content')

<h1 class="title">{{$group->name}} admin overview</h1>

@if ($times->count())
    <table class="table is-hoverable is-fullwidth">
        <tbody class="box">
            @foreach ($times as $time)

                <tr>
                    <td style="border:none;"><strong>{{$time->user->name}}</strong></td>
                    <td style="border:none;">{{$time->task->name}}</td>

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

<a href="/groups" class="button is-link">Back</a>

@endsection
