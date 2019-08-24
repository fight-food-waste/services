@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">

                @include('partials.alert')

                <div class="card card-more">
                    <div class="card-header">{{ __('admin.services_requests.incoming_service_requests') }}</div>
                    <div class="card-body">
                        @if (sizeof($serviceRequests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.day') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.start_time') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.end_time') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.service') }}</th>
                                    <th scope="col">Description</th>
                                    @if ($user->type == 'member')
                                        <th scope="col">{{ __('admin.services_requests.columns.volunteer') }}</th>
                                    @endif
                                    @if ($user->type == 'volunteer')
                                        <th scope="col">{{ __('admin.services_requests.columns.member') }}</th>
                                    @endif
                                    <th scope="col">{{ __('admin.services_requests.columns.status') }}</th>
                                    <th scope="col">{{ __('admin.services_requests.columns.cancel') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($serviceRequests as $serviceRequest)

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
                                                            data-dismiss="modal">{{ __('main.close') }}
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
                                        <td>
                                            @if($serviceRequest->status === 1)
                                                <a href="{{ route('service_requests.cancel', $serviceRequest->id) }}">
                                                    <button type="button" class="btn btn-sm btn-danger">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </a>
                                            @endif
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
            </div>
        </div>
    </div>
@endsection
