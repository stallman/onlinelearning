@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="container">
            <div class="error-page">
                Ошибка! Страница не найдена
                <img src="{{ asset('assets/img/404.svg') }}" alt="Ошибка 404" />
                <a href="{{ route('home') }}" class="btn btn-primary">На главную</a>
            </div>
        </div>
        <!-- End content page -->
    </main>
@endsection
