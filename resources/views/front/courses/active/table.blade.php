@foreach($arCourses as $obCourse)
    @php
        $obCourse->getReadPercent(\Illuminate\Support\Facades\Auth::user());
    @endphp
    <div id="" class="course-table-tr">
        <a href="{{ route('profile.courses.program', compact('obCourse')) }}" class="course-name">
            {{ $obCourse->title }}
        </a>
        <div class="square">
            <div class="square-body">{{ $obCourse->start_date }}</div>
        </div>
        <div class="square">
            <div class="course-progress" style="height: {{ $obCourse->getReadPercent(\Illuminate\Support\Facades\Auth::user()) }}%"></div>
            <div class="square-body">{{ $obCourse->getReadPercent(\Illuminate\Support\Facades\Auth::user()) }}%</div>
        </div>
        <div class="course-expert">
            <a href="#" class="expert">
                <div class="expert-img"
                     @if($obCourse->curator->image)
                     style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($obCourse->curator->image) }})"
                    @endif
                ></div>
                <div>
                    <p class="expert-name">{!! $obCourse->curator->curator_display_name !!}</p>
                    <span>{{ $obCourse->curator->position }}</span>
                </div>
            </a>
        </div>
    </div>
@endforeach
