<?php

namespace Tests\Feature;

use App\Livewire\AddNewItem;
use App\Livewire\EditItem;
use App\Livewire\Profile\UpdateProfileInformationForm;
use App\Livewire\ViewItem;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use ReflectionClass;
use Tests\TestCase;

class PhotoUploadCapacityTest extends TestCase
{
    use RefreshDatabase;

    public function test_item_photo_max_size_is_twenty_five_mb_across_item_components(): void
    {
        $addRules = $this->readProperty(AddNewItem::class, 'rules');
        $viewRules = $this->readProperty(ViewItem::class, 'rules');
        $editRules = $this->invokeMethod(EditItem::class, 'rules');

        $this->assertSame('nullable|image|max:25600', $addRules['image']);
        $this->assertSame('nullable|image|max:25600', $viewRules['image']);
        $this->assertSame('nullable|image|max:25600', $editRules['image']);
    }

    public function test_profile_photo_max_size_is_twenty_five_mb_for_livewire_profile_and_fortify_action(): void
    {
        $this->actingAs(User::factory()->create());

        $profileRules = $this->invokeMethod(UpdateProfileInformationForm::class, 'rules');

        $this->assertSame(['nullable', 'image', 'max:25600'], $profileRules['photo']);

        $fortifySource = file_get_contents(app_path('Actions/Fortify/UpdateUserProfileInformation.php'));

        $this->assertNotFalse($fortifySource);
        $this->assertStringContainsString("'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:25600']", $fortifySource);
    }

    /**
     * @return array<string, mixed>
     */
    private function readProperty(string $className, string $propertyName): array
    {
        $reflection = new ReflectionClass($className);
        $property = $reflection->getProperty($propertyName);
        $property->setAccessible(true);

        return $property->getValue($reflection->newInstanceWithoutConstructor());
    }

    /**
     * @return array<string, mixed>
     */
    private function invokeMethod(string $className, string $methodName): array
    {
        $reflection = new ReflectionClass($className);
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invoke($reflection->newInstanceWithoutConstructor());
    }
}
