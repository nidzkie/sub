<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Livewire\Component;

class AdminDashboard extends Component
{
    /**
     * @return array<string, mixed>
     */
    public function render()
    {
        $totalUsers = User::query()->count();
        $verifiedStudents = User::query()->where('is_verified_student', true)->count();
        $totalItems = Item::query()->count();
        $availableItems = Item::query()->available()->count();
        $totalRentals = Rental::query()->count();
        $activeRentals = Rental::query()->where('status', Rental::STATUS_ACTIVE)->count();
        $pendingRentals = Rental::query()->where('status', Rental::STATUS_PENDING)->count();

        return view('livewire.admin-dashboard', [
            'totalUsers' => $totalUsers,
            'verifiedStudents' => $verifiedStudents,
            'totalItems' => $totalItems,
            'availableItems' => $availableItems,
            'totalRentals' => $totalRentals,
            'activeRentals' => $activeRentals,
            'pendingRentals' => $pendingRentals,
        ]);
    }
}
