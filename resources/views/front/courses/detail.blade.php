@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{asset('assets/img/fon-study.jpg')}})"></div>
            <div class="heading">
                <h1>Курс</h1>
            </div>
        </div>
        <div class="container">
            <div class="course__head">
                <div class="course__col">
                    <h2 class="course-name">{{ $obCourse->title }}</h2>
                    <div class="course-params">
                        <div class="course-period">{{ $obCourse->duration }} {{Lang::choice('неделя|недели|недель', $obCourse->duration, [], 'ru')}}</div>
                        @if($obCourse->is_nmo_balls)
                            <div class="course-nmo">Начисляются баллы НМО</div>
                        @endif
                    </div>
                    <div class="course-preview">
                        {!! $obCourse->description !!}
                    </div>
                </div>
                <div class="course__col">
                    <div class="course-params">

                    @if ($obCourse->studyforms()->first()) 
                        <ul class="course-finance">
                        @foreach($obCourse->studyforms()->get() as $obSf)
                            <li>{{$obSf->name}}</li>
                        @endforeach
                        </ul> 
                    @endif
                                                                       
{{--                        <a href="#" target="_blank" class="btn btn-download">Полное описание</a>--}}
                    </div>
                    <div class="course-image" style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($obCourse->image) }})"></div>
                    <div class="course-note">
                    @if($obCourse->education_level_id == 1)
                        * к освоению программы допускаются лица, имеющие высшее медицинское образование
                    @elseif ($obCourse->education_level_id == 2)
                        * к освоению программы допускаются лица, имеющие среднее медицинское образование
                    @endif
                    </div>
                    @if($obCourse->users->contains('id', \Illuminate\Support\Facades\Auth::id()))
                        <div class="course-sign-up">
                            <div class="alert alert-light">
                                Вы записаны на курс. <b>Дата начала:</b> {{ $obCourse->start_date }}
                            </div>
                            <a type="button" class="btn" href="{{ route('profile.courses.show', compact('obCourse')) }}">Начать обучение</a>
                        </div>
                    @else
                        <div class="course-sign-up">
                            <button type="button" class="btn" data-target="#signupCourse" data-toggle="modal">Записаться</button>
                        </div>
                    @endif
                </div>
            </div>
            <div class="course__body">
                <div class="course__col">
                    {!! $obCourse->content !!}
                </div>

                <div class="course__col">
                    @if($obCourse->is_nmo_balls)
                        <div class="course__section">
                            <h4 class="title-h5">Баллы НМО</h4>
                            <p>
                                Для получения баллов Вам необходимо подать заявку на цикл на портале НМО в личном кабинете по <a href="https://edu.rosminzdrav.ru/" target="_blank"><b>ссылке</b></a> и успешно пройти итоговую аттестацию.
                            </p>
                            <p>
                                После поданной заявки на цикл и  успешной сдачи итогового тестирования, его результат вносится в систему непрерывного медицинского образования.
                            </p>
                            <p>
                                Если у Вас возникли трудности при подаче заявки на цикл, Вы можете посмотреть инструкцию получения баллов НМО перейдя по <a href="https://niioz.ru/doc/%D0%9A%D0%B0%D0%BA%20%D0%B7%D0%B0%D1%80%D0%B5%D0%B3%D0%B8%D1%81%D1%82%D1%80%D0%B8%D1%80%D0%BE%D0%B2%D0%B0%D1%82%D1%8C%D1%81%D1%8F%20%D0%BD%D0%B0%20%D0%BF%D0%BE%D1%80%D1%82%D0%B0%D0%BB%D0%B5%20%D0%9D%D0%9C%D0%9E.pdf" target="_blank"><b>ссылке</b></a>.
                            </p>
                        </div>
                    @endif
                    <div class="program__menu">
                        <h5 class="program-toggle">Программа курса</h5>
                        <div class="program-collapse">
                            <ol>
                                @foreach($obCourse->blocks as $obB)
                                    <li>
                                      {{ $obB->title }}
                                    </li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End content page -->
    </main>
@endsection

