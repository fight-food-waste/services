@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <h2 class="text-center mb-4">Who are you?</h2>
                        <div>
                            <ul>
                                <li><a href="{{ url('register/member') }}">Member</a></li>
                                <li><a href="{{ url('register/volunteer') }}">Volunteer</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
