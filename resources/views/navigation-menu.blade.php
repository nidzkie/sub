<nav x-data="{ open: false }" class="border-b border-slate-200 bg-white">
    <!-- Primary Navigation Menu -->
    <div class="mx-auto flex h-14 max-w-7xl items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-6">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="inline-flex h-6 w-6 items-center justify-center rounded bg-[#2850d8] text-xs font-bold text-white">CR</span>
                <span class="text-sm font-semibold text-slate-900 sm:text-base">Campus Rental</span>
            </a>
        </div>

        <div class="hidden items-center gap-3 sm:flex">
            <div class="flex items-center gap-2 rounded-full bg-slate-50 px-2 py-1 ring-1 ring-slate-200">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'bg-[#2850d8] text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} rounded-full px-4 py-2 text-sm font-semibold transition">
                    {{ __('Home') }}
                </a>

                <a href="{{ route('my-rentals') }}"
                    class="{{ request()->routeIs('my-rentals') ? 'bg-[#2850d8] text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} rounded-full px-4 py-2 text-sm font-semibold transition">
                    {{ __('My Rentals') }}
                </a>

                <a href="{{ route('my-listings') }}"
                    class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-[#2850d8] text-white shadow-sm' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} rounded-full px-4 py-2 text-sm font-semibold transition">
                    {{ __('My Listings') }}
                </a>
            </div>

            @livewire('notifications-dropdown')

            <!-- Settings Dropdown -->
            <div class="ms-3 relative">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <button class="flex rounded-full border-2 border-transparent focus:outline-none transition">
                                <img class="size-12 rounded-full object-cover ring-1 ring-slate-200 transition hover:ring-slate-300" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
                            </button>
                        @else
                            @php($initials = collect(explode(' ', trim(Auth::user()->name)))->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode(''))
                            <button type="button" class="inline-flex size-12 items-center justify-center rounded-full bg-[#e9f1ff] text-base font-semibold text-[#7c94ff] ring-1 ring-[#d9e6ff] transition hover:bg-[#dfeaff] focus:outline-none">
                                {{ $initials }}
                            </button>
                        @endif
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

                        <div class="border-t border-gray-200"></div>

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

        <button @click="open = !open" class="inline-flex items-center justify-center rounded-md p-2 text-slate-500 hover:bg-slate-100 hover:text-slate-700 sm:hidden">
            <svg class="h-5 w-5" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" x-cloak class="border-t border-slate-200 bg-white px-4 py-3 sm:hidden">
        <div class="space-y-2 text-sm">
            <div class="space-y-2 rounded-2xl bg-slate-50 p-2 ring-1 ring-slate-200">
                <a href="{{ route('home') }}"
                    class="{{ request()->routeIs('home') ? 'bg-[#2850d8] text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} block rounded-xl px-4 py-3 font-semibold transition">
                    {{ __('Home') }}
                </a>

                <a href="{{ route('my-rentals') }}"
                    class="{{ request()->routeIs('my-rentals') ? 'bg-[#2850d8] text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} block rounded-xl px-4 py-3 font-semibold transition">
                    {{ __('My Rentals') }}
                </a>

                <a href="{{ route('my-listings') }}"
                    class="{{ request()->routeIs('my-listings') || request()->routeIs('add-item') || request()->routeIs('item.view') ? 'bg-[#2850d8] text-white' : 'text-slate-600 hover:bg-white hover:text-slate-900' }} block rounded-xl px-4 py-3 font-semibold transition">
                    {{ __('My Listings') }}
                </a>
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
        </div>
    </div>
</nav>
