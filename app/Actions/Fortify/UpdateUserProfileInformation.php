<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's editable profile information.
     *
     * @param  array<string, mixed>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'secondary_phone_number' => ['nullable', 'string', 'max:30'],
            'course' => ['nullable', 'string', Rule::in(User::PROGRAMS)],
            'year_level' => ['nullable', Rule::in(User::SCHOOL_LEVELS)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:25600'],
        ], [
            'course.in' => 'Please select a valid program.',
            'year_level.in' => 'Please select a valid school level.',
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        $user->forceFill([
            'secondary_phone_number' => $input['secondary_phone_number'] ?? null,
            'course' => $input['course'] ?? null,
            'year_level' => $input['year_level'] ?? null,
        ])->save();
    }
}
