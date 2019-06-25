@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Confirm your new service request</div>
                    <div class="card-body">
                        You made a request for {{ $requested_service->name }} during {{ $service_request->hour_count }}
                        hours starting on the {{ date("d-m-Y", strtotime($service_request->start_date)) }}
                        at {{ date("H:i", strtotime($service_request->start_date)) }}.
                    </div>
                    <div class="card-body">
                        @if(sizeof($available_volunteers) == 0)
                            Sorry there are no available volunteers for this time range and service...
                        @else
                            <div>
                                There
                                are {{sizeof($available_volunteers)}} {{ Str::plural('volunteer', sizeof($available_volunteers)) }}
                                available for this time range. Choose
                                one:
                            </div>
                            <form method="POST" enctype="multipart/form-data"
                                  action="{{ url('services/new/confirm') }}">
                                @csrf

                                <input type="hidden" name="service_id" value="{{$service_request->service_id}}">
                                <input type="hidden" name="start_date" value="{{$service_request->start_date}}">
                                <input type="hidden" name="hour_count" value="{{$service_request->hour_count}}">


                                <div class="form-group row">
                                    <label for="volunteer_id"
                                           class="col-md-4 col-form-label text-md-right">{{ __('Volunteer ') }}</label>

                                    <div class="col-md-6">
                                        <select name="volunteer_id" id="volunteer_id"
                                                class="form-control @error('volunteer_id') is-invalid @enderror">
                                            @foreach($available_volunteers as $volunteer)
                                                <option value="{{ $volunteer->id }}">{{$volunteer->first_name}} {{$volunteer->last_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('volunteer_id')
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
