@extends('layouts.alumni')

@section('content')
<div>
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Upcoming Events</h1>
        <p class="text-gray-500 mt-1">Connect with fellow alumni at reunions, parties, and seminars</p>
    </div>

    <div class="flex justify-end mb-6">
        <a href="{{ route('alumni.events.create') }}" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-5 py-2 rounded-full transition font-semibold flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Event
        </a>
    </div>

    <div class="space-y-4">
        @forelse($events as $event)
        <div class="bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition">
            <div class="p-5">
                <div class="flex justify-between items-start">
                    <div>
                        <div class="flex items-center gap-2 mb-2">
                            <span class="text-2xl">
                                @switch($event->event_type)
                                    @case('reunion') 🎓 @break
                                    @case('homecoming') 🏠 @break
                                    @case('seminar') 📚 @break
                                    @case('party') 🎉 @break
                                    @case('webinar') 💻 @break
                                    @default 📅
                                @endswitch
                            </span>
                            <h3 class="text-xl font-bold text-gray-800">{{ $event->title }}</h3>
                        </div>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600 mb-3">
                            <span class="flex items-center gap-1">📅 {{ $event->event_date->format('F j, Y g:i A') }}</span>
                            <span class="flex items-center gap-1">📍 {{ $event->location }}</span>
                            <span class="flex items-center gap-1">👥 {{ $event->registrations->count() }}/{{ $event->max_attendees ?? '∞' }}</span>
                        </div>
                        <p class="text-gray-600">{{ Str::limit($event->description, 100) }}</p>
                    </div>
                    <a href="{{ route('alumni.events.show', $event->id) }}" class="text-[#f5a623] hover:text-[#f4b84a] font-medium">View →</a>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl shadow-md p-12 text-center">
            <p class="text-gray-500">No events yet. Be the first to create one!</p>
        </div>
        @endforelse
    </div>

    {{ $events->links() }}
</div>
@endsection