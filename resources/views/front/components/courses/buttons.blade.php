<div class="program__footer">
    <a href="{{ $sPrevRoute }}" class="btn @if(!$sPrevRoute) disabled @endif">предыдущая тема</a>
    <form action="{{ route('profile.block.mark.is.read', compact('obBlock')) }}" method="post">
        @csrf
        <input type="hidden" value="{{$sNextRoute}}" name="next_route">
        @if(!$sNextRoute)
            @isset($obCourse->test)
                @if ($obCourse->test->is_visible)
                    <button type="submit" class="btn">приступить к тестированию</button>
                @endif
            @endisset
        @else
            <button type="submit" class="btn">следующая тема</button>
        @endif
    </form>

</div>
