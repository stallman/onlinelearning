
@foreach($arCourses as $obC)
    <x-courses.card
        :ob-course="$obC"
    />
@endforeach