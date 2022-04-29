@extends('front.layouts.master')
@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{asset('assets/img/fon-ordinatura.jpg')}})"></div>
            <div class="heading">
                <h1>Контакты</h1>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-10 center-bloc">
                    @if (session()->has('success'))
                        <div class="alert alert-success" role="alert">
                            {{session()->get('success')}}
                        </div>
                    @endif
                </div>
            </div>
            <div class="contacts">
                <div class="contacts__col">
                    <h2 class="title-h4">Отдел образования</h2>
                    <div class="contacts__item">
                        <p>
                            <b>Масалова Светлана Владимировна</b>
                        </p>
                        <p>
                            <a href="tel:+74992497472" class="unstyled">8 (499) 249-74-72 (доб. 563)</a>
                        </p>
                        <p>
                            <a href="mailto:MasalovaSV@zdrav.mos.ru">MasalovaSV@zdrav.mos.ru</a>
                        </p>
                    </div>
                    <div class="contacts__item">
                        <p>
                            <b>Гаврилина Мария Викторовна</b>
                        </p>
                        <p>
                            <a href="tel:+74992497472" class="unstyled">8 (499) 249-74-72 (доб. 551)</a>
                        </p>
                        <p>
                            <a href="mailto:GavrilinaMV@zdrav.mos.ru">GavrilinaMV@zdrav.mos.ru</a>
                        </p>
                    </div>
                    <div class="contacts__item">
                        <p>
                            <b>Кузьминская Ольга Борисовна</b>
                        </p>
                        <p>
                            <a href="tel:+74992497472" class="unstyled">8 (499) 249-74-72 (доб. 561)</a>
                        </p>
                        <p>
                            <a href="mailto:KuzminskayaOB@zdrav.mos.ru">KuzminskayaOB@zdrav.mos.ru</a>
                        </p>
                    </div>
                </div>

                <div class="contacts__feedback">
                    <h2 class="title-h4">Обратная связь</h2>
                    <form class="needs-validation" method="post" action="{{route('front.feedback.store')}}">
                        @csrf
                        <div class="feedback-form">
                            <div class="feedback-form-group">
                                <div class="form-group">
                                    <input type="text"
                                           required
                                           name="fullname"
                                           class="form-control"
                                           placeholder="ФИО"
                                           @if(!empty($arUserData))
                                               value="{{$arUserData['fullname']}}"
                                           @endif
                                    >
                                </div>
                                <div class="form-group">
                                    <input type="email"
                                           required
                                           name="email"
                                           class="form-control"
                                           placeholder="E-mail"
                                           @if(!empty($arUserData))
                                                value="{{$arUserData['email']}}"
                                           @endif
                                    >
                                </div>
                            </div>
                            <div class="feedback-form-group">
                                <div class="form-group">
                                    @if(!empty($arUserData))
                                        <textarea class="form-control" required name="question" placeholder="Ваш вопрос">{{$arUserData['question']}}</textarea>
                                    @else
                                        <textarea class="form-control" required name="question" placeholder="Ваш вопрос"></textarea>
                                    @endif
                                </div>
                            </div>
                            <div class="feedback-form-submit">
                                {{--TODO: сделать капчу--}}
                                <label>Введите код с картинки</label>
                                <div class="feedback-form-captcha">
                                    <div>
                                        <div>{{ $captcha->html_image() }} {{ $captcha->form_field() }}</div>
                                    </div>
                                    <div>
                                        <input type="text" name="captcha" class="form-control"/>
                                    </div>
                                </div>
                            </div>
                            <div class="feedback-form-submit">
                                <button type="submit" class="btn">Отправить</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="contacts__col">
                    <h3 class="title-h5">Офис</h3>
                    <p>
                        <b>ГБУ «Научно-исследовательский институт организации здравоохранения и медицинского менеджмента ДЗМ»</b>
                    </p>
                    <p>
                        <a href="https://niioz.ru/" target="_blank"><b>www.niioz.ru</b></a>
                    </p>
                </div>

                <div class="contacts__col">
                    <p>
{{--                        <b>115088, г.&nbsp;Москва, ул.&nbsp;Шарикоподшипниковская, д.&nbsp;9</b>--}}
                        <b>ул. Киевская, д.20 станция метро Студенческая</b>
                    </p>
                    <p>
                        <a href="mailto:niiozmm@zdrav.mos.ru">niiozmm@zdrav.mos.ru</a>
                    </p>
                    <p>
                        <a href="tel:+74995301289" class="unstyled">8 (495) 530-12-89</a>
                    </p>
                </div>
            </div>

            <div class="contacts__map">
{{--                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1ad744798230a84d0ea9362dd4cee94036986b00a9327efe12aa7f4678895500&amp;width=100%25&amp;height=460&amp;lang=ru_RU&amp;scroll=true"></script>--}}
{{--                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A702703c48a35087eb31deae0fed9ec1b3d0c93b68c03ebdccefb02eaa01961c6&amp;width=100%25&amp;height=460&amp;lang=ru_RU&amp;scroll=true"></script>--}}
{{--                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A702703c48a35087eb31deae0fed9ec1b3d0c93b68c03ebdccefb02eaa01961c6&amp;width=100%25&amp;height=460&amp;lang=ru_RU&amp;scroll=true"></script>--}}
                <script type="text/javascript" charset="utf-8" async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A702703c48a35087eb31deae0fed9ec1b3d0c93b68c03ebdccefb02eaa01961c6&amp;width=100%25&amp;height=558&amp;lang=ru_RU&amp;scroll=true"></script>
            </div>
        </div>
        <!-- End content page -->
    </main>
@endsection
