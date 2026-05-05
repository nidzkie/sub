<?php

namespace App\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateProfileInformationForm extends Component
{
    use WithFileUploads;

    public $photo;

    public $state = [];

    protected function rules(): array
    {
        return [
            'state.secondary_phone_number' => ['nullable', 'string', 'max:30'],
            'state.course' => ['nullable', 'string', Rule::in(User::PROGRAMS)],
            'state.year_level' => ['nullable', Rule::in(User::SCHOOL_LEVELS)],
            'photo' => ['nullable', 'image', 'max:25600'],
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();
        $nameParts = explode(' ', trim($user->name), 2);

        $this->state = [
            'first_name' => $user->first_name ?: ($nameParts[0] ?? ''),
            'last_name' => $user->last_name ?: ($nameParts[1] ?? ''),
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'secondary_phone_number' => $user->secondary_phone_number,
            'course' => $user->course,
            'year_level' => $user->year_level,
        ];
    }

    public function updateProfileInformation(): void
    {
        $this->validate();

        Auth::user()->fill([
            'secondary_phone_number' => $this->state['secondary_phone_number'] ?? null,
            'course' => $this->state['course'] ?? null,
            'year_level' => $this->state['year_level'] ?? null,
        ])->save();

        $this->dispatch('saved');
    }

    public function deleteProfilePhoto(): void
    {
        Auth::user()->deleteProfilePhoto();

        $this->dispatch('refresh')->to('profile.update-profile-information-form');
    }

    public function render()
    {
        return view('livewire.profile.update-profile-information-form');
    }
}
