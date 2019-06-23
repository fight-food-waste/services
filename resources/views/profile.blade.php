@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Profile page</div>

                    <div class="card-body">
                        Welcome, {{ $user->first_name }}<br>

                        <br>You can manage your membership <a href="{{ url('membership') }}">here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
