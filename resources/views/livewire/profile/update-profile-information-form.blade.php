<form wire:submit="updateProfileInformation">
    <div>
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="grid gap-8 xl:grid-cols-[12rem_minmax(0,1fr)]" x-data="{photoName: null, photoPreview: null}">
                <div class="space-y-4">
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

                    <div x-show="! photoPreview">
                        <img src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" class="h-40 w-40 rounded-2xl object-cover ring-2 ring-blue-100 shadow-xl shadow-blue-600/20 dark:ring-blue-900">
                    </div>

                    <div x-show="photoPreview" style="display: none;">
                        <span class="block h-40 w-40 rounded-2xl bg-cover bg-no-repeat bg-center ring-2 ring-blue-100 shadow-xl shadow-blue-600/20 dark:ring-blue-900"
                            x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <x-secondary-button class="w-40 justify-center" type="button" x-on:click.prevent="$refs.photo.click()">
                        {{ __('Select A New Photo') }}
                    </x-secondary-button>

                    @if (Auth::user()->profile_photo_path)
                        <x-secondary-button type="button" class="w-40 justify-center" wire:click="deleteProfilePhoto">
                            {{ __('Remove Photo') }}
                        </x-secondary-button>
                    @endif

                    <x-input-error for="photo" class="mt-2" />
                </div>

                <div>
                    @include('profile.partials.editable-profile-fields')
                </div>
            </div>
        @else
            <div>
                @include('profile.partials.editable-profile-fields')
            </div>
        @endif
    </div>

    <div class="mt-8 flex items-center justify-end gap-3 border-t border-slate-200/70 pt-5 dark:border-slate-700/70">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </div>
</form>
