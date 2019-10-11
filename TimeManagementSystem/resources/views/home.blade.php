@extends('layouts.basic-layout')

@section('title', "Dashboard")

@section('content')

    @if (session('status'))
        <div class="notification is-danger" role="alert">
                {{ session('status') }}
        </div>
    @endif

    {{-- <div class="notification is-success">
            <button class="delete"></button>
            You succesful logged in.
    </div> --}}


    <p>
        <h1 class="title">Dashboard</h1>

        @if (Auth::user()->times->count())
            @foreach (Auth::user()->times as $time)
                <div class="content">
                    <div class="card">
                        <header class="card-header">
                            <p class="card-header-title">
                            {{$time->task->name}}
                            </p>
                        </header>

                        <footer class="card-footer">
                                @if ($time->group_id == 0)
                                    <div class="card-footer-item">Prive</div>
                                @else
                                    <a href="#" class="card-footer-item">
                                    {{$time->group->name}}
                                    </a>
                                @endif
                            <div class="card-footer-item">Hoelang</div>
                            <div class="card-footer-item">{{$time->start_time}}</div>
                            <div class="card-footer-item">{{$time->end_time}}</div>
                            <a href="#" class="card-footer-item">Edit</a>
                            <a href="#" class="card-footer-item">Delete</a>
                        </footer>
                    </div>
                </div>
            @endforeach
        @endif
    </p>

@endsection
