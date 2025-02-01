@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Event Reminders</h1>

    <div class="d-flex justify-content-between mb-4">
        <a href="{{ route('events.create') }}" class="btn btn-primary shadow-sm">Create New Event</a>
        <a href="{{ route('events.export') }}" class="btn btn-success shadow-sm">Export Events</a>
    </div>

    <form action="{{ route('events.import') }}" method="POST" enctype="multipart/form-data" class="mb-4">
        @csrf
        <div class="input-group">
            <input type="file" name="file" class="form-control shadow-sm" accept=".csv" required>
            <button type="submit" class="btn btn-info shadow-sm">Import Events</button>
        </div>
    </form>

    <form action="{{ route('events.index') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control shadow-sm" placeholder="Search events..." value="{{ request('search') }}">
            <button type="submit" class="btn btn-secondary shadow-sm">Search</button>
        </div>
    </form>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-lg">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Events</h5>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped shadow-sm">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Event Time</th>
                                    <th>Location</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($events as $event)
                                    <tr>
                                        <td>{{ $event->title }}</td>
                                        <td>{{ $event->event_time }}</td>
                                        <td>{{ $event->location }}</td>
                                        <td>
                                            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning btn-sm shadow-sm">Edit</a>
                                            <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm shadow-sm">Delete</button>
                                            </form>
                                            <form action="{{ route('events.complete', $event) }}" method="POST" style="display:inline;">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm shadow-sm">Complete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Calendar Section -->
        <div class="col-lg-6 mb-4">
            <div id="calendar"></div>
        </div>
    </div>

</div>

@endsection

<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.9/index.global.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: @json($events->map(function ($event) {
                return [
                    'title' => $event->title,
                    'start' => $event->event_time,
                ];
            })),
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,dayGridWeek,dayGridDay'
            },
            aspectRatio: 1.5,
            eventColor: '#378006',
            eventTextColor: 'white',
        });
        calendar.render();
    });
</script>
