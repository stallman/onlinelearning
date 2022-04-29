@extends('front.courses.master')

@section('course.content')
    @if(Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    @if(isset($obBlock))
        <h3 class="program__theme">
            <span class="theme">Тема</span>
            {{ $obBlock->title }}
        </h3>
        {!! $obBlock->content !!}
    @else
        Тема отсутствует
    @endif

    @include('front.components.courses.buttons', compact('sPrevRoute', 'sNextRoute', 'obCourse', 'obBlock'))
@endsection
