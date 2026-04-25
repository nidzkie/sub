<nav x-data="{ open: false }" class="border-b border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 transition-colors">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto flex h-14 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <span class="inline-flex h-6 w-6 items-center justify-center rounded bg-gradient-primary text-xs font-bold text-white group-hover:shadow-lg group-hover:shadow-primary-500/50 transition-all duration-300">CR</span>
                <span class="text-sm font-semibold text-slate-900 dark:text-slate-50 sm:text-base">Campus Rental</span>
            </a>
        </div>

        <div class="hidden items-center gap-3 sm:flex">
            <div class="flex items-center gap-2 rounded-full bg-slate-50 dark:bg-slate-800 px-2 py-1 ring-1 ring-slate-200 dark:ring-slate-700">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'bg-gradient-primary text-white shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }} rounded-full px-4 py-2 text-sm font-semibold transition">
                    {{ __('Home') }}
                </a>

                <a href="{{ route('my-rentals') }}"
                    class="{{ request()->routeIs('my-rentals') ? 'bg-gradient-primary text-white shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }} rounded-full px-4 py-2 text-sm font-semibold transition">
                    {{ __('My Rentals') }}
                </a>

                <a href="{{ route('my-listings') }}"
                    class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-gradient-primary text-white shadow-sm' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }} rounded-full px-4 py-2 text-sm font-semibold transition">
                    {{ __('My Listings') }}
                </a>
            </div>

            @livewire('notifications-dropdown')

            <!-- Dark Mode Toggle -->
            <x-dark-mode-toggle />

            <!-- Settings Dropdown -->
            <div class="ms-3 relative group">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <x-profile-avatar :user="Auth::user()" />
                    </x-slot>

                    <x-slot name="content">
                        <!-- Account Management -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Manage Account') }}
                        </div>

                        <x-dropdown-link href="{{ route('profile.show') }}">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-dropdown-link>
                        @endif

                        <div class="border-t border-gray-200 dark:border-slate-700"></div>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}" x-data>
                            @csrf

                            <x-dropdown-link href="{{ route('logout') }}"
                                     @click.prevent="$root.submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>

        <div class="flex items-center gap-2 sm:hidden">
            <x-dark-mode-toggle />
            <button @click="open = !open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 hover:text-slate-700 dark:hover:text-slate-200">
                <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-cloak class="border-t border-slate-200 dark:border-slate-700 bg-white dark:bg-slate-900 px-4 py-3 sm:hidden">
        <div class="space-y-2 text-sm">
            <div class="space-y-2 rounded-2xl bg-slate-50 dark:bg-slate-800 p-2 ring-1 ring-slate-200 dark:ring-slate-700">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'bg-gradient-primary text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }} block rounded-xl px-4 py-3 font-semibold transition">
                    {{ __('Home') }}
                </a>

                <a href="{{ route('my-rentals') }}"
                    class="{{ request()->routeIs('my-rentals') ? 'bg-gradient-primary text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }} block rounded-xl px-4 py-3 font-semibold transition">
                    {{ __('My Rentals') }}
                </a>

                <a href="{{ route('my-listings') }}"
                    class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-gradient-primary text-white' : 'text-slate-600 dark:text-slate-400 hover:bg-white dark:hover:bg-slate-700 hover:text-slate-900 dark:hover:text-slate-100' }} block rounded-xl px-4 py-3 font-semibold transition">
                    {{ __('My Listings') }}
                </a>
            </div>
            <a href="{{ route('profile.show') }}" class="flex items-center gap-3 px-1 pt-2 text-slate-600 dark:text-slate-400 hover:text-slate-900 dark:hover:text-slate-100 transition">
                <x-profile-avatar :user="Auth::user()" size="md" />
                <span class="font-medium">Profile</span>
            </a>
        </div>
    </div>
</nav>
