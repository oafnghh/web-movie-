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
                <div class="col-lg-12">
                    <div class="breadcrumb__links">
                        @foreach($movies as $movie)
                        <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                        <span>{{$movie->T_Name}}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb End -->

    <!-- Anime Section Begin -->
    <section class="anime-details spad">
        <div class="container">
            <div class="anime__details__content">
                <div class="row">
                    <div class="col-lg-3">
                        @foreach($movies as $movie)
                        <div class="anime__details__pic set-bg" data-setbg="{{$movie->T_Thumb}}">
                        </div>
                        @endforeach
                    </div>
                    <div class="col-lg-9">
                        @foreach($movies as $movie)
                        <div class="anime__details__text">
                            <div class="anime__details__title">
                                <h3>{{$movie->T_Name}}</h3>
                                <span>{{$movie->T_Name}}</span>
                            </div>
                            <p>{{$movie->T_Description}}</p>
                            <div class="anime__details__widget">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Loại:</span> Hoạt hình</li>
                                            <li><span>Đạo diễn:</span> {{$movie->T_Directer}}</li>
                                            <li><span>Ngày sản xuất:</span> {{$movie->D_ReleaseDate}}</li>
                                            <li><span>Thể loại:</span> {{$movie->genre_name}}</li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <ul>
                                            <li><span>Thời gian:</span> {{$movie->I_Duration}} min/ep</li>
                                            <li><span>Hình ảnh:</span> HD</li>
                                            <li><span>Số tập:</span> {{$movie->I_Ep}}</li>
                                            <li><span>Ngôn ngữ:</span> {{$movie->T_Language}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="anime__details__btn">
                                <a @foreach($eps as $ep) href="/watch/{{$movie->id}}/{{$ep->s_url}}" class="watch-btn" @endforeach><span>Watch Now</span> <i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 col-md-8">
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
                        <div>
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

                <div class="col-lg-4 col-md-4">
                    <div class="anime__details__sidebar">
                        <div class="section-title">
                            <h5>you might like...</h5>
                        </div>
                        @foreach($arr as $movie)
                        <div class="product__sidebar__view__item set-bg" data-setbg="{{$movie->T_Thumb}}">
                            <div class="view"><i class="fa fa-eye"></i> {{$movie->views}}</div>
                            <h5><a href="/banner/{{$movie->id}}">{{$movie->T_Name}}</a></h5>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('client.footer')
</body>

</html>