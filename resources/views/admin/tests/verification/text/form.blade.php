@extends('admin.layouts.master')
@section('h1', $sPageTitle)
@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          action="{{route('admin.tests.verification.update', $obAnswer->id)}}"
          novalidate>
    @method('PUT')
    @csrf
        <p><strong>Текст вопроса:</strong> {!! App\Models\Question::find($obAnswer->question_id)->text !!}</p>
        <p><strong>Ответ пользователя:</strong><br> {!! $obAnswer->text !!}</p>
        <x-forms.checkbox
            s-name-field="is_right"
            s-name="Это верный ответ"
            :is-required="false"
            :ob-data='$obAnswer??null'
        />
        <button type="submit" class="btn btn-success">Отправить</button>
    </form>
@endsection
