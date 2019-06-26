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
                            <br>You can manage your membership <a href="{{ url('membership') }}">here</a>
                        @elseif($user->type == "volunteer")
                            <br>You can download your planning <a href="{{ route('planning.export') }}">here</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
