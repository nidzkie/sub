<div class="min-h-screen bg-[#f5f7fb] font-sans text-slate-900 antialiased">
        <nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">
            <div class="mx-auto flex h-14 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="inline-flex h-6 w-6 items-center justify-center rounded bg-[#2850d8] text-xs font-bold text-white">CR</span>
                        <span class="text-sm font-semibold text-slate-900 sm:text-base">Campus Rental</span>
                    </a>
                </div>

                <div class="hidden items-center gap-3 sm:flex">
                    @auth
                        <div class="flex items-center gap-2 rounded-full bg-slate-50 px-2 py-1 ring-1 ring-slate-200">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-[#2850d8] text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} rounded-full px-4 py-2 text-sm font-semibold transition">Home</a>
                            <a href="{{ route('my-rentals') }}" class="{{ request()->routeIs('my-rentals') ? 'bg-[#2850d8] text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} rounded-full px-4 py-2 text-sm font-semibold transition">My Rentals</a>
                            <a href="{{ route('my-listings') }}" class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-[#2850d8] text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} rounded-full px-4 py-2 text-sm font-semibold transition">My Listings</a>
                        </div>

                        @livewire('notifications-dropdown')

                        <a href="{{ route('profile.show') }}" class="inline-flex">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="size-12 rounded-full object-cover ring-1 ring-slate-200 transition hover:ring-slate-300" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                @php($initials = collect(explode(' ', trim(Auth::user()->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode(''))
                                <span class="inline-flex size-12 items-center justify-center rounded-full bg-[#e9f1ff] text-base font-semibold text-[#7c94ff] ring-1 ring-[#d9e6ff] transition hover:bg-[#dfeaff]">
                                    {{ $initials }}
                                </span>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 hover:text-slate-900">Sign In</a>
                        <a href="{{ route('register') }}" class="rounded-md bg-[#2850d8] px-3 py-1.5 text-sm font-semibold text-white hover:bg-[#1f42b5]">Sign Up</a>
                    @endauth
                </div>

                <button @click="open = !open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 sm:hidden">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div x-show="open" x-cloak class="border-t border-slate-200 bg-white px-4 py-3 sm:hidden">
                <div class="space-y-2 text-sm">
                    @auth
                        <div class="space-y-2 rounded-2xl bg-slate-50 p-2 ring-1 ring-slate-200">
                            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-[#2850d8] text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} block rounded-xl px-4 py-3 font-semibold transition">Home</a>
                            <a href="{{ route('my-rentals') }}" class="{{ request()->routeIs('my-rentals') ? 'bg-[#2850d8] text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} block rounded-xl px-4 py-3 font-semibold transition">My Rentals</a>
                            <a href="{{ route('my-listings') }}" class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-[#2850d8] text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} block rounded-xl px-4 py-3 font-semibold transition">My Listings</a>
                        </div>
                        <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-1 pt-2 text-slate-600 hover:text-slate-900">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                                <img class="size-12 rounded-full object-cover ring-1 ring-slate-200" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                @php($initials = collect(explode(' ', trim(Auth::user()->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode(''))
                                <span class="inline-flex size-12 items-center justify-center rounded-full bg-[#e9f1ff] text-base font-semibold text-[#7c94ff] ring-1 ring-[#d9e6ff]">
                                    {{ $initials }}
                                </span>
                            @endif
                            <span class="font-medium">Profile</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="block text-slate-600 hover:text-slate-900">Sign In</a>
                        <a href="{{ route('register') }}" class="block font-semibold text-[#2850d8] hover:text-[#1f42b5]">Sign Up</a>
                    @endauth
                </div>
            </div>
        </nav>

        <section class="bg-[#3263e6] text-white">
            <div class="mx-auto max-w-7xl px-4 py-14 sm:px-6 lg:px-8">
                <div class="mx-auto max-w-4xl text-center">
                    <h1 class="text-4xl font-bold tracking-tight sm:text-6xl">Share Resources, Save Money</h1>
                    <p class="mx-auto mt-4 max-w-2xl text-base text-blue-100 sm:text-2xl/relaxed">Rent and lend items within the University of Mindanao campus community.</p>

                    <form class="mx-auto mt-10 flex max-w-4xl items-center gap-4 rounded-2xl bg-white p-3 shadow-[0_18px_50px_rgba(20,39,107,0.18)]">
                        <div class="flex min-w-0 flex-1 items-center gap-4 px-3">
                            <svg class="h-6 w-6 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0Z" />
                            </svg>
                            <input
                                type="text"
                                placeholder="Search for electronic, books, gadgets, clothes..."
                                class="h-14 w-full min-w-0 border-0 bg-transparent text-lg text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-0"
                            >
                        </div>
                        <button
                            type="button"
                            class="h-14 rounded-xl bg-[#3263e6] px-9 text-lg font-semibold text-white transition hover:bg-[#2850d8]"
                        >
                            Search
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <section class="border-b border-slate-200 bg-white">
            <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
                <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-center gap-2 rounded-2xl bg-[#f4f6fb] p-2 shadow-sm ring-1 ring-slate-100">
                    <a
                        href="{{ route('home') }}"
                        class="{{ $selectedCategory === null ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-900' }} inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                        </svg>
                        <span>All</span>
                    </a>

                    @foreach ($categories as $category)
                        <a
                            href="{{ route('categories.show', $category) }}"
                            class="{{ optional($selectedCategory)->is($category) ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-500 hover:bg-white hover:text-slate-900' }} inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition"
                        >
                            @if ($category->icon === 'book')
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 17A2.5 2.5 0 0 0 4 19.5m2.5-2.5V5A2 2 0 0 1 8.5 3H20v14M6.5 17H20" />
                                </svg>
                            @elseif ($category->icon === 'device')
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z" />
                                </svg>
                            @elseif ($category->icon === 'pencil')
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 5 4 4M4 20l4.5-1 9-9a2.121 2.121 0 0 0-3-3l-9 9L4 20Z" />
                                </svg>
                            @elseif ($category->icon === 'speaker')
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 9a2 2 0 0 1 2-2h3l3-2v14l-3-2H7a2 2 0 0 1-2-2V9Zm11.5-1.5a5 5 0 0 1 0 9m-2-6.5a2 2 0 0 1 0 4" />
                                </svg>
                            @elseif ($category->icon === 'tool')
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 0 0-5.4 5.87l-5.01 5.02a1.5 1.5 0 1 0 2.12 2.12l5.02-5.01a4 4 0 0 0 5.87-5.4l-2.1 2.1-2.83-.71-.71-2.83 2.1-2.16Z" />
                                </svg>
                            @elseif ($category->icon === 'fitness')
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 10V8a1 1 0 0 1 1-1h1v10H7a1 1 0 0 1-1-1v-2m12-4V8a1 1 0 0 0-1-1h-1v10h1a1 1 0 0 0 1-1v-2M8 12h8" />
                                </svg>
                            @else
                                <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.7 2.154a1 1 0 0 0 .95.69h2.264c.969 0 1.371 1.24.588 1.81l-1.832 1.331a1 1 0 0 0-.364 1.118l.7 2.154c.3.921-.755 1.688-1.539 1.118l-1.832-1.331a1 1 0 0 0-1.176 0l-1.832 1.331c-.783.57-1.838-.197-1.539-1.118l.7-2.154a1 1 0 0 0-.364-1.118L5.547 7.58c-.783-.57-.38-1.81.588-1.81H8.4a1 1 0 0 0 .95-.69l.7-2.154Z" />
                                </svg>
                            @endif

                            <span>{{ $category->name }}</span>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>

        <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="text-base font-semibold text-slate-900 sm:text-lg">All Available Items</h2>
                    <p class="text-xs text-slate-500 sm:text-sm">Explore rentals shared by your campus community.</p>
                </div>
                <span class="rounded-full bg-white px-3 py-1 text-xs font-medium text-slate-500 shadow-sm ring-1 ring-slate-200">
                    {{ $featuredItems->count() }} showing
                </span>
            </div>

            @if ($featuredItems->isEmpty())
                <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
                    <h3 class="text-lg font-semibold text-slate-900">No items available yet</h3>
                    <p class="mt-2 text-sm text-slate-500">Be the first to list something useful for other students.</p>
                </div>
            @else
                <div class="grid grid-cols-2 gap-4 sm:grid-cols-3 xl:grid-cols-5">
                    @foreach ($featuredItems as $item)
                        <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-0.5 hover:shadow-md">
                            <div class="aspect-[4/3] overflow-hidden bg-slate-100">
                                @if ($item->image_path)
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->name }}" class="h-full w-full object-cover">
                                @else
                                    <div class="flex h-full w-full items-center justify-center bg-slate-100">
                                        <svg class="h-10 w-10 text-slate-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                @endif
                            </div>

                            <div class="space-y-3 p-3">
                                <div>
                                    <div class="line-clamp-1 text-sm font-semibold text-slate-900">{{ $item->name }}</div>
                                    <div class="mt-1 line-clamp-2 text-xs text-slate-500">{{ $item->description ?: 'No description provided yet.' }}</div>
                                </div>

                                <div class="flex items-end justify-between">
                                    <div>
                                        <div class="text-base font-bold text-[#2850d8]">₱{{ number_format($item->price, 2) }}</div>
                                        <div class="text-[11px] text-slate-400">per day</div>
                                    </div>
                                    <div class="text-right text-[11px] text-slate-400">
                                        <div>{{ $item->categoryRecord?->name ?? ucfirst(str_replace('-', ' ', $item->category ?? 'uncategorized')) }}</div>
                                        <div>{{ ucfirst($item->status) }}</div>
                                    </div>
                                </div>

                                @auth
                                    <a href="{{ route('item.view', $item->id) }}" class="block rounded-lg bg-[#2850d8] px-3 py-2 text-center text-xs font-semibold text-white hover:bg-[#1f42b5]">
                                        View
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="block rounded-lg bg-slate-900 px-3 py-2 text-center text-xs font-semibold text-white hover:bg-slate-800">
                                        Sign In
                                    </a>
                                @endauth
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </main>
    </div>
