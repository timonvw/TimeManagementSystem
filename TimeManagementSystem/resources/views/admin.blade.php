@extends('layouts.basic-layout')

@section('title', "Admin panel")

@section('head')
    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }
    </style>
@endsection

@section('content')

    <p>
        <h1 class="title">Admin panel</h1>
    </p>

    <div>
        @foreach ($users as $user)
            <table class="table is-hoverable is-fullwidth">
                <tbody>
                    <tr class="box">
                        <td style="width:100%; border:none;"><strong>{{$user->name}}</strong></td>
                        <td style="border:none;"><a class="button is-light" href="/user/{{$user->id}}/edit">Edit</a></td>
                        <td style="border:none;">
                        <form method="POST" action="/user/{{$user->id}}">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="button is-danger">Delete</button>
                        </form></td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>

@endsection
