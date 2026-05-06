<article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
    <header class="mb-4">
        <div class="flex items-center gap-3">
            <a href="{{ url('@' . $profile->username) }}">
                <div class="h-10 w-10 rounded-full bg-teal-600 dark:bg-purple-900 flex items-center justify-center text-white font-semibold hover:bg-teal-700 dark:hover:bg-purple-800">
                    {{ strtoupper(substr($profile->first_name, 0, 1) . substr($profile->last_name, 0, 1)) }}
                </div>
            </a>
            <div>
                <a href="{{ url('@' . $profile->username) }}" class="hover:underline">
                    <p class="font-semibold text-gray-900 dark:text-white">
                        {{ $profile->first_name }} {{ $profile->last_name }}
                    </p>
                </a>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                    {{ '@' . $profile->username }}
                </p>
            </div>
        </div>
    </header>

    <footer class="pt-4 border-t border-gray-200 dark:border-gray-700">
        <div class="flex items-center justify-between text-sm text-gray-600 dark:text-gray-400">
            <form method="POST" action="{{ url('/users/' . $profile->username . '/like') }}">
                @csrf
                <button type="submit"
                    class="px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800">
                    {{ trans_choice('ui.profiles.like', $liked) }}
                </button>
            </form>
            <a href="{{ url('@' . $profile->username) }}"
                class="px-4 py-2 border border-teal-600 dark:border-purple-900 text-teal-600 dark:text-purple-400 rounded-md hover:bg-teal-50 dark:hover:bg-slate-700">
                {{ __('ui.profiles.view_profile') }}
            </a>
        </div>
    </footer>
</article>
