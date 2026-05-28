@extends('layouts.admin')

@section('content')
<div>
    <!-- Page Header with Create Button -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Manage Events</h1>
            <p class="text-gray-500 mt-1">View and manage all alumni events</p>
        </div>
        <a href="{{ route('admin.events.create') }}" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-5 py-2 rounded-full transition shadow-sm flex items-center gap-2 font-semibold">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
            </svg>
            Create Event
        </a>
    </div>

    <!-- Events Table -->
    <div class="bg-white rounded-2xl shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gradient-to-r from-[#1a3c5e] to-[#2d5a7b] text-white">
                    <tr>
                        <th class="px-6 py-4 text-left">Title</th>
                        <th class="px-6 py-4 text-left">Host</th>
                        <th class="px-6 py-4 text-left">Date & Time</th>
                        <th class="px-6 py-4 text-left">Location</th>
                        <th class="px-6 py-4 text-left">Attendees</th>
                        <th class="px-6 py-4 text-left">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4 font-medium">{{ $event->title }}</td>
                        <td class="px-6 py-4">{{ $event->user->name }}</td>
                        <td class="px-6 py-4">{{ $event->event_date->format('M d, Y g:i A') }}</td>
                        <td class="px-6 py-4">{{ $event->location }}</td>
                        <td class="px-6 py-4">{{ $event->registrations->count() }}/{{ $event->max_attendees ?? '∞' }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2">
                                <a href="{{ route('admin.events.show', $event->id) }}" class="bg-[#f5a623] hover:bg-[#f4b84a] text-[#1a3c5e] px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </a>
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="bg-[#1a3c5e] hover:bg-[#2d5a7b] text-white px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    
                                </a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline" onsubmit="return confirm('Delete this event?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="bg-[#dc2626] hover:bg-[#ef4444] text-white px-3 py-1.5 rounded-xl transition flex items-center gap-1 text-sm">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-12 text-gray-500">
                            <svg class="w-16 h-16 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p>No events found</p>
                            <p class="text-sm mt-1">Click "Create Event" to add your first event.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-4 border-t">
            {{ $events->links() }}
        </div>
    </div>
</div>
@endsection