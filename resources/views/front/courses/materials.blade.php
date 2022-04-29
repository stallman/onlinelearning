@extends('front.courses.master')

@section('course.content')
    @isset($obBlock)
        <h3 class="program__theme">
            <span class="theme">Тема</span>
            {{ $obBlock->title }}
        </h3>
        {!! $obBlock->content !!}
        @if($obBlock->files->first())
            <h4 class="title-h5">Материалы</h4>
            <ul class="list-documents column-2">
                @foreach($obBlock->files as $obFile)
                    <li>
                        <a href="{{ \Illuminate\Support\Facades\Storage::url($obFile->path) }}" target="_blank">{{ $obFile->name }}</a>
                    </li>
                @endforeach
            </ul>
        @endif
        @if(strip_tags($obBlock->literature) !== '')
            <h4 class="title-h5">Список литературы</h4>
            {!! $obBlock->literature !!}
        @endif
        @include('front.components.courses.buttons', compact('sPrevRoute', 'sNextRoute', 'obCourse', 'obBlock'))
    @else
        <h4>Материалы отсутствуют</h4>
    @endisset

@endsection
