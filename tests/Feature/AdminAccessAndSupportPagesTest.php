<?php

namespace Tests\Feature;

use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminAccessAndSupportPagesTest extends TestCase
{
    use RefreshDatabase;

    public function test_help_center_terms_and_privacy_pages_are_accessible(): void
    {
        $this->get(route('help-center'))
            ->assertOk()
            ->assertSee('Help Center');

        $this->get(route('terms.show'))
            ->assertOk()
            ->assertSee('Campus Rental Terms of Use');

        $this->get(route('policy.show'))
            ->assertOk()
            ->assertSee('Campus Rental Privacy Policy');
    }

    public function test_non_admin_user_cannot_access_admin_dashboard(): void
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
            'is_admin' => false,
        ]);

        $this->actingAs($user)
            ->get(route('admin.dashboard'))
            ->assertForbidden();
    }

    public function test_admin_can_access_admin_dashboard_and_view_metrics(): void
    {
        $admin = User::factory()->admin()->create([
            'email_verified_at' => now(),
        ]);
        $renter = User::factory()->create();
        $item = Item::query()->create([
            'user_id' => $admin->id,
            'name' => 'Projector',
            'description' => 'HD projector',
            'condition' => 'Good',
            'price' => 150,
            'status' => 'available',
        ]);
        Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $renter->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(2),
            'total_price' => 300,
            'paid_amount' => 0,
            'payment_status' => Rental::PAYMENT_STATUS_OUTSTANDING,
            'status' => Rental::STATUS_PENDING,
        ]);

        $this->actingAs($admin)
            ->get(route('admin.dashboard'))
            ->assertOk()
            ->assertSee('Admin Dashboard')
            ->assertSee('Total Users')
            ->assertSee('Total Items')
            ->assertSee('Pending Requests');
    }
}
