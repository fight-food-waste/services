@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('partials.alert')

                <div class="card">
                    <div class="card-header">{{__('admin.time_slots.add_new_availability_time_slot') }}</div>
                    <div class="card-body">
                        {!! form($form) !!}
                    </div>
                </div>


                <div class="card card-more">
                    <div class="card-header">{{__('admin.time_slots.your_availability_time_slots') }}</div>
                    <div class="card-body">
                        @if (sizeof($user->timeSlots) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{__('admin.time_slots.columns.day') }}</th>
                                    <th scope="col">{{__('admin.time_slots.columns.start_time') }}e</th>
                                    <th scope="col">{{__('admin.time_slots.columns.end_time') }}</th>
                                    <th scope="col">{{__('admin.time_slots.columns.delete') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach ($user->timeSlots as $timeSlot)
                                    <tr>
                                        <td>{{ $timeSlot->getWeekDayName() }}</td>
                                        <td>{{ $timeSlot->start_time->format('H:i') }}</td>
                                        <td>{{ $timeSlot->end_time->format('H:i') }}</td>
                                        <td>
                                            <form action="{{ route('time_slots.destroy', $timeSlot->id) }}"
                                                  method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @else
                            {{__('admin.time_slots.no_time_slot') }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
