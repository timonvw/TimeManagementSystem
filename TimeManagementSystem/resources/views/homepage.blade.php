@extends('layouts.basic-layout')

@section('title', "Home")

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
        <h1 class="title">TMSystem</h1>
        <h2 class="subtitle">Track your time free</h2>
    </p>

    <div class="box">
        <ul>
        <li><a href="/projects">Alle projecten</a></li>
        <li><a href="/projects/create">Project aanmaken</a></li>
        </ul>
    </div>

@endsection
