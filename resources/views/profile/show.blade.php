<x-app-layout>
    <div class="min-h-screen bg-white font-sans text-slate-900 antialiased transition-colors dark:bg-slate-950 dark:text-slate-100">
        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <!-- Profile Header Section -->
            <div class="mb-8 overflow-hidden rounded-2xl border border-slate-200/70 bg-gradient-to-br from-blue-600 via-blue-500 to-violet-600 shadow-lg dark:border-slate-700/70">
                <div class="pointer-events-none absolute inset-0 overflow-hidden">
                    <div class="absolute -right-32 -top-32 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
                    <div class="absolute -bottom-24 -left-24 h-56 w-56 rounded-full bg-white/5 blur-2xl"></div>
                </div>
                <div class="relative px-6 py-12 sm:px-8 sm:py-16">
                    <div class="flex flex-col items-start justify-between gap-6 sm:flex-row sm:items-center">
                        <div class="flex items-center gap-4">
                            <div class="flex h-24 w-24 items-center justify-center rounded-2xl bg-white/20 text-3xl font-black text-white shadow-xl shadow-black/20 backdrop-blur ring-2 ring-white/30">
                                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                            </div>
                            <div>
                                <h1 class="text-3xl font-black text-white sm:text-4xl">{{ Auth::user()->name }}</h1>
                                <p class="mt-1 text-blue-100">{{ Auth::user()->email }}</p>
                                <div class="mt-3 inline-flex items-center gap-2 rounded-full bg-white/15 px-3 py-1 text-xs font-semibold text-white backdrop-blur ring-1 ring-white/30">
                                    <svg class="h-3.5 w-3.5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-1 14.414-3.707-3.707 1.414-1.414L11 13.586l5.293-5.293 1.414 1.414z"/></svg>
                                    STUDENT VERIFIED
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="grid gap-8 lg:grid-cols-4">
                <!-- Left Sidebar Navigation -->
                <aside class="lg:col-span-1">
                    <div class="sticky top-24 space-y-4">
                        {{-- Settings Nav --}}
                        <div class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/80 p-2 shadow-lg shadow-slate-900/5 backdrop-blur-xl transition duration-300 hover:shadow-xl dark:border-slate-700/70 dark:bg-slate-900/80 dark:shadow-slate-900/40">
                            <p class="px-4 py-2 text-xs font-bold uppercase tracking-widest text-slate-500 dark:text-slate-400">Settings</p>
                            <nav class="space-y-1">
                                <a href="{{ route('profile.show') }}"
                                   class="{{ request()->routeIs('profile.show') ? 'bg-gradient-to-r from-blue-600 to-violet-600 text-white shadow-md shadow-blue-600/20' : 'text-slate-600 hover:bg-slate-100/80 dark:text-slate-400 dark:hover:bg-slate-800/80' }} flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold transition duration-200">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    Profile
                                </a>
                                <a href="{{ route('profile.show') }}#security"
                                   class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-600 transition duration-200 hover:bg-slate-100/80 dark:text-slate-400 dark:hover:bg-slate-800/80">
                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                    Security
                                </a>
                            </nav>
                        </div>
                    </div>
                </aside>

                <!-- Right Content -->
                <div class="lg:col-span-3 space-y-6">

                    {{-- Profile Information Section --}}
                    <div class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/80 shadow-lg shadow-slate-900/5 backdrop-blur-xl transition duration-300 hover:shadow-xl dark:border-slate-700/70 dark:bg-slate-900/80 dark:shadow-slate-900/40">
                        <div class="border-b border-slate-200/70 px-6 py-4 dark:border-slate-700/70">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-slate-50">Profile Information</h2>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Update your account's profile information and email address.</p>
                        </div>
                        <div class="p-6">
                            @livewire('profile.update-profile-information-form')
                        </div>
                    </div>

                    {{-- Security Section --}}
                    <div id="security" class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/80 shadow-lg shadow-slate-900/5 backdrop-blur-xl transition duration-300 hover:shadow-xl dark:border-slate-700/70 dark:bg-slate-900/80 dark:shadow-slate-900/40">
                        <div class="border-b border-slate-200/70 px-6 py-4 dark:border-slate-700/70">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-slate-50">Security</h2>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="p-6">
                            @livewire('profile.update-password-form')
                        </div>
                    </div>

                    {{-- Delete Account Section --}}
                    <div class="overflow-hidden rounded-2xl border border-red-200/70 bg-red-50/80 shadow-lg shadow-red-900/5 backdrop-blur-xl transition duration-300 hover:shadow-xl dark:border-red-900/40 dark:bg-red-950/30">
                        <div class="border-b border-red-200/70 px-6 py-4 dark:border-red-900/40">
                            <h2 class="text-lg font-bold text-red-600 dark:text-red-400">Delete Account</h2>
                            <p class="mt-1 text-sm text-red-600/70 dark:text-red-400/70">Permanently delete your account and all data.</p>
                        </div>
                        <div class="p-6">
                            <div class="mb-4 text-sm text-red-700 dark:text-red-300">
                                Once your account is deleted, all of its resources and data will be permanently deleted. Please download any data or information that you wish to retain before proceeding.
                            </div>
                            @livewire('profile.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>