<?php

namespace Tests\Feature;

use App\Livewire\Profile\UpdateProfileInformationForm;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
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

    public function test_profile_information_uses_name_when_first_and_last_name_are_empty(): void
    {
        $this->actingAs($user = User::factory()->create([
            'name' => 'Josh Andrew Duwenyas',
            'first_name' => null,
            'last_name' => null,
        ]));

        $component = Livewire::test(UpdateProfileInformationForm::class);

        $this->assertEquals('Josh', $component->state['first_name']);
        $this->assertEquals('Andrew Duwenyas', $component->state['last_name']);
        $this->assertEquals($user->email, $component->state['email']);
    }

    public function test_name_and_email_cannot_be_changed_from_profile_information_form(): void
    {
        $this->actingAs($user = User::factory()->create([
            'name' => 'Original Name',
            'first_name' => 'Original',
            'last_name' => 'Name',
            'email' => 'original@umindanao.edu.ph',
            'phone_number' => '09000000000',
        ]));

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', [
                'first_name' => 'Changed',
                'last_name' => 'Person',
                'email' => 'changed@umindanao.edu.ph',
                'phone_number' => '09123456789',
            ])
            ->call('updateProfileInformation');

        $updatedUser = $user->fresh();

        $this->assertEquals('Original', $updatedUser->first_name);
        $this->assertEquals('Name', $updatedUser->last_name);
        $this->assertEquals('Original Name', $updatedUser->name);
        $this->assertEquals('original@umindanao.edu.ph', $updatedUser->email);
        $this->assertEquals('09000000000', $updatedUser->phone_number);
    }

    public function test_extended_profile_information_can_be_updated(): void
    {
        $this->actingAs($user = User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', [
                'first_name' => 'Test',
                'last_name' => 'Name',
                'email' => 'test-profile@umindanao.edu.ph',
                'phone_number' => '09123456789',
                'secondary_phone_number' => '09876543210',
                'course' => 'Computing Education',
                'year_level' => '3rd Year',
            ])
            ->call('updateProfileInformation');

        $updatedUser = $user->fresh();

        $this->assertNull($updatedUser->phone_number);
        $this->assertEquals('09876543210', $updatedUser->secondary_phone_number);
        $this->assertEquals('Computing Education', $updatedUser->course);
        $this->assertEquals('3rd Year', $updatedUser->year_level);
    }

    public function test_campus_column_is_removed_from_users_table(): void
    {
        $this->assertFalse(Schema::hasColumn('users', 'campus'));
        $this->assertTrue(Schema::hasColumn('users', 'secondary_phone_number'));
    }

    public function test_profile_program_and_school_level_must_be_valid_options(): void
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(UpdateProfileInformationForm::class)
            ->set('state', [
                'first_name' => 'Test',
                'last_name' => 'User',
                'email' => 'test-options@umindanao.edu.ph',
                'course' => 'Invalid Program',
                'year_level' => '6th Year',
            ])
            ->call('updateProfileInformation')
            ->assertHasErrors(['course', 'year_level']);
    }
}
