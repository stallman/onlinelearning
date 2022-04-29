@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          @isset($obSpecialization)
          action="{{route('admin.specializations.update', $obSpecialization)}}"
          @else
          action="{{route('admin.specializations.store')}}"
          @endisset
          novalidate>
        @isset($obSpecialization)
            @method('PUT')
        @endisset
        @csrf
        <x-forms.text-input
            s-name-field="name"
            s-name="Название"
            :is-required="true"
            :ob-data='$obSpecialization??null'
        />
        @isset($obSpecialization)
            <button type="submit" class="btn btn-warning">Обновить</button>
        @else
            <button type="submit" class="btn btn-success">Добавить</button>
        @endisset

    </form>
@endsection
