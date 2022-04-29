@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
        <x-forms.text-input
            s-name-field="surname"
            s-name="Фамилия"
            :is-required="true"
            :ob-data='$obRequest??null'
        />
        <x-forms.text-input
            s-name-field="name"
            s-name="Имя"
            :is-required="true"
            :ob-data='$obRequest??null'
        />
        <x-forms.text-input
            s-name-field="patronymic"
            s-name="Отчество"
            :is-required="true"
            :ob-data='$obRequest??null'
        />
        <x-forms.text-input
            s-name-field="email"
            s-name="Почта"
            :is-required="true"
            :ob-data='$obRequest??null'
        />

        <a href="{{ \Illuminate\Support\Facades\Storage::url($obRequest->request_file) }}" target="_blank">Прикрепленная заявка</a>
        <br>
        <div class="mb-3">
            Курс: <br>
            id: {{ $obRequest->course->id }} <br>
            Название: {{ $obRequest->course->title }} <br>
        </div>
    </form>
@endsection
