<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class UserProfilePhotoUrlTest extends TestCase
{
    public function test_profile_photo_url_uses_relative_storage_path_when_file_exists(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('profile-photos/josh.jpg', 'fake image contents');

        $user = new User([
            'name' => 'Josh Andrew',
            'email' => 'josh@umindanao.edu.ph',
        ]);
        $user->forceFill(['profile_photo_path' => 'profile-photos/josh.jpg']);

        $this->assertSame('/storage/profile-photos/josh.jpg', $user->profile_photo_url);
    }
}
