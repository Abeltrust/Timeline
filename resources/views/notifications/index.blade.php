@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
    <!-- HEADER -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3 mb-4">
        <h1 class="text-lg sm:text-xl font-bold text-gray-800">Notifications</h1>
        <button onclick="markAllAsRead()" 
            class="text-sm sm:text-base text-amber-500 hover:underline">
            Mark all as read
        </button>
    </div>

    <!-- FILTER TABS -->
    <div class="flex flex-wrap gap-2 sm:gap-3 mb-6">
        @php
            $filters = [
                'all' => 'All',
                'unread' => 'Unread',
                'tap' => 'TAPs',
                'lock-in' => 'Lock-Ins',
                'resonance' => 'Resonance'
            ];
        @endphp

        @foreach($filters as $key => $label)
            <a href="{{ route('notifications.index', ['filter' => $key]) }}"
                class="px-3 sm:px-4 py-1.5 rounded-full text-xs sm:text-sm font-medium 
                {{ $filter === $key ? 'bg-amber-500 text-white' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>

    <!-- NOTIFICATION LIST -->
    <div class="space-y-3">
        @forelse($notifications as $notification)
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-3 p-4 bg-white rounded-xl border shadow-sm hover:bg-gray-50 transition">
                
                <!-- LEFT SIDE -->
                <div class="flex items-start gap-3">
                    <!-- AVATAR / ICON -->
                    <div class="w-10 h-10 rounded-full flex items-center justify-center shrink-0
                        {{ $notification->read ? 'bg-gray-200 text-gray-500' : 'bg-amber-500 text-amber-600' }}">
                        <span class="font-bold text-sm">
                            {{ strtoupper(substr($notification->fromUser->name ?? 'N/A', 0, 2)) }}
                        </span>
                    </div>

                    <!-- MESSAGE -->
                    <div>
                        <p class="text-sm sm:text-base text-gray-800">
                            {!! $notification->message !!}
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $notification->created_at->diffForHumans() }}
                        </p>
                    </div>
                </div>

                <!-- ACTIONS -->
                <div class="flex flex-row sm:flex-col items-center sm:items-end gap-2">
                    @if(!$notification->read)
                        <button onclick="markAsRead('{{ $notification->id }}')" 
                            class="text-xs text-amber-500 hover:underline">
                            Mark as read
                        </button>
                    @endif
                    <button onclick="deleteNotification('{{ $notification->id }}')" 
                        class="text-xs text-red-500 hover:underline">
                        Dismiss
                    </button>
                </div>
            </div>
        @empty
            <p class="text-gray-500 text-center">No notifications found.</p>
        @endforelse
    </div>

    <!-- PAGINATION -->
    <div class="mt-6">
        {{ $notifications->links() }}
    </div>
</div>

<script>
    function markAsRead(id) {
        fetch(`/notifications/${id}/read`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(() => location.reload());
    }

    function markAllAsRead() {
        fetch(`/notifications/read-all`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(() => location.reload());
    }

    function deleteNotification(id) {
        fetch(`/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            }
        }).then(() => location.reload());
    }
</script>
@endsection
