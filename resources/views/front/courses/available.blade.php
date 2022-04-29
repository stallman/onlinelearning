@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-account.jpg') }})"></div>
            <div class="heading">
                <h1>Мои курсы</h1>
            </div>
        </div>
        <div class="container">
            @include('front.courses.menu')
            <h2 class="title-h3">Доступные курсы</h2>
            <div class="course-list">
                @foreach($arCourses as $obCourse)
                        <x-courses.card
                            :ob-course="$obCourse"
                            :b-is-profile="true"
                        />
                @endforeach
            </div>
        </div>
        <!-- End content page -->
    </main>
@endsection
