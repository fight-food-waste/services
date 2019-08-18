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

                @if($user->type == 'member')
                    <div class="card">
                        <div class="card-header">Make a new service request</div>
                        <div class="card-body">
                            @if($user->hasValidMembership())

                                <form method="POST" enctype="multipart/form-data"
                                      action="{{ route('service_requests.store') }}">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="service_id"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Type of service') }}</label>

                                        <div class="col-md-6">
                                            <select name="service_id" id="service_id"
                                                    class="form-control @error('service_id') is-invalid @enderror">
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('service_id')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="start_date"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Appointment time') }}</label>

                                        <div class="col-md-6">
                                            <input class="form-control @error('start_date') is-invalid @enderror"
                                                   type="datetime-local" id="start_date"
                                                   name="start_date" step="300"
                                                   min="{{ date("Y-m-d", strtotime("+1 day")) }}T00:00">
                                            @error('start_date')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="hour_count"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Hours requested') }}</label>

                                        <div class="col-md-6">
                                            <input class="form-control @error('hour_count') is-invalid @enderror"
                                                   type="number" id="hour_count"
                                                   name="hour_count" step="1" value="1">
                                            @error('hour_count')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description"
                                               class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                                        <div class="col-md-6">
                                            <input class="form-control @error('description') is-invalid @enderror"
                                                   type="text" id="description"
                                                   name="description">
                                            @error('description')
                                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row mb-0">
                                        <div class="col-md-8 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Send service request') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                You don't have a valid membership, so you can't request a service!
                            @endif
                        </div>
                    </div>

                @endif

                @if($user->type == 'member')
                    <div class="card card-more">
                        <div class="card-header">Unassigned Service Requests</div>
                        <div class="card-body">
                            @if (sizeof($unassignedServiceRequests) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Start time</th>
                                        <th scope="col">End time</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Cancel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unassignedServiceRequests as $serviceRequest)
                                        <tr>
                                            <th scope="row">{{ $serviceRequest->id }}</th>
                                            <td>{{ $serviceRequest->timeSlot->date }}</td>
                                            <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->service->name }}</td>

                                            <td>
                                                @if($serviceRequest->status == 0)
                                                    <a href="{{ route('service_requests.cancel', $serviceRequest->id) }}">
                                                        <button type="button" class="btn btn-sm btn-danger">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    {{ $serviceRequest->getStatusName() }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                There are no unassigned requests
                            @endif
                        </div>
                    </div>
                @endif

                @if($user->type == 'volunteer')
                    <div class="card card-more">
                        <div class="card-header">Available Service Requests</div>
                        <div class="card-body">
                            @if (sizeof($unassignedServiceRequests) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Day</th>
                                        <th scope="col">Start time</th>
                                        <th scope="col">End time</th>
                                        <th scope="col">Service</th>
                                        <th scope="col">Pick up</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unassignedServiceRequests as $serviceRequest)
                                        <tr>
                                            <th scope="row">{{ $serviceRequest->id }}</th>
                                            <td>{{ $serviceRequest->timeSlot->date }}</td>
                                            <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->service->name }}</td>

                                            <td>
                                                @if($serviceRequest->status == 0)
                                                    <a href="{{ route('service_requests.pick_up', $serviceRequest->id) }}">
                                                        <button type="button" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    {{ $serviceRequest->getStatusName() }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @else
                                There are no available requests
                            @endif
                        </div>
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header">Incoming Service Requests</div>
                    <div class="card-body">
                        @if (sizeof($incomingServiceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Start time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Service</th>
                                    @if ($user->type == 'member' || $user->type == 'admin')
                                        <th scope="col">Volunteer</th>
                                    @endif
                                    @if ($user->type == 'volunteer' || $user->type == 'admin')
                                        <th scope="col">Member</th>
                                    @endif
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($incomingServiceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
                                        @if ($user->type == 'member' || $user->type == 'admin')
                                            <td>{{ $serviceRequest->volunteer->first_name }}
                                                {{ $serviceRequest->volunteer->last_name }}</td>
                                        @endif
                                        @if ($user->type == 'volunteer' || $user->type == 'admin')
                                            <td>{{ $serviceRequest->member->first_name }}
                                                {{ $serviceRequest->member->last_name }}</td>
                                        @endif
                                        <td>
                                            {{ $serviceRequest->getStatusName() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There are no incoming requests
                        @endif
                    </div>
                </div>
                <div class="card card-more">
                    <div class="card-header">Past Service Requests</div>
                    <div class="card-body">
                        @if (sizeof($pastServiceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Start time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Service</th>
                                    @if ($user->type == 'member' || $user->type == 'admin')
                                        <th scope="col">Volunteer</th>
                                    @endif
                                    @if ($user->type == 'volunteer' || $user->type == 'admin')
                                        <th scope="col">Member</th>
                                    @endif
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pastServiceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
                                        @if ($user->type == 'member' || $user->type == 'admin')
                                            <td>{{ $serviceRequest->volunteer->first_name }}
                                                {{ $serviceRequest->volunteer->last_name }}</td>
                                        @endif
                                        @if ($user->type == 'volunteer' || $user->type == 'admin')
                                            <td>{{ $serviceRequest->member->first_name }}
                                                {{ $serviceRequest->member->last_name }}</td>
                                        @endif
                                        <td>
                                            {{ $serviceRequest->getStatusName() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There are no past requests
                        @endif
                    </div>
                </div>
                <div class="card card-more">
                    <div class="card-header">Rejected Service Requests</div>
                    <div class="card-body">
                        @if (sizeof($cancelledServiceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Start time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cancelledServiceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>

                                        <td>
                                            {{ $serviceRequest->getStatusName() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There are no rejected requests
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
