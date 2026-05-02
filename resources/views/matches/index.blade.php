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
            <article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <a href="{{ url('@' . $match->username) }}">
                            <div class="h-10 w-10 rounded-full bg-teal-600 dark:bg-purple-900 flex items-center justify-center text-white font-semibold hover:bg-teal-700 dark:hover:bg-purple-800">
                                {{ strtoupper(substr($match->first_name, 0, 1) . substr($match->last_name, 0, 1)) }}
                            </div>
                        </a>
                        <div>
                            <a href="{{ url('@' . $match->username) }}" class="hover:underline">
                                <p class="font-semibold text-gray-900 dark:text-white">
                                    {{ $match->first_name }} {{ $match->last_name }}
                                </p>
                            </a>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ '@' . $match->username }}
                            </p>
                        </div>
                    </div>

                    <div class="flex items-center gap-3">
                        <a href="{{ url('@' . $match->username) }}"
                            class="px-4 py-2 border border-teal-600 dark:border-purple-900 text-teal-600 dark:text-purple-400 rounded-md hover:bg-teal-50 dark:hover:bg-slate-700 text-sm">
                            {{ __('ui.profiles.view_profile') }}
                        </a>
                        <form method="POST" action="{{ url('/users/' . $match->username . '/like') }}">
                            @csrf
                            @method('POST')
                            <button type="submit"
                                class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 text-sm">
                                {{ __('ui.matches.unmatch') }}
                            </button>
                        </form>
                    </div>
                </div>
            </article>
        @empty
            <p class="text-gray-500 dark:text-gray-400">
                {{ __('ui.matches.index.empty') }}
            </p>
        @endforelse
</x-default-layout>
