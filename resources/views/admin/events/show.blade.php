@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header -->
    <div class="mb-8">
        <div class="flex items-center gap-3">
            <div class="w-12 h-12 bg-[#f5a623] rounded-2xl flex items-center justify-center">
                <svg class="w-6 h-6 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-gray-800">{{ $event->title }}</h1>
                <p class="text-gray-500 mt-1">Hosted by {{ $event->user->name }}</p>
            </div>
        </div>
    </div>

    <!-- Event Details Card -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] px-6 py-4">
            <div class="flex items-center gap-2">
                <div class="bg-[#f5a623] rounded-lg p-1">
                    <svg class="w-5 h-5 text-[#1a3c5e]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-white">Event Details</h2>
            </div>
        </div>

        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">Event Information</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Title:</div>
                            <div class="text-gray-800">{{ $event->title }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Type:</div>
                            <div class="text-gray-800">
                                @switch($event->event_type)
                                    @case('reunion') 🎓 Reunion @break
                                    @case('homecoming') 🏠 Homecoming @break
                                    @case('seminar') 📚 Seminar @break
                                    @case('party') 🎉 Party @break
                                    @case('webinar') 💻 Webinar @break
                                    @default 📅 Other
                                @endswitch
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Venue:</div>
                            <div class="text-gray-800">
                                @switch($event->venue_type)
                                    @case('in-person') 🏢 In-person @break
                                    @case('virtual') 💻 Virtual @break
                                    @case('hybrid') 🔄 Hybrid @break
                                @endswitch
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Location:</div>
                            <div class="text-gray-800">{{ $event->location }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Date & Time:</div>
                            <div class="text-gray-800">{{ $event->event_date->format('F d, Y g:i A') }}</div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">Registration Info</h3>
                    <div class="space-y-3">
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Attendees:</div>
                            <div class="text-gray-800">{{ $event->registrations->count() }} / {{ $event->max_attendees ?? 'Unlimited' }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Contact Email:</div>
                            <div class="text-gray-800">
                                @if($event->contact_email)
                                    <a href="mailto:{{ $event->contact_email }}" class="text-blue-600 hover:underline">{{ $event->contact_email }}</a>
                                @else
                                    <span class="text-gray-400">Not provided</span>
                                @endif
                            </div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Created:</div>
                            <div class="text-gray-800">{{ $event->created_at->format('F d, Y') }}</div>
                        </div>
                        <div class="flex">
                            <div class="w-32 text-gray-500 font-medium">Last Updated:</div>
                            <div class="text-gray-800">{{ $event->updated_at->format('F d, Y') }}</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">Description</h3>
                <div class="text-gray-700 whitespace-pre-wrap leading-relaxed bg-gray-50 p-4 rounded-xl">
                    {{ $event->description }}
                </div>
            </div>

            <!-- Attendees List -->
            @if($event->registrations->count() > 0)
            <div class="mt-6">
                <h3 class="text-lg font-semibold text-gray-800 border-b-2 border-gray-200 pb-2 mb-4">Registered Attendees ({{ $event->registrations->count() }})</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($event->registrations as $reg)
                        <span class="bg-gray-100 rounded-full px-3 py-1.5 text-sm text-gray-700">
                            👤 {{ $reg->user->name }}
                        </span>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- Action Buttons -->
            <div class="mt-8 pt-4 border-t border-gray-200 flex justify-end gap-3">
                <a href="{{ route('admin.events.edit', $event->id) }}" class="px-5 py-2 bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white rounded-xl transition flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Edit Event
                </a>
                <a href="{{ route('admin.events.index') }}" class="px-5 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-xl transition">Close</a>
            </div>
        </div>
    </div>
</div>
@endsection