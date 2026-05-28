@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.events.index') }}" class="text-blue-600">← Back to Events</a>
    </div>

    <div class="bg-white rounded-2xl shadow-md p-6">
        <h1 class="text-2xl font-bold mb-6">Create New Event</h1>

        <!-- IMPORTANT: use the admin route -->
        <form action="{{ route('admin.events.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block font-semibold mb-1">Event Title <span class="text-red-500">*</span></label>
                <input type="text" name="title" required class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="mb-4">
                <label class="block font-semibold mb-1">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="4" required class="w-full border rounded-xl px-4 py-2"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold mb-1">Event Date & Time <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="event_date" required class="w-full border rounded-xl px-4 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" required class="w-full border rounded-xl px-4 py-2">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold mb-1">Event Type</label>
                    <select name="event_type" class="w-full border rounded-xl px-4 py-2">
                        <option value="reunion">Reunion</option>
                        <option value="homecoming">Homecoming</option>
                        <option value="seminar">Seminar</option>
                        <option value="party">Party</option>
                        <option value="webinar">Webinar</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                <div>
                    <label class="block font-semibold mb-1">Venue Type</label>
                    <select name="venue_type" class="w-full border rounded-xl px-4 py-2">
                        <option value="in-person">In-person</option>
                        <option value="virtual">Virtual</option>
                        <option value="hybrid">Hybrid</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block font-semibold mb-1">Max Attendees (optional)</label>
                    <input type="number" name="max_attendees" class="w-full border rounded-xl px-4 py-2">
                </div>
                <div>
                    <label class="block font-semibold mb-1">Contact Email (optional)</label>
                    <input type="email" name="contact_email" class="w-full border rounded-xl px-4 py-2" placeholder="for inquiries">
                </div>
            </div>

            <div class="flex justify-end gap-3 mt-6">
                <a href="{{ route('admin.events.index') }}" class="px-4 py-2 bg-gray-300 rounded-xl">Cancel</a>
                <button type="submit" class="px-4 py-2 bg-[#f5a623] text-[#1a3c5e] rounded-xl font-semibold">Create Event</button>
            </div>
        </form>
    </div>
</div>
@endsection