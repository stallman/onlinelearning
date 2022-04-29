@extends('admin.layouts.master')

@section('content')
    <h1>{{ $sPageTitle }}</h1>
    <form class="coll col-lg-8 needs-validation" method="POST"
          @isset($obBanner)
          action="{{route('admin.banners.update', $obBanner)}}"
          @else
          action="{{route('admin.banners.store')}}"
          @endisset
          novalidate

          enctype="multipart/form-data"
    >
        @isset($obBanner)
            @method('PUT')
        @endisset

        @csrf
            <div class="content">
                <div class="row">
                    <div class="col-6">
                        <x-forms.checkbox
                            s-name-field="is_published"
                            s-name="Видимость банера"
                            :is-required="false"
                            :ob-data='$obBanner??null'
                        />
                        <x-forms.text-input
                            s-name-field="title"
                            s-name="Заголовок"
                            :is-required="true"
                            :ob-data='$obBanner??null'
                        />
                        <x-forms.summernote-editor
                            s-name-field="content"
                            s-name="Контент"
                            :is-required="true"
                            :ob-data='$obBanner??null'
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
                                   value="@isset($obBanner){{$obBanner->image}}@endisset"
                                   defaultvalue="@isset($obBanner){{$obBanner->image}}@endisset">
                        </div>
                        <br>
                        <img id="img_input" class="img-thumbnail"
                             @isset($obBanner)
                                src="{{asset('storage/'.$obBanner->image)}}"
                             @else
                                src="{{asset('assets/img/news-image.jpg')}}"
                             @endisset
                             alt="">
                    </div>
{{--                    <div class="col-6">--}}
{{--                        --}}
{{--                        <br>--}}
{{--                    </div>--}}
                    <div class="col-6">
                        <label for="formFile" class="form-label">Изображение</label>
                        <input type="file"
                               class="form-control"
                               name="image"
                               id="formFile"
                               accept="image/*">
                        <br>
                        <button type="button" id="click_clr_img_input" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-2">
                        @isset($obBanner)
                            <button type="submit" class="btn btn-warning">Обновить</button>
                        @else
                            <button type="submit" class="btn btn-success">Добавить</button>
                        @endisset
                    </div>
                </div>
            </div>
    </form>
@endsection
