<div class="row">
    <div class="col-lg-12">
        <div class="popularQuestion">
            <h4 class="mb-3">Popular Question</h4>
            <div class="list-group">
                @foreach ($populars as $popular)
                <a href="{{route('forumslug', $popular->slug)}}" class="list-group-item"
                    id="popularHover">{{$popular->title}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>