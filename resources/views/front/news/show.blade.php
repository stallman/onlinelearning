@extends('front.layouts.master')
@section('content')
    <main>
        <div class="title-page">
            <div class="layout" style="background-image: url({{asset('assets/img/fon-ordinatura.jpg')}})"></div>
            <div class="heading">
                <h1>Новости</h1>
            </div>
        </div>
        <div class="container">
            <div class="news-page">
                <div class="news-page__col order-lg-1">
                    <div class="news-page-image" style="background-image:
                        @if ($obNews->image !== "default")
                            url({{asset('storage/'.$obNews->image)}})">
                        @else
                            url({{asset('assets/img/news-image.jpg')}}")">
                        @endif
                    </div>
                </div>
                <div class="news-page__col">
                    <h2 class="news-page-title">
                        {{$obNews->title}}
                    </h2>
                    <div class="news-page-head">
{{--                        <span class="news-date">{{$obNews->created_at}}</span>--}}
                        <span class="news-date">{{date("d.m.Y",strtotime($obNews->created_at))}}</span>
                        <span class="news-view d-none">Просмотров: 0</span>
                    </div>

                </div>
                <div class="news-page__body">
                    {!! $obNews->content !!}
                </div>


            </div>

            @if (count($arOtherNews)>0)
            <h4 class="title-h4">Читайте также</h4>
            <div class="news last-n-tablet">
                @foreach($arOtherNews as $obPost)
                    <div class="news__item">
                        <a href="{{route('front.news.show', $obPost)}}" class="news-card">
                            <div class="news-card-image" style="background-image:
                                @if ($obPost->image !== "default")
                                    url({{asset('storage/'.$obPost->image)}})">
                                @else
                                    url({{asset('assets/img/news-image.jpg')}}")">
                                @endif
                            </div>
                            <div class="news-card-head">
{{--                                <span class="news-date">{{$obPost->created_at}}</span>--}}
                                <span class="news-date">{{date("d.m.Y",strtotime($obPost->created_at))}}</span>
                                <span class="news-view d-none">Просмотров: 0</span>
                            </div>
                            <h4 class="news-card-title">
                                {{$obPost->title}}
                            </h4>
                        </a>
                    </div>
                @endforeach
            </div>
            @endif
        </div>
    </main>
@endsection

