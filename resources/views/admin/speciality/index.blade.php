@extends('admin.layouts.master')
@section('h1', $sPageTitle)
@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <a href="{{route('admin.speciality.create')}}" class="btn btn-success">Добавить</a>
    @include('admin.search_in_entities.search')
    <br><br>
    <table id="" class="table table-admin-in-entities">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col" class="text-center">Название</th>
            <th scope="col" class="text-center">Образование</th>
            <th scope="col">Дата добавления</th>
            <th scope="col">Дата изменения</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($arSpeciality as $obItem)
            <tr>
                <td scope="row" name="id">{{$obItem->id}}</td>
                <td class="text-center" name="name">{{$obItem->name}}</td>
                <td>@if ($obItem->education_level_id == 1) высшее @else среднее @endif</td>
                <td>{{$obItem->created_at}}</td>
                <td>{{$obItem->updated_at}}</td>
                <td>
                    <form action="{{route('admin.speciality.destroy', $obItem)}}" method="POST" class="btn-group"
                          role="group" aria-label="Basic mixed styles example">
                        <a href="{{route('admin.speciality.edit', $obItem)}}" class="btn btn-success">Редактировать</a>
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
