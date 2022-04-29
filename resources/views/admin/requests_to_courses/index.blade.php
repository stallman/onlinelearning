@extends('admin.layouts.master')
@section('h1', $sPageTitle)
@section('content')
    <h1>{{ $sPageTitle }}</h1>
    @include('admin.search_in_entities.search')
    <br><br>
    <table id="" class="table table-admin-in-entities">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center">Фио</th>
            <th scope="col" class="text-center">Почта</th>
            <th scope="col">Дата добавления</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($arRequests as $obItem)
            <tr>
                <td scope="row" name="id">{{$obItem->id}}</td>
                <td class="text-center" name="name">{{$obItem->surname}} {{$obItem->name}} {{$obItem->patronymic}}</td>
                <td class="text-center">{{$obItem->email}}</td>
                <td>{{$obItem->created_at}}</td>

                <td>
                    <form action="{{route('admin.requests-to-courses.destroy', $obItem)}}" method="POST" class="btn-group"
                          role="group" aria-label="Basic mixed styles example">
                        <a href="{{route('admin.requests-to-courses.show', $obItem)}}" class="btn btn-success">Просмотреть</a>
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
