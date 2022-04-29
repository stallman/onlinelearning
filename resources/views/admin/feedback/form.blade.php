@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-8 needs-validation" method="POST"
          @isset($obFeedback)
          action="{{route('admin.feedback.update', $obFeedback)}}"
          @else
          action="{{route('admin.feedback.store')}}"
          @endisset
          novalidate

          enctype="multipart/form-data"
    >
        @isset($obFeedback)
            @method('PUT')
        @endisset

        @csrf
        <div class="content">
            <div class="row">
                <div class="col-6">
                    <x-forms.text-input
                        s-name-field="fullname"
                        s-name="ФИО"
                        :is-required="true"
                        :ob-data='$obFeedback??null'
                    />
                    <x-forms.text-input
                        s-name-field="email"
                        s-name="Email"
                        :is-required="true"
                        :ob-data='$obFeedback??null'
                    />
                    <x-forms.text-input
                        s-name-field="phone"
                        s-name="Телефон"
                        :is-required="false"
                        :ob-data='$obFeedback??null'
                    />
                    <x-forms.summernote-editor
                        s-name-field="question"
                        s-name="Вопрос"
                        :is-required="true"
                        :ob-data='$obFeedback??null'
                    />
                </div>
                <div class="col-4">
                    <label for="">Дата создания</label>
                    <input class="form-control"
                           type="text"
                           readonly
                           value="{{$obFeedback->created_at}}"
                           name="created_at"
                    >
{{--                    <x-forms.text-input--}}
{{--                        s-name-field="updated_at"--}}
{{--                        s-name="Дата редактирования"--}}
{{--                        :is-required="true"--}}
{{--                        :ob-data='$obFeedback??null'--}}
{{--                    />--}}
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    @isset($obFeedback)
                        <button type="submit" class="btn btn-warning">Обновить</button>
                    @else
                        <button type="submit" class="btn btn-success">Добавить</button>
                    @endisset
                </div>
            </div>
        </div>
    </form>
@endsection
