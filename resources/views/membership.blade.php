@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Membership management</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if($user->type == "member")
                            @if($user->hasValidMembership())
                                Great, your membership is active until the {{ $user->membership_end_date }}
                            @else
                                Your membership is not active. You can't request services.
                                <a href="{{ url('/membership/renew') }}"><button type="button" class="btn btn-primary">Subscribe</button>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
