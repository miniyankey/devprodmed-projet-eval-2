<x-default-layout>
  <x-slot:title>
        {{ __('ui.welcome.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.welcome.description') }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">{{ __('ui.welcome.h1', ['username' => auth()->user()->username, 'app_name' => config('app.name')]) }}</h1>
    <p class="mt-4 dark:text-gray-300">{{__('ui.welcome.connected')}}</p>
    <a href="{{ url('/profiles') }}"
        class="block bg-teal-700 dark:bg-purple-900 px-3 py-1 rounded-md hover:bg-teal-800 dark:hover:bg-purple-800">
        {{ __('ui.profiles.name') }}
    </a>
</x-default-layout>
