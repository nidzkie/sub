<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = ['item_id', 'renter_id', 'start_date', 'end_date', 'total_price', 'payment_status', 'status'];

    protected function casts(): array
    {
        return [
            'start_date' => 'datetime',
            'end_date' => 'datetime',
            'total_price' => 'decimal:2',
        ];
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function renter()
    {
        return $this->belongsTo(User::class, 'renter_id');
    }
}
