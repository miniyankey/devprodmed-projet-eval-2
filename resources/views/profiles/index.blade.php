<x-default-layout>
    <x-slot:title>
        {{ __('ui.profiles.index.title') }}
    </x-slot>
    <x-slot:description>
        {{ __('ui.profiles.index.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        {{ __('ui.profiles.index.title') }}
    </h1>
    <p class="mt-4 dark:text-gray-300">
        {{ __('ui.profiles.index.description', ['app_name' => config('app.name')]) }}
    </p>

    @if (session('success'))
        <p class="mt-4 text-green-600 dark:text-green-400">{{ session('success') }}</p>
    @endif

    @if (session('error'))
        <p class="mt-4 text-red-600 dark:text-red-400">{{ session('error') }}</p>
    @endif

    <div class="mt-8 space-y-6">
        @forelse ($profiles as $profile)
            <x-profile-card :profile="$profile" :liked="0"/>
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('ui.profiles.index.empty') }}
            </p>
        @endforelse
    </div>
</x-default-layout>
