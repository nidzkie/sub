<?php

namespace Tests\Feature;

use App\Livewire\NotificationsDropdown;
use App\Models\Category;
use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Livewire\Livewire;
use Tests\TestCase;

class NotificationsDropdownTest extends TestCase
{
    use RefreshDatabase;

    public function test_open_notification_redirects_to_owner_rental_request_view_and_deletes_it(): void
    {
        $owner = User::factory()->create();
        $renter = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Portable Speaker',
            'description' => 'Bluetooth speaker',
            'price' => 50,
            'status' => 'available',
            'category' => 'electronics',
            'category_id' => $category->id,
        ]);

        $rental = Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $renter->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(2),
            'total_price' => 100,
            'paid_amount' => 0,
            'payment_status' => 'outstanding',
            'status' => 'pending',
        ]);

        $notification = $owner->notifications()->create([
            'id' => (string) Str::uuid(),
            'type' => 'App\\Notifications\\RentalRequestedNotification',
            'data' => [
                'title' => 'New rental request',
                'message' => 'Test message',
                'rental_id' => $rental->id,
            ],
        ]);

        $this->actingAs($owner);

        Livewire::test(NotificationsDropdown::class)
            ->call('openNotification', $notification->id)
            ->assertRedirect(route('rental-requests.show', $rental));

        $this->assertDatabaseMissing('notifications', ['id' => $notification->id]);
    }

    public function test_open_notification_without_rental_id_resolves_owner_rental_request_view(): void
    {
        $owner = User::factory()->create();
        $renter = User::factory()->create();
        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Portable Speaker',
            'description' => 'Bluetooth speaker',
            'price' => 50,
            'status' => 'available',
            'category' => 'electronics',
            'category_id' => $category->id,
        ]);

        $rental = Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $renter->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(2),
            'total_price' => 100,
            'paid_amount' => 0,
            'payment_status' => 'outstanding',
            'status' => 'pending',
        ]);

        $notification = $owner->notifications()->create([
            'id' => (string) Str::uuid(),
            'type' => 'App\\Notifications\\RentalRequestedNotification',
            'data' => [
                'title' => 'New rental request',
                'message' => 'Test message',
                'item_id' => $item->id,
                'renter_id' => $renter->id,
            ],
        ]);

        $this->actingAs($owner);

        Livewire::test(NotificationsDropdown::class)
            ->call('openNotification', $notification->id)
            ->assertRedirect(route('rental-requests.show', $rental));
    }
}
