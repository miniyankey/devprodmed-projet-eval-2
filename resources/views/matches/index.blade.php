<x-default-layout>
    <x-slot:title>
        {{ __('ui.matches.index.title') }}
    </x-slot>
    <x-slot:description>
        {{ __('ui.matches.index.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        {{ __('ui.matches.index.title') }}
    </h1>
    <p class="mt-4 dark:text-gray-300">
        {{ __('ui.matches.index.description', ['app_name' => config('app.name')]) }}
    </p>

    <div class="mt-8 space-y-6">
         @forelse ($matches as $match)
            <x-profile-card :profile="$match" :liked="1" />
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('ui.profiles.index.empty') }}
            </p>
        @endforelse
</x-default-layout>
