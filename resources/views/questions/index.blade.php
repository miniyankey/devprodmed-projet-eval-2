<x-default-layout>
    <x-slot:title>
        {{ __('ui.questions.index.title') }}
    </x-slot>

    <x-slot:description>
        {{ __('ui.questions.index.description', ['app_name' => config('app.name')]) }}
    </x-slot>
    <form method="POST" action="/questions">
    @csrf

    @error('answers')
        <div class="error">{{ $message }}</div>
    @enderror

    @foreach ($questions as $question)
        <div class="question-block">
            <p>{{ $question->question }}</p>

            @error("answers.{$question->id}")
                <span class="error">{{ $message }}</span>
            @enderror

            <label>
                <input
                    type="radio"
                    name="answers[{{ $question->id }}]"
                    value="a"
                    {{ optional($question->answers->first())->answer === 'a' ? 'checked' : '' }}
                />
                {{ $question->option_a }}
            </label>

            <label>
                <input
                    type="radio"
                    name="answers[{{ $question->id }}]"
                    value="b"
                    {{ optional($question->answers->first())->answer === 'b' ? 'checked' : '' }}
                />
                {{ $question->option_b }}
            </label>
        </div>
    @endforeach

    <button type="submit">Enregistrer mes réponses</button>
</form>
</x-default-layout>
