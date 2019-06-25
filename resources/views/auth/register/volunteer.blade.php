@extends('auth.register.signup')

@section('form-specifics')

    <div class="form-group row">
        <label for="service_id" class="col-md-4 col-form-label text-md-right">{{ __('What do you do?') }}</label>

        <div class="col-md-6">
            <select name="service_id" id="service_id" class="form-control @error('service_id') is-invalid @enderror">
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

        <label for="application_file" class="col-md-4 col-form-label text-md-right">{{ __('Proof') }}</label>

        <div class="col-md-6">
            <input id="application_file" name="application_file"
                   class="form-control-file @error('application_file') is-invalid @enderror" type="file"
                   accept="application/pdf">

            @error('application_file')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

@endsection
