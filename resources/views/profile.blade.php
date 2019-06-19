@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile page</div>

                    <div class="card-body">
                        Welcome, {{ $user->first_name }}<br>

                        @if($user->type == "member")
                            @if($user->membership_active)
                                Great, your membership is active until the {{ $user->membership_expiration }}
                            @else
                                Your membership is not active. You can't request services.
                                <br>You can manage your membership <a href="{{ url('membership') }}">here</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
