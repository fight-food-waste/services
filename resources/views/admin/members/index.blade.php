@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('partials.alert')

                <div class="card card-more">
                    <div class="card-header">{{ __('admin.index.members') }}</div>

                    <div class="card-body">

                        @if (sizeof($members) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('admin.members.columns.first_name') }}</th>
                                    <th scope="col">{{ __('admin.members.columns.last_name') }}</th>
                                    <th scope="col">{{ __('admin.members.columns.status') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($members as $member)
                                    <tr>
                                        <th scope="row">{{ $member->id }}</th>
                                        <td>{{ $member->first_name }}</td>
                                        <td>{{ $member->last_name }}</td>

                                        <td>
                                            {{ $member->getStatusName() }}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            {{ __('admin.members.no_banned_volunteer') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
