@extends('layouts.basic-layout')

@section('title', "Create group")

@section('content')
    <style>
        .box
        {
            padding: 0.5rem !important;
            line-height: 2 !important;
        }
    </style>

    <h1 class="title">Create a group</h1>

    <form class="box" method="POST" action="/groups">
        @csrf

        <label class="label" for="name">Create a group</label>

        <div class="field">
            <p class="control is-expanded">
                Group name <input id="name" type="text" class="input" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="group name">
            </p>
        </div>
        <div class="field">
            <p class="control is-expanded">
                Add group users<textarea id="emails" class="textarea" name="emails" value="{{ old('emails') }}" placeholder="add email of user(s) here. Devide multiple emails with ','
                <?="\n"?>Example:<?="\n"?>email1@mail.com, email2@mail.com" required autocomplete="emails"></textarea>
            </p>
        </div>

        <div class="field">
            <p class="control">
                <button type="submit" class="button is-link">Create</button>
            </p>
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

    <a href="/groups" class="button is-link">Back</a>


@endsection
