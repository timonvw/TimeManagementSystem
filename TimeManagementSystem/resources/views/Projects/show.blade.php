@extends('layouts.basic-layout')

@section('title', "Show Project")

@section('content')

<h1 class="title">{{$project->title}}</h1>

<div class="content">
    {{$project->description}}
</div>

<p>
    <a href="/projects/{{ $project->id}}/edit">Edit</a>
</p>

@if ($project->tasks->count())
<div class="content">
    <ul>
    @foreach ($project->tasks as $task)
        <li>{{$task->name}}</li>
    @endforeach
    </ul>
</div>
@endif

@endsection
