@extends('layouts.basic-layout')

@section('title', "Groups")

@section('content')
    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }
    </style>

    <h1 class="title">Groups</h1>

    @if ($groups->count())
        @foreach ($groups as $group)
            <table class="table is-hoverable is-fullwidth box">
                <tbody>
                    <tr>
                        <td style="width:100%; border:none;"><h4 class="title is-4">{{$group->name}}</h4></td>
                        <td style="border:none;"><button class="button is-danger">
                        @if (Auth::user()->id == $group->admin_id)
                            Delete group
                        @else
                            Leave group
                        @endif
                        </button></td>
                    </tr>
                    <tr>
                        <td style="border:none;">People:
                        @foreach ($group->users as $user)
                            @if($user->id == Auth::user()->id)
                                <strong>You</strong>,
                            @else
                                <strong>{{$user->name}}</strong>,
                            @endif
                        @endforeach
                        </td>
                        @if ($group->admin_id == Auth::user()->id)
                        <td style="border:none; align:right;"><a class="button is-link" href="/groups/{{$group->id}}">More</a></td>
                        @endif
                    </tr>
                        {{-- <td style="border:none;"><a class="button is-light" href="/tasks/{{$task->id}}/edit">Edit</a></td>
                        <td style="border:none;">
                                <form method="POST" action="/tasks/{{$task->id}}">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="button is-danger">Delete</button>
                                </form></td> --}}

                </tbody>
            </table>
        @endforeach
    @endif

@endsection
