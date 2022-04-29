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
            <div class="news" id="news-data">
                @foreach($arAllNews as $obPost)
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

            @if ($arNewsCount > Config::get('pagination.PAGES_COUNT'))
            <div class="news__more">
                <button type="button" id="click_load_news" class="btn">показать еще</button>
            </div>
            @endif

        </div>
    </main>
@endsection
