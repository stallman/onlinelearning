@extends('front.courses.master')

@section('course.content')
    <h4 class="title-h5">Преподаватели</h4>
    <div class="teachers">
        @foreach($obCourse->teachers as $obTeacher)
            <div class="teachers__item">
            <div class="curator-card">
                <div class="expert-img" @if($obTeacher->image)
                                            style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($obTeacher->image) }})"
                                        @endif></div>
                <div>
                    <p class="expert-name">{{ $obTeacher->full_name }}</p>
                    {!! $obTeacher->description !!}
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
