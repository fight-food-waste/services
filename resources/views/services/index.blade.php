@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('partials.alert')

                @if($user->type == 'member')
                    <div class="card">
                        <div class="card-header">{{ __('admin.services_requests.make_new_service_request') }}</div>
                        <div class="card-body">
                            @if($user->hasValidMembership())
                                {!! form($form) !!}
                            @else
                                {{ __('admin.services_requests.no_valid_membership') }}
                            @endif
                        </div>
                    </div>

                @endif

                @if($user->type == 'member')
                    <div class="card card-more">
                        <div class="card-header">{{ __('admin.services_requests.unassigned_service_requests') }}</div>
                        <div class="card-body">
                            @if (sizeof($unassignedServiceRequests) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.day') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.start_time') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.end_time') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.service') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.cancel') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unassignedServiceRequests as $serviceRequest)
                                        <tr>
                                            <th scope="row">{{ $serviceRequest->id }}</th>
                                            <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
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
                                {{ __('admin.services_requests.no_unassigned_requests') }}
                            @endif
                        </div>
                    </div>
                @endif

                @if($user->type == 'volunteer')
                    <div class="card card-more">
                        <div class="card-header">{{ __('admin.services_requests.available_service_requests') }}</div>
                        <div class="card-body">
                            @if (sizeof($unassignedServiceRequests) > 0)
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.day') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.start_time') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.end_time') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.service') }}</th>
                                        <th scope="col">{{ __('admin.services_requests.columns.pick_up') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($unassignedServiceRequests as $serviceRequest)
                                        <tr>
                                            <th scope="row">{{ $serviceRequest->id }}</th>
                                            <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                            <td>{{ $serviceRequest->service->name }}</td>

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
                                {{ __('admin.services_requests.no_available_request') }}
                            @endif
                        </div>
                    </div>
                @endif

                <div class="card card-more">
                    <div class="card-header">{{ __('admin.services_requests.incoming_service_requests') }}</div>
                    <div class="card-body">
                        @if (sizeof($incomingServiceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.day') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.start_time') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.end_time') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.service') }}</th>
                                    @if ($user->type == 'member')
                                        <th scope="col">{{ __('admin.services_requests.columns.volunteer') }}</th>
                                    @endif
                                    @if ($user->type == 'volunteer')
                                        <th scope="col">{{ __('admin.services_requests.columns.member') }} }}</th>
                                    @endif
                                    <th scope="col">{{ __('admin.services_requests.columns.status') }} }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($incomingServiceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
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
                            {{ __('admin.services_requests.no_incoming_request') }}
                        @endif
                    </div>
                </div>
                <div class="card card-more">
                    <div class="card-header">{{ __('admin.services_requests.past_service_requests') }}</div>
                    <div class="card-body">
                        @if (sizeof($pastServiceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.day') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.start_time') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.end_time') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.service') }} }}</th>
                                    @if ($user->type == 'member')
                                        <th scope="col">{{ __('admin.services_requests.columns.volunteer') }} }}</th>
                                    @endif
                                    @if ($user->type == 'volunteer')
                                        <th scope="col">{{ __('admin.services_requests.columns.member') }} }}</th>
                                    @endif
                                    <th scope="col">{{ __('admin.services_requests.columns.status') }} }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($pastServiceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
                                        <td>{{ $serviceRequest->service->name }}</td>
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
                            {{ __('admin.services_requests.no_past_request') }}
                        @endif
                    </div>
                </div>
                <div class="card card-more">
                    <div class="card-header">{{ __('admin.services_requests.rejected_service_request') }}</div>
                    <div class="card-body">
                        @if (sizeof($cancelledServiceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.day') }} }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.start_time') }} }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.end_time') }} }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.service') }} }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.status') }} }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($cancelledServiceRequests as $serviceRequest)
                                    <tr>
                                        <th scope="row">{{ $serviceRequest->id }}</th>
                                        <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
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
                            {{ __('admin.services_requests.no_rejected_request') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
