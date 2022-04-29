@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-6 needs-validation" method="POST" enctype="multipart/form-data"
          @isset($obTest)
          action="{{route('admin.tests.update', $obTest)}}"
          @else
          action="{{route('admin.tests.store')}}"
          @endisset
          novalidate>
        @isset($obTest)
            @method('PUT')
        @endisset
        @csrf
        <x-forms.text-input
            s-name-field="title"
            s-name="Название"
            :is-required="true"
            :ob-data='$obTest??null'
        />
        <x-forms.text-input
            s-name-field="allocated_time"
            s-name="Выделенное время(вводить в формате часы:минуты)"
            :is-required="true"
            :ob-data='$obTest??null'
        />
        <x-forms.text-input
            s-name-field="minimal_right_questions"
            s-name="Минимальное количество вопросов для сдачи"
            :is-required="true"
            :ob-data='$obTest??null'
        />
        <x-forms.checkbox
            s-name-field="is_visible"
            s-name="Видимость"
            :is-required="false"
            :ob-data='$obTest??null'
        />


        @isset($obTest)
            <button type="submit" class="btn btn-warning">Обновить</button>
        @else
            <button type="submit" class="btn btn-success">Добавить</button>
        @endisset
    </form>
    @isset($obTest)
        <br>
        <hr><br>
        <h3>Вопросы теста</h3>
        <form action="{{ route('admin.questions.store') }}" method="post" class="coll col-lg-6 needs-validation"
              enctype="multipart/form-data">
            @csrf
            <h5>Новый вопрос</h5>
            <input type="hidden" value="{{ $obTest->id }}" name="test_id">
            <x-forms.text-input
                s-name-field="order"
                s-name="Номер вопроса"
                :is-required="true"
                :ob-data='null'
            />
            <x-forms.summernote-editor
                s-name-field="text"
                s-name="Текст вопроса"
                :is-required="true"
                :ob-data='null'
            />
            <div class="mb-3">
                <label for="type" class="form-label">Выберите тип вопроса</label>
                <select name="type" id="type" class="form-control">
                    @foreach($arTestTypes as $arTestType)
                        <option value="{{ $arTestType['type'] }}">{{ $arTestType['title'] }}</option>
                    @endforeach
                </select>
                @error('type')
                <div class="alert alert-danger" role="alert">
                    {{$message}}
                </div>
                @enderror
            </div>
            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
        <br>
        <hr>
        <br>
        <h5>Редактор вопросов</h5>

        @foreach($arQuestions as $obQuestion)
            <form action="{{ route('admin.questions.update', $obQuestion) }}" method="post"
                  class="coll col-lg-6 needs-validation" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <h4>Вопрос №{{ $obQuestion->order }} тип {{ $obQuestion->type }}</h4>
                <x-forms.text-input
                    s-name-field="order"
                    s-name="Номер вопроса"
                    :is-required="true"
                    :ob-data='$obQuestion??null'
                />
                <x-forms.summernote-editor
                    s-name-field="text"
                    s-name="Текст вопроса"
                    :is-required="true"
                    :ob-data='$obQuestion??null'
                />
                <button type="submit" class="btn btn-primary">Обновить</button>
            </form>
            <form action="{{ route('admin.questions.destroy', $obQuestion) }}" method="post"
            class="coll col-lg-6 needs-validation">
            @csrf
            @method('delete')
            <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
            @if($obQuestion->type !== \App\Models\Question::TYPES['text']['type'])
                <div class="answers" style="margin-left: 30px;">
                <form action="{{ route('admin.answers.store') }}" method="post" class="coll col-lg-6 needs-validation">
                    @csrf
                    <h5>Добавить вариант ответа</h5>
                    <x-forms.summernote-editor
                        s-name-field="text"
                        s-name="Текст ответа"
                        :is-required="true"
                        :ob-data='null'
                    />
                    @if($obQuestion->type === \App\Models\Question::TYPES['one']['type'] || $obQuestion->type === \App\Models\Question::TYPES['several']['type'])
                        <x-forms.checkbox
                            s-name-field="is_right"
                            s-name="Это верный ответ"
                            :is-required="false"
                            :ob-data='null'
                        />
                    @endif
                    @if($obQuestion->type === \App\Models\Question::TYPES['right_order']['type'])
                        <x-forms.text-input
                            s-name-field="right_order"
                            s-name="Укажите верное положение данного ответа(к примеру 1, 2, 3 и т.д.)"
                            :is-required="true"
                            :ob-data='null'
                        />
                    @endif
                    <input type="hidden" value="{{ $obQuestion->id }}" name="question_id">
                    <button type="submit" class="btn btn-success">Добавить</button>
                </form>
                @isset($obQuestion->answers)
                    @foreach($obQuestion->answers as $obAnswer)
                            <form action="{{ route('admin.answers.update', $obAnswer) }}" method="post" class="coll col-lg-6 needs-validation">
                                @csrf
                                @method('patch')
                                <h5>Вариант ответа</h5>
                                <x-forms.summernote-editor
                                    s-name-field="text"
                                    s-name="Текст ответа"
                                    :is-required="true"
                                    :ob-data='$obAnswer??null'
                                />
                                @if($obQuestion->type === \App\Models\Question::TYPES['one']['type'] || $obQuestion->type === \App\Models\Question::TYPES['several']['type'])
                                    <x-forms.checkbox
                                        s-name-field="is_right"
                                        s-name="Это верный ответ"
                                        :is-required="false"
                                        :ob-data='$obAnswer??null'
                                    />
                                @endif
                                @if($obQuestion->type === \App\Models\Question::TYPES['right_order']['type'])
                                    <x-forms.text-input
                                        s-name-field="right_order"
                                        s-name="Укажите верное положение данного ответа(к примеру 1, 2, 3 и т.д.)"
                                        :is-required="true"
                                        :ob-data='$obAnswer??null'
                                    />
                                @endif
                                <button type="submit" class="btn btn-warning">обновить</button>
                            </form>
                            <form action="{{ route('admin.answers.destroy', $obAnswer->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit" style="margin-top: 10px;">Удалить вариант ответа</button>
                            </form>
                    @endforeach
                @endisset
            </div>
            @endif
            <br>
            <hr><br>
        @endforeach
    @endisset

@endsection
