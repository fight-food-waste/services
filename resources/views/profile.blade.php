@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('profile.profile_page') }}</div>

                    <div class="card-body">
                        {{ __('profile.welcome', ['user' => $user->first_name]) }}<br>
                        @if($user->type == "member")
                            <br>{{ __('profile.manage_membership') }}<a href="{{ url('membership') }}">{{ __('profile.here') }}</a>
                        @elseif($user->type == "volunteer")
                            <br>{{ __('profile.download_planning') }}<a href="{{ route('planning.export') }}">{{ __('profile.here') }}</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
