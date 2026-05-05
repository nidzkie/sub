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
                    @include('profile.partials.editable-profile-fields')
                </div>
            </div>
        @else
            <div class="space-y-5">
                @include('profile.partials.editable-profile-fields')
            </div>
        @endif
    </div>

    <div class="mt-6 flex items-center justify-end border-t border-slate-200/70 pt-4 dark:border-slate-700/70">
        <x-action-message class="me-3 bg-blue-100 text-blue-700 px-3 py-1 rounded-full font-bold shadow-sm" on="saved">
            <i class="fas fa-check-circle me-1"></i> {{ __('Changes Applied! Your profile is updated.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
