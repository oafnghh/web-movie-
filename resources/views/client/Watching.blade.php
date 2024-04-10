<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('client.head')
</head>

<body>
    @include('client.header')
    <div class="breadcrumb-option">
        <div class="container">
            <div class="row">
                @foreach($listWatchs as $list)
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <a href="./categories.html">{{$list->movieName}}</a>
                        <span>{{$list->t_Name}}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @foreach($listWatchs as $list)
                    <div class="anime__video__player">
                        @if(strpos($list->T_Video, 'http') === 0)
                        <iframe allowfullscreen width="100%" height="600px" src="{{$list->T_Video}}"></iframe>
                        @else
                        <video id="player" playsinline controls poster="{{$list->movieThumb}}">
                            <source src="/{{$list->T_Video}}" type="video/mp4" />
                        </video>
                        @endif

                    </div>
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>{{$list->t_Name}}</h5>
                        </div>
                    </div>
                    @endforeach
                    <div class="anime__details__episodes">
                        <div class="section-title">
                            <h5>List Name</h5>
                        </div>
                        @foreach($listEp as $Ep)
                        <a href="/watch/{{$Ep->I_Movie_ID}}/{{$Ep->s_url}}">Tập {{$Ep->I_Ep_Present}}</a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8">
                    <div class="anime__details__review">
                        <div class="section-title">
                            <h5>Reviews</h5>
                        </div>
                        <div id="commentsContainer">
                            @foreach($comments as $comment)
                            <div class="anime__review__item">
                                <div class="anime__review__item__pic">
                                    <img src="https://png.pngtree.com/png-vector/20190805/ourlarge/pngtree-account-avatar-user-abstract-circle-background-flat-color-icon-png-image_1650938.jpg" alt="">
                                </div>
                                <div class="anime__review__item__text">
                                    <h6>{{ $comment->username }} - <span>{{ $comment->created_at }}</span></h6>
                                    <p>{{ $comment->comment }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="anime__details__form">
                        <div class="section-title">
                            <h5>Your Comment</h5>
                        </div>
                        <form action="/comment">
                            @csrf
                            <textarea id="comment-content" name="comment" placeholder="Your Comment"></textarea>
                            @foreach($movies as $movie)
                            <input name="id_movie" id="movieID" value="{{ $movie->id }}" type="hidden">
                            @endforeach
                            <small id="comment-error" class="help-blog"></small>
                            <button id="btn-comment" type="submit"><i class="fa fa-location-arrow"></i> Review</button>
                        </form>
                    </div>
                    <script>
                        var commentUrl = '{{ route("comment") }}';
                    </script>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Anime Section End -->
    @include('client.footer')
</body>

</html>