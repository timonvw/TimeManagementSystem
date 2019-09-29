@extends('layouts.basic-layout')

@section('title', "Edit Project")

@section('content')

    <h1 class="title">
        Edit Project
    </h1>

    <form method="POST" action="/projects/{{$project->id}}">
        @method('PATCH')
        @csrf

        <div class="field">
            <label class="label" for="title">Titel</label>
            <div class="control">
            <input type="text" class="input" name="title" placeholder="title" value="{{ $project->title}}" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="title">Description</label>
            <div class="control">
                <textarea name="description" class="textarea" required>{{ $project->description}}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Update project</button>
            </div>
        </div>
    </form>
    <br>
    <form method="POST" action="/projects/{{$project->id}}">
        @method('DELETE')
        @csrf

        <div class="field">
                <div class="control">
                    <button type="submit" class="button">Delete project</button>
                </div>
        </div>
    </form>




@endsection
