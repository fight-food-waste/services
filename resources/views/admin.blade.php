@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Admin</div>
                    <div class="card-body">
                        Welcome, {{ $user->first_name }}<br>
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Volunteers waiting for approval') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (sizeof($volunteers) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Proof of application</th>
                                    <th scope="col">Approve</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($volunteers as $volunteer)
                                    <tr>
                                        <th scope="row">{{ $volunteer->id }}</th>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>
                                            <a href="{{ url('admin/application_files/' . $volunteer->application_filename) }}">
                                                <button type="button" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="/admin/volunteer/{{ $volunteer->id }}/approve">
                                                <button type="button" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </a>
                                            <a href="/admin/volunteer/{{ $volunteer->id }}/reject">
                                                <button type="button" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no volunteer waiting for approval!
                        @endif
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection
