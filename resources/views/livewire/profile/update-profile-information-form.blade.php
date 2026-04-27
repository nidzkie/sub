<form wire:submit="updateProfileInformation">
    <div class="space-y-6">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="grid gap-6 lg:grid-cols-[16rem_minmax(0,1fr)]" x-data="{photoName: null, photoPreview: null}">
                <div>
                    <input type="file" id="photo" class="hidden"
                        wire:model.live="photo"
                        x-ref="photo"
                        x-on:change="
                            photoName = $refs.photo.files[0].name;
                            const reader = new FileReader();
                            reader.onload = (e) => {
                                photoPreview = e.target.result;
                            };
                            reader.readAsDataURL($refs.photo.files[0]);
                        " />

                    <x-label for="photo" value="{{ __('Photo') }}" />

                    <div class="mt-2" x-show="! photoPreview">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-36 w-36 rounded-2xl object-cover ring-2 ring-blue-100 shadow-xl shadow-blue-600/20 dark:ring-blue-900">
                    </div>

                    <div class="mt-2" x-show="photoPreview" style="display: none;">
                        <span class="block h-36 w-36 rounded-2xl bg-cover bg-no-repeat bg-center ring-2 ring-blue-100 shadow-xl shadow-blue-600/20 dark:ring-blue-900"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="me-2 mt-3" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-secondary-button>

                    @if (Auth::user()->profile_photo_path)
                        <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>

                <div class="space-y-5">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="first_name" value="{{ __('First Name') }}" />
                            <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model="state.first_name" required autocomplete="given-name" />
                            <x-input-error for="state.first_name" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="last_name" value="{{ __('Last Name') }}" />
                            <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="state.last_name" required autocomplete="family-name" />
                            <x-input-error for="state.last_name" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="email" value="{{ __('Email') }}" />
                            <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
                            <x-input-error for="state.email" class="mt-2" />

                            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && ! Auth::user()->hasVerifiedEmail())
                                <p class="mt-2 text-sm">
                                    {{ __('Your email address is unverified.') }}

                                    <button type="button" class="rounded-md text-sm text-slate-600 underline hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:text-slate-300 dark:hover:text-slate-100 dark:focus:ring-offset-slate-900" wire:click.prevent="sendEmailVerification">
                                        {{ __('Click here to re-send the verification email.') }}
                                    </button>
                                </p>

                                @if ($this->verificationLinkSent ?? false)
                                    <p class="mt-2 text-sm font-medium text-emerald-600 dark:text-emerald-400">
                                        {{ __('A new verification link has been sent to your email address.') }}
                                    </p>
                                @endif
                            @endif
                        </div>

                        <div>
                            <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                            <x-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="state.phone_number" autocomplete="tel" />
                            <x-input-error for="state.phone_number" class="mt-2" />
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <x-label for="course" value="{{ __('Course Program') }}" />
                            <x-input id="course" type="text" class="mt-1 block w-full" wire:model="state.course" />
                            <x-input-error for="state.course" class="mt-2" />
                        </div>

                        <div>
                            <x-label for="year_level" value="{{ __('Year Level') }}" />
                            <select id="year_level" wire:model="state.year_level" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                                <option value="">Select Year Level</option>
                                <option value="1st Year">1st Year</option>
                                <option value="2nd Year">2nd Year</option>
                                <option value="3rd Year">3rd Year</option>
                                <option value="4th Year">4th Year</option>
                                <option value="5th Year">5th Year</option>
                            </select>
                            <x-input-error for="state.year_level" class="mt-2" />
                        </div>
                    </div>

                    <div>
                        <x-label for="campus" value="{{ __('Campus') }}" />
                        <select id="campus" wire:model="state.campus" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">Select Campus</option>
                            <option value="Panabo">Panabo</option>
                            <option value="Digos">Digos</option>
                            <option value="Peñaplata">Peñaplata</option>
                            <option value="Bansalan">Bansalan</option>
                            <option value="Davao (Matina-Main)">Davao (Matina-Main)</option>
                            <option value="Davao (Bolton)">Davao (Bolton)</option>
                            <option value="Davao (Bangoy)">Davao (Bangoy)</option>
                            <option value="Tagum (Arellano)">Tagum (Arellano)</option>
                            <option value="Tagum (Visayan)">Tagum (Visayan)</option>
                        </select>
                        <x-input-error for="state.campus" class="mt-2" />
                    </div>
                </div>
            </div>
        @else
            <div class="space-y-5">
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="first_name" value="{{ __('First Name') }}" />
                        <x-input id="first_name" type="text" class="mt-1 block w-full" wire:model="state.first_name" required autocomplete="given-name" />
                        <x-input-error for="state.first_name" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="last_name" value="{{ __('Last Name') }}" />
                        <x-input id="last_name" type="text" class="mt-1 block w-full" wire:model="state.last_name" required autocomplete="family-name" />
                        <x-input-error for="state.last_name" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="email" value="{{ __('Email') }}" />
                        <x-input id="email" type="email" class="mt-1 block w-full" wire:model="state.email" required autocomplete="username" />
                        <x-input-error for="state.email" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="phone_number" value="{{ __('Phone Number') }}" />
                        <x-input id="phone_number" type="text" class="mt-1 block w-full" wire:model="state.phone_number" autocomplete="tel" />
                        <x-input-error for="state.phone_number" class="mt-2" />
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <x-label for="course" value="{{ __('Course Program') }}" />
                        <x-input id="course" type="text" class="mt-1 block w-full" wire:model="state.course" />
                        <x-input-error for="state.course" class="mt-2" />
                    </div>

                    <div>
                        <x-label for="year_level" value="{{ __('Year Level') }}" />
                        <select id="year_level" wire:model="state.year_level" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                            <option value="">Select Year Level</option>
                            <option value="1st Year">1st Year</option>
                            <option value="2nd Year">2nd Year</option>
                            <option value="3rd Year">3rd Year</option>
                            <option value="4th Year">4th Year</option>
                            <option value="5th Year">5th Year</option>
                        </select>
                        <x-input-error for="state.year_level" class="mt-2" />
                    </div>
                </div>

                <div>
                    <x-label for="campus" value="{{ __('Campus') }}" />
                    <select id="campus" wire:model="state.campus" class="mt-1 block w-full rounded-xl border border-slate-200 bg-white px-3 py-2.5 text-sm text-slate-900 focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500/20 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-100">
                        <option value="">Select Campus</option>
                        <option value="Panabo">Panabo</option>
                        <option value="Digos">Digos</option>
                        <option value="Peñaplata">Peñaplata</option>
                        <option value="Bansalan">Bansalan</option>
                        <option value="Davao (Matina-Main)">Davao (Matina-Main)</option>
                        <option value="Davao (Bolton)">Davao (Bolton)</option>
                        <option value="Davao (Bangoy)">Davao (Bangoy)</option>
                        <option value="Tagum (Arellano)">Tagum (Arellano)</option>
                        <option value="Tagum (Visayan)">Tagum (Visayan)</option>
                    </select>
                    <x-input-error for="state.campus" class="mt-2" />
                </div>
            </div>
        @endif
    </div>

    <div class="mt-6 flex items-center justify-end border-t border-slate-200/70 pt-4 dark:border-slate-700/70">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
