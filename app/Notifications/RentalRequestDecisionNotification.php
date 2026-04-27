<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class RentalRequestDecisionNotification extends Notification
{
    use Queueable;

    public function __construct(
        public int $rentalId,
        public int $itemId,
        public string $itemName,
        public string $decision
    ) {}

    public function via(object $notifiable): array
    {
        return ['database'];
    }

    public function toArray(object $notifiable): array
    {
        $decisionLabel = $this->decision === 'approved' ? 'approved' : 'rejected';

        return [
            'title' => 'Rental request update',
            'message' => "Your request for {$this->itemName} was {$decisionLabel}.",
            'item_id' => $this->itemId,
            'item_name' => $this->itemName,
            'rental_id' => $this->rentalId,
            'decision' => $this->decision,
            'url' => route('my-rentals'),
        ];
    }
}
