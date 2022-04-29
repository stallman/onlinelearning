@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          @isset($obUser)
          action="{{route('admin.teachers.update', $obUser)}}"
          @else
          action="{{route('admin.teachers.store')}}"
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
        <div class="form-group">
            @isset($obUser)
                <img src="{{ \Illuminate\Support\Facades\Storage::url($obUser->image) }}" alt="" width="150">
            @endisset
                <br>
            <label for="">Портрет</label>
            <input type="file" name="image">
        </div>
        <x-forms.summernote-editor
            s-name-field="description"
            s-name="Описание"
            :is-required="false"
            :ob-data='$obUser??null'
        />
        @isset($obUser)
            <button type="submit" class="btn btn-warning">Обновить</button>
        @else
            <button type="submit" class="btn btn-success">Добавить</button>
        @endisset

    </form>
@endsection
