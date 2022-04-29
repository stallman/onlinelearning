@extends('front.layouts.master')

@section('content')
    <main>

        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-account.jpg') }})"></div>
            <div class="heading">
                <h1>Мой профиль</h1>
            </div>
        </div>
        <div class="container">
            <form method="post" action="{{ route('users.update') }}">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if(session()->has('success'))
                    <div class="alert alert-success" role="alert">
                        {{session()->get('success')}}
                    </div>
                @endif
                @csrf
                <div class="profile">
                    <div class="profile__col">
                        <div class="profile__row">
                            <div class="profile__fieldset">
                                <h2 class="title-h4">Персональные данные</h2>
                                <div class="form-group">
                                    <label>*Фамилия</label>
                                    <input type="text" required class="form-control" value="{{ $obUser->surname }}" name="surname"/>
                                </div>
                                <div class="form-group">
                                    <label>*Имя</label>
                                    <input type="text" required class="form-control" value="{{ $obUser->name }}" name="name"/>
                                </div>
                                <div class="form-group">
                                    <label>Отчество</label>
                                    <input type="text" class="form-control" value="{{ $obUser->patronymic }}"
                                           name="patronymic"/>
                                </div>
                            </div>
                            <div class="profile__fieldset">
                                <h2 class="title-h4">Контакты</h2>
                                <div class="form-group">
                                    <label>*E-mail</label>
                                    <input type="email" required class="form-control" value="{{ $obUser->email }}" name="email"/>
                                </div>
                                <div class="form-group">
                                    <label>Телефон</label>
                                    <input type="text" class="form-control phone" value="{{ $obUser->phone }}" name="phone" inputmode="tel" minlength="12"/>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="profile__col">
                        <div class="profile__row">
                            <div class="profile__fieldset">
                                <h2 class="title-h4">Карьера</h2>
                                <div class="form-group">
                                    <label>Основное место работы (организация)</label>
                                    <input type="text" class="form-control" value="{{ $obUser->job }}" name="job"/>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>--}}
{{--                                        Специализация--}}
{{--                                        <span class="label-tooltip" data-toggle="tooltip"--}}
{{--                                              title="В соответствии с номенклатурой специальностей специалистов, имеющих высшее медицинское и фармацевтическое образование"></span>--}}
{{--                                    </label>--}}
{{--                                    <select class="custom-select" name="specialization_id" id="select_specialization">--}}
{{--                                        <option value="-1" disabled selected>выберите специализацию</option>--}}
{{--                                        @foreach($arSpecializations as $obSpecialization)--}}
{{--                                            <option value="{{ $obSpecialization->id }}"--}}
{{--                                                    @if($obSpecialization->id === $obUser->specialization_id) selected @endif>{{ $obSpecialization->name }}</option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
{{--                                </div>--}}
                                <div class="form-group">
                                    <label>*Должность</label>
                                    <input type="text" required class="form-control" value="{{ $obUser->position }}" name="position"/>
                                </div>
                            </div>
                            <div class="profile__fieldset">
                                <h2 class="title-h4">Образование</h2>
                                <div class="form-group">
                                    <label>
                                        *Уровень образования
                                        <span class="label" data-toggle="tooltip"></span>
                                    </label>
{{--                                    <select class="custom-select" id="select_education_lvl" name="education_level_id" required>--}}
{{--                                        <option value="" disabled selected>выберите уровень образования</option>--}}
{{--                                        @foreach($arEducationLevel as $obEducationLevel)--}}
{{--                                            <option value="{{ $obEducationLevel->id }}"--}}
{{--                                                    @if($obEducationLevel->id === $obUser->education_level_id) selected @endif>--}}
{{--                                                {{ $obEducationLevel->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}

                                    <select class="selectpicker"
                                            id="select_education_lvl"
                                            name="education_level_id"
{{--                                            data-live-search="true"--}}
                                            title="выберите уровень образования"
                                            data-width="400px"
                                            data-size="5"
                                            required>
                                        <option value="" disabled selected>выберите уровень образования</option>
                                        @foreach($arEducationLevel as $obEducationLevel)
                                            <option value="{{ $obEducationLevel->id }}"
                                                    @if($obEducationLevel->id === $obUser->education_level_id) selected @endif>
                                                {{ $obEducationLevel->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <input type="hidden" id="url_specialty_get_data" value="{{ route('specialty_get_data') }}">
                                </div>
                                <div class="form-group">
                                    <label>
                                        Специальность
                                        <span class="label" data-toggle=""></span>
                                    </label>
                                    <div class="speciality-filter">
                                    <select class="selectpicker"
                                            id="select_speciality"
                                            data-live-search="true"
                                            title="выберите специальность"
                                            name="speciality_id"
                                            data-width="400px"
                                            data-size="5"
                                    >
                                        <option value="" >выберите специальность</option>
                                        @foreach($arSpeciality as $obSpeciality)
                                            <option value="{{ $obSpeciality->id }}"
                                                    @if($obSpeciality->id === $obUser->speciality_id) selected @endif>
                                                {{ $obSpeciality->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    </div>
{{--                                    <select class="custom-select" id="select_speciality"--}}
{{--                                            name="speciality_id"--}}
{{--                                            @isset($obUser->other_speciality)--}}
{{--                                                disabled--}}
{{--                                            @endisset--}}
{{--                                    >--}}
{{--                                        <option value="" >выберите специальность</option>--}}
{{--                                        @foreach($arSpeciality as $obSpeciality)--}}
{{--                                            <option value="{{ $obSpeciality->id }}"--}}
{{--                                                    @if($obSpeciality->id === $obUser->speciality_id) selected @endif>--}}
{{--                                                {{ $obSpeciality->name }}--}}
{{--                                            </option>--}}
{{--                                        @endforeach--}}
{{--                                    </select>--}}
                                    <br>
                                    <br>
                                    <div class="form-check">
                                        <input type="checkbox"
                                               class="form-check-input"
                                               id="checkOtherSpeciality"
                                               @isset($obUser->other_speciality)
                                                    checked
                                               @endisset
                                        >
                                        <label class="form-check-label" for="checkOtherSpeciality">
                                            Другое
                                        </label>
                                    </div>
                                    <br>
                                    <div id="other_speciality"
                                         class="form-group @empty($obUser->other_speciality) d-none @endempty">
                                        <label>Другая специальность</label>
                                        <input type="text" id="input_other_speciality" class="form-control" value="{{$obUser->other_speciality}}"  name="other_speciality"/>
                                    </div>
                                </div>
{{--                                <div class="form-group">--}}
{{--                                    <label>--}}
{{--                                        Наличие сертификата/аттестации--}}
{{--                                        <span class="label-tooltip" data-toggle="tooltip"--}}
{{--                                              title="Указывается специальность и год последней сертификации/аккредитации"></span>--}}
{{--                                    </label>--}}
{{--                                    <input type="text" class="form-control" value="{{ $obUser->certificate }}" name="certificate"/>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                    <div class="profile__col">
                        <div class="profile__row">
                            <div class="profile__fieldset">
                                <h2 class="title-h4">Безопасность</h2>
                                <div class="form-group">
                                    <label>Старый пароль</label>
                                    <input type="password" class="form-control" name="old_password" value="{{ old('old_password') }}"/>
                                </div>
                                <div class="form-group">
                                    <label>
                                        Новый пароль
                                        <span class="label-tooltip" data-toggle="tooltip"
                                              title="Пароль должен содержать не менее 6 знаков"></span>
                                    </label>
                                    <input type="password" class="form-control" name="password" value="{{ old('password') }}"/>
                                </div>
                                <div class="form-group">
                                    <label>Повторите новый пароль</label>
                                    <input type="password" class="form-control" name="password_confirmation"/>
                                </div>
                            </div>
                            <div class="profile__fieldset">
                                <h2 class="title-h4">Фото профиля</h2>
                                <div class="profile__photo">
                                    <div class="position-relative">
{{--                                        <a href="#" class="btn-delete" title="удалить фото">&times;</a>--}}
                                        <div class="photo-profile"
                                             style="background-image: url({{ Storage::url($obUser->image) }})"></div>
                                    </div>
                                    <div>
                                        <button type="button" class="btn btn-link" data-toggle="modal"
                                                data-target="#addPhoto">Добавить фото
                                        </button>
                                    </div>
                                </div>
                                <div class="profile__submit">
                                    <button class="btn btn-submit" type="submit">сохранить изменения</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- End content page -->
    </main>
@endsection
