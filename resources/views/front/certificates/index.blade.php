@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-account.jpg') }})"></div>
            <div class="heading">
                <h1>Документы о повышении</h1><h1>квалификации</h1>
            </div>
        </div>
        <div class="container">
            @foreach(\Illuminate\Support\Facades\Auth::user()->courses as $obCourse)
                @if(\Illuminate\Support\Facades\Auth::user()->getCertificate($obCourse->id))
                    <div class="certificate">
                        <div class="certificate__image">
                            <img src="{{ asset('assets/img/udostoverenie-image2.jpg') }}" alt=""/>
                        </div>
                        <div class="certificate__body">
                            <div class="certificate__title">
                                {{ $obCourse->title }}
                            </div>
                            <div class="certificate__footer">
                                <div class="desc">
                                    <!--<div>№{{ \Illuminate\Support\Facades\Auth::user()
                                                    ->getCertificate($obCourse->id)->number }}</div>
                                    <div>Выдан {{ date('d.m.Y',
                                                    \Illuminate\Support\Facades\Auth::user()
                                                    ->getCertificate($obCourse->id)->created_at->timestamp) }}</div>-->
                                </div>
                                <!--<div class="points">Баллов: {{ \Illuminate\Support\Facades\Auth::user()
                                                    ->getCertificate($obCourse->id)->scores }}
                                </div>-->
                                <a href="{{ \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->getCertificate($obCourse->id)->path) }}"
                                   target="_blank" class="btn btn-primary">скачать</a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <!-- End content page -->
    </main>
@endsection
