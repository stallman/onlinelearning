@extends('front.tests.master')

@section('course.content')
        <div class="testing">
            <h3 class="testing__title">Итоговое тестирование</h3>

            <div class="test-title">Ваш результат:</div>
            @if($iResult >= $obCourse->test->minimal_right_questions)
                <div class="testing__result bg-success">
                    Тест сдан
                </div>
            @else
                <div class="testing__result bg-danger">
                    Тест не сдан
                </div>
                <div class="alert alert-light">
                    Тест не сдан по баллам, либо не отвечен вопрос, требующий обязательного правильно ответа.
                </div>
            @endif

            <table class="table table-borderless">
                <tbody>
                <tr>
                    <td>Количество вопросов</td>
                    <td class="test-total">{{ count($obCourse->test->questions) }}</td>
                </tr>
                <tr>
                    <td>Количество правильных ответов</td>
                    <td class="test-total">{{ $iResult }}</td>
                </tr>
                <tr>
                    <td>Максимальное количество баллов</td>
                    <td class="test-total">{{ count($obCourse->test->questions) }}</td>
                </tr>
                <tr>
                    <td>Количество набранных баллов</td>
                    <td class="test-total">{{ $iResult }}
                        @if (count($obCourse->test->questions) !== 0)
                            ({{ number_format((100 / count($obCourse->test->questions))*$iResult, 2) }} %)
                        @endif
                    </td>
                </tr>
                </tbody>
            </table>

            <div class="test-submit">
                <a href="{{ route("profile.courses.test.reset", $obCourse) }}" class="btn btn-primary px-5">пройти еще раз</a>
            </div>
        </div>
@endsection
