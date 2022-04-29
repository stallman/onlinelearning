@extends('admin.layouts.master')
@section('h1', $sPageTitle)
@section('content')
    <h1>{{ $sPageTitle }}</h1><br>
    <form action="{{route('admin.users.import.store')}}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="file">Файл для импорта</label><br><br>
        <input type="file" name="file"><br><br>
        <button type="submit" class="btn btn-success">Импортировать</button>
    </form>

    <table class="table">

    </table>
@endsection
