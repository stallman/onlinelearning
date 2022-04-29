@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          @isset($obCourse)
          action="{{ route('admin.courses.update', $obCourse) }}"
          @else
          action="{{ route('admin.courses.store') }}"
          @endisset
          novalidate>
        @isset($obCourse)
            @method('PATCH')
        @endisset
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <x-forms.text-input
            s-name-field="title"
            s-name="Название"
            :is-required="true"
            :ob-data='$obCourse??null'
        />
        <x-forms.select
            s-name-field="course_category_id"
            s-name="Категория"
            :ar-data="$arCourseCategories"
            s-display-key="title"
            :ob-data="$obCourse??null"
        />
        <x-forms.checkbox
            s-name-field="is_home_visible"
            s-name="Видимость на главной"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.checkbox
            s-name-field="is_visible"
            s-name="Видимость курса"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.checkbox
            s-name-field="is_anketable"
            s-name="Анкета"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.date-picker
            s-name-field="date_start"
            s-name="Дата начала"
            :is-required="true"
            :ob-data='$obCourse??null'
        />
        <x-forms.date-picker
            s-name-field="date_end"
            s-name="Дата конца"
            :is-required="true"
            :ob-data='$obCourse??null'
        />
        <x-forms.summernote-editor
            s-name-field="description"
            s-name="Краткое описание"
            :is-required="true"
            :ob-data='$obCourse??null'
        />
        <x-forms.summernote-editor
            s-name-field="program"
            s-name="Программа"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.summernote-editor
            s-name-field="literature"
            s-name="Рекомендуемая литература"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.summernote-editor
            s-name-field="content"
            s-name="Контент для детальной странички курса дпо"
            :is-required="true"
            :ob-data='$obCourse??null'
        />
        <x-forms.select
            s-name-field="user_id"
            s-name="Куратор"
            :ar-data="$arCurators"
            s-display-key="full_name"
            :ob-data="$obCourse??null"
        />
            <div class="mb-3">
                <label for="">Преподаватели</label><br>
                <select name="teachers[]" class="form-label  multiple-select" multiple size="10">
                    @foreach($arTeachers as $obTeacher)
                        <option value="{{ $obTeacher->id }}"  @if(isset($obCourse)&& $obCourse->teachers->contains('id', $obTeacher->id)) selected @endif>
                            {{ $obTeacher->full_name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="">Специальности</label><br>
                <select name="specialities[]" class="form-label multiple-select" multiple size="10">
                    @foreach($arSpecialities as $obSpeciality)
                        <option value="{{ $obSpeciality->id }}"  @if(isset($obCourse) && $obCourse->specialities->contains('id', $obSpeciality->id)) selected @endif>
                            {{ $obSpeciality->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        <x-forms.select
            s-name-field="test_id"
            s-name="Тест прикрепленный к курсу"
            :ar-data="$arTests"
            s-display-key="title"
            :ob-data="$obCourse??null"
        />
        <x-forms.checkbox
            s-name-field="is_nmo_balls"
            s-name="Начисляются ли баллы НМО"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.checkbox
            s-name-field="is_has_certificate"
            s-name="Будет ли сертификат"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <x-forms.text-input
            s-name-field="duration"
            s-name="Продолжительность(в неделях)"
            :is-required="true"
            :ob-data='$obCourse??null'
        />
        <x-forms.text-input
            s-name-field="price"
            s-name="Цена"
            :is-required="false"
            :ob-data='$obCourse??null'
        />
        <div class="mb-3">
            <label class="form-label">Требуемое образование</label>
            <select class="form-control" id="education" name="education_level_id">
                @foreach($arEducationLevels as $obE)
                        <option value="{{ $obE->id }}"  @if(isset($obCourse) && $obCourse->education_level_id == $obE->id) selected @endif>
                            {{ $obE->name }}
                        </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="">Основа обучения</label><br>
            <select name="studyforms[]" class="form-label multiple-select" multiple size="10">
                @foreach($arStudyForms as $obStudyForm)
                    <option value="{{ $obStudyForm->id }}"  @if(isset($obCourse) && $obCourse->studyforms->contains('id', $obStudyForm->id)) selected @endif>
                        {{ $obStudyForm->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            @isset($obCourse)
                Текущая обложка
                <img src="{{ \Illuminate\Support\Facades\Storage::url($obCourse->image) }}" alt="" width="150"><br>
            @endisset
            <label for="image" class="form-label">Обложка</label>
            <input class="form-control" type="file" id="image" name="image"
            >
            @if(!isset($obSpecialist))
                <div class="invalid-feedback">
                    Вы не указали фото
                </div>
            @endif
        </div>

        @isset($arUsers)
            <div class="mb-3">
                <label for="">Пользователи</label><br>
                <select name="users[]" class="form-label  multiple-select" multiple>
                    @foreach($arUsers as $obUser)
                        @if(isset($obCourse) && !$obCourse->users->contains('id', $obUser->id))
                            <option value="{{ $obUser->id }}">
                                {{ $obUser->full_name }}
                            </option>
                        @endif
                    @endforeach
                </select>
            </div>
        @endisset

        <div class="form-group">
            <label for="">Файлы</label><br>
            <input type="file" name="files[]" multiple>
        </div>

        @isset($obCourse)
            <button type="submit" class="btn btn-warning">Обновить</button>
        @else
            <button type="submit" class="btn btn-success">Добавить</button>
        @endisset
    </form>

    <br>
    @isset($arUsers)
        <div class="mb-3">
            <h4>Пользователи уже записанные на курс</h4><br>
            <form action="{{ route('admin.courses.users.detach', compact('obCourse')) }}"
                  method="post">
                @csrf
                @foreach($arUsers as $obUser)
                    @if(isset($obCourse) && $obCourse->users->contains('id', $obUser->id))
                        <input type="checkbox" value="{{ $obUser->id }}" name="users[]"> {{ $obUser->full_name }}<br><br>
                    @endif
                @endforeach
                <button class="btn-danger btn" type="submit">Открепить</button>
            </form><br>
        </div>
    @endisset

    @isset($obCourse)
        <p>Файлы курса:</p>
        @foreach($obCourse->files as $obFile)
            <form action="{{ route('admin.file.course.detach', ['obCourse' => $obCourse, 'obFile' => $obFile]) }}"
                  method="post">
                @csrf
                <a href="{{ \Illuminate\Support\Facades\Storage::url($obFile->path) }}"
                   target="_blank">{{ $obFile->name }}</a>
                <button class="btn btn-danger" type="submit">Удалить файл</button>
            </form>
        @endforeach
    @endisset
    <br><br><br>

    {{--  ====================================================  --}}


    @isset($obCourse)
        <h1>Контент курса</h1>
        <form action="{{ route('admin.blocks.store') }}" method="POST" class="coll col-lg-6 needs-validation" enctype="multipart/form-data">
            @csrf
            <h3>Добавление темы</h3>
            <input type="hidden" name="course_id" value="{{ $obCourse->id }}">
            <x-forms.text-input
                s-name-field="order"
                s-name="Порядок"
                :is-required="true"
                :ob-data="null"
            />
            <x-forms.text-input
                s-name-field="title"
                s-name="Название"
                :is-required="true"
                :ob-data='null'
            />
            <x-forms.summernote-editor
                s-name-field="content"
                s-name="Контент на страничке"
                :is-required="false"
                :ob-data='null'
            />
            <x-forms.summernote-editor
                s-name-field="literature"
                s-name="Список литературы по теме"
                :is-required="false"
                :ob-data='null'
            />
            <div class="form-group">
                <label for="">Материалы</label><br>
                <input type="file" name="materials[]" multiple>
            </div>
            <div class="form-group">
                <label for="">Презентации</label><br>
                <input type="file" name="presentations[]" multiple>
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
        <br><br>
        @foreach($arBlocks as $obBlock)
            <form action="{{ route('admin.blocks.update', $obBlock) }}" method="POST"
                  class="coll col-lg-6 needs-validation" enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <x-forms.text-input
                    s-name-field="order"
                    s-name="Порядок"
                    :is-required="true"
                    :ob-data="$obBlock??null"
                />
                <x-forms.text-input
                    s-name-field="title"
                    s-name="Название"
                    :is-required="true"
                    :ob-data="$obBlock??null"
                />
                <x-forms.summernote-editor
                    s-name-field="content"
                    s-name="Контент на страничке"
                    :is-required="false"
                    :ob-data='$obBlock??null'
                />
                <x-forms.summernote-editor
                    s-name-field="literature"
                    s-name="Список литературы по теме"
                    :is-required="false"
                    :ob-data='$obBlock??null'
                />
                <div class="form-group">
                    <label for="">Материалы</label><br>
                    <input type="file" name="materials[]" multiple>
                </div>
                <div class="form-group">
                    <label for="">Презентации</label><br>
                    <input type="file" name="presentations[]" multiple>
                </div>
                <button type="submit" class="btn btn-info">Обновить тему</button>
            </form>
            <p>Материалы:</p>
            @foreach($obBlock->materials as $obMaterial)
                <form action="{{ route('admin.file.block.detach', ['obBlock' => $obBlock, 'obFile' => $obMaterial]) }}"
                      method="post">
                    @csrf
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($obMaterial->path) }}"
                       target="_blank">{{ $obMaterial->name }}</a>
                    <button class="btn btn-danger" type="submit">Удалить файл</button>
                </form>
            @endforeach
            <p>Презентации:</p>
            @foreach($obBlock->presentations as $obPresentation)
                <form
                    action="{{ route('admin.file.block.detach', ['obBlock' => $obBlock, 'obFile' => $obPresentation]) }}"
                    method="post">
                    @csrf
                    <a href="{{ \Illuminate\Support\Facades\Storage::url($obPresentation->path) }}"
                       target="_blank">{{ $obPresentation->name }}</a>
                    <button class="btn btn-danger" type="submit">Удалить файл</button>
                </form>
            @endforeach
            <form method="post" action="{{ route('admin.blocks.destroy', $obBlock) }}"
                  style="margin-left: 15px; margin-top: 5px; margin-bottom: 15px">
                @method('delete')
                @csrf
                <button type="submit" class="btn btn-danger">Удалить тему</button>
            </form>
            <br><br><br>
        @endforeach
    @endisset
@endsection
