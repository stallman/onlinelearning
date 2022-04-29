@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          @isset($obSpeciality)
          action="{{route('admin.speciality.update', $obSpeciality)}}"
          @else
          action="{{route('admin.speciality.store')}}"
          @endisset
          novalidate>
        @isset($obSpeciality)
            @method('PUT')
        @endisset
        @csrf
        <x-forms.text-input
            s-name-field="name"
            s-name="Название"
            :is-required="true"
            :ob-data='$obSpeciality??null'
        />
        <div class="form-group">
            <label>
                Уровень образования
                <span class="label" data-toggle="tooltip"></span>
            </label>
            <select class="custom-select" name="education_level_id">
                <option value="">выберите уровень образования</option>
                @foreach($arEducationLevel as $obEducationLevel)
                    <option value="{{ $obEducationLevel->id }}"
                            @isset($obSpeciality)
                                @if($obEducationLevel->id === $obSpeciality->education_level_id) selected @endif
                            @endisset
                    >
                        {{ $obEducationLevel->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @isset($obSpeciality)
            <button type="submit" class="btn btn-warning">Обновить</button>
        @else
            <button type="submit" class="btn btn-success">Добавить</button>
        @endisset

    </form>
@endsection

