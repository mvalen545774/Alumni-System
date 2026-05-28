<?php

namespace App\Http\Controllers\Alumni;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventRegistration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')->latest()->paginate(10);
        return view('alumni.events.index', compact('events'));
    }

    public function create()
    {
        return view('alumni.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date|after:now',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:reunion,homecoming,seminar,party,webinar,other',
            'venue_type' => 'required|in:in-person,virtual,hybrid',
            'max_attendees' => 'nullable|integer|min:1',
            'contact_email' => 'nullable|email',
        ]);

        Event::create([
            'user_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'event_type' => $request->event_type,
            'venue_type' => $request->venue_type,
            'max_attendees' => $request->max_attendees,
            'contact_email' => $request->contact_email,
        ]);

        return redirect()->route('alumni.events.index')->with('success', 'Event created successfully!');
    }

    public function show($id)
    {
        $event = Event::with('user', 'registrations.user')->findOrFail($id);
        $isRegistered = EventRegistration::where('event_id', $id)
                                         ->where('user_id', auth()->id())
                                         ->exists();
        return view('alumni.events.show', compact('event', 'isRegistered'));
    }

    public function edit($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        return view('alumni.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'event_type' => 'required|in:reunion,homecoming,seminar,party,webinar,other',
            'venue_type' => 'required|in:in-person,virtual,hybrid',
            'max_attendees' => 'nullable|integer|min:1',
            'contact_email' => 'nullable|email',
        ]);

        $event->update($request->all());

        return redirect()->route('alumni.events.show', $event->id)->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::where('user_id', auth()->id())->findOrFail($id);
        $event->delete();

        return redirect()->route('alumni.events.index')->with('success', 'Event deleted successfully');
    }

    // RSVP / Registration methods
    public function register($id)
    {
        $event = Event::findOrFail($id);

        // Check if already registered
        if (EventRegistration::where('event_id', $id)->where('user_id', auth()->id())->exists()) {
            return redirect()->back()->with('error', 'You have already registered for this event.');
        }

        // Check capacity
        if ($event->max_attendees && $event->registrations()->count() >= $event->max_attendees) {
            return redirect()->back()->with('error', 'Sorry, this event is full.');
        }

        EventRegistration::create([
            'event_id' => $id,
            'user_id' => auth()->id(),
            'status' => 'registered',
        ]);

        return redirect()->back()->with('success', 'You have successfully registered for the event!');
    }

    public function cancelRegistration($id)
    {
        $registration = EventRegistration::where('event_id', $id)
                                        ->where('user_id', auth()->id())
                                        ->firstOrFail();
        $registration->delete();

        return redirect()->back()->with('success', 'Your registration has been cancelled.');
    }
}