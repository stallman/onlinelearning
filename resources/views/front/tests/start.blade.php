@extends('front.tests.master')

@section('course.content')
    <div class="program__content">
        <div class="testing">
            {{--            @if(!$bIsTestAvailable)--}}
            {{--                <h3 class="testing__title">Итоговое тестирование не доступно</h3>--}}
            {{--                <p>Не все темы были прочитаны</p>--}}
            {{--            @else--}}
            <h3 class="testing__title">Итоговое тестирование</h3>

            @if ($afterAnketa)
                <div><b>Спасибо, что поучаствовали в анкетировании! Вам открыт доступ к тестированию</b></div><br/>
            @endif
            <div class="testing__start">

{{--                <div>--}}
{{--                    <p>--}}
{{--                        Для прохождения итоговой аттестации по курсу необходимо--}}
{{--                        выполнить тесты с количеством правильных ответов не менее--}}
{{--                        @if(count($obCourse->test->questions) !== 0)--}}
{{--                            {{ number_format((100 / count($obCourse->test->questions))--}}
{{--                                *$obCourse->test->minimal_right_questions, 2) }}%.--}}
{{--                        @else--}}
{{--                            none--}}
{{--                        @endif--}}
{{--                    </p>--}}
{{--                    <p>--}}
{{--                        На прохождение тестирование дается {{ $obCourse->test->allocated_time }}--}}
{{--                    </p>--}}
{{--                </div>--}}

                <p>
                    Результаты итоговой аттестации оцениваются по традиционной системе («Зачтено», «Не зачтено»)
                    в соответствии с нижеприведенными критериями:
                    <ul>
                        <li>
                            «Зачтено» - если слушатель выполнил тест итоговой аттестации с количеством правильных ответов от 71 % до 100 %.
                        </li>
                        <br>
                        <li>
                            «Не зачтено» – если слушатель выполнил тест итоговой аттестации с количеством правильных ответов 70 % и ниже.
                        </li>
                    </ul>
                </p>
                <p>
                    На прохождение тестирования дается 1 час 30 минут.
                </p>


                <a class="btn start-testing"
                   href="{{ route('profile.courses.test', ['obCourse' => $obCourse, 'questionNum' => 1]) }}">Начать
                    тестирование</a>
            </div>
            {{--            @endif--}}

        </div>
    </div>
@endsection
