@foreach($arAllNews as $obPost)
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