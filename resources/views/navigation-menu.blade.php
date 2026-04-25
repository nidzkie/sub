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