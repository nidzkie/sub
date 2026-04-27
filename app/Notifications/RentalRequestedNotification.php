<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RentalRequestedNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $itemId,
        public string $itemName,
        public int $renterId,
        public string $renterName,
        public string $startDate,
        public string $endDate,
        public float $totalPrice,
        public int $rentalId,
        public string $additionalNotes = ''
    ) {}

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'title' => 'New rental request',
            'message' => "{$this->renterName} requested to rent {$this->itemName}.",
            'item_id' => $this->itemId,
            'item_name' => $this->itemName,
            'renter_id' => $this->renterId,
            'renter_name' => $this->renterName,
            'rental_id' => $this->rentalId,
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_price' => $this->totalPrice,
            'additional_notes' => $this->additionalNotes,
            'url' => route('rental-requests.show', $this->rentalId),
        ];
    }
}
