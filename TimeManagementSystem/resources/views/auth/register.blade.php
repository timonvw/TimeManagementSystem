@extends('layouts.basic-layout')

@section('title', "Register")

@section('content')
    <h1 class="title">{{ __('Register') }}</h1>

    <form class="box" method="POST" action="{{ route('register') }}">
        @csrf

        <div class="field">
            <label class="label" for="name">{{ __('Name') }}</label>
            <div class="control">
            <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
            </div>
        </div>

        <div class="field">
            <label class="label" for="email">{{ __('E-Mail Address') }}</label>
            <div class="control">
                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="email">
            </div>
        </div>

        <div class="field">
            <label class="label" for="password">{{ __('Password') }}</label>
            <div class="control">
                    <input id="password" type="password" class="input" name="password" required autocomplete="new-password">
            </div>
        </div>

        <div class="field">
            <label class="label" for="password-confirm">{{ __('Confirm Password') }}</label>
            <div class="control">
                    <input id="password-confirm" type="password" class="input" name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">{{ __('Register') }}</button>
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
