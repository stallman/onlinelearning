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
            <th scope="col" class="text-center">Название</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($arCourses as $obItem)
            <tr>
                <td scope="row" name="id">{{$obItem->id}}</td>
                <td class="text-center" name="name">{{$obItem->title}}</td>
                <td>
                    <a href="{{route('admin.report-courses-views.export', $obItem)}}" class="btn btn-success">Выгрузить</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
