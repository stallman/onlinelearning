@extends('front.tests.master')

@section('course.content')
    <div class="program__content">
        <div class="testing">
            <h3 class="testing__title">Итоговое тестирование</h3>

            @include('front.components.tests.timer', ['date_in_ms' => Illuminate\Support\Facades\Auth::user()->getCourseTestEndedDate($obCourse)->getTimestampMs()])

            <ul class="answer-mark">
                @foreach($obCourse->test->questions as $obQ)
                    @isset($obQ->answered)
                        @if($obQ->answered->is_right === 1) <li class="valid"></li>
                        @elseif($obQ->answered->is_right === 0) <li class="invalid"></li>
                        @else <li class="not-checked"></li>@endif
                    @else <li></li>@endisset
                @endforeach
            </ul>

            <form method="post" action="{{ route('profile.courses.test',
                                                ['obCourse' => $obCourse, 'questionNum' => (int)$obQuestion->order + 1]) }}">
                @csrf
                <input type="hidden" name="question_type" value="{{ $obQuestion->type }}">
                <input type="hidden" name="question_id" value="{{ $obQuestion->id }}">
                <div class="test-question">
                    <div class="test-title">Вопрос {{ $obQuestion->order }} из {{ count($obCourse->test->questions) }}</div>
                    <p>
                        {!! $obQuestion->text !!}
                    </p>
                </div>
                @if($obQuestion->type === \App\Models\Question::TYPES['one']['type'])
                    <div class="test-answer">
                        <div class="test-title">Варианты ответов:</div>
                        <div class="test-answer-list">
                            @foreach($obQuestion->answers as $obAnswer)
                                <div class="test-answer-choice">
                                    <input type="radio" name="answer" id="{{ $obAnswer->id }}"
                                           value="{{ $obAnswer->id  }}">
                                    <label for="{{ $obAnswer->id }}">{!! $obAnswer->text !!}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @elseif($obQuestion->type === \App\Models\Question::TYPES['several']['type'])
                    <div class="test-answer">
                        <div class="test-title">Варианты ответов: <sup>*</sup></div>
                        <div class="test-answer-list">
                            @foreach($obQuestion->answers as $obAnswer)
                                <div class="test-answer-choice col-sm-6">
                                    <input type="checkbox" name="answer[]" id="{{ $obAnswer->id }}" value="{{ $obAnswer->id  }}">
                                    <label for="{{ $obAnswer->id }}">{!! $obAnswer->text !!}</label>
                                </div>
                            @endforeach
                        </div>
                        <div class="small">* ответов на этот вопрос может быть несколько</div>
                    </div>
                @elseif($obQuestion->type === \App\Models\Question::TYPES['text']['type'])
                    <div class="test-answer">
                        <div class="test-title">Ваш ответ:</div>
                        <textarea class="form-control" rows="5" name="answer"></textarea>
                    </div>
                @elseif($obQuestion->type === \App\Models\Question::TYPES['right_order']['type'])
                    <div class="test-answer">
                        <div class="test-title">Ваш ответ:</div>
                        @foreach($obQuestion->answers as $obAnswer)
                            <div class="form-group">
                                <select class="custom-select" name="answer[]">
                                    <option value="0">Выберите ответ</option>
                                    @foreach($obQuestion->answers as $obAnswer)
                                        <option value="{{ $obAnswer->id }}">{!! $obAnswer->text !!}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endforeach
                    </div>
                @endif
                <div class="test-submit">
{{--                    <a href="#" class="btn btn-danger">завершить</a>--}}
                    <button type="submit" class="btn btn-primary">далее</button>
                </div>
            </form>
        </div>
    </div>
@endsection
