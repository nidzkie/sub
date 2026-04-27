<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.app')]
class AddNewItem extends Component
{
    use WithFileUploads;

    public $name;

    public $description;

    public $price;

    public string $condition = 'Good';

    public $category_id;

    public $image;

    protected $rules = [
        'name' => 'required|string|min:3',
        'description' => 'required',
        'price' => 'required|numeric|min:0',
        'condition' => 'required|in:Like New,Good,Fair,Old',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|max:1024',
    ];

    public function mount(): void
    {
        $this->category_id = Category::query()
            ->where('is_active', true)
            ->orderBy('name')
            ->value('id');
    }

    public function submit()
    {
        abort_unless(Auth::check(), 403);

        $this->validate();

        $category = Category::query()
            ->where('is_active', true)
            ->findOrFail($this->category_id);
        $imagePath = $this->image ? $this->image->store('item-photos', 'public') : null;

        Item::create([
            'user_id' => Auth::id(),
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'condition' => $this->condition,
            'category' => $category->slug,
            'category_id' => $category->id,
            'image_path' => $imagePath,
        ]);

        session()->flash('message', 'Item successfully added!');

        return redirect()->to('/my-listings');
    }

    public function render()
    {
        return view('livewire.add-new-item', [
            'categories' => Category::query()
                ->where('is_active', true)
                ->orderBy('name')
                ->get(),
        ]);
    }
}
