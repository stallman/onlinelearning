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
            <h2 class="title-h3">Завершенные курсы</h2>
            <div class="course-table-responsive">
                <form class="form-inline">
                    <div class="form-group">
                        <label for="inputPassword6">Сортировка:</label>
                        <select id="select_sort_completed_courses"
                                class="form-select form-control mx-sm-3"
                                aria-label=".form-select-lg example">
                            <option value="desc">Сначала новые</option>
                            <option value="asc">Сначала старые</option>
                        </select>
                    </div>
                </form>
                <input type="hidden" id="url_sort_completed_courses" value="{{ route('profile.courses.completed.sort_completed_curses') }}">
                <br>
                <div class="course-table">
                    <div class="course-table-th">
                        <div class="course-name">Наименование курса</div>
                        <div>Дата завершения</div>
                        <div>Количество баллов</div>
                        <div>Удостоверения о ПК</div>
                        <div>Куратор</div>
                    </div>
                    <div id="table_data_completed_curses">
                        @include('front.courses.completed.table')
                    </div>
                </div>
            </div>
            @else
                <h2 class="text-primary">Завершенные курсы отсутствуют</h2>
            @endisset
        </div>
        <!-- End content page -->
    </main>
@endsection
