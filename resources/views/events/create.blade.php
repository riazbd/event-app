@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4">Create Event</h1>
            <form action="{{ route('events.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" name="title" class="form-control shadow-sm" placeholder="Enter Event Title" required>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="event_time">Event Time</label>
                            <input type="datetime-local" name="event_time" class="form-control shadow-sm" required>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="description">Event Description</label>
                    <textarea name="description" class="form-control shadow-sm" rows="4" placeholder="Provide a brief description of the event"></textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" class="form-control shadow-sm" placeholder="Event Location">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="attendees">Attendees (Comma-separated emails)</label>
                            <input type="text" name="attendees" class="form-control shadow-sm" placeholder="email1@example.com, email2@example.com">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Create Event</button>
            </form>
        </div>
    </div>
@endsection
