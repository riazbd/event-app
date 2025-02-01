<?php

namespace App\Http\Controllers;

use App\Models\EventReminder;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventRemindersExport;
use App\Imports\EventRemindersImport;
use Illuminate\Support\Facades\Mail;
use App\Mail\EventReminderMail;

class EventReminderController extends Controller
{
    public function index(Request $request)
    {
        $query = EventReminder::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhere('location', 'like', '%' . $request->search . '%');
        }

        $events = $query->paginate(10);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_time' => 'required|date',
            'location' => 'nullable|string',
            'attendees' => 'nullable|string',
        ]);

        $event = EventReminder::create($request->all());
        $this->sendReminderEmail($event);

        return redirect()->route('events.index')->with('success', 'Event created successfully.');
    }

    public function edit(EventReminder $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, EventReminder $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'event_time' => 'required|date',
            'location' => 'nullable|string',
            'attendees' => 'nullable|string',
        ]);

        $event->update($request->all());

        if ($event->wasChanged('event_time')) {
            $this->sendReminderEmail($event);
        }

        return redirect()->route('events.index')->with('success', 'Event updated successfully.');
    }

    public function destroy(EventReminder $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event deleted successfully.');
    }

    public function import(Request $request)
    {
        $request->validate(['file' => 'required|mimes:csv,txt']);
        Excel::import(new EventRemindersImport, $request->file('file'));
        return redirect()->route('events.index')->with('success', 'Events imported successfully.');
    }

    public function export()
    {
        return Excel::download(new EventRemindersExport, 'event_reminders.csv');
    }

    public function markAsComplete(EventReminder $event)
    {
        $event->update(['completed' => true]);
        return redirect()->route('events.index')->with('success', 'Event marked as complete.');
    }

    private function sendReminderEmail($event)
    {
        if ($event->attendees) {
            $emails = explode(',', $event->attendees);
            foreach ($emails as $email) {
                Mail::to(trim($email))->send(new EventReminderMail($event));
            }
        }
    }
}
