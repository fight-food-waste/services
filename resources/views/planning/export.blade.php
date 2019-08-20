<table class="table table-bordered">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Day</th>
        <th scope="col">Start time</th>
        <th scope="col">End time</th>
        <th scope="col">Service</th>
        <th scope="col">Description</th>
        @if ($user->type == 'admin')
            <th scope="col">Volunteer</th>
        @endif
        @if ($user->type == 'volunteer' || $user->type == 'admin')
            <th scope="col">Member</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach ($serviceRequests->reverse() as $serviceRequest)
        <tr>
            <th scope="row">{{ $serviceRequest->id }}</th>
            <td>{{ $serviceRequest->timeSlot->date->format('Y-m-d') }}</td>
            <td>{{ $serviceRequest->timeSlot->start_time->format('H:i') }}</td>
            <td>{{ $serviceRequest->timeSlot->end_time->format('H:i') }}</td>
            <td>{{ $serviceRequest->service->name }}</td>
            <td>{{$serviceRequest->description}}</td>
            @if ($user->type == 'admin')
                <td>{{ $serviceRequest->volunteer->first_name }}
                    {{ $serviceRequest->volunteer->last_name }}</td>
            @endif
            @if ($user->type == 'volunteer' || $user->type == 'admin')
                <td>{{ $serviceRequest->member->first_name }}
                    {{ $serviceRequest->member->last_name }}</td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>
