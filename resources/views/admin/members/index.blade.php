@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')

                <div class="card card-more">
                    <div class="card-header">{{ __('Members') }}</div>

                    <div class="card-body">

                        @if (sizeof($members) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <th scope="row">{{ $member->id }}</th>
                                        <td>{{ $member->first_name }}</td>
                                        <td>{{ $member->last_name }}</td>

                                        <td>
                                            {{ $member->getStatusName()  }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            There is no banned volunteer.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
