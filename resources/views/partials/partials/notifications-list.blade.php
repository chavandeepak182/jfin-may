@forelse($notifications as $notification)
<a href="{{ $notification->url ?? '#' }}"
   class="list-group-item list-group-item-action {{ $notification->seen_by_user ? '' : 'unread-notification' }}"
   data-id="{{ $notification->id }}">
    <div class="text-dark fw-bold">{{ $notification->title }}</div>
    <div class="text-muted small">{{ $notification->description }}</div>
    <div class="text-muted small">{{ $notification->created_at->diffForHumans() }}</div>
</a>
@empty
<div class="text-center text-muted py-2">No notifications</div>
@endforelse
