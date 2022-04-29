@extends('admin.layouts.master')
@section('h1', $sPageTitle)
@section('content')
    <h1>{{ $sPageTitle }}</h1><br>
    <form action="{{route('admin.tests.import.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file">Файл для импорта</label><br><br>
        <input type="file" name="file"><br><br>
        <x-forms.select
            s-name-field="test_id"
            s-name="Тест для импорта"
            :ar-data="$arTests"
            s-display-key="title"
            :ob-data="$obCourse??null"
        />
        <button type="submit" class="btn btn-success">Импортировать</button>
    </form>

    <table class="table">

    </table>
@endsection
