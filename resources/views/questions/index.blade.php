<x-default-layout>
    <x-slot:title>
        {{ __('ui.questions.index.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.questions.index.description', ['app_name' => config('app.name')]) }}
    </x-slot>

    <h1 class="text-2xl font-bold dark:text-white">
        {{ __('ui.questions.index.title') }}
    </h1>

    <p class="mt-4 dark:text-gray-300">
        {{ __('ui.questions.index.description', ['app_name' => config('app.name')]) }}
    </p>

    @if ($errors->any())
        <div class="mt-4 p-4 bg-red-50 dark:bg-red-900/20 border border-red-200 dark:border-red-800 rounded-md">
            <p class="text-sm text-red-600 dark:text-red-400">
                {{ __('ui.questions.errors.missing_answers') }}
            </p>
        </div>
    @endif

    <form method="POST" action="/questions" class="mt-8">
        @csrf

        <div class="space-y-6">
            @foreach ($questions as $index => $question)
                <article class="bg-white dark:bg-slate-800 rounded-lg shadow-md p-6">
                    <header class="mb-4">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="h-8 w-8 rounded-full bg-teal-600 dark:bg-purple-900 flex items-center justify-center text-white text-sm font-semibold">
                                {{ $index + 1 }}
                            </div>
                            <p class="font-semibold text-gray-900 dark:text-white">
                                {{ $question->question }}
                            </p>
                        </div>

                        @error("answers.{$question->id}")
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                        @enderror
                    </header>

                    <div class="pt-4 border-t border-gray-200 dark:border-gray-700 grid grid-cols-2 gap-4">
                        <label class="flex items-center gap-3 p-3 rounded-md border cursor-pointer
                            {{ optional($question->answers->first())->answer === 'a'
                                ? 'border-teal-500 dark:border-purple-500 bg-teal-50 dark:bg-purple-900/20'
                                : 'border-gray-200 dark:border-gray-700 hover:border-teal-400 dark:hover:border-purple-600 hover:bg-teal-50 dark:hover:bg-slate-700' }}">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="a"
                                {{ optional($question->answers->first())->answer === 'a' ? 'checked' : '' }}
                                class="accent-teal-600 dark:accent-purple-500"
                            />
                            <span class="text-gray-700 dark:text-gray-300 text-sm">
                                {{ $question->option_a }}
                            </span>
                        </label>

                        <label class="flex items-center gap-3 p-3 rounded-md border cursor-pointer
                            {{ optional($question->answers->first())->answer === 'b'
                                ? 'border-teal-500 dark:border-purple-500 bg-teal-50 dark:bg-purple-900/20'
                                : 'border-gray-200 dark:border-gray-700 hover:border-teal-400 dark:hover:border-purple-600 hover:bg-teal-50 dark:hover:bg-slate-700' }}">
                            <input
                                type="radio"
                                name="answers[{{ $question->id }}]"
                                value="b"
                                {{ optional($question->answers->first())->answer === 'b' ? 'checked' : '' }}
                                class="accent-teal-600 dark:accent-purple-500"
                            />
                            <span class="text-gray-700 dark:text-gray-300 text-sm">
                                {{ $question->option_b }}
                            </span>
                        </label>
                    </div>
                </article>
            @endforeach
        </div>

        <button type="submit"
            class="mt-6 block w-full px-4 py-2 bg-teal-600 dark:bg-purple-900 text-white rounded-md hover:bg-teal-700 dark:hover:bg-purple-800 text-center">
            {{ __('ui.questions.form.submit') }}
        </button>
    </form>
</x-default-layout>
