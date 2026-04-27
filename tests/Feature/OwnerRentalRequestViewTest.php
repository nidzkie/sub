<?php

namespace Tests\Feature;

use App\Livewire\OwnerRentalRequestView;
use App\Models\Category;
use App\Models\Item;
use App\Models\Rental;
use App\Models\User;
use App\Notifications\RentalRequestDecisionNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class OwnerRentalRequestViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_view_request_details_and_grant_request(): void
    {
        Notification::fake();

        [$owner, $borrower, $rental] = $this->createRentalRequest();
        $this->actingAs($owner);

        Livewire::test(OwnerRentalRequestView::class, ['rental' => $rental])
            ->assertSee('View Request')
            ->assertSee($borrower->name)
            ->assertSee($borrower->email)
            ->call('grantRequest')
            ->assertSee('Rental request granted.');

        $rental->refresh();

        $this->assertSame('approved', $rental->status);

        Notification::assertSentTo(
            [$borrower],
            RentalRequestDecisionNotification::class,
            function (RentalRequestDecisionNotification $notification) use ($rental): bool {
                return $notification->rentalId === $rental->id
                    && $notification->decision === 'approved';
            }
        );
    }

    public function test_owner_can_reject_request(): void
    {
        Notification::fake();

        [$owner, $borrower, $rental] = $this->createRentalRequest();
        $this->actingAs($owner);

        Livewire::test(OwnerRentalRequestView::class, ['rental' => $rental])
            ->call('rejectRequest')
            ->assertSee('Rental request rejected.');

        $rental->refresh();

        $this->assertSame('cancelled', $rental->status);

        Notification::assertSentTo(
            [$borrower],
            RentalRequestDecisionNotification::class,
            function (RentalRequestDecisionNotification $notification) use ($rental): bool {
                return $notification->rentalId === $rental->id
                    && $notification->decision === 'rejected';
            }
        );
    }

    public function test_non_owner_cannot_open_owner_request_view(): void
    {
        [$owner, $borrower, $rental] = $this->createRentalRequest();
        $this->actingAs($borrower);

        $this->get(route('rental-requests.show', $rental))
            ->assertForbidden();
    }

    public function test_due_tomorrow_alert_is_visible_for_active_rental_with_one_day_left(): void
    {
        [$owner, $borrower, $rental] = $this->createRentalRequest();
        $this->actingAs($owner);

        $rental->update([
            'status' => 'active',
            'start_date' => now()->subDay(),
            'end_date' => now()->addDay(),
        ]);

        Livewire::test(OwnerRentalRequestView::class, ['rental' => $rental->fresh()])
            ->assertSee('Due soon:')
            ->assertSee('This rental is due in 1 day.');
    }

    /**
     * @return array{0: User, 1: User, 2: Rental}
     */
    private function createRentalRequest(): array
    {
        $owner = User::factory()->create();
        $borrower = User::factory()->create([
            'phone_number' => '09912345678',
            'course' => 'BSIT',
            'year_level' => '3',
        ]);

        $category = Category::query()->create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'icon' => 'chip',
            'is_active' => true,
        ]);

        $item = Item::query()->create([
            'user_id' => $owner->id,
            'name' => 'Portable Projector',
            'description' => 'Compact projector',
            'price' => 100,
            'status' => 'available',
            'category' => 'electronics',
            'category_id' => $category->id,
        ]);

        $rental = Rental::query()->create([
            'item_id' => $item->id,
            'renter_id' => $borrower->id,
            'start_date' => now()->addDay(),
            'end_date' => now()->addDays(4),
            'total_price' => 300,
            'paid_amount' => 0,
            'payment_status' => 'outstanding',
            'status' => 'pending',
        ]);

        return [$owner, $borrower, $rental];
    }
}
