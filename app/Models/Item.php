<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Item extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'price', 'condition', 'status', 'category', 'category_id', 'image_path'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }

    public function latestRental(): HasOne
    {
        return $this->hasOne(Rental::class)->latestOfMany();
    }

    public function categoryRecord()
    {
        return $this->belongsTo(Category::class);
    }
}
