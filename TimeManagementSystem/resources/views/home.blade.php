@extends('layouts.basic-layout')

@section('title', "Dashboard")

@section('content')

    @if (session('status'))
        <div class="notification is-danger" role="alert">
                {{ session('status') }}
        </div>
    @endif

    <div class="notification is-success">
            <button class="delete"></button>
            You succesful logged in.
    </div>


    <p>
        <h1 class="title">Dashboard</h1>
    </p>

@endsection
