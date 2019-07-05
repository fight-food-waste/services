@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="card">
                    <div class="card-header">Admin</div>
                    <div class="card-body">
                        Welcome, {{ $user->first_name }}<br>
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Manage services') }}</div>

                    <div class="card-body">
                        You can see and manage the services <a href="{{ route('services') }}">here</a>.
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Volunteers waiting for approval') }}</div>

                    <div class="card-body">

                        @if (sizeof($unapproved_volunteers) > 0)
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
                                @foreach ($unapproved_volunteers as $volunteer)
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

                <div class="card card-more">
                    <div class="card-header">{{ __('Approved volunteers') }}</div>

                    <div class="card-body">

                        @if (sizeof($active_volunteers) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Proof of application</th>
                                    <th scope="col">Reject</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($active_volunteers as $volunteer)
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
                            There is no approved volunteer.
                        @endif
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Banned volunteers') }}</div>

                    <div class="card-body">

                        @if (sizeof($banned_volunteers) > 0)
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
                                @foreach ($banned_volunteers as $volunteer)
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
                                            {{ ucfirst($volunteer->status)  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no banned volunteer.
                        @endif
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Rejected volunteers') }}</div>

                    <div class="card-body">

                        @if (sizeof($rejected_volunteers) > 0)
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
                                @foreach ($rejected_volunteers as $volunteer)
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
                                            {{ ucfirst($volunteer->status)  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no banned volunteer.
                        @endif
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Members') }}</div>

                    <div class="card-body">

                        @if (sizeof($members) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <th scope="row">{{ $member->id }}</th>
                                        <td>{{ $member->first_name }}</td>
                                        <td>{{ $member->last_name }}</td>

                                        <td>
                                            {{ ucfirst($member->status)  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no banned volunteer.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
