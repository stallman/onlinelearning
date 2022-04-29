@extends('admin.layouts.master')
@section('h1', $sPageTitle)
@section('content')
    <h1>{{ $sPageTitle }} </h1>
    <a href="{{route('admin.courses.create')}}" class="btn btn-success">Добавить</a>
    @include('admin.search_in_entities.search')
    <br><br>
    <table id="" class="table table-admin-in-entities">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center">Название</th>
            <th scope="col" class="text-center">Дата добавления</th>
            <th scope="col" class="text-center">Видимость</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($arCourses as $obItem)
            <tr>
                <td scope="row" name="id">{{$obItem->id}}</td>
                <td class="text-center" name="name">{{$obItem->title}}</td>
                <td class="text-center">{{$obItem->created_at}}</td>
                <td class="text-center">
                    <input type="checkbox" @if($obItem->is_visible) checked @endif class="change-visible-course" data-id="{{ $obItem->id }}">
                <td>
                    <form action="{{route('admin.courses.destroy', $obItem)}}" method="POST" class="btn-group"
                          role="group" aria-label="Basic mixed styles example">
                        <a href="{{route('admin.courses.edit', $obItem)}}" class="btn btn-success">Редактировать</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
