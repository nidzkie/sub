<div class="bg-gradient-to-b from-gray-50 to-white py-8 md:py-12 dark:from-slate-950 dark:to-slate-900">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2 dark:text-slate-100">Add New Item</h1>
            <p class="text-gray-600 dark:text-slate-400">Share a resource with the campus community</p>
        </div>

        <!-- Back Button -->
        <a href="{{ route('my-listings') }}" class="inline-flex items-center mb-8 text-blue-600 hover:text-blue-700 font-medium transition-colors dark:text-blue-400 dark:hover:text-blue-300">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
            Back to My Listings
        </a>

        <!-- Error Messages -->
        @if ($errors->any())
            <div class="mb-6 p-4 md:p-5 bg-red-50 border border-red-200 text-red-800 rounded-xl dark:bg-red-900/20 dark:border-red-700 dark:text-red-300">
                <div class="flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-500 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                    </svg>
                    <div>
                        <h3 class="font-semibold mb-2">Please fix the following errors:</h3>
                        <ul class="space-y-1 text-sm">
                            @foreach ($errors->all() as $error)
                                <li>• {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <!-- Form -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden p-6 md:p-8 lg:p-10 dark:bg-slate-900 dark:shadow-slate-900/40">
            <form wire:submit.prevent="submit" class="space-y-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Item Name -->
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-3 dark:text-slate-300">Item Name <span class="text-red-500">*</span></label>
                        <input
                            type="text"
                            id="name"
                            wire:model="name"
                            placeholder="What would you like to share?"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                        >
                        @error('name')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.414 11.01a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l8.08-8.08z" clip-rule="evenodd"/></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Condition -->
                    <div>
                        <label for="condition" class="block text-sm font-semibold text-gray-700 mb-3 dark:text-slate-300">Condition <span class="text-red-500">*</span></label>
                        <select
                            id="condition"
                            wire:model="condition"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100"
                        >
                            <option value="Like New">Like New</option>
                            <option value="Good">Good</option>
                            <option value="Fair">Fair</option>
                            <option value="Old">Old</option>
                        </select>
                        @error('condition')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.414 11.01a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l8.08-8.08z" clip-rule="evenodd"/></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-3 dark:text-slate-300">Description <span class="text-red-500">*</span></label>
                        <textarea
                            id="description"
                            wire:model="description"
                            rows="4"
                            placeholder="Describe your item in detail (condition, features, etc.)"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                        ></textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.414 11.01a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l8.08-8.08z" clip-rule="evenodd"/></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label for="price" class="block text-sm font-semibold text-gray-700 mb-3 dark:text-slate-300">Price per Day <span class="text-red-500">*</span></label>
                        <div class="relative">
                            <span class="absolute left-4 top-3 text-gray-500 font-semibold">₱</span>
                            <input
                                type="number"
                                step="0.01"
                                min="0"
                                id="price"
                                wire:model="price"
                                placeholder="0.00"
                                class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100 dark:placeholder:text-slate-500"
                            >
                        </div>
                        @error('price')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.414 11.01a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l8.08-8.08z" clip-rule="evenodd"/></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div>
                        <label for="category" class="block text-sm font-semibold text-gray-700 mb-3 dark:text-slate-300">Category <span class="text-red-500">*</span></label>
                        <select
                            id="category"
                            wire:model="category_id"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all bg-white dark:border-slate-700 dark:bg-slate-800 dark:text-slate-100"
                        >
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.414 11.01a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l8.08-8.08z" clip-rule="evenodd"/></path></svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-gray-700 mb-3 dark:text-slate-300">Item Image <span class="text-red-500">*</span></label>
                        <div class="relative border-2 border-dashed border-gray-300 rounded-lg p-8 hover:border-blue-500 transition-colors cursor-pointer dark:border-slate-700 dark:hover:border-blue-500">
                            <input
                                type="file"
                                id="image"
                                wire:model="image"
                                accept="image/*"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                            >
                            <div class="text-center">
                                <svg class="w-12 h-12 text-gray-400 mx-auto mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                                <p class="text-gray-600 font-medium dark:text-slate-300">Click or drag image here</p>
                                <p class="text-gray-500 text-sm dark:text-slate-500">PNG, JPG, GIF up to 2MB</p>
                            </div>
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-2 flex items-center gap-1">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18.101 12.93a1 1 0 00-1.414-1.414L10 15.586 5.414 11.01a1 1 0 00-1.414 1.414l5 5a1 1 0 001.414 0l8.08-8.08z" clip-rule="evenodd"/></path></svg>
                                {{ $message }}
                            </p>
                        @enderror

                        @if ($image)
                            <div class="mt-4">
                                <p class="text-sm font-medium text-gray-700 mb-3 dark:text-slate-300">Preview</p>
                                <img src="{{ $image->temporaryUrl() }}" alt="Preview" class="h-48 w-full object-cover rounded-lg shadow-md">
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200 dark:border-slate-700">
                    <button
                        type="submit"
                        class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        Create Item
                    </button>
                    <a
                        href="{{ route('my-listings') }}"
                        class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2 dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-100"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
