@extends('front.layouts.master')

@section('content')
    <main>
        <div class="title-page">
            <div class="layout" style="background-image: url({{asset('assets/img/fon-study.jpg')}})"></div>
            <div class="heading">
                <h1>Курсы ДПО</h1>
            </div>
        </div>
        <div class="container">
            <div class="courses__header">
                <h2 class="courses__h2">Дополнительное профессиональное образование</h2>
                <div class="courses__filter">
                    <select class="js-example-basic-single" id="spec-select" data-live-search="true" title="Выберите специальность курсов" data-width="350px" data-size="5" data-virtual-scroll="false" data-none-results-text="Не найдено" data-dropdown-align-right="true">
                    @foreach($arSpecialities as $obSpeciality)
                        <option value="{{ $obSpeciality->id }}" @if (request()->speciality == $obSpeciality->id) selected @endif>
                            {{ $obSpeciality->name }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="courses__list" id="course-specialities">
                @foreach($arCourses as $obC)
                    <x-courses.card
                        :ob-course="$obC"
                    />
                @endforeach
            </div>

            @if ($arCoursesCount > Config::get('pagination.PAGES_COUNT'))
            <div class="news__more">
                <button type="button" id="click_load_courses" class="btn">показать еще</button>
            </div>
            @endif

        </div>

    </main>
@endsection
