@extends('layouts.basic-layout')

@section('title', "User")

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
        <h1 class="title">{{$user->name}}s account</h1>
    </p>

    <div class="box level">
        <div class="level-left" style="width: 40%;">
            <form method="POST" action="/user/{{$user->id}}" style="width: 100%">
                @csrf
                @method('PATCH')
                <p>User since: {{$created}}</p><br>

                <div class="field">
                    <label for="name" class="label" >Name</label>
                    <p class="control">
                        <input id="name" type="text"  class="input" name="name" value="{{ $user->name }}" required autocomplete="name">
                    </p>
                </div>

                <div class="field">
                    <label for="email" class="label" >Email</label>
                    <p class="control">
                        <input id="email" type="text" class="input" name="email" value="{{ $user->email }}" required autocomplete="email">
                    </p>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" name="updateUser" class="button is-link">Update</button>
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
        </div>


        <div class="level-right" style="width: 40%;">
            <form method="POST" action="/user/{{$user->id}}" style="width: 100%">
                @csrf
                @method('PATCH')

                <div class="field">
                    <label for="password" class="label" >Old password</label>
                    <p class="control">
                        <input id="password" type="password" class="input" name="password" value="{{ old('password') }}" required autocomplete="password">
                    </p>
                </div>

                <div class="field">
                    <label for="new_password" class="label" >New password</label>
                    <p class="control">
                        <input id="new_password" type="password" class="input" name="new_password" value="{{ old('new_password') }}" required autocomplete="new_password">
                    </p>
                </div>

                <div class="field">
                    <label for="new_password_repeat" class="label" >New password repeat</label>
                    <p class="control">
                        <input id="new_password_repeat" type="password" class="input" name="new_password_repeat" value="{{ old('new_password_repeat') }}" required autocomplete="new_password_repeat">
                    </p>
                </div>

                <div class="field">
                    <div class="control">
                        <button type="submit" name="updatePassword" class="button is-link">Change password</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="field is-grouped">
        <div class="content">
            <form method="POST" action="/user/{{$user->id}}">
                @csrf
                @method('DELETE')

                <button type="submit" class="button is-danger">Delete account</button>
            </form>
        </div>
    </div>

@endsection
