@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="d-md-none">
            <img src="{{ asset('assets/img/back-small.jp') }}g" alt="Система дистанционного обучения"/>
        </div>

        <section class="site-title">
            <div class="container">
                <h1><strong>Система дистанционного обучения</strong></h1>
                <div class="niioz">
                    <div>
                        При поддержке
                    </div>
                    <div>
                        <a href="https://niioz.ru/" target="_blank">
                            <img src="{{ asset('assets/img/niioz.svg') }}" alt="НИИОЗММ ДЗМ"/>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section class="about">
            <div class="about__body">
                <div class="section-title">
                    <h2>О проекте</h2>
                </div>
                <div class="about__text">
                    <div class="epigraph">
                        <p>
                            "Природный ум может заменить любое образование, но&nbsp;никакое образование не&nbsp;может заменить природного ума."
                        </p>
                        <p>
                            Артур Шопенгауэр
                        </p>
                    </div>
                    <p>Государственное бюджетное учреждение города Москвы «Научно-исследовательский институт организации здравоохранения и медицинского менеджмента Департамента здравоохранения города Москвы» (далее – Институт) является одним из ведущих образовательных центров города Москвы по разработке и реализации дополнительных профессиональных образовательных программ повышения квалификации в сфере общественного здоровья и здравоохранения.</p>
                    <p>В Институте разработаны образовательные программы повышения квалификации для совершенствования и получения новых компетенций, а также для повышения профессионального уровня в рамках имеющейся квалификации для медицинских специалистов различного профиля высшего и среднего звена.</p>
                    <p>Разработка дополнительных профессиональных образовательных программ осуществляется с учетом требований профессиональных стандартов и квалификационных требований к профессиональным знаниям и навыкам, необходимым для исполнения должностных обязанностей.</p>
                    <div class="collapse" id="collapseAbout">
                        <p>Обучение по дополнительным профессиональным образовательным программам осуществляется на основании лицензии на осуществление образовательной деятельности.</p>
                        <p>Обучение по программам осуществляется в очной, очно-заочной и заочной формах. Программы могут быть реализованы с применением электронного обучения и (или) дистанционных образовательных технологий в соответствии с локальными нормативными актами Института.</p>
                        <p>К реализации программ повышения квалификации привлекается преподавательский состав Института, чей уровень квалификации и профиль подготовки соответствует установленным требованиям, а также научно-педагогические работники, руководители и высококвалифицированные специалисты.</p>
                        <p>В Институте обучение специалистов здравоохранения с высшим и средним медицинским образованием по программам повышения квалификации проводится за счет бюджетных ассигнований города Москвы, а также за счет средств физических и (или) юридических лиц в соответствии с договорами об оказании платных образовательных услуг. Стоимость обучения в Институте является доступной для каждого специалиста.</p>
                        <p>После успешной сдачи итоговой аттестации слушателю выдается Удостоверение о повышении квалификации.</p>
                        <p>Все программы проходят регистрацию на портале непрерывного медицинского и фармацевтического образования Минздрава России. После успешного освоения программы специалисту начисляются баллы на портале НМФО.</p>
                    </div>
                    <div>
                        <a href="#collapseAbout" data-toggle="collapse" class="collapse-toggle">Читать еще</a>
                    </div>
                </div>
                <div class="about__image">
                    <img src="assets/img/doctor.png" alt=""/>
                </div>
            </div>
        </section>

        <section class="courses">
            <div class="courses__header">
                <h2 class="courses__title">Курсы для Вас</h2>
                <div class="courses__filter">
                    <select class="js-example-basic-single" id="spec-select" data-live-search="true" title="Выберите специальность курсов" data-width="350px" data-size="5" data-virtual-scroll="false" data-none-results-text="Не найдено" data-dropdown-align-right="true">
                    @foreach($arSpecialities as $obSpeciality)
                        <option value="{{ $obSpeciality->id }}">
                            {{ $obSpeciality->name }}
                        </option>
                    @endforeach
                    </select>
                </div>
            </div>


            <div class="row last-n-tablet" id="course-specialities">
                @foreach($arCourses as $obC)
                    <x-courses.card
                        :ob-course="$obC"
                    />
                @endforeach
            </div>

            <div class="center-button">
                <a href="{{ route('courses.index') }}" class="btn" id="more-courses">Больше курсов</a>
            </div>
        </section>


        <div class="card-block">
            <div class="card-block__container">
                <div class="row">
                    @foreach($arInfoBanners as $obBanner)
                        <div class="card-block__item">
                            <div class="card-rounded">
                                {!! $obBanner->content !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- Скрытый блок --}}
        <section class="courses d-none">
            <div class="courses__header">
                <h2 class="courses__title">Популярные курсы</h2>
            </div>
            <div class="row last-n-tablet">
                <div class="courses__item">
                    <div class="course-card">
                        <a href="#" class="unstyled">
                            <div class="course-card-image" style="background-image: url({{ asset('assets/img/temp/course1.jpg') }})"></div>
                            <h5 class="course-card-title">Инфекционная безопасность. Основные правила для популяции, населения и медицинских работников</h5>
                        </a>
                        <div class="course-card-body">
                            <div class="col">
                                <p>Дата начала: 01.09.20</p>
                                <p>Стоимость: Бесплатно</p>
                                <p>Длительность: 3 месяца</p>
                                <p>Диплом/сертификат: нет</p>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary">записаться</button>
                                <button class="btn btn-primary" data-target="#program" data-toggle="modal">запросить программу</button>
                            </div>
                        </div>
                        {{-- Скрытый блок --}}
                        <div class="course-card-footer d-none">
                            <div class="course-feedback">
                                Отвывы: <a href="#">10</a>
                            </div>
                            <ul class="rating rating-4">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="courses__item">
                    <div class="course-card">
                        <a href="#" class="unstyled">
                            <div class="course-card-image" style="background-image: url({{ asset('assets/img/temp/course2.jpg') }})"></div>
                            <h5 class="course-card-title">Адаптация системы здравоохранения в условиях распространения инфекционных заболеваний</h5>
                        </a>
                        <div class="course-card-body">
                            <div class="col">
                                <p>Дата начала: 01.09.20</p>
                                <p>Стоимость: Бесплатно</p>
                                <p>Длительность: 3 месяца</p>
                                <p>Диплом/сертификат: да</p>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary">записаться</button>
                                <button class="btn btn-primary" data-target="#program" data-toggle="modal">запросить программу</button>
                            </div>
                        </div>
                        {{-- Скрытый блок --}}
                        <div class="course-card-footer d-none">
                            <div class="course-feedback">
                                Отвывы: <a href="#">17</a>
                            </div>
                            <ul class="rating rating-5">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="courses__item">
                    <div class="course-card">
                        <a href="#" class="unstyled">
                            <div class="course-card-image" style="background-image: url({{ asset('assets/img/temp/course3.jpg') }})"></div>
                            <h5 class="course-card-title">ОЗиОЗ-Демографический статус и состояние здоровья населения РФ</h5>
                        </a>
                        <div class="course-card-body">
                            <div class="col">
                                <p>Дата начала: 01.09.20</p>
                                <p>Стоимость: Бесплатно</p>
                                <p>Длительность: 3 месяца</p>
                                <p>Диплом/сертификат: нет</p>
                            </div>
                            <div class="col">
                                <button class="btn btn-secondary">записаться</button>
                                <button class="btn btn-primary" data-target="#program" data-toggle="modal">запросить программу</button>
                            </div>
                        </div>
                        {{-- Скрытый блок --}}
                        <div class="course-card-footer d-none">
                            <div class="course-feedback">
                                Отвывы: <a href="#">2</a>
                            </div>
                            <ul class="rating rating-3">
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                                <li></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="center-button">
                <a href="#" class="btn">Все курсы</a>
            </div>
        </section>

        <section class="courses">
            <div class="courses__header">
                <h2 class="courses__title">Новости</h2>
            </div>
            <div class="row last-n-tablet">
                @foreach($arLastNews as $obPost)
                    <div class="news__item">
                        <a href="{{route('front.news.show', $obPost)}}" class="news-card">
                            <div class="news-card-image" style="background-image:
                            @if ($obPost->image !== "default")
                                url({{asset('storage/'.$obPost->image)}})">
                                @else
                                    url({{asset('assets/img/news-image.jpg')}}")">
                                @endif
                            </div>
                            <div class="news-card-head">
                                <span class="news-date">{{date("d.m.Y",strtotime($obPost->created_at))}}</span>
                                <span class="news-view d-none">Просмотров: 0</span>
                            </div>
                            <h4 class="news-card-title">
                                {{$obPost->title}}
                            </h4>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="center-button">
                <a href="{{ route('news') }}" class="btn">Все новости</a>
            </div>
        </section>


        <div class="bg-gradient-light">
            {{-- Скрытый блок --}}
            <section class="reviews d-none">
                <div class="row">
                    <div class="section-title">
                        <h2>Студенты о нас</h2>
                    </div>
                    <div class="carousel-reviews">
                        <div class="carousel-cell">
                            <div class="reviews-item">
                                <div class="reviews-card">
                                    <div class="review-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                                    </div>
                                    <div class="review-score">
                                        <ul class="rating rating-5">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="review-person">
                                        <div class="user-img" style="background-image: url({{ asset('assets/img/temp/curator.jpg') }})"></div>
                                        <div class="user-name">
                                            <p><b>Иванов Иван</b></p>
                                            <span>куратор</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-cell">
                            <div class="reviews-item">
                                <div class="reviews-card">
                                    <div class="review-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                                    </div>
                                    <div class="review-score">
                                        <ul class="rating rating-4">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="review-person">
                                        <div class="user-img"></div>
                                        <div class="user-name">
                                            <p><b>Ксения Серебрякова</b></p>
                                            <span>студент</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-cell">
                            <div class="reviews-item">
                                <div class="reviews-card">
                                    <div class="review-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                                    </div>
                                    <div class="review-score">
                                        <ul class="rating rating-1">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="review-person">
                                        <div class="user-img"></div>
                                        <div class="user-name">
                                            <p ><b>Игорь Гапонов</b></p>
                                            <span>руководитель</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-cell">
                            <div class="reviews-item">
                                <div class="reviews-card">
                                    <div class="review-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                                    </div>
                                    <div class="review-score">
                                        <ul class="rating rating-5">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="review-person">
                                        <div class="user-img" style="background-image: url({{ asset('assets/img/temp/curator.jpg') }})"></div>
                                        <div class="user-name">
                                            <p><b>Иванов Иван</b></p>
                                            <span>куратор</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-cell">
                            <div class="reviews-item">
                                <div class="reviews-card">
                                    <div class="review-text">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo.
                                    </div>
                                    <div class="review-score">
                                        <ul class="rating rating-1">
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                            <li></li>
                                        </ul>
                                    </div>
                                    <div class="review-person">
                                        <div class="user-img"></div>
                                        <div class="user-name">
                                            <p><b>Игорь Гапонов</b></p>
                                            <span>руководитель</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Скрытый блок --}}
            <section class="curators d-none">
                <div class="row">
                    <div class="section-title">
                        <h2>Кураторы</h2>
                    </div>
                </div>
                <div class="row last-n-tablet">
                    <div class="curators__item">
                        <a href="#" class="unstyled">
                            <div class="curator-card">
                                <div class="expert-img" style="background-image: url({{ asset('assets/img/temp/curator.jpg') }})"></div>
                                <div>
                                    <p class="expert-name">Иванов<br />Иван Иванович</p>
                                    <p>Доцент</p>
                                    <p>Заведующий отделением неотложной хирургии</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="curators__item">
                        <a href="#" class="unstyled">
                            <div class="curator-card">
                                <div class="expert-img" style="background-image: url({{ asset('assets/img/temp/curator.jpg') }})"></div>
                                <div>
                                    <p class="expert-name">Иванов<br />Иван Иванович</p>
                                    <p>Доцент</p>
                                    <p>Заведующий отделением неотложной хирургии</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="curators__item d-md-none d-lg-block">
                        <a href="#" class="unstyled">
                            <div class="curator-card">
                                <div class="expert-img" style="background-image: url({{ asset('assets/img/temp/curator.jpg') }})"></div>
                                <div>
                                    <p class="expert-name">Иванов<br />Иван Иванович</p>
                                    <p>Доцент</p>
                                    <p>Заведующий отделением неотложной хирургии</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="center-button">
                    <a href="#" class="btn">Все кураторы</a>
                </div>
            </section>
        </div>
        <!-- End content page -->
    </main>
@endsection
