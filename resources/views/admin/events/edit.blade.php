@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Edit Event</h1>
        <p class="text-gray-500 mt-1">Update event details</p>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="bg-[#f5a623] rounded-lg p-1">
                    <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Edit Event</h2>
            </div>
            <p class="text-blue-100 text-sm mt-1 ml-8">Update the event information below</p>
        </div>

        <form action="{{ route('admin.events.update', $event->id) }}" method="POST" class="p-6">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Event Title <span class="text-red-500">*</span></label>
                    <input type="text" name="title" required value="{{ old('title', $event->title) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Location <span class="text-red-500">*</span></label>
                    <input type="text" name="location" required value="{{ old('location', $event->location) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Event Date & Time <span class="text-red-500">*</span></label>
                    <input type="datetime-local" name="event_date" required value="{{ old('event_date', $event->event_date->format('Y-m-d\TH:i')) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Event Type</label>
                    <select name="event_type" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="reunion" {{ $event->event_type == 'reunion' ? 'selected' : '' }}>🎓 Reunion</option>
                        <option value="homecoming" {{ $event->event_type == 'homecoming' ? 'selected' : '' }}>🏠 Homecoming</option>
                        <option value="seminar" {{ $event->event_type == 'seminar' ? 'selected' : '' }}>📚 Seminar</option>
                        <option value="party" {{ $event->event_type == 'party' ? 'selected' : '' }}>🎉 Party</option>
                        <option value="webinar" {{ $event->event_type == 'webinar' ? 'selected' : '' }}>💻 Webinar</option>
                        <option value="other" {{ $event->event_type == 'other' ? 'selected' : '' }}>📅 Other</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Venue Type</label>
                    <select name="venue_type" class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                        <option value="in-person" {{ $event->venue_type == 'in-person' ? 'selected' : '' }}>🏢 In-person</option>
                        <option value="virtual" {{ $event->venue_type == 'virtual' ? 'selected' : '' }}>💻 Virtual</option>
                        <option value="hybrid" {{ $event->venue_type == 'hybrid' ? 'selected' : '' }}>🔄 Hybrid</option>
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Max Attendees (optional)</label>
                    <input type="number" name="max_attendees" value="{{ old('max_attendees', $event->max_attendees) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">
                </div>

                <div>
                    <label class="block text-gray-700 font-semibold mb-2">Contact Email (optional)</label>
                    <input type="email" name="contact_email" value="{{ old('contact_email', $event->contact_email) }}" 
                        class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent"
                        placeholder="for inquiries">
                </div>
            </div>

            <div class="mt-6">
                <label class="block text-gray-700 font-semibold mb-2">Description <span class="text-red-500">*</span></label>
                <textarea name="description" rows="6" required 
                    class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-[#f5a623] focus:border-transparent">{{ old('description', $event->description) }}</textarea>
                <p class="text-xs text-gray-400 mt-1">Describe what the event is about, schedule, etc.</p>
            </div>

            <div class="flex justify-end gap-3 mt-8 pt-4 border-t border-gray-200">
                <a href="{{ route('admin.events.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Cancel</a>
                <button type="submit" class="px-5 py-2 bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] rounded-xl transition font-semibold flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
                    </svg>
                    Update Event
                </button>
            </div>
        </form>
    </div>
</div>
@endsection