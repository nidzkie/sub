<div class="min-h-screen bg-slate-50 font-sans text-slate-900 antialiased transition-colors dark:bg-slate-950 dark:text-slate-100">
    <nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl dark:border-slate-700/80 dark:bg-slate-900/85">
        <div class="mx-auto flex h-16 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
            <a href="{{ route('home') }}" class="group flex items-center gap-2">
                <span class="inline-flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 text-xs font-bold text-white shadow-lg shadow-blue-600/30 transition-all duration-300 group-hover:-translate-y-0.5">CR</span>
                <span class="text-sm font-semibold text-slate-900 sm:text-base dark:text-slate-50">Campus Rental</span>
            </a>

            <div class="hidden items-center gap-3 sm:flex">
                @auth
                    <div class="flex items-center gap-2 rounded-full bg-slate-50 px-2 py-1 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} rounded-full px-4 py-2 text-sm font-semibold transition">Marketplace</a>
                        <a href="{{ route('my-rentals') }}" class="{{ request()->routeIs('my-rentals') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} rounded-full px-4 py-2 text-sm font-semibold transition">My Rentals</a>
                        <a href="{{ route('my-listings') }}" class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} rounded-full px-4 py-2 text-sm font-semibold transition">My Listings</a>
                    </div>

                    @livewire('notifications-dropdown')

                    <x-dark-mode-toggle />

                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="group inline-flex items-center rounded-full px-1 py-1 ring-1 ring-transparent transition hover:ring-slate-200 dark:hover:ring-slate-700">
                                <x-profile-avatar :user="Auth::user()" showChevron />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="block px-4 py-2 text-xs text-slate-400">
                                Manage Account
                            </div>

                            <x-dropdown-link href="{{ route('profile.show') }}">Profile</x-dropdown-link>

                            <div class="border-t border-gray-200 dark:border-slate-700"></div>

                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <x-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    Log Out
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <x-dark-mode-toggle />
                    <a href="{{ route('login') }}" class="text-sm font-medium text-slate-600 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">Sign In</a>
                    <a href="{{ route('register') }}" class="rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-2 text-sm font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5 hover:shadow-xl">Sign Up</a>
                @endauth
            </div>

            <div class="flex items-center gap-2 sm:hidden">
                <x-dark-mode-toggle />
                <button @click="open = !open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 dark:text-slate-400 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                    <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <div x-show="open" x-cloak class="border-t border-slate-200 bg-white px-4 py-3 sm:hidden dark:border-slate-700 dark:bg-slate-900">
            <div class="space-y-2 text-sm">
                @auth
                    <div class="space-y-2 rounded-2xl bg-slate-50 p-2 ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} block rounded-xl px-4 py-3 font-semibold transition">Marketplace</a>
                        <a href="{{ route('my-rentals') }}" class="{{ request()->routeIs('my-rentals') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} block rounded-xl px-4 py-3 font-semibold transition">My Rentals</a>
                        <a href="{{ route('my-listings') }}" class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} block rounded-xl px-4 py-3 font-semibold transition">My Listings</a>
                    </div>
                    <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-1 pt-2 text-slate-600 transition hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">
                        <x-profile-avatar :user="Auth::user()" size="md" />
                        <span class="font-medium">Profile</span>
                    </a>
                @else
                    <a href="{{ route('login') }}" class="block py-2 font-medium text-slate-600 hover:text-slate-900 dark:text-slate-400 dark:hover:text-slate-100">Sign In</a>
                    <a href="{{ route('register') }}" class="block rounded-lg bg-gradient-to-r from-blue-600 to-violet-600 px-4 py-2 text-center font-semibold text-white">Sign Up</a>
                @endauth
            </div>
        </div>
    </nav>

    <section class="relative overflow-hidden bg-gradient-to-br from-blue-700 via-violet-700 to-slate-900 text-white">
        <div class="pointer-events-none absolute inset-0">
            <div class="absolute -left-16 -top-12 h-72 w-72 rounded-full bg-cyan-300/20 blur-3xl"></div>
            <div class="absolute -bottom-20 right-0 h-80 w-80 rounded-full bg-fuchsia-300/20 blur-3xl"></div>
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_top_left,_rgba(255,255,255,0.16),_transparent_45%)]"></div>
        </div>

        <div class="relative mx-auto max-w-7xl px-4 py-16 sm:px-6 sm:py-20 lg:px-8 lg:py-24">
            <div class="mx-auto max-w-4xl text-center">
                <p class="mb-6 inline-flex rounded-full border border-white/25 bg-white/10 px-4 py-2 text-xs font-semibold uppercase tracking-wider text-blue-50 backdrop-blur-xl">
                    Campus Marketplace
                </p>
                <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black tracking-tighter leading-tight mb-6">
                    <span class="block">Share Resources,</span>
                    <span class="block bg-gradient-to-r from-white to-blue-100 dark:to-accent-200 bg-clip-text text-transparent">Save Money</span>
                </h1>

                <p class="mx-auto max-w-2xl text-lg sm:text-xl text-blue-100 dark:text-accent-200 mb-8 leading-relaxed">
                    Rent and lend items within the school campus community. Connect with fellow students, save money, and share resources effortlessly.
                </p>

                <form class="mx-auto mt-10 flex max-w-3xl flex-col gap-3 rounded-2xl border border-white/20 bg-white/95 p-2 shadow-2xl backdrop-blur-xl dark:bg-slate-900/95 sm:flex-row sm:items-center">
                    <div class="flex min-w-0 flex-1 items-center gap-3 px-4">
                        <svg class="h-5 w-5 shrink-0 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m21 21-4.35-4.35m1.85-5.15a7 7 0 11-14 0 7 7 0 0114 0Z" />
                        </svg>
                        <input type="text" placeholder="Search for camera, laptop, reviewer, projector..." class="w-full min-w-0 border-0 bg-transparent text-base text-slate-900 placeholder:text-slate-400 focus:outline-none focus:ring-0 dark:text-slate-100 dark:placeholder:text-slate-500">
                    </div>
                    <button type="button" class="h-12 rounded-xl bg-gradient-to-r from-blue-600 to-violet-600 px-8 text-base font-semibold text-white shadow-lg shadow-blue-600/30 transition hover:-translate-y-0.5 hover:shadow-xl">
                        Search Items
                    </button>
                </form>
            </div>
        </div>
    </section>

    <section class="border-b border-slate-200 bg-white dark:border-slate-700 dark:bg-slate-900">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <h2 class="mb-6 text-2xl font-bold text-slate-900 dark:text-slate-50">Browse Categories</h2>
            <div class="mx-auto flex max-w-5xl flex-wrap items-center justify-center gap-2 rounded-2xl bg-slate-50 p-3 shadow-sm ring-1 ring-slate-200 dark:bg-slate-800 dark:ring-slate-700">
                <a href="{{ route('home') }}" class="{{ $selectedCategory === null ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200 dark:bg-slate-700 dark:text-slate-50 dark:ring-slate-600' : 'text-slate-500 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition">
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" /></svg>
                    <span>All</span>
                </a>

                @foreach ($categories as $category)
                    <a href="{{ route('categories.show', $category) }}" class="{{ optional($selectedCategory)->is($category) ? 'bg-white text-slate-900 shadow-sm ring-1 ring-slate-200 dark:bg-slate-700 dark:text-slate-50 dark:ring-slate-600' : 'text-slate-500 hover:bg-white hover:text-slate-900 dark:text-slate-400 dark:hover:bg-slate-700 dark:hover:text-slate-100' }} inline-flex items-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold transition">
                        @if ($category->icon === 'book')
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20M6.5 17A2.5 2.5 0 0 0 4 19.5m2.5-2.5V5A2 2 0 0 1 8.5 3H20v14M6.5 17H20" /></svg>
                        @elseif ($category->icon === 'device')
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2Z" /></svg>
                        @elseif ($category->icon === 'pencil')
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 5 4 4M4 20l4.5-1 9-9a2.121 2.121 0 0 0-3-3l-9 9L4 20Z" /></svg>
                        @elseif ($category->icon === 'tool')
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.7 6.3a4 4 0 0 0-5.4 5.87l-5.01 5.02a1.5 1.5 0 1 0 2.12 2.12l5.02-5.01a4 4 0 0 0 5.87-5.4l-2.1 2.1-2.83-.71-.71-2.83 2.1-2.16Z" /></svg>
                        @elseif ($category->icon === 'fitness')
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 10V8a1 1 0 0 1 1-1h1v10H7a1 1 0 0 1-1-1v-2m12-4V8a1 1 0 0 0-1-1h-1v10h1a1 1 0 0 0 1-1v-2M8 12h8" /></svg>
                        @elseif ($category->icon === 'shirt')
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 4.5 5.5 7 3 5.5l2.5-2.5L8 4.5Zm8 0L18.5 7 21 5.5l-2.5-2.5L16 4.5ZM7 7l1-2.5h8L17 7v12a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V7Z" /></svg>
                        @else
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l.7 2.154a1 1 0 0 0 .95.69h2.264c.969 0 1.371 1.24.588 1.81l-1.832 1.331a1 1 0 0 0-.364 1.118l.7 2.154c.3.921-.755 1.688-1.539 1.118l-1.832-1.331a1 1 0 0 0-1.176 0l-1.832 1.331c-.783.57-1.838-.197-1.539-1.118l.7-2.154a1 1 0 0 0-.364-1.118L5.547 7.58c-.783-.57-.38-1.81.588-1.81H8.4a1 1 0 0 0 .95-.69l.7-2.154Z" /></svg>
                        @endif
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <main class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    @livewire('item-filter')
</main>

    <x-site-footer />
</div>
