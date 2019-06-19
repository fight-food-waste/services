@extends('layouts.app')

@section('content')
    <header class="text-center mb-4">
        <h2>Who are you?</h2>
    </header>

    <div>
        <ul>
            <li><a href="{{ url('register/member') }}">Member</a></li>
            <li><a href="{{ url('register/volunteer') }}">Volunteer</a></li>
        </ul>
@endsection
