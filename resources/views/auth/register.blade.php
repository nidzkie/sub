<x-guest-layout>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[#E8F1FF]">

        <div class="w-full sm:max-w-md mt-6 px-10 py-10 bg-white shadow-lg overflow-hidden sm:rounded-xl border border-gray-100 text-center">

            <div class="flex justify-center mb-4">
                <div class="bg-blue-600 rounded-full p-3 shadow-md">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
            </div>

            <h2 class="text-2xl font-bold text-gray-800">Create Account</h2>
            <p class="text-gray-500 text-sm mb-6">Join the Campus Rental community</p>

            <x-validation-errors class="mb-4 text-left" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="text-left">
                    <x-label for="name" value="{{ __('Full Name') }}" class="font-semibold text-gray-700" />
                    <x-input id="name" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="text" name="name" :value="old('name')" required autofocus placeholder="Juan Dela Cruz" />
                </div>

                <div class="mt-4 text-left">
                    <x-label for="email" value="{{ __('Email') }}" class="font-semibold text-gray-700" />
                    <x-input id="email" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="email" name="email" :value="old('email')" required placeholder="juan.dela@gmail.com" />
                </div>

                <div class="mt-4 text-left">
                    <x-label for="password" value="{{ __('Password') }}" class="font-semibold text-gray-700" />
                    <x-input id="password" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="password" name="password" required placeholder="••••••••" />
                </div>

                <div class="mt-4 text-left">
                    <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" class="font-semibold text-gray-700" />
                    <x-input id="password_confirmation" class="block mt-1 w-full bg-gray-50 border-gray-200 focus:border-blue-500 focus:ring-blue-500 rounded-lg" type="password" name="password_confirmation" required placeholder="••••••••" />
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="mt-4 text-left">
                        <x-label for="terms">
                            <div class="flex items-center">
                                <x-checkbox name="terms" id="terms" required class="text-blue-600 rounded focus:ring-blue-500" />
                                <div class="ms-2 text-xs text-gray-600">
                                    {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                            'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline hover:text-blue-600">'.__('Terms').'</a>',
                                            'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline hover:text-blue-600">'.__('Privacy').'</a>',
                                    ]) !!}
                                </div>
                            </div>
                        </x-label>
                    </div>
                @endif

                <div class="mt-8">
                    <button type="submit" class="w-full bg-[#0D1117] hover:bg-black text-white font-bold py-3 rounded-lg transition duration-200">
                        Create Account
                    </button>
                </div>
            </form>

            <div class="mt-6 text-sm text-gray-600">
                Already have an account?
                <a href="{{ route('login') }}" class="text-blue-600 font-semibold hover:underline">Sign in</a>
            </div>
        </div>
    </div>
</x-guest-layout>