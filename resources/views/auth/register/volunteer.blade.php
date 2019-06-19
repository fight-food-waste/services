@extends('auth.register.signup')

@section('form-specifics')

    <div class="form-group row">
        <label for="volunteer-type" class="col-md-4 col-form-label text-md-right">{{ __('What do you do?') }}</label>

        <div class="col-md-6">
            <select id="volunteer-type"  class="@error('volunteer-type') is-invalid @enderror">
                <option value="">Cooking classes</option>
                <option value="">Car sharing</option>
                <option value="">Repair services</option>
                <option value="">Guarding</option>
                <option value="">Housing/DIY</option>
                <option value="">Electricity</option>
                <option value="">Plumbing</option>
            </select>
            @error('volunteer-type')
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
