<?php

namespace Tests\Unit;

use App\Models\Item;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ItemImageUrlTest extends TestCase
{
    public function test_image_url_is_null_when_file_is_missing(): void
    {
        Storage::fake('public');

        $item = new Item([
            'image_path' => 'item-photos/missing.jpg',
        ]);

        $this->assertNull($item->imageUrl());
    }

    public function test_image_url_is_returned_when_file_exists(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('item-photos/mouse.jpg', 'fake image contents');

        $item = new Item([
            'image_path' => 'item-photos/mouse.jpg',
        ]);

        $this->assertSame('/storage/item-photos/mouse.jpg', $item->imageUrl());
    }
}
