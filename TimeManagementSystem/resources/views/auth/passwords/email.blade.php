@extends('layouts.basic-layout')

@section('title', "Reset password")

@section('content')

<h1 class="title">{{ __('Password Reset') }}</h1>

    @if (session('status'))
        <div class="notification is-success" role="alert">
                {{ session('status') }}
        </div>
    @endif

    <form class="box" method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="field">
            <label class="label" for="email">{{ __('E-Mail Address') }}</label>
            <div class="control">
                <input id="email" type="email" class="input " name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
        </div>


        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">{{ __('Send Password Reset Link') }}</button>
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
