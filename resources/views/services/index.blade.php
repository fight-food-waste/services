@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Make a new service request</div>
                    <div class="card-body">
                        <form method="POST" enctype="multipart/form-data" action="{{ url('services/new/prepare') }}">
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
                                    <input class="form-control @error('start_date') is-invalid @enderror" type="datetime-local" id="start_date"
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
                                    <input class="form-control @error('hour_count') is-invalid @enderror" type="number" id="hour_count"
                                           name="hour_count" step="1" value="1">
                                    @error('hour_count')
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
                    </div>
                </div>
                <div class="card card-more">
                    <div class="card-header">Service Requests</div>

                    <div class="card-body">
                        @if (sizeof($service_requests) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Day</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Number of hours</th>
                                    <th scope="col">Service</th>
                                    <th scope="col">Volunteer</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($service_requests as $service_request)
                                    <tr>
                                        <th scope="row">{{ $service_request->id }}</th>
                                        <td>{{ date("d-m-Y", strtotime($service_request->start_date)) }}</td>
                                        <td>{{ date("H:i", strtotime($service_request->start_date)) }}</td>
                                        <td>{{ $service_request->hour_count }}</td>
                                        <td>{{ $service_request->service()->first()->name }}</td>
                                        <td>{{ $service_request->volunteer()->first()->first_name }}
                                            {{ $service_request->volunteer()->first()->last_name }}</td>
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
