@extends('front.tests.master')

@section('course.content')
<div class="program__content">
    <div class="report">
        <h3 class="report__title">Анкетирование</h3>

        <div class="report__preview">
            <p>
                Уважаемые слушатели!
            </p>
            <p>
                Просим Вас принять участие в нашем исследовании и оценить результаты образовательного процесса в системе дистанционных образовательных технологий, с целью выявления степени удовлетворенности обучением. Прохождение анкетирования займет у Вас не более 2 минут.
            </p>
            <p>
                После прохождения анкетирования Вам будет открыт <b>доступ к итоговому тестированию</b>
            </p>
        </div>

        <form method="post" action="{{ route("profile.courses.test.anketa", $obCourse) }}">@csrf
            <div class="report__item">
                <div class="report__label">
                    Как Вы оцениваете качество поданного к изучению материала по программе?
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report1" name="q1" class="custom-control-input" value="Отлично, все понятно и интересно" required>
                    <label class="custom-control-label" for="report1">Отлично, все понятно и интересно</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report2" name="q1" class="custom-control-input" value="Хорошо, но хотелось бы больше дополнительных материалов по изучаемым темам">
                    <label class="custom-control-label" for="report2">Хорошо, но хотелось бы больше дополнительных материалов по изучаемым темам</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report3" name="q1" class="custom-control-input" value="Удовлетворительно, я полностью не освоил (-ла) материал">
                    <label class="custom-control-label" for="report3">Удовлетворительно, я полностью не освоил (-ла) материал</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report4" name="q1" class="custom-control-input" value="Плохо, темы не понимаю">
                    <label class="custom-control-label" for="report4">Плохо, темы не понимаю</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report5" name="q1" class="custom-control-input" value="Затрудняюсь ответить">
                    <label class="custom-control-label" for="report5">Затрудняюсь ответить</label>
                </div>
            </div>

            <div class="report__item">
                <div class="report__label">
                    Удовлетворены ли Вы преподавателем (-ми) программы?
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report6" name="q2" class="custom-control-input" value="Да" required>
                    <label class="custom-control-label" for="report6">Да</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report7" name="q2" class="custom-control-input" value="Скорее да, чем нет">
                    <label class="custom-control-label" for="report7">Скорее да, чем нет</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report8" name="q2" class="custom-control-input" value="Скорее нет, чем да">
                    <label class="custom-control-label" for="report8">Скорее нет, чем да</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report9" name="q2" class="custom-control-input" value="Нет">
                    <label class="custom-control-label" for="report9">Нет</label>
                </div>
            </div>

            <div class="report__item">
                <div class="report__label">
                    Происходило ли своевременное информирование Вас по организационным вопросам обучения?
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report10" name="q3" class="custom-control-input" value="Да, постоянно" required>
                    <label class="custom-control-label" for="report10">Да, постоянно</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report11" name="q3" class="custom-control-input" value="Редко">
                    <label class="custom-control-label" for="report11">Редко</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report12" name="q3" class="custom-control-input" value="Не информируют вообще">
                    <label class="custom-control-label" for="report12">Не информируют вообще</label>
                </div>
            </div>

            <div class="report__item">
                <div class="report__label">
                    Удобно ли Вам пользоваться личным кабинетом на портале дистанционного образования?
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report13" name="q4" class="custom-control-input" value="Да" required>
                    <label class="custom-control-label" for="report13">Да</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report14" name="q4" class="custom-control-input" value="Нет">
                    <label class="custom-control-label" for="report14">Нет</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" id="report15" name="q4" class="custom-control-input" value="Испытываю некоторые трудности">
                    <label class="custom-control-label" for="report15">Испытываю некоторые трудности</label>
                </div>
            </div>

            <div class="report__item">
                <div class="report__label">
                    Что Вам больше всего понравилось при прохождении обучения?
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="report16" name="q5[]" class="custom-control-input" value="Возможность повторно посмотреть материалы по предмету">
                    <label class="custom-control-label" for="report16">Возможность повторно посмотреть материалы по предмету</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="report17" name="q5[]" class="custom-control-input" value="Использование современных технологий обучения">
                    <label class="custom-control-label" for="report17">Использование современных технологий обучения</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="report18" name="q5[]" class="custom-control-input" value="Возможность совмещать работу с учебой">
                    <label class="custom-control-label" for="report18">Возможность совмещать работу с учебой</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="report19" name="q5[]" class="custom-control-input" value="Своевременное информирование об этапах обучения">
                    <label class="custom-control-label" for="report19">Своевременное информирование об этапах обучения</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="report20" name="q5[]" class="custom-control-input" value="Быстрое решение куратором курса возникающих вопросов и проблем в процессе обучения">
                    <label class="custom-control-label" for="report20">Быстрое решение куратором курса возникающих вопросов и проблем в процессе обучения</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" id="report21" name="q5[]" class="custom-control-input" value="Затрудняюсь ответить">
                    <label class="custom-control-label" for="report21">Затрудняюсь ответить</label>
                </div>
            </div>

            <div class="report__item">
                <div class="report__label">
                    Оставьте свой отзыв о курсе (по желанию)
                </div>
                <textarea class="form-control" rows="5" name="q6"></textarea>
            </div>

            <div class="report__submit">
                <button type="submit" class="btn">Отправить</button>
            </div>
        </form>
    </div>
</div>
@endsection
