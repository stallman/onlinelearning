@extends('front.courses.master')

@section('course.content')

    <h4 class="title-h5">Куратор курса</h4>
    <div class="teachers">
        <div class="teachers__item">
            <div class="curator-card">
                <div class="expert-img"
                     @if($obCourse->curator->image)
                        style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($obCourse->curator->image) }})"
                    @endif></div>
                <div>
                    <p class="expert-name">{{ $obCourse->curator->full_name }}</p>
                    {!! html_entity_decode($obCourse->curator->description) !!}
                </div>
            </div>
        </div>
    </div>


    {!! $obCourse->program !!}
    @if($obCourse->files->first())

        <h4 class="title-h5">Прикрепленные файлы</h4>
        <ul class="list-documents column-2">
            @foreach($obCourse->files as $obFile)
                <li>
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($obFile->path) }}" target="_blank">{{ $obFile->name }}</a>
                </li>
            @endforeach
        </ul>
    @endif
@endsection
