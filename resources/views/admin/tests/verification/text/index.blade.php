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
            <th scope="col" class="text-center">Номер теста</th>
            <th scope="col" class="text-center">Пользователь</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($arData as $obItem)
            <tr>
                <td scope="row" name="id">{{$obItem->id}}</td>
                <td class="text-center" name="name">{{$obItem->title}}</td>
                <td class="text-center">{{App\Models\User::find($obItem->user_id)->full_name}}</td>
                <td>{{$obItem->created_at}}</td>

                <td>
                    <a href="{{route('admin.tests.verification.edit', $obItem->id)}}" class="btn btn-success">Просмотреть</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
