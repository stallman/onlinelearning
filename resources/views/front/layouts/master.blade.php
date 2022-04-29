<!DOCTYPE html>
<html lang="ru">
<head>
    <title>Дистанционное обучение</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">

    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>

    <script src="{{ asset('assets/js/main.min.js') }}"></script>

    <!-- Yandex.Metrika counter -->
    <script type="text/javascript">
        (function (m, e, t, r, i, k, a) {
            m[i] = m[i] || function () {
                (m[i].a = m[i].a || []).push(arguments)
            };
            m[i].l = 1 * new Date();
            k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
        })
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(56379670, "init", {
            clickmap: true,
            trackLinks: true,
            accurateTrackBounce: true,
            webvisor: true,
            trackHash: true
        });
    </script>
    <noscript>
        <div><img src="https://mc.yandex.ru/watch/56379670" style="position:absolute; left:-9999px;" alt=""/></div>
    </noscript>
    <!-- /Yandex.Metrika counter -->
</head>

<body>
<header class="fixed-top">
    <nav class="navbar">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainMenu"
                aria-label="Toggle navigation"></button>
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="{{ asset('assets/img/logo.svg') }}" alt="Дистанционное обучение"/>
        </a>
        @if(!\Illuminate\Support\Facades\Auth::check())
            <div class="dropdown order-lg-1">
                <button class="btn btn-login" data-target="#authorization" data-toggle="modal"><span>войти</span>
                </button>
            </div>
        @else
            <div class="dropdown order-lg-1">
                <a href="#" class="navbar-account" data-toggle="dropdown">
                    <div class="photo-profile"
                         style="background-image: url({{ Storage::url(Auth::user()->image) }})"></div>
                    <div class="account-title">{{ Auth::user()->surname }} {{ Auth::user()->name }}</div>
                </a>
                <div class="dropdown-menu user-menu">
                    <a class="dropdown-item" href="{{ route('home') }}">Главная</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{ route('profile.home') }}">Мой профиль</a>
                    <a class="dropdown-item" href="{{ route('profile.courses.active') }}">Мои курсы</a>
                    <a class="dropdown-item" href="{{ route('profile.certificates.index') }}">Документы о ПК</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button type="submit" class="dropdown-item" href="#">Выход</button>
                    </form>
                </div>
            </div>
        @endif
        <div class="collapse navbar-collapse" id="mainMenu">
            <ul class="navbar-nav">
                {{--                <li class="nav-item active">--}}
                {{--                    <a class="nav-link" href="#">Ординатура</a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item">--}}
                {{--                    <a class="nav-link" href="#">Аспирантура</a>--}}
                {{--                </li>--}}
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('courses.index') }}">Курсы ДПО</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news') }}">Новости</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('feedback') }}">Контакты</a>
                </li>
            </ul>
        </div>
        <div class="navbar-search">
            <button type="button" class="btn search-toggle" data-toggle="dropdown"></button>
            <div class="dropdown-menu">
                <form method="get" action="{{ route('search.handle', 1) }}">
                    <div class="search-form">
                        <input type="text" class="form-control search-string" name="search">
                        <button type="submit" class="btn search-submit">Найти</button>
                    </div>
                </form>
            </div>
        </div>
    </nav>
</header>
@yield('content', 'not content')
<footer>
    <div class="container">
        <div class="footer">
            <div class="footer__menu">
                <ul class="nav">
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#">Ординатура</a>--}}
                    {{--                    </li>--}}
                    {{--                    <li class="nav-item">--}}
                    {{--                        <a class="nav-link" href="#">Аспирантура</a>--}}
                    {{--                    </li>--}}
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">Курсы ДПО</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('news') }}">Новости</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('feedback') }}">Контакты</a>
                    </li>
                </ul>
            </div>
            <div class="footer__brand">
                <div class="footer__brand-name">
                    Система дистанционного обучения
                </div>
            </div>
            <div class="footer__logo">
                <div class="footer__logo-block">
                    <div class="small">При поддержке</div>
                    <div class="niioz">
                        <a href="https://niioz.ru/" target="_blank">
                            <img src="{{ asset('assets/img/NII_white.svg') }}" alt="НИИОЗММ ДЗМ"/>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer__copyright">
        &copy; Москва 2022
    </div>
</footer>
<!-- Авторизация -->
<div class="modal" id="authorization" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body login">

                <!-- Войти -->
                <div id="auth">
                    <h3 class="modal-title"><b>Авторизация</b></h3>
                    @if($errors->auth->any())
                        <div class="alert alert-danger">
                            <b>Ошибка!</b> Неверный логин или пароль
                        </div>
                    @endif
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control"
                                   placeholder="E-mail" name="email" value="{{ old('email') }}" required autofocus/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Пароль" required
                                   name="password"/>
                        </div>
                        <div class="auth-remember">
                            <div class="login-checkbox">
                                <input type="checkbox" class="custom-control-input"
                                       id="remember" name="remember">
                                <label class="custom-control-label" for="remember">Запомнить</label>
                            </div>
                            <a class="js-toggle link-small" href="#recover" data-hide="#auth">Забыли пароль?</a>
                        </div>
                        <div class="login-footer">
                            <button type="submit" class="btn">Войти</button>
                        </div>
                    </form>
                    <a href="#registration" data-toggle="modal" data-dismiss="modal" class="link-small">Нет аккаунта?
                        Зарегистрируйтесь!</a>
                </div>

                <!-- Восстановить пароль -->
                <div id="recover" class="collapse">
                    <h3 class="modal-title"><b>Восстановить пароль</b></h3>
                    @if(session()->has('password_reset_email_error'))
                        <div class="alert alert-danger">
                            {{ session()->get('password_reset_email_error') }}
                        </div>
                    @endif
                    @if(session()->has('password_reset_status'))
                        <div class="alert alert-success">
                            {{  session()->get('password_reset_status') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('password.email') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail"
                                   autocomplete="off" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="login-footer">
                            <button type="submit" class="btn">Отправить</button>
                        </div>
                    </form>
                    <a class="js-toggle link-small" href="#auth" data-hide="#recover">Авторизация</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Регистрация -->
<div class="modal" id="registration" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body login">
                <h3 class="modal-title"><b>Регистрация</b></h3>
                <form method="post" action="{{ route('register') }}">
                    @csrf
                    @if($errors->registration->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->registration->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="email"
                               value="{{ old('email') }}" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" minlength="2" placeholder="Фамилия" name="surname"
                               value="{{ old('surname') }}" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" minlength="2" placeholder="Имя" name="name"
                               value="{{ old('name') }}" required/>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" minlength="2" placeholder="Отчество" name="patronymic"
                               value="{{ old('patronymic') }}" required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Пароль" name="password" value=""
                               required/>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Повторите пароль"
                               name="password_confirmation" value="" required/>
                    </div>
                    <div class="form-group text-left mt-4">
                        <label class="small text-muted">Введите код с картинки</label>
                        <div class="captcha">
                            @if (Route::currentRouteName() === 'home')
                                <div>{{ $captcha->html_image() }} {{ $captcha->form_field() }}</div>
                            @endif
                            <div>
                                <input type="text" maxlength="6" minlength="6" class="form-control" name="captcha"
                                       required/>
                            </div>
                        </div>
                    </div>
                    <div class="login-checkbox mb-4">
                        <input type="checkbox" class="custom-control-input" id="assent" checked>
                        <label class="custom-control-label" for="assent">Я согласен с
                            <a href="{{ asset('assets/files/conditions.pdf') }}" target="_blank">условиями использования
                                сайта</a> и <a href="{{ asset('assets/files/politics.pdf') }}" target="_blank">политикой
                                обработки персональных данных</a></label>
                    </div>
                    <div class="login-footer">
                        <button type="submit" class="btn">Зарегистрироваться</button>
                    </div>
                </form>
                <a href="#authorization" data-toggle="modal" data-dismiss="modal" class="link-small">Есть
                    аккаунт? Вход</a>
            </div>
        </div>
    </div>
</div>
<!-- Запросить программу -->
<div class="modal" id="program" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body login">
                <h3 class="modal-title"><b>Запросить программу курса</b></h3>
                <p class="text-muted mb-5">
                    <b>«Инфекционная безопасность. Основные правила для популяции, населения и медицинских
                        работников»</b>
                </p>
                <form method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="ФИО"/>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail"/>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="btn btn-primary px-5">Отправить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Добавить фото профиля -->
<div class="modal" id="addPhoto" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title h4">Фотография профиля</h3>
                <form method="post" action="{{ route('users.upload.image') }}"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="mb-5">
                        <input type="file" class="form-control" name="image"/>
                        <span
                            class="form-text">Допускаются файлы формата JPG, JPEG, PNG размером до 1Mb</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="button" class="btn btn-light" data-dismiss="modal">отмена</button>
                        <button type="submit" class="btn btn-secondary">загрузить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="signupCourse" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <h3 class="modal-title h4">Записаться на курс</h3>
                <input type="hidden" value="{{ route('request.to.course') }}" id="route-to-signup-to-course">
                <input type="hidden" value="@isset($obCourse) {{ $obCourse->id }} @else 0 @endisset" id="course_id"
                       name="course_id">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Фамилия" name="surname" id="surname"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Имя" name="name" id="name"/>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Отчество" name="patronymic" id="patronymic"/>
                </div>
                <div class="form-group">
                    <input type="email" class="form-control" placeholder="E-mail" name="email" id="email"/>
                </div>
                <div class="mb-5">
                    <label for="image">Заявка</label>
                    <input type="file" class="form-control" name="request_file" id="request_file"/><br>
                    <span>
                            <a href="{{ asset('assets/files/zayavka_2022_vo.docx') }}" target="_blank">Скачать форму заявки для лиц с высшим образованием </a><br>
                            <a href="{{ asset('assets/files/zayvka_2022_spo.docx') }}" target="_blank">Скачать форму заявки для лиц со средним специальным образованием </a>
                        </span>
                </div>
                <div class="d-flex justify-content-between">
                    <button type="button" class="btn btn-light" data-dismiss="modal">отмена</button>
                    <button id="signup-course-btn" class="btn btn-secondary">Подать заявку</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="toast toast-success" role="alert" style="z-index: 9999999;" data-autohide="false" data-delay="5000">
    <span class="close-toast" data-dismiss="toast"></span>
    <div class="toast-body">
        <div class="toast-head">Спасибо!</div>
        <p class="message">Ваша заявка принята. Ожидайте ответ на электронную почту.</p>
    </div>
</div>

<div class="toast toast-danger" role="alert" style="z-index: 9999999;">
    <span class="close-toast" data-dismiss="toast"></span>
    <div class="toast-body">
        <div class="toast-head">Ошибка!</div>
        <p class="message">Попробуйте еще раз позже.</p>
    </div>
</div>


<script src="{{ asset('js/custom.js') }}"></script>

<script>
    @if($errors->registration->any())
    $('#registration').modal('show');
    @elseif($errors->auth->any() && Route::current()->getName() !== 'login')
    $('#authorization').modal('show');
    @endif
    @if(session()->has('password_reset_email_error'))
        $('#authorization').modal('show');
        $('#auth').hide();
        $('#recover').show();
    @endif
    @if(session()->has('password_reset_status'))
    $('#authorization').modal('show');
    $('#auth').hide();
    $('#recover').show();
    @endif
</script>
</body>
</html>
