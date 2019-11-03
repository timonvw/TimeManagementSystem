@extends('layouts.basic-layout')

@section('title', "Login")

@section('content')
    <h1 class="title">{{ __('Login') }}</h1>

    <form class="box" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="field">
            <label class="label" for="email">{{ __('E-Mail Address') }}</label>
            <div class="control">
                <input id="email" type="email" class="input" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
            </div>
        </div>

        <div class="field">
            <label class="label" for="password">{{ __('Password') }}</label>
            <div class="control">
                <input id="password" type="password" class="input" name="password" required autocomplete="current-password">
            </div>
        </div>

        <div class="field">
                <div class="control">
                        <label class="checkbox" for="remember">
                                <input class="checkbox" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                {{ __('Remember me') }}
                        </label>
                </div>
            </div>

        <div class="field">
            <div class="control">
                <button type="submit" class="button is-link">{{ __('Login') }}</button>

                @if (Route::has('password.request'))
                    <a class="button" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                @endif
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
