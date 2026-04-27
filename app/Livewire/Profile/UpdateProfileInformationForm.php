<?php

namespace App\Livewire\Profile;

use Illuminate\Contracts\Auth\MustVerifyEmail;
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
            'state.first_name' => ['required', 'string', 'max:255'],
            'state.last_name' => ['required', 'string', 'max:255'],
            'state.email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore(Auth::user()->id)],
            'state.phone_number' => ['nullable', 'string', 'max:30'],
            'state.course' => ['nullable', 'string', 'max:255'],
            'state.year_level' => ['nullable', Rule::in(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'])],
            'state.campus' => ['nullable', Rule::in([
                'Panabo',
                'Digos',
                'Peñaplata',
                'Bansalan',
                'Davao (Matina-Main)',
                'Davao (Bolton)',
                'Davao (Bangoy)',
                'Tagum (Arellano)',
                'Tagum (Visayan)',
            ])],
            'photo' => ['nullable', 'image', 'max:1024'],
        ];
    }

    public function mount(): void
    {
        $user = Auth::user();

        $this->state = [
            'first_name' => $user->first_name ?? '',
            'last_name' => $user->last_name ?? '',
            'email' => $user->email,
            'phone_number' => $user->phone_number,
            'course' => $user->course,
            'year_level' => $user->year_level,
            'campus' => $user->campus,
        ];
    }

    public function updateProfileInformation(): void
    {
        $this->validate();

        Auth::user()->fill($this->state)->save();

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
