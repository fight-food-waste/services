@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                @include('partials.alert')
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('account.index') }}">
                            <button class="btn btn-sm btn-primary" style="margin-right:5px">
                                <i class="fas fa-arrow-left"></i>
                            </button>
                        </a>
                        {{ __('account.edit_account') }}
                    </div>

                    <div class="card-body">
                        {!! form($form) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
