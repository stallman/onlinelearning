<div class="course-nav-wrap">
    <div class="course-nav ">
        <div class="course-nav-item ">
            <a href="{{ route('profile.courses.active') }}" class="course-nav-link courses-menu-btn" style="background-image: url({{ asset('assets/img/icons/course1.svg') }})">
                Активные курсы
            </a>
        </div>
        <div class="course-nav-item">
            <a href="{{ route('profile.courses.completed') }}" class="course-nav-link courses-menu-btn" style="background-image: url({{ asset('assets/img/icons/course2.svg') }})">
                Завершенные курсы
            </a>
        </div>
        <div class="course-nav-item">
            <a href="{{ route('profile.courses.available') }}" class="course-nav-link courses-menu-btn" style="background-image: url({{ asset('assets/img/icons/course3.svg') }})">
                Доступные курсы
            </a>
        </div>
        <div class="course-nav-item">
            <a href="{{ route('profile.courses.webinars') }}" class="course-nav-link courses-menu-btn" style="background-image: url({{ asset('assets/img/icons/course4.svg') }})">
                Вебинары
            </a>
        </div>
    </div>
</div>
