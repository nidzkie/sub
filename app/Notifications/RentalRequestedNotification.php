<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

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
            'encrypted_item_id' => Crypt::encryptString((string) $this->itemId),
            'item_name' => $this->itemName,
            'encrypted_renter_id' => Crypt::encryptString((string) $this->renterId),
            'renter_name' => $this->renterName,
            'encrypted_rental_id' => Crypt::encryptString((string) $this->rentalId),
            'start_date' => $this->startDate,
            'end_date' => $this->endDate,
            'total_price' => $this->totalPrice,
            'additional_notes' => $this->additionalNotes,
        ];
    }
}
