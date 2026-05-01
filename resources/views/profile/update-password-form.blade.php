<form wire:submit="updatePassword" class="space-y-6">
    <div>
        <x-label for="current_password" value="{{ __('Current Password') }}" />
        <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model="state.current_password" autocomplete="current-password" />
        <x-input-error for="current_password" class="mt-2" />
    </div>

    <div>
        <x-label for="password" value="{{ __('New Password') }}" />
        <x-input id="password" type="password" class="mt-1 block w-full" wire:model="state.password" autocomplete="new-password" />
        <x-input-error for="password" class="mt-2" />
    </div>

    <div>
        <x-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
        <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model="state.password_confirmation" autocomplete="new-password" />
        <x-input-error for="password_confirmation" class="mt-2" />
    </div>

    <div class="flex items-center justify-end gap-3">
        <x-action-message class="me-2" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button>
            {{ __('Save') }}
        </x-button>
    </div>
</form>
