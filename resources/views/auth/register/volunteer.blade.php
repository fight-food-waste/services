@extends('auth.register.signup')

@section('form-specifics')

    <div class="form-group row">
        <label for="service_id" class="col-md-4 col-form-label text-md-right">{{ __('What do you do?') }}</label>

        <div class="col-md-6">
            <select name="service_id" id="service_id" class="@error('service_id') is-invalid @enderror">
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

        <label for="proof" class="col-md-4 col-form-label text-md-right">{{ __('Proof') }}</label>

        <div class="col-md-6">
            <input id="proof" class="@error('proof') is-invalid @enderror" type="file" accept="image/*" name="file">

            @error('proof')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>

    </div>

@endsection
