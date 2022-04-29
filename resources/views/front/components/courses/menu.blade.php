<nav class="nav-study">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link @if($sActiveTab === 'program') active @endif"
               href="{{ route('profile.courses.program', compact('obCourse')) }}">Программа</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($sActiveTab === 'show') active @endif"
               href="{{ route('profile.courses.show', compact('obCourse')) }}">Учебные материалы</a>
        </li>
        <li class="nav-item">
            <a class="nav-link @if($sActiveTab === 'literature') active @endif"
               href="{{ route('profile.courses.literature',
                ['id' => $obCourse->id]) }}">Рекомендуемая литература</a>
        </li>
        @if($obCourse->teachers()->first())
            <li class="nav-item">
                <a class="nav-link @if($sActiveTab === 'teachers') active @endif" href="{{ route('profile.courses.teachers',
                ['id' => $obCourse->id]) }}">Преподаватели</a>
            </li>
        @endif
    </ul>
</nav>
