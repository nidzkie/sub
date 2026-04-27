<x-app-layout>
    <div class="min-h-screen bg-white font-sans text-slate-900 antialiased transition-colors dark:bg-slate-950 dark:text-slate-100">
        @php
            $user = Auth::user();
            $initials = collect(explode(' ', trim($user->name)))
                ->filter()
                ->take(2)
                ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
                ->implode('');
        @endphp

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
            <section class="mb-10 overflow-hidden rounded-3xl border border-slate-200/70 bg-gradient-to-br from-slate-50 via-white to-blue-50 shadow-lg dark:border-slate-700/70 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800">
                <div class="relative grid gap-8 px-6 py-8 sm:px-8 lg:grid-cols-[1.45fr_1fr] lg:items-center lg:py-10">
                    <div>
                        <div class="mb-5 inline-flex items-center gap-2 rounded-full bg-blue-100 px-4 py-2 text-xs font-bold uppercase tracking-[0.2em] text-blue-700 ring-1 ring-blue-200 dark:bg-blue-500/15 dark:text-blue-300 dark:ring-blue-500/30">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M7 12h10M10 18h4" />
                            </svg>
                            Manage Account
                        </div>

                        <h1 class="text-2xl font-black tracking-tight text-slate-900 sm:text-5xl lg:text-4xl dark:text-slate-50">
                            Your account, tuned to you.
                        </h1>
                        <p class="mt-4 max-w-2xl text-lg leading-relaxed text-slate-600 dark:text-slate-300">
                            Manage profile details, password protection, and appearance preferences.
                        </p>
                    </div>

                    <div class="rounded-2xl border border-slate-200/80 bg-white/85 p-4 shadow-xl shadow-slate-900/10 backdrop-blur dark:border-slate-700/80 dark:bg-slate-900/85 dark:shadow-slate-900/40">
                        <div class="mb-3 flex flex-wrap items-center gap-2">
                            <span class="rounded-full bg-blue-100 px-3 py-1.5 text-xs font-bold uppercase tracking-[0.18em] text-blue-700 ring-1 ring-blue-200 dark:bg-blue-500/15 dark:text-blue-300 dark:ring-blue-500/30">
                                Account Settings
                            </span>
                            <span class="rounded-full bg-slate-100 px-3 py-1.5 text-xs font-semibold text-slate-600 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700">
                                {{ $user->email }}
                            </span>
                        </div>

                        <div class="grid gap-2 sm:grid-cols-3">
                            <a href="#profile" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-800 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                </svg>
                                Profile
                            </a>
                            <a href="#security" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-800 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                Security
                            </a>
                            <a href="#appearance" class="inline-flex items-center justify-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-semibold text-slate-800 transition hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-100 dark:hover:bg-slate-700">
                                <svg class="h-4 w-4 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3" />
                                </svg>
                                Appearance
                            </a>
                        </div>
                    </div>
                </div>
            </section>

            <section class="grid gap-8 lg:grid-cols-[18rem_minmax(0,1fr)]">
                <aside class="lg:sticky lg:top-24 lg:h-fit">
                    <div class="rounded-3xl border border-slate-200/70 bg-white/90 p-5 shadow-xl shadow-slate-900/10 backdrop-blur dark:border-slate-700/70 dark:bg-slate-900/90 dark:shadow-slate-900/40">
                        <div class="rounded-3xl border border-slate-200/80 bg-slate-50/90 p-5 shadow-inner shadow-slate-900/5 dark:border-slate-700/80 dark:bg-slate-900/80">
                            <div class="flex items-center gap-4">
                                <div class="inline-flex h-16 w-16 items-center justify-center rounded-full bg-gradient-to-br from-blue-500 to-violet-600 text-xl font-black text-white ring-2 ring-white shadow-lg shadow-blue-600/30 dark:ring-slate-900">
                                    {{ $initials }}
                                </div>

                                <div class="min-w-0">
                                    <h2 class="truncate text-m font-bold text-slate-900 dark:text-slate-50">{{ $user->name }}</h2>
                                    <p class="truncate text-sm text-slate-600 dark:text-slate-400">{{ $user->email }}</p>
                                </div>
                            </div>

                            <div class="mt-5 inline-flex items-center gap-2 rounded-full bg-blue-100 px-3 py-1 text-xs font-bold uppercase tracking-[0.14em] text-blue-700 ring-1 ring-blue-200 dark:bg-blue-500/15 dark:text-blue-300 dark:ring-blue-500/30">
                                <span class="inline-block h-2 w-2 rounded-full bg-blue-500"></span>
                                VERIFIED STUDENT
                            </div>
                        </div>

                        <div class="mt-6">
                            <p class="mb-3 px-1 text-xs font-bold uppercase tracking-[0.22em] text-slate-500 dark:text-slate-400">Settings</p>

                            <nav class="space-y-2">
                                <a href="#profile" class="inline-flex w-full items-center gap-3 rounded-2xl bg-gradient-to-r from-blue-100 to-blue-50 px-4 py-3 text-sm font-semibold text-blue-800 ring-1 ring-blue-200 transition hover:brightness-105 dark:from-blue-900/40 dark:to-blue-800/20 dark:text-blue-300 dark:ring-blue-500/30">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-blue-200/80 text-blue-700 dark:bg-blue-500/20 dark:text-blue-300">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </span>
                                    Profile
                                </a>

                                <a href="#security" class="inline-flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800/80">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </span>
                                    Security
                                </a>

                                <a href="#appearance" class="inline-flex w-full items-center gap-3 rounded-2xl px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-100 dark:text-slate-200 dark:hover:bg-slate-800/80">
                                    <span class="inline-flex h-10 w-10 items-center justify-center rounded-xl bg-slate-100 text-slate-500 ring-1 ring-slate-200 dark:bg-slate-800 dark:text-slate-300 dark:ring-slate-700">
                                        <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v18m9-9H3" />
                                        </svg>
                                    </span>
                                    Appearance
                                </a>
                            </nav>
                        </div>
                    </div>
                </aside>

                <div class="space-y-6">


                    <div id="profile" class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/85 shadow-lg shadow-slate-900/5 backdrop-blur-xl dark:border-slate-700/70 dark:bg-slate-900/85 dark:shadow-slate-900/40">
                        <div class="border-b border-slate-200/70 px-6 py-4 dark:border-slate-700/70">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-slate-50">Profile Information</h2>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Update your account's profile information and email address.</p>
                        </div>
                        <div class="p-6">
                            @livewire('profile.update-profile-information-form')
                        </div>
                    </div>

                    <div id="security" class="overflow-hidden rounded-2xl border border-slate-200/70 bg-white/85 shadow-lg shadow-slate-900/5 backdrop-blur-xl dark:border-slate-700/70 dark:bg-slate-900/85 dark:shadow-slate-900/40">
                        <div class="border-b border-slate-200/70 px-6 py-4 dark:border-slate-700/70">
                            <h2 class="text-lg font-bold text-slate-900 dark:text-slate-50">Security</h2>
                            <p class="mt-1 text-sm text-slate-600 dark:text-slate-400">Ensure your account is using a long, random password to stay secure.</p>
                        </div>
                        <div class="p-6">
                            @livewire('profile.update-password-form')
                        </div>
                    </div>

                    <div class="overflow-hidden rounded-2xl border border-red-200/70 bg-red-50/80 shadow-lg shadow-red-900/5 backdrop-blur-xl dark:border-red-900/40 dark:bg-red-950/30">
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
            </section>
        </div>
    </div>
</x-app-layout>
