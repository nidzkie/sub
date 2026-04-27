<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class EditItem extends Component
{
    use WithFileUploads;

    public Item $item;

    public $name;

    public $description;

    public $price;

    public $condition;

    public $category_id;

    public $image;

    public $status;

    public function mount(Item $item)
    {
        // security check
        abort_unless($item->user_id === Auth::id(), 403);

        $this->item = $item;

        // preload fields
        $this->name = $item->name;
        $this->description = $item->description;
        $this->price = $item->price;
        $this->condition = $item->condition;
        $this->category_id = $item->category_id;
        $this->status = $item->status;
    }

    protected function rules()
    {
        return [
            'name' => 'required|string|min:3',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'condition' => 'required|in:Like New,Good,Fair,Old',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ];
    }

    public function update()
    {
        abort_unless(Auth::check(), 403);

        $this->validate();

        $data = [
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'condition' => $this->condition,
            'category_id' => $this->category_id,
            'status' => $this->status,
        ];

        // handle image replacement
        if ($this->image) {
            if ($this->item->image_path) {
                Storage::disk('public')->delete($this->item->image_path);
            }

            $data['image_path'] = $this->image->store('item-photos', 'public');
        }

        $this->item->update($data);

        session()->flash('message', 'Item updated successfully.');

        return redirect()->route('my-listings');
    }

    public function render()
    {
        return view('livewire.edit-item', [
            'categories' => Category::where('is_active', true)->orderBy('name')->get(),
        ]);
    }
}
