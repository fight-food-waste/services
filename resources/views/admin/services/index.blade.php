@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')

                <div class="card">
                    <div class="card-header">{{ __('admin.services.add_new_service') }}</div>
                    <div class="card-body">
                        {!! form($form) !!}
                    </div>
                </div>

                <div class="card card-more">
                    <div class="card-header">{{ __('Services') }}</div>

                    <div class="card-body">

                        @if (sizeof($services) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('admin.services.column.name') }}</th>
                                    <th scope="col">{{ __('admin.services.column.short_name') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <th scope="row">{{ $service->id }}</th>
                                        <td>{{ $service->name }}</td>
                                        <td>{{ $service->shortname }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            {{ __('admin.services.no_service') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
