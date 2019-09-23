@extends('layouts.basic-layout')

@section('title', "Home")

@section('content')
    <p>
        <h1>Time Management System</h1>
    </p>

    <ul>
        @foreach ($projects as $project)
            <li>{{$project->title}}</li>
        @endforeach
    </ul>
@endsection
