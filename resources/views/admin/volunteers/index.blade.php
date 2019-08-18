@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')

                <div class="card card-more">
                    <div class="card-header">{{ __('Volunteers waiting for approval') }}</div>

                    <div class="card-body">

                        @if (sizeof($unapprovedVolunteers) > 0)
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
                                @foreach ($unapprovedVolunteers as $volunteer)
                                    <tr>
                                        <th scope="row">{{ $volunteer->id }}</th>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.volunteers.application_file.download', $volunteer->application_filename) }}">
                                                <button type="button" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td style="display: flex">
                                            <form action="{{ route('admin.volunteers.approve', $volunteer->id) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success">
                                                    <i class="fas fa-check"></i>
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
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

                        @if (sizeof($activeVolunteers) > 0)
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
                                @foreach ($activeVolunteers as $volunteer)
                                    <tr>
                                        <th scope="row">{{ $volunteer->id }}</th>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.volunteers.application_file.download', $volunteer->application_filename) }}">
                                                <button type="button" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.volunteers.reject', $volunteer->id) }}"
                                                  method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
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
                    <div class="card-header">{{ __('Rejected volunteers') }}</div>

                    <div class="card-body">

                        @if (sizeof($rejectedVolunteers) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Proof of application</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($rejectedVolunteers as $volunteer)
                                    <tr>
                                        <th scope="row">{{ $volunteer->id }}</th>
                                        <td>{{ $volunteer->first_name }}</td>
                                        <td>{{ $volunteer->last_name }}</td>
                                        <td>
                                            <a href="{{ route('admin.volunteers.application_file.download', $volunteer->application_filename) }}">
                                                <button type="button" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-download"></i>
                                                </button>
                                            </a>
                                        </td>
                                        <td>
                                            {{ $volunteer->getStatusName() }}
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
