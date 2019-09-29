@extends('layouts.basic-layout')

@section('title', "Home")

@section('content')
    <p>
        <h1 class="title">Time Management System</h1>
    </p>

    <ul>
        @foreach ($projects as $project)
            <li><a href="/projects/{{$project->id}}">{{$project->title}}</a></li>
        @endforeach
    </ul>
@endsection
