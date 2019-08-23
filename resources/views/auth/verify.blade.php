@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('admin.auth.verify.verify_your_email_address') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('admin.auth.verify.success_message') }}
                        </div>
                    @endif

                    {{ __('admin.auth.verify.check_email_message') }}
                    {{ __('If you did not receive the email') }}, <a href="{{ route('verification.resend') }}">{{ __('admin.auth.verify.did_not_receive_the_email') }}</a>.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
