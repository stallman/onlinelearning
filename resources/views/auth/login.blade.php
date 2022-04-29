@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-account.jpg') }})"></div>
            <div class="heading">
                <h1>Личный кабинет</h1>
            </div>
        </div>
        <div class="container">
            <div class="signin">
                <!-- Войти -->
                <div id="authForm">
                    <h2 class="title-h4">Авторизация</h2>
                    @if($errors->auth->any())
                    <div class="alert alert-danger">
                        <b>Ошибка!</b> Не верный логин или пароль
                    </div>
                    @endif
                    @if(session()->has('password_update_status'))
                        <div class="alert alert-success">
                            {{ session()->get('password_update_status') }}
                        </div>
                    @endif
                    <form method="post" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail"
                                   name="email" value="{{ old('email') }}" required autofocus/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Пароль"
                                   name="password"
                                   required/>
                        </div>
                        <div class="auth-remember">
                            <div class="login-checkbox">
                                <input type="checkbox" class="custom-control-input" id="remember">
                                <label class="custom-control-label" for="remember" id="remember_me">Запомнить</label>
                            </div>
                            <a class="js-toggle link-small" href="#recoverForm" data-hide="#authForm">Забыли пароль?</a>
                        </div>
                        <div class="login-footer">
                            <button type="submit" class="btn">Войти</button>
                        </div>
                    </form>
                    <a href="#registration" data-toggle="modal" data-dismiss="modal" class="link-small">Нет аккаунта? Зарегистрируйтесь!</a>
                </div>

                <!-- Восстановить пароль -->
                <div id="recoverForm" class="collapse">
                    <h2 class="title-h4">Восстановить пароль</h2>
                    <div class="alert alert-success">
                        Ваш пароль отправлен на почту user@zdrav.mos.ru
                    </div>
                    <form method="post">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail" autocomplete="off">
                        </div>
                        <div class="login-footer">
                            <button type="submit" class="btn">Отправить</button>
                        </div>
                    </form>
                    <a class="js-toggle link-small" href="#authForm" data-hide="#recoverForm">Авторизация</a>
                </div>
            </div>
        </div>
    </main>
@endsection
