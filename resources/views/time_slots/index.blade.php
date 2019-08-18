@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card">
                    <div class="card-header">Add a new availability time slot</div>
                    <div class="card-body">
                        {!! form($form) !!}
                    </div>
                </div>


                <div class="card card-more">
                    <div class="card-header">Your availability time slots</div>
                    <div class="card-body">
                        @if (sizeof($user->timeSlots) > 0)
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Day</th>
                                    <th scope="col">Start time</th>
                                    <th scope="col">End time</th>
                                    <th scope="col">Delete</th>
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
                            You don't have any time slot yet.
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
