@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')
                <div class="card">
                    <div class="card-header">Admin</div>

                    <div class="card-body">
                        <p>{{ __('admin.volunteers.welcome_message', ['user' => $user->first_name]) }}</p>

                        <ul>
                            <li><a href="{{ route('admin.volunteers.index') }}">{{ __('admin.index.volunteers') }}</a></li>
                            <li><a href="{{ route('admin.members.index') }}">{{ __('admin.index.members') }}</a></li>
                            <li><a href="{{ route('admin.services.index') }}">{{ __('admin.index.services') }}</a></li>
                            <li><a href="{{ route('planning.index') }}">Planning</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
