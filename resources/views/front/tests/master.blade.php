@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-study.jpg') }})"></div>
            <div class="heading">
                <h1>Курс</h1>
            </div>
        </div>
        <div class="container">
            <div class="program__header">
                <div class="program__header-image">
                    <div class="back-image"
                         style="background-image: url({{ asset('assets/img/temp/course4.jpg') }})"></div>
                </div>
                <div class="program__header-title">
                    <h2>
                        {{ $obCourse->title }}
                    </h2>
                </div>
            </div>
            {{--            <ol class="program__breadcrumb">--}}
            {{--                <li class="breadcrumb-item">Развитие цифровых инноваций в области здравоохранения, обзор основных трендов цифровой трансформации медицины</li>--}}
            {{--                <li class="breadcrumb-item">Основная часть курса</li>--}}
            {{--            </ol>--}}
            <div class="row">
                <div class="program__aside">
                    <div class="program__menu">
                        <h5 class="program-toggle">Программа курса</h5>
                        <div class="program-collapse">
                            <ul>
                                @foreach($obCourse->blocks as $obB)
                                        <li>
                                            <a class="nav-link course-submenu-btn" href="{{ route('profile.courses.show.block',
                                                    ['id' => $obCourse->id, 'blockId' => $obB->id]) }}">{{ $obB->title }}</a>
                                        </li>
                                @endforeach
                                @isset($obCourse->test)
                                    @if ($obCourse->test->is_visible)
                                        <li>
                                            <a class="nav-link course-submenu-btn"
                                               href="{{ route('profile.courses.test.start', compact('obCourse')) }}">
                                                Итоговое тестирование
                                            </a>
                                        </li>
                                    @endif
                                @endisset
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="program__content">
                    @yield('course.content')
                </div>
            </div>
        </div>
        <!-- End content page -->
    </main>
@endsection
