<?php

namespace Tests\Feature;

use App\Livewire\Profile\UpdateProfileInformationForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProfileInformationTest extends TestCase
{
    use RefreshDatabase;

    public function test_current_profile_information_is_available(): void
    {
        $this->actingAs($user = User::factory()->create([
            'first_name' => 'John',
            'last_name' => 'Doe',
        ]));

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals('John', $component->state['first_name']);
        $this->assertEquals('Doe', $component->state['last_name']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', ['first_name' => 'Test', 'last_name' => 'User', 'email' => 'test@example.com'])
            ->call('updateProfileInformation');

        $this->assertEquals('Test', $user->fresh()->first_name);
        $this->assertEquals('User', $user->fresh()->last_name);
        $this->assertEquals('Test User', $user->fresh()->name);
        $this->assertEquals('test@example.com', $user->fresh()->email);
    }

    public function test_extended_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', [
                'first_name' => 'Test',
                'last_name' => 'Name',
                'email' => 'test@example.com',
                'phone_number' => '09123456789',
                'course' => 'BS Information Technology',
                'year_level' => '3rd Year',
                'campus' => 'Davao (Matina-Main)',
            ])
            ->call('updateProfileInformation');

        $updatedUser = $user->fresh();

        $this->assertEquals('Test', $updatedUser->first_name);
        $this->assertEquals('Name', $updatedUser->last_name);
        $this->assertEquals('Test Name', $updatedUser->name);
        $this->assertEquals('09123456789', $updatedUser->phone_number);
        $this->assertEquals('BS Information Technology', $updatedUser->course);
        $this->assertEquals('3rd Year', $updatedUser->year_level);
        $this->assertEquals('Davao (Matina-Main)', $updatedUser->campus);
    }
}
