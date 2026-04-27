<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rental extends Model
{
    protected $fillable = [
        'item_id',
        'renter_id',
        'start_date',
        'end_date',
        'total_price',
        'paid_amount',
        'payment_status',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'total_price' => 'decimal:2',
            'paid_amount' => 'decimal:2',
        ];
    }

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }

    public function renter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'renter_id');
    }

    public function applyPayment(float $paymentAmount): void
    {
        $currentPaidAmount = (float) ($this->paid_amount ?? 0);
        $nextPaidAmount = min((float) $this->total_price, $currentPaidAmount + $paymentAmount);

        $paymentStatus = 'outstanding';

        if ($nextPaidAmount >= (float) $this->total_price) {
            $paymentStatus = 'fully_paid';
        } elseif ($nextPaidAmount > 0) {
            $paymentStatus = 'partial';
        }

        $this->update([
            'paid_amount' => $nextPaidAmount,
            'payment_status' => $paymentStatus,
        ]);
    }
}
