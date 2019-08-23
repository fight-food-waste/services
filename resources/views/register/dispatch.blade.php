@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('signup.signup') }}</div>

                    <div class="card-body">
                        <h2 class="text-center mb-4">{{ __('signup.who_are_you') }}</h2>
                        <div>
                            <ul>
                                <li><a href="{{ url('register/member') }}">{{ __('admin.singular.member') }}</a></li>
                                <li><a href="{{ url('register/volunteer') }}">{{ __('admin.singular.volunteer') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
