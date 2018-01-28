@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">AbleTo Questionnaire</div>

                <div class="panel-body">
                    @include('layouts.flash')

                    @if (count($questionnaires) > 0)
                        @foreach ($questionnaires as $questionnaire)
                            <form method="POST" action="/answers">
                                {{ csrf_field() }}

                                <h3>{{ $questionnaire->name }}</h3>

                                @foreach ($questions as $question)
                                    <div class="question-group">
                                        @php
                                            $questionOptionList = $questionChoices[$questionnaire->id][$question->id];
                                        @endphp

                                        {{ $loop->index + 1 }}. <label for="question_{{ $loop->index }}" class="question-label">{{ $question->label }}</label>

                                        @foreach ($questionOptionList as $questionOption)
                                            <div class="question-option-group">
                                                <input type="{{ $question->type }}"
                                                       id="q_{{ $question->id }}_c_{{ $questionOption->id }}"
                                                       class="input-{{ $question->type }}"
                                                       name="q{{ $question->id }}{{ $question->type == 'checkbox' ? '[]' : '' }}"
                                                       value="{{ $questionOption->id }}"
                                                       {{ $question->required ? 'required="required"' : '' }}>

                                                <label for="q_{{ $question->id }}_c_{{ $questionOption->id }}" class="question-choice-label">
                                                    {{ $questionOption->label }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach

                                <input type="hidden" name="questionnaire" value="{{ $questionnaire->id }}">

                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </form>
                        @endforeach
                    @else
                        <div>There are no questions to display.</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
