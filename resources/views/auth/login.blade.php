<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50">

        <div class="w-full sm:max-w-md mt-6 px-10 py-12 bg-white shadow-xl shadow-slate-200/50 rounded-2xl border border-slate-100 text-center">

            <div class="flex justify-center mb-6">
                <div class="bg-blue-50 text-blue-600 rounded-full p-4">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-3xl font-extrabold text-slate-900 tracking-tight">Welcome Back</h2>
            <p class="text-slate-500 mt-2 mb-8">Sign in to your Campus Rental account</p>

            <x-validation-errors class="mb-4 text-left" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="text-left">
                    <x-label for="email" value="{{ __('Email Address') }}" class="text-sm font-medium text-slate-700" />
                    <x-input id="email" class="block mt-2 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-lg transition-all" type="email" name="email" :value="old('email')" required autofocus placeholder="name@university.edu" />
                </div>

                <div class="mt-5 text-left">
                    <div class="flex justify-between">
                        <x-label for="password" value="{{ __('Password') }}" class="text-sm font-medium text-slate-700" />
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:text-blue-500 font-medium transition" href="{{ route('password.request') }}">
                                {{ __('Forgot password?') }}
                            </a>
                        @endif
                    </div>
                    <x-input id="password" class="block mt-2 w-full bg-slate-50 border-slate-200 focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 rounded-lg transition-all" type="password" name="password" required placeholder="••••••••" />
                </div>

                <div class="block mt-4 text-left">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" class="text-blue-600 rounded border-slate-300 focus:ring-blue-500/20" />
                        <span class="ms-2 text-sm text-slate-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="mt-8">
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 active:scale-[0.98] text-white font-semibold py-3 rounded-lg shadow-sm transition-all duration-200">
                        Sign in
                    </button>
                </div>
            </form>

            <div class="mt-8 pt-6 border-t border-slate-100 text-sm text-slate-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-blue-600 font-semibold hover:text-blue-500 transition">Sign up</a>
            </div>
        </div>
    </div>
</x-guest-layout>