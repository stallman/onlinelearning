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
            @if(!$arCourses->isEmpty())
            <h2 class="title-h3">Активные курсы</h2>
            <div class="course-table-responsive">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="inputPassword6">Сортировка:</label>
                        <select id="select_sort_active_courses"
                                class="form-select form-control mx-sm-3"
                                aria-label=".form-select-lg example">
                            <option value="desc">Сначала новые</option>
                            <option value="asc">Сначала старые</option>
                        </select>
                    </div>
                </form>
                <input type="hidden" id="url_sort_active_courses" value="{{ route('profile.courses.active.sort_active_curses') }}">
                <br>
                <div class="course-table">
                    <div class="course-table-th">
                        <div class="course-name">Наименование курса</div>
                        <div>Дата начала</div>
                        <div>Процент завершения</div>
                        <div>Куратор</div>
                    </div>
                    <div id="table_data_active_curses">
                        @include('front.courses.active.table')
                    </div>
                </div>
            </div>
            @else
                <h2 class="text-primary">Активные курсы отсутствуют</h2>
            @endisset
        </div>
        <!-- End content page -->
    </main>
@endsection
