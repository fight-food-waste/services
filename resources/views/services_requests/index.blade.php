@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @include('partials.alert')

                @if($user->type == 'member')
                    <div class="card">
                        <div class="card-header">Make a new service request</div>
                        <div class="card-body">
                            @if($user->hasValidMembership())
                                {!! form($form) !!}
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
                                        <th scope="col">Description</th>
                                        <th scope="col">Cancel</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unassignedServiceRequests as $serviceRequest)

                                        <div class="modal fade" id="modal-{{$serviceRequest->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Description</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{$serviceRequest->description}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <tr>
                                            <th scope="row">{{ $serviceRequest->id }}</th>
                                            <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->service->name }}</td>

                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#modal-{{$serviceRequest->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>

                                            <td>
                                                <a href="{{ route('service_requests.cancel', $serviceRequest->id) }}">
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
                                        <th scope="col">Description</th>
                                        <th scope="col">Pick up</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unassignedServiceRequests as $serviceRequest)
                                        <div class="modal fade" id="modal-{{$serviceRequest->id}}" tabindex="-1"
                                             role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Description</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        {{$serviceRequest->description}}
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">Close
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <tr>
                                            <th scope="row">{{ $serviceRequest->id }}</th>
                                            <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->service->name }}</td>
                                            <td>
                                                <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                        data-target="#modal-{{$serviceRequest->id}}">
                                                    <i class="fas fa-eye"></i>
                                                </button>
                                            </td>

                                            <td>
                                                @if($user->canPickUp($serviceRequest))
                                                    <a href="{{ route('service_requests.pick_up', $serviceRequest->id) }}">
                                                        <button type="button" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-cart-plus"></i>
                                                        </button>
                                                    </a>
                                                @else
                                                    <button type="button" class="btn btn-sm btn-secondary" disabled>
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
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
                                    <th scope="col">Description</th>
                                    @if ($user->type == 'member')
                                        <th scope="col">Volunteer</th>
                                    @endif
                                    @if ($user->type == 'volunteer')
                                        <th scope="col">Member</th>
                                    @endif
                                    <th scope="col">Cancel</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($incomingServiceRequests as $serviceRequest)

                                    <div class="modal fade" id="modal-{{$serviceRequest->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Description</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$serviceRequest->description}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#modal-{{$serviceRequest->id}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        @if ($user->type == 'member')
                                            <td>{{ $serviceRequest->volunteer->first_name }}
                                                {{ $serviceRequest->volunteer->last_name }}</td>
                                        @endif
                                        @if ($user->type == 'volunteer')
                                            <td>{{ $serviceRequest->member->first_name }}
                                                {{ $serviceRequest->member->last_name }}</td>
                                        @endif
                                        <td>
                                            <a href="{{ route('service_requests.cancel', $serviceRequest->id) }}">
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
                                    <th scope="col">Description</th>
                                    @if ($user->type == 'member')
                                        <th scope="col">Volunteer</th>
                                    @endif
                                    @if ($user->type == 'volunteer')
                                        <th scope="col">Member</th>
                                    @endif
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pastServiceRequests as $serviceRequest)

                                    <div class="modal fade" id="modal-{{$serviceRequest->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Description</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$serviceRequest->description}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#modal-{{$serviceRequest->id}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>
                                        @if ($user->type == 'member')
                                            <td>{{ $serviceRequest->volunteer->first_name }}
                                                {{ $serviceRequest->volunteer->last_name }}</td>
                                        @endif
                                        @if ($user->type == 'volunteer')
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
                                    <th scope="col">Description</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cancelledServiceRequests as $serviceRequest)

                                    <div class="modal fade" id="modal-{{$serviceRequest->id}}" tabindex="-1"
                                         role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Description</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    {{$serviceRequest->description}}
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Close
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                    data-target="#modal-{{$serviceRequest->id}}">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                        </td>

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
