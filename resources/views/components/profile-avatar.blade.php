@props(['user' => null, 'size' => 'md', 'class' => ''])

@php
    $sizes = [
        'sm' => 'h-8 w-8',
        'md' => 'h-12 w-12',
        'lg' => 'h-16 w-16',
    ];
    $sizeClass = $sizes[$size] ?? $sizes['md'];
    
    $initials = collect(explode(' ', trim($user?->name ?? '')))
        ->filter()
        ->take(2)
        ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
        ->implode('');
@endphp

<div class="relative inline-flex items-center justify-center {{ $class }}">
    <!-- Gradient ring effect -->
    <div class="absolute inset-0 rounded-full bg-gradient-to-r from-primary-600 to-accent-600 p-0.5 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
    
    <!-- Avatar container -->
    <div class="relative {{ $sizeClass }} rounded-full overflow-hidden bg-gradient-to-br from-primary-100 to-accent-100 dark:from-primary-900 dark:to-accent-900 ring-2 ring-white dark:ring-slate-800">
        @if ($user && \Laravel\Jetstream\Jetstream::managesProfilePhotos() && $user->profile_photo_url)
            <img 
                class="h-full w-full object-cover" 
                src="{{ $user->profile_photo_url }}" 
                alt="{{ $user->name }}"
            >
        @else
            <!-- Gradient text for initials -->
            <div class="h-full w-full flex items-center justify-center">
                <span class="font-bold text-xs sm:text-sm bg-gradient-to-r from-primary-600 to-accent-600 dark:from-primary-400 dark:to-accent-400 bg-clip-text text-transparent">
                    {{ $initials }}
                </span>
            </div>
        @endif
    </div>
    
    <!-- Optional glow effect -->
    <div class="absolute -inset-1 rounded-full bg-gradient-to-r from-primary-400 to-accent-400 opacity-0 group-hover:opacity-20 blur transition-opacity duration-300 -z-10"></div>
</div>
