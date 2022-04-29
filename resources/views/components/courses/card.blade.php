<div class="courses__item">
    <div class="course-card">
        <a href="{{ route('courses.detail', $obCourse) }}" class="unstyled">
            @if($obCourse->is_nmo_balls)
                <span class="course-badge">Баллы НМО</span>
            @endif
            <div class="course-card-image" @if($obCourse->image)
                                            style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($obCourse->image) }})"
                                            @endif></div>
            <h5 class="course-card-title">{{ $obCourse->title }}</h5>
        </a>
        <div class="course-card-body">
            <div class="col">
                <p>Длительность: {{ $obCourse->duration }} {{Lang::choice('неделя|недели|недель', $obCourse->duration, [], 'ru')}} </p>
                @if ($obCourse->studyforms()->first()) 
                    <p>Основа обучения: 
                    @foreach($obCourse->studyforms()->get() as $obSf)
                        @if ($loop->index>0)/ @endif
                        {{$obSf->name}}
                    @endforeach
                    </p> 
                @endif
                @if (isset($obCourse->price)) <p>Стоимость: {{ $obCourse->price }} </p> @endif
                <p>Удостоверение о ПК: @if($obCourse->is_has_certificate) Да @else Нет @endif</p>
            </div>
            <div class="col">
{{--                <button class="btn btn-secondary">записаться</button>--}}
                <a href="{{ route('courses.detail', $obCourse) }}" class="btn btn-primary">подробнее</a>
            </div>
        </div>
{{--        <div class="course-card-footer">--}}
{{--            <div class="course-feedback">--}}
{{--                Отвывы: <a href="#">10</a>--}}
{{--            </div>--}}
{{--            <ul class="rating rating-4">--}}
{{--                <li></li>--}}
{{--                <li></li>--}}
{{--                <li></li>--}}
{{--                <li></li>--}}
{{--                <li></li>--}}
{{--            </ul>--}}
{{--        </div>--}}
    </div>
</div>
