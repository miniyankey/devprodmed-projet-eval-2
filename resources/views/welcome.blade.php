<x-default-layout>
  <x-slot:title>
        {{ __('ui.welcome.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.welcome.description') }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">{{ __('ui.welcome.h1', ['username' => auth()->user()->username, 'app_name' => config('app.name')]) }}</h1>
    <p class="mt-4 dark:text-gray-300">{{__('ui.welcome.connected')}}</p>
</x-default-layout>
