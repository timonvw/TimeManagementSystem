@extends('layouts.basic-layout')

@section('title', "Home")

@section('content')
    <p>
        <h1 class="title">Time Management System</h1>
    </p>

    @foreach ($projects as $project)
        <div class="tile is-ancestor">
            <div class="tile is-vertical is-8">
              <div class="tile">
                <div class="tile is-parent is-vertical">
                  <article class="tile is-child notification is-primary">
                    <p class="title"><a href="/projects/{{$project->id}}">{{$project->title}}</a></p>
                    <p class="subtitle">{{$project->description}}</p>
                  </article>
                </div>
              </div>
            </div>
        </div>
    @endforeach

@endsection
