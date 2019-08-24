@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('admin.membership.membership_management') }}</div>

                    <div class="card-body">
                        @include('partials.alert')

                        @if($user->type == "member")
                            @if($user->hasValidMembership())
                                {{ __('admin.membership.membership_active_until', ['date' => $user->membership_end_date->format('Y-m-d')]) }}
                            @else
                                {{ __('admin.membership.membership_not_active') }}
                                <a href="{{ url('/membership/renew') }}"><button type="button" class="btn btn-primary">{{ __('admin.membership.subscribe') }}</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
