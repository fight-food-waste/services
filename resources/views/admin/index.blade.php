@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')
                <div class="card">
                    <div class="card-header">Admin</div>

                    <div class="card-body">
                        <p>Welcome, {{ $user->first_name }}. Click one of the links below to manage resources.</p>

                        <ul>
                            <li><a href="{{ route('admin.volunteers.index') }}">Volunteers</a></li>
                            <li><a href="{{ route('admin.members.index') }}">Members</a></li>
                            <li><a href="{{ route('admin.services.index') }}">Services</a></li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
