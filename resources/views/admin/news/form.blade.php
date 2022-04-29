@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-8 needs-validation" method="POST"
          @isset($obNews)
          action="{{route('admin.news.update', $obNews)}}"
          @else
          action="{{route('admin.news.store')}}"
          @endisset
          novalidate

          enctype="multipart/form-data"
    >
        @isset($obNews)
            @method('PUT')
        @endisset

        @csrf
        <div class="content">
            <div class="row">
                <div class="col-6">
                    {{--                        <x-forms.checkbox--}}
                    {{--                            s-name-field="is_published"--}}
                    {{--                            s-name="Видимость поста"--}}
                    {{--                            :is-required="false"--}}
                    {{--                            :ob-data='$obNews??null'--}}
                    {{--                        />--}}
                    <x-forms.text-input
                        s-name-field="title"
                        s-name="Заголовок"
                        :is-required="true"
                        :ob-data='$obNews??null'
                    />
                    <x-forms.summernote-editor
                        s-name-field="content"
                        s-name="Контент"
                        :is-required="true"
                        :ob-data='$obNews??null'
                    />
                </div>
            </div>
            <div class="row">
                <div class="col-6">
                    <div class="">
                        <label for="old_image" class="form-label">Путь</label>
                        <input id="old_image" readonly
                               name="image_old"
                               class="form-control"
                               type="text"
                               @isset($obNews)
                                    value="{{$obNews->image}}"
                               @endisset
                               defaultvalue="@isset($obNews){{$obNews->image}}@endisset">
                    </div>
                    <br>
                    <img id="img_input" class="img-thumbnail"
                         @if (isset($obNews) && ($obNews->image !== "default"))
                             src={{asset('storage/'.$obNews->image)}}
                         @else
                             src="{{asset('assets/img/news-image.jpg')}}"
                         @endif
                         alt="">
                </div>
                <div class="col-6">
                    <label for="formFile" class="form-label">Загрузить изображение</label>
                    <input type="file"
                           class="form-control"
                           name="image"
                           id="formFile"
                           accept="image/*"
                           >
                    <br>
                    <button type="button" id="click_clr_img_input" class="btn btn-danger">Удалить</button>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-2">
                    @isset($obNews)
                        <button type="submit" class="btn btn-warning">Обновить</button>
                    @else
                        <button type="submit" class="btn btn-success">Добавить</button>
                    @endisset
                </div>
            </div>
        </div>
    </form>
@endsection
