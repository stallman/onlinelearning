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
            <h2 class="title-h3">Вебинары</h2>
            <h3 class="text-primary" id="not-webinars" style="display: none;">Активные вебинары отсутствуют</h3>
            <div class="webinars">
            </div>
        </div>
        <script>
            $.get('https://events.niioz.ru/api/get-token', {key: 'fdgsd4543f'},
            function (tokenData){
                $.get('https://events.niioz.ru/api/user/events',
                    {
                        token: tokenData.token,
                        username: '{{ \Illuminate\Support\Facades\Auth::user()->email }}'
                    },
                    function (data) {
                        console.log(data);
                        if (data.error) {
                            $('#not-webinars').show();
                        }
                        data.events.forEach(function (event, idx) {
                            // if(idx > 10){
                            //     return false;
                            // }
                            var statusHtml = '';
                            var statusBtn = '';
                            switch (event.status.toLowerCase()) {
                                case 'архив':
                                case 'архив c видео':
                                case 'архив c регистрацией':
                                    break;
                                case 'онлайн':
                                    statusHtml = '<span class="webinar-badge badge-danger">Онлайн</span>';
                                    statusBtn = `<div class="webinar-card-footer">
                                <a href="https://events.niioz.ru/event/${event.id}" target="_blank" class="btn btn-webinar">Трансляция</a>
                            </div>`;
                                    break;
                                case 'анонс':
                                    statusHtml = '<span class="webinar-badge badge-warning">Анонс</span>';
                                    break;
                            }
                            var descriptionText = event.description;

                            if (descriptionText !== null) {
                                descriptionText = descriptionText.split(' ', 10).join(' ') + '...';
                            } else {
                                descriptionText = '';
                            }

                            var imageHtml = event.preview.split('images/')[1] ? `style="background: url('${event.preview}'); background-size: contain;"` : "";

                            var eventHtml = `
                               <div class="webinars__item">
                            <div class="webinar-card">
                                <a href="https://events.niioz.ru/event/${event.id}" target="_blank" class="unstyled">
                                    ${statusHtml}
                                    <div class="webinar-card-image" ${imageHtml}></div>
                                    <div class="webinar-card-head">
                                        ${event.dateStart}
                                    </div>
                                    <h5 class="webinar-card-title"> ${event.title}</h5>
                                </a>
                                <div class="webinar-card-body">
                                    ${descriptionText}
                                </div>
                                ${statusBtn}
                            </div>
                        </div>
                               `
                            $('.webinars').append(eventHtml);
                        });
                    });
            }
            )

        </script>
        <!-- End content page -->
    </main>
@endsection
