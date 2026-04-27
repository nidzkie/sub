<?php

namespace App\Livewire;

use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NotificationsDropdown extends Component
{
    public function openNotification(string $notificationId): mixed
    {
        abort_unless(Auth::check(), 403);

        $notification = Auth::user()->notifications()->find($notificationId);

        if (! $notification) {
            return redirect()->route('my-listings');
        }

        $notificationData = $notification->data;
        $notification->delete();

        $rentalId = $notificationData['rental_id'] ?? $this->resolveRentalIdFromNotificationData($notificationData);

        if ($rentalId) {
            return redirect()->route('rental-requests.show', $rentalId);
        }

        $url = $notificationData['url'] ?? null;

        if (! $url && isset($notificationData['item_id'])) {
            $url = route('item.view', $notificationData['item_id']);
        }

        return redirect()->to($url ?? route('my-listings'));
    }

    /**
     * @param  array<string, mixed>  $notificationData
     */
    private function resolveRentalIdFromNotificationData(array $notificationData): ?int
    {
        if (! isset($notificationData['item_id'])) {
            return null;
        }

        $query = Rental::query()
            ->where('item_id', (int) $notificationData['item_id'])
            ->whereHas('item', fn ($itemQuery) => $itemQuery->where('user_id', Auth::id()));

        if (isset($notificationData['renter_id'])) {
            $query->where('renter_id', (int) $notificationData['renter_id']);
        }

        $rental = $query->latest('id')->first();

        return $rental?->id;
    }

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
