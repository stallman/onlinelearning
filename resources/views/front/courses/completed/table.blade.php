@foreach($arCourses as $obCourse)
    <div class="course-table-tr">
        <a href="{{ route('profile.courses.program', compact('obCourse')) }}" class="course-name">
            {{ $obCourse->title }}
        </a>
        <div class="square">
            <div class="square-body">{{ $obCourse->current_user_ended_date }}</div>
        </div>
        <div class="square">
            <div class="square-body"><b>{{ $obCourse->test_results }}/{{ count($obCourse->test->questions) }}</b></div>
        </div>
        <div class="square">
            @if(\Illuminate\Support\Facades\Auth::user()->getCertificate($obCourse->id))
                <a href="{{ \Illuminate\Support\Facades\Storage::url(\Illuminate\Support\Facades\Auth::user()->getCertificate($obCourse->id)->path) }}"
                   target="_blank" class="square-download"></a>
            @endif
        </div>
        <div class="course-expert">
            <a href="#" class="expert">
                <div class="expert-img"
                     @if($obCourse->curator->image)
                     style="background-image: url({{ \Illuminate\Support\Facades\Storage::url($obCourse->curator->image) }})"
                    @endif></div>
                <div>
                    <p class="expert-name">{!! $obCourse->curator->curator_display_name !!}</p>
                    <span>{{ $obCourse->curator->position }}</span>
                </div>
            </a>
        </div>
    </div>
@endforeach
