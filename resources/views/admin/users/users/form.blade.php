@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          @isset($obUser)
          action="{{route('admin.users.update', $obUser)}}"
          @else
          action="{{route('admin.users.store')}}"
          @endisset
          novalidate>
        @isset($obUser)
            @method('PUT')
        @endisset
        @csrf
        <x-forms.text-input
            s-name-field="surname"
            s-name="Фамиля"
            :is-required="true"
            :ob-data='$obUser??null'
        />
        <x-forms.text-input
            s-name-field="name"
            s-name="Имя"
            :is-required="true"
            :ob-data='$obUser??null'
        />
        <x-forms.text-input
            s-name-field="patronymic"
            s-name="Отчество"
            :is-required="true"
            :ob-data='$obUser??null'
        />
        <x-forms.text-input
            s-name-field="email"
            s-name="Почта"
            :is-required="true"
            :ob-data='$obUser??null'
        />
        <x-forms.text-input
            s-name-field="password"
            s-name="Пароль(оставьте пустым если не нужно изменить)"
            :is-required="false"
            :ob-data='null'
        />
        @isset($arCourses)
            <label for="">Доступные курсы</label><br>
            <select name="courses[]" id="courses" style="width: 1500px;" multiple>

                @if(isset($obUser))
                    @foreach($arCourses as $obCourse)
                        @if(isset($obCourse) && !$obCourse->users->contains('id', $obUser->id))
                            <option value="{{ $obCourse->id }}">{{ $obCourse->title }}</option>
                        @endif
                    @endforeach
                @else
                    @foreach($arCourses as $obCourse)
                            <option value="{{ $obCourse->id }}">{{ $obCourse->title }}</option>
                    @endforeach
                @endisset
            </select><br>
        @endisset
        @isset($obUser)
            <button type="submit" class="btn btn-warning">Обновить</button>
        @else
            <button type="submit" class="btn btn-success">Добавить</button>
        @endisset
    </form>
    @if(isset($obUser) && $obUser->courses()->first())
        <br/><hr/><br/>
        <div class="mb-3">
            <h4>Курсы юзера</h4><br>
            @foreach($arCourses as $obCourse)
                @if(isset($obCourse) && $obCourse->users->contains('id', $obUser->id))
                    <form action="{{ route('admin.users.course.detach', compact('obCourse', 'obUser')) }}"
                          method="post">
                        @csrf
                        <h5>{{ $obCourse->title }}</h5>
                        <button class="btn-danger btn">Открепить</button>
                    </form><br>
                    @if($obUser->getCertificate($obCourse->id))
                        <form
                            action="{{ route('admin.certificates.update', ['obCertificate' => $obUser->getCertificate($obCourse->id)]) }}"
                            method="post"
                            enctype="multipart/form-data">
                            @csrf
                            @method('patch')
                            <a href="{{ \Illuminate\Support\Facades\Storage::url($obUser->getCertificate($obCourse->id)->path) }}"
                               target="_blank">Предыдущий сертификат</a><br>
                            <label for="file">Прикрепить файл</label>
                            <input type="file" name="file"><br>
                            <!--<label for="number">Номер</label>
                            <input type="text" name="number"
                                   value="{{ $obUser->getCertificate($obCourse->id)->number }}"><br>
                            <label for="number">Баллы</label>
                            <input type="text" name="scores"
                                   value="{{ $obUser->getCertificate($obCourse->id)->scores }}">--><br>
                            <button class="btn btn-success" type="submit">Обновить сертификат</button>
                        </form>
                        <form
                            action="{{ route('admin.certificates.delete', ['iId' => $obUser->getCertificate($obCourse->id)->id ]) }}"
                            method="post">
                            @method('delete')
                            @csrf

                            <br>
                            <button class="btn btn-warning" type="submit">Удалить сертификат</button>
                        </form>
                        <br>
                    @endif
                    <form
                        action="{{ route('admin.certificates.store', ['obUser' => $obUser, 'obCourse' => $obCourse]) }}"
                        method="post" enctype="multipart/form-data">
                        @csrf
                        <label for="file">Прикрепить файл</label>
                        <input type="file" name="file"><br>
                        <!--<label for="number">Номер</label>
                        <input type="text" name="number"><br>
                        <label for="number">Баллы</label>
                        <input type="text" name="scores">--><br>
                        <button class="btn btn-success" type="submit">Прикрепить сертификат</button>
                    </form><br><br><br><br>
                @endif
            @endforeach
        </div>
    @endif
@endsection
