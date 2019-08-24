@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')

                <div class="card">
                    <div class="card-header">{{ __('home.dashboard') }}</div>

                    <div class="card-body">

                         {{ __('home.message') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
