<?php

use App\Livewire\AddNewItem;
use App\Livewire\AdminDashboard;
use App\Livewire\Dashboard;
use App\Livewire\EditItem;
use App\Livewire\HomePage;
use App\Livewire\MyListings;
use App\Livewire\MyRentals;
use App\Livewire\OwnerItemRentalRequests;
use App\Livewire\OwnerRentalRequestView;
use App\Livewire\RentInventoryManagement;
use App\Livewire\ViewItem;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

// Landing page for guests
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('home');
    }

    return view('landing');
})->name('landing');

// Home page (accessible to both auth and guests)
Route::get('/marketplace', HomePage::class)->name('home');
Route::get('/categories/{category:slug}', HomePage::class)->name('categories.show');
Route::view('/help-center', 'help-center')->name('help-center');
Route::get('/terms-of-service', function () {
    return view('terms', [
        'terms' => Str::markdown(file_get_contents(resource_path('markdown/terms.md'))),
    ]);
})->name('terms.show');
Route::get('/privacy-policy', function () {
    return view('policy', [
        'policy' => Str::markdown(file_get_contents(resource_path('markdown/policy.md'))),
    ]);
})->name('policy.show');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/my-listings', MyListings::class)->name('my-listings');
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/rent-inventory-management', RentInventoryManagement::class)->name('rent-inventory-management');
    Route::get('/items/{item}/rental-requests', OwnerItemRentalRequests::class)->name('rental-requests.item');
    Route::get('/rental-requests/{rental}', OwnerRentalRequestView::class)->name('rental-requests.show');
    Route::get('/add-item', AddNewItem::class)->name('add-item');
    Route::get('/my-rentals', MyRentals::class)->name('my-rentals');

    Route::get('/item/{id}', ViewItem::class)->name('item.view');
    Route::get('/item/{item}/edit', EditItem::class)->name('edit-item');

    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    });
});
