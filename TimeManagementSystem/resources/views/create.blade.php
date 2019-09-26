@extends('layouts.basic-layout')

@section('title', "Create")

@section('content')
    <form action="/projects/create" method="POST">
        {{csrf_field()}}
        <p><input type="text" name="title" placeholder="Project titel"></p>
        <p><textarea name="description" placeholder="Project description"></textarea></p>
        <p><button type="submit">Create project</button></p>
    </form>
@endsection
