<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')->latest()->paginate(10);
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
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

        return redirect()->route('admin.events.index')->with('success', 'Event created successfully!');
    }

    public function show($id)
    {
        $event = Event::with('user', 'registrations.user')->findOrFail($id);
        return view('admin.events.show', compact('event'));
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

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

        return redirect()->route('admin.events.show', $event->id)->with('success', 'Event updated successfully');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        return redirect()->route('admin.events.index')->with('success', 'Event deleted successfully');
    }
}