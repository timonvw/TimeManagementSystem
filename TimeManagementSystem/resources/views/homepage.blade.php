@extends('layouts.basic-layout')

@section('title', "Home")

@section('content')
    <p>
        <h1 class="title">Welkom bij deze mooie test kut site</h1>
    </p>

    <ul>
       <li><a href="/projects">Alle projecten</a></li>
       <li><a href="/projects/create">Project aanmaken</a></li>
    </ul>
@endsection
