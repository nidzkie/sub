<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        $validCampuses = [
            'Panabo',
            'Digos',
            'Peñaplata',
            'Bansalan',
            'Davao (Matina-Main)',
            'Davao (Bolton)',
            'Davao (Bangoy)',
            'Tagum (Arellano)',
            'Tagum (Visayan)',
        ];

        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => ['nullable', 'string', 'max:30'],
            'course' => ['nullable', 'string', 'max:255'],
            'year_level' => ['nullable', Rule::in(['1st Year', '2nd Year', '3rd Year', '4th Year', '5th Year'])],
            'campus' => ['nullable', Rule::in($validCampuses)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'name' => trim($input['first_name'] . ' ' . $input['last_name']),
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'phone_number' => $input['phone_number'] ?? null,
                'course' => $input['course'] ?? null,
                'year_level' => $input['year_level'] ?? null,
                'campus' => $input['campus'] ?? null,
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'name' => trim($input['first_name'] . ' ' . $input['last_name']),
            'first_name' => $input['first_name'],
            'last_name' => $input['last_name'],
            'email' => $input['email'],
            'phone_number' => $input['phone_number'] ?? null,
            'course' => $input['course'] ?? null,
            'year_level' => $input['year_level'] ?? null,
            'campus' => $input['campus'] ?? null,
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
