@extends('layouts.header')

@section('title', 'Notifications')

<style>
    .notification-container {
        background: #f9f9f9;
        border-radius: 12px;
        padding: 30px;
        max-width: 1200px;
        margin: 30px auto;
    }

    .notification-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 20px;
        margin-bottom: 25px;
    }

    .notification-header h2 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #2c3e50;
        display: flex;
        align-items: center;
    }

    .notification-header h2 i {
        margin-right: 10px;
        color: #4e73df;
    }

    .mark-all-btn {
        background-color: #4e73df;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
    }

    .mark-all-btn i {
        margin-right: 8px;
    }

    .mark-all-btn:hover {
        background-color: #3a5bc7;
        transform: translateY(-2px);
    }

    .notification-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .notification-card {
        background-color: white;
        border-radius: 10px;
        padding: 20px 25px;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        border-left: 5px solid transparent;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .notification-card.unread {
        background-color: #f0f5ff;
        border-left-color: #4e73df;
    }

    .notification-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .notification-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #34495e;
        display: flex;
        align-items: center;
        margin-bottom: 8px;
    }

    .notification-title i {
        margin-right: 8px;
        color: #4e73df;
    }

    .badge-unread {
        background-color: #4e73df;
        color: white;
        font-size: 0.7rem;
        padding: 3px 8px;
        border-radius: 12px;
        margin-left: 10px;
    }

    .notification-desc {
        font-size: 0.95rem;
        color: #5a6a7e;
        margin-bottom: 12px;
        line-height: 1.5;
    }

    .notification-meta {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        color: #95a5a6;
    }

    .mark-as-read {
        color: #4e73df;
        font-weight: 500;
        transition: 0.2s;
    }

    .mark-as-read:hover {
        text-decoration: underline;
        color: #3a5bc7;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #7f8c8d;
    }

    .empty-state i {
        font-size: 65px;
        margin-bottom: 20px;
        color: #bdc3c7;
    }

    .pagination {
        justify-content: center;
        margin-top: 30px;
    }

    .page-item.active .page-link {
        background-color: #4e73df;
        border-color: #4e73df;
    }

    .page-link {
        color: #4e73df;
    }
</style>

@section('content')
    <div class="notification-container">
        <div class="notification-header">
            <h2><i class="fas fa-bell"></i>Notifications</h2>
            @if (!$notifications->isEmpty())
                <button class="mark-all-btn" id="markAllAsRead">
                    <i class="fas fa-check-circle"></i> Mark All as Read
                </button>
            @endif
        </div>

        @if ($notifications->isEmpty())
            <div class="empty-state">
                <i class="far fa-bell-slash"></i>
                <h4>No notifications yet</h4>
                <p>When you receive notifications, they’ll appear here.</p>
            </div>
        @else
            <div class="notification-list">
                @foreach ($notifications as $notification)
                    <div class="notification-card {{ $notification->seen_by_user ? '' : 'unread' }}"
                        data-id="{{ $notification->id }}">
                        <div class="notification-title">
                            <i class="fas fa-{{ $notification->seen_by_user ? 'envelope-open' : 'envelope' }}"></i>
                            {{ $notification->title }}
                            @if (!$notification->seen_by_user)
                                <span class="badge-unread">New</span>
                            @endif
                        </div>
                        <div class="notification-desc">
                            {{ $notification->description }}
                        </div>
                        <div class="notification-meta">
                            <span><i class="far fa-clock mr-1"></i> {{ $notification->created_at->diffForHumans() }}</span>
                            @if (!$notification->seen_by_user)
                                <a href="" class="mark-as-read" data-id="{{ $notification->id }}">
                                    <i class="fas fa-check mr-1"></i>Mark as read
                                </a>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-4">
                {{ $notifications->links() }}
            </div>
        @endif
    </div>



@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Mark as read (single)
            $('.mark-as-read').click(function(e) {
                e.preventDefault();
                let id = $(this).data('id');
                let card = $(this).closest('.notification-card');

                $.post(`/notifications/mark-as-read/${id}`, {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    card.removeClass('unread');
                    card.find('.badge-unread').remove();
                    card.find('.mark-as-read').remove();
                    card.find('.fa-envelope').removeClass('fa-envelope').addClass(
                        'fa-envelope-open');
                    updateNotificationCount();
                });
            });

            // Mark all as read
            $('#markAllAsRead').click(function() {
                $.post('/notifications/mark-all-read', {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    $('.notification-card').each(function() {
                        $(this).removeClass('unread');
                        $(this).find('.badge-unread').remove();
                        $(this).find('.mark-as-read').remove();
                        $(this).find('.fa-envelope').removeClass('fa-envelope').addClass(
                            'fa-envelope-open');
                    });
                    updateNotificationCount();
                });
            });

            // Make the full card clickable
            $('.notification-card').click(function(e) {
                if ($(e.target).is('a') || $(e.target).parents('a').length > 0) return;

                let card = $(this);
                let id = card.data('id');

                if (!card.hasClass('unread')) return;

                $.post(`/notifications/mark-as-read/${id}`, {
                    _token: '{{ csrf_token() }}'
                }, function() {
                    card.removeClass('unread');
                    card.find('.badge-unread').remove();
                    card.find('.mark-as-read').remove();
                    card.find('.fa-envelope').removeClass('fa-envelope').addClass(
                        'fa-envelope-open');
                    updateNotificationCount();
                });
            });

            // Update notification count
            function updateNotificationCount() {
                $.get('/notifications/unread-count', function(data) {
                    $('#notification-count').text(data.count);
                    $('#notification-header').text(
                        data.count > 0 ?
                        `You have ${data.count} new notifications` :
                        `No new notifications`
                    );
                });
            }
        });
    </script>
@endsection

