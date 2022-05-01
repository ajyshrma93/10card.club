<div class="news_content" style="max-height:400px;overflow-y:auto">
    @php
    $image = 'assets/images/default-news-image.png';
    if($news->cover_image)
    {
    $image = $news->cover_image;
    }
    @endphp
    <p>
        <img src="{{asset($image)}}" />
    </p>
    <p><b>News Title </b>: {!! $news->title!!}</p>
    <p><b>Description</b> :</p>
    <p>{!!$news->description!!}</p>

</div>
