@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-account.jpg') }})"></div>
            <div class="heading">
            </div>
        </div>
        <div class="container">
            <div class="signin">
                <!-- Войти -->
                <div id="authForm">
                    <h2 class="title-h4">Сброс пароля</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }} <br>
                                @endforeach
                        </div>
                    @endif
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="E-mail" autocomplete="off"
                                   name="email" value="{{ old('email', $request->email) }}" required autofocus/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Пароль"
                                   name="password" autocomplete="off"
                                   required />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Повторите пароль"
                                   name="password_confirmation" autocomplete="off"
                                   required/>
                        </div>
                        <div class="login-footer">
                            <button type="submit" class="btn">Сбросить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

