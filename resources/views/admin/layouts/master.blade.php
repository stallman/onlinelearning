<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@section('title')Админ панель@show @hasSection('h1') | @yield('h1')@endif</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="{{ asset('assets/img/favicon.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js" defer></script>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">

    <!-- include codemirror (codemirror.css, codemirror.js, xml.js, formatting.js) -->
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.css">
    <link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/theme/monokai.css">
                                                                                    
    <base href="{{Request::url()}}/" />

</head>
<body class="min-vh-100">
    <div class="row g-0 min-vh-100" >
        <div class="col col-lg-2 p-2 flex-shrink-0 p-3 bg-white border-end" >
            <a href="{{route('admin.home')}}" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
                <img class="bi me-2" src="{{ asset('assets/img/logo.svg') }}">
            </a>
            <ul class="list-unstyled ps-0">
                <li class="mb-1 btn-toggle-nav">
                    <a href="" class="btn align-items-center rounded">Пользователи</a>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse" aria-expanded="false">
                        Контент
                    </button>
                    <div class="collapse" id="dashboard-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="{{ route('admin.specializations.index') }}" class="link-dark rounded">Специализации</a></li>
                            <li><a href="{{ route('admin.speciality.index') }}" class="link-dark rounded">Специальности</a></li>
                            <li><a href="{{ route('admin.courses.index') }}" class="link-dark rounded">Курсы</a></li>
                            <li><a href="{{ route('admin.tests.verification.index') }}" class="link-dark rounded">Проверка тестов</a></li>
                            <li><a href="{{ route('admin.banners.index') }}" class="link-dark rounded">Баннеры</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-2" aria-expanded="false">
                        Тесты
                    </button>
                    <div class="collapse" id="dashboard-collapse-2">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="{{ route('admin.tests.index') }}" class="link-dark rounded">Редактор тестов</a></li>
                            <li><a href="{{ route('admin.tests.import.index') }}" class="link-dark rounded">Импорт теста</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-2" aria-expanded="false">
                        Новости и События
                    </button>
                    <div class="collapse" id="dashboard-collapse-2">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="{{ route('admin.news.index') }}" class="link-dark rounded">Новости</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#orders-collapse" aria-expanded="false">
                        Пользователи
                    </button>
                    <div class="collapse" id="orders-collapse">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li>
                                <a href="{{ route('admin.users.index') }}" class="link-dark rounded">Обычные пользователи</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.curators.index') }}" class="link-dark rounded">Кураторы</a>
                            </li>
                            <li>
                                <a href="{{ route('admin.teachers.index') }}" class="link-dark rounded">Преподаватели</a>
                            </li>
                            <li><a href="{{ route('admin.users.import.index') }}" class="link-dark rounded">Импорт пользователей</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-reviews" aria-expanded="false">
                        Отзывы
                    </button>
                    <div class="collapse" id="dashboard-collapse-reviews">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="{{ route('admin.feedback.index') }}" class="link-dark rounded">Обратная связь</a></li>
                        </ul>
                    </div>
                </li>

                <li class="mb-1">
                    <button class="btn btn-toggle align-items-center rounded collapsed" data-bs-toggle="collapse" data-bs-target="#dashboard-collapse-reports" aria-expanded="false">
                        Отчеты
                    </button>
                    <div class="collapse" id="dashboard-collapse-reports">
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            <li><a href="{{ route('admin.report-courses.show-results') }}" class="link-dark rounded">Выгрузка результатов тестирования по курсу</a></li>
                            <li><a href="{{ route('admin.report-courses.show-views') }}" class="link-dark rounded">Выгрузка визитов по курсу</a></li>
                            <li><a href="{{ route('admin.report-courses.show-anketa') }}" class="link-dark rounded">Выгрузка анкет по курсу</a></li>
                        </ul>
                    </div>
                </li>
                <li class="mb-1">
                    <a href="{{ route('admin.requests-to-courses.index') }}" class="link-dark rounded">Заявки на курсы</a>
                </li>
            </ul>
        </div>
        <div class="col col-lg-10 ">

            <nav class=" navbar p-2 navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="{{route('home')}}">На сайт</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end pr-4" id="navbarSupportedContent">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <div class="">
                                <button type="submit" class="btn btn-danger">Выход</button>
                            </div>
                        </form>


                    </div>
                </div>
            </nav>
            <div class="container-fluid p-4">
                <hr class="mb-4">
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @yield('content')
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                tabsize: 2,
                height: 300,
                width: 900,
                callbacks: {
                    onImageUpload: function (files, editor) {
                        console.log('editor', this);
                        for (let i = 0; i < files.length; i++) {
                            upload(files[i], $(this));
                        }
                        console.log('file loading');
                    },
                    onMediaDelete : function(target) {
                        // alert(target[0].src)
                        deleteFile(target[0].src);
                    }
                },
            });

            function upload(file, editor) {
                let out = new FormData();
                out.append('file', file, file.name);
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.summernote.upload.image') }}',
                    contentType: false,
                    cache: false,
                    processData: false,
                    data: out,
                    success: function (img) {
                        editor.summernote('insertImage', img);
                    },
                    error: function (jqXHR, textStatus, errorThrown) {
                        console.error(textStatus + " " + errorThrown);
                    }
                });
            }
            function deleteFile(src) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    data: {src : src},
                    type: "POST",
                    url: '{{ route('admin.summernote.delete.image') }}',
                    cache: false,
                    success: function(resp) {
                        console.log(resp);
                    }
                });
            }
        });

        $('.change-visible-course').click(function (){
            var is_visible = !!$(this).prop('checked') ? 1 : 0;
            console.log(is_visible);
            var course_id = $(this).attr('data-id');
            $.ajax({
                data: {is_visible, course_id},
                type: "POST",
                url: '/api/admin/courses/change-visible',
                cache: false,
                success: function(resp) {
                    console.log(resp);
                }
            });
         });
        $('.change-visible-test').click(function (){
            var is_visible = !!$(this).prop('checked') ? 1 : 0;
            console.log(is_visible);
            var test_id = $(this).attr('data-id');
            $.ajax({
                data: {is_visible, test_id},
                type: "POST",
                url: '/api/admin/tests/change-visible',
                cache: false,
                success: function(resp) {
                    console.log(resp);
                }
            });
        });
    </script>
    <!-- Scripts -->
    <script src="{{ asset('js/admin.js') }}" ></script>
    <script src="{{ asset('js/summernote.js') }}" ></script>
    <script src="{{ asset('js/datepicker/datepicker.min.js') }}" ></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/codemirror.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/3.20.0/mode/xml/xml.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/codemirror/2.36.0/formatting.js"></script>
    <script src="{{ asset('js/custom.js') }}" ></script>
    <script>
        (function () {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

</body>
</html>
