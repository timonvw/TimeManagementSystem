@extends('layouts.basic-layout')

@section('title', "Create")

@section('content')

    <h1 class="title">
        Create Project
    </h1>

    <form method="POST" action="/projects">
        @csrf

        <div class="field">
            <label class="label" for="title">Titel</label>
            <div class="control">
            <input type="text" class="input" name="title" placeholder="title" value="{{ old('title') }}" required>
            </div>
        </div>

        <div class="field">
            <label class="label" for="title">Description</label>
            <div class="control">
                <textarea name="description" class="textarea" required>{{ old('description') }}</textarea>
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">Create project</button>
            </div>
        </div>

        @if ($errors->any())
        <div class="notification is-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

    </form>

@endsection
