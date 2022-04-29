@extends('front.layouts.master')

@section('content')
    <main>
        <!-- Start content page -->
        <div class="title-page">
            <div class="layout" style="background-image: url({{ asset('assets/img/fon-ordinatura.jpg') }})"></div>
            <div class="heading">
                <h1>Результаты поиска</h1>
            </div>
        </div>
        <div class="container">
            <div class="search__head">
                <form method="get" action="{{ route('search.handle', 1) }}">
                    <div class="search-form">
                        <input type="text" class="form-control" @isset($sSearchString) value="{{ $sSearchString }}"
                               @endisset name="search" required>
                        <button type="submit" class="btn search-submit">Найти</button>
                    </div>
                </form>
                @isset($iResults)
                    @if($iResults > 0)
                        <div class="search__result">
                            <div class="search-count">
                                Найдено результатов: <b>{{ $iResults }}</b>
                            </div>
                            <div class="search-sort">
                                <div class="search-sort-label">Сортировка:</div>
                                <div class="search-sort-link">
                                    <a href="{{ route('search.handle', ['iPage' => ($iPage)]) }}?search={{ $sSearchString }}&filter=date"
                                       @if($sFilterType === 'date')
                                            class="current"
                                       @endif
                                       >по дате</a>
                                </div>
                                <div class="search-sort-link">
                                    <a href="{{ route('search.handle', ['iPage' => ($iPage)]) }}?search={{ $sSearchString }}&filter=relevant"
                                       @if($sFilterType === 'relevant')
                                       class="current"
                                        @endif
                                    >по релевантности</a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endisset
            </div>

            <div class="search__body">
                @isset($arResultOnPage)
                @if($iResults > 0)
                    @foreach($arResultOnPage as $obResult)
                        <div class="search__item">
                            <div class="search__item-head">
                                <a href="{{ $obResult->getRoute() }}" target="_blank">{!! $obResult->getTitleForSearch($sSearchString) !!}</a>
                            </div>
                            <div class="search__item-body">
                                {!! $obResult->getSearchDescription($sSearchString) !!}
                                {{--                                Посвящена актуальным вопросам неотложной <span>хирургии</span>. Неотложная <span>хирургия</span>--}}
                                {{--                                требует от врача знаний, опыта и широкой эрудиции для принятия правильных решений в--}}
                                {{--                                критических ситуациях....--}}
                            </div>
                            <div class="search__item-footer">
                                <p>Изменен: {{ date('d.m.Y', $obResult->updated_at->timestamp) }} </p>
                                <p>Путь: <a href="{{ route('home') }}">Главная</a> / <a
                                        href="{{ $obResult->type['route'] }}">{{ $obResult->type['title'] }}</a>
                                </p>
                            </div>
                        </div>
                    @endforeach

                @else
                    <h4>Результатов по запросу "{{ $sSearchString }}" не найдено</h4>
                @endif
                @endisset

                @isset($arResultOnPage)
                    @if($iPages > 1)
                        <ul class="pagination">
                            @if($iPage !== 1)
                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ route('search.handle', ['iPage' => ($iPage - 1)]) }}?search={{ $sSearchString }}&filter={{ $sFilterType }}"
                                       aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                            @endif
                            @if($iPage - 2 !== 0  && $iPage >= 2)
                                <li class="page-item">
                                    <a class="page-link" href="{{ route('search.handle', ['iPage' => ( 1)]) }}?search={{ $sSearchString }}&filter={{ $sFilterType }}">{{ 1 }}</a>
                                </li>
                            @endif
                            @if($iPages >= 5 && $iPage - 1 > 2)
                                <li class="page-item">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            @if($iPage - 1 >= 1)
                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ route('search.handle', ['iPage' => ($iPage - 1)]) }}?search={{ $sSearchString }}&filter={{ $sFilterType }}">{{ $iPage - 1 }}</a>
                                </li>
                            @endif
                            <li class="page-item active">
                                <a class="page-link" href="#">{{ $iPage }}</a>
                            </li>
                            @if($iPage + 1 < $iPages && $iPage + 1 !== 2 )
                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ route('search.handle', ['iPage' => ($iPage + 1)]) }}?search={{ $sSearchString }}&filter={{ $sFilterType }}">{{ $iPage + 1 }}</a>
                                </li>
                            @endif
                            @if($iPages >= 5 && $iPages - $iPage > 2)
                                <li class="page-item">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            @if($iPage !== $iPages && is_int($iPages))
                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ route('search.handle', ['iPage' => $iPages]) }}?search={{ $sSearchString }}&filter={{ $sFilterType }}">{{ $iPages }}</a>
                                </li>
                            @endif
                            @if($iPage < $iPages)
                                <li class="page-item">
                                    <a class="page-link"
                                       href="{{ route('search.handle', ['iPage' => ($iPage + 1)]) }}?search={{ $sSearchString }}&filter={{ $sFilterType }}"
                                       aria-label="Previous">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    @endif
                @endisset
            </div>
        </div>
        <!-- End content page -->
    </main>
@endsection
