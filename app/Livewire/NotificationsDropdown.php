<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsDropdown extends Component
{
    public function markAsRead(string $notificationId): void
    {
        abort_unless(Auth::check(), 403);

        $notification = Auth::user()->notifications()->find($notificationId);

        if ($notification && is_null($notification->read_at)) {
            $notification->markAsRead();
        }
    }

    public function markAllAsRead(): void
    {
        abort_unless(Auth::check(), 403);

        Auth::user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        abort_unless(Auth::check(), 403);

        $notifications = Auth::user()
            ->notifications()
            ->latest()
            ->limit(8)
            ->get();

        return view('livewire.notifications-dropdown', [
            'notifications' => $notifications,
            'unreadCount' => Auth::user()->unreadNotifications()->count(),
        ]);
    }
}
