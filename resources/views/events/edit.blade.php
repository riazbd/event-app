@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="card shadow-lg p-4">
            <h1 class="text-center mb-4">Edit Event</h1>
            <form action="{{ route('events.update', $event) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="title">Event Title</label>
                            <input type="text" name="title" class="form-control shadow-sm" value="{{ old('title', $event->title) }}" required>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="event_time">Event Time</label>
                            <input type="datetime-local" name="event_time" class="form-control shadow-sm" value="{{ old('event_time', $event->event_time) }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-group mb-4">
                    <label for="description">Event Description</label>
                    <textarea name="description" class="form-control shadow-sm" rows="4">{{ old('description', $event->description) }}</textarea>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input type="text" name="location" class="form-control shadow-sm" value="{{ old('location', $event->location) }}">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="form-group">
                            <label for="attendees">Attendees (Comma-separated emails)</label>
                            <input type="text" name="attendees" class="form-control shadow-sm" value="{{ old('attendees', $event->attendees) }}">
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100 shadow-sm">Update Event</button>
            </form>
        </div>
    </div>
@endsection
