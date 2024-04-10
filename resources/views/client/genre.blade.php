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
    <section class="hero">
        <div class="container">
            <div class="hero__slider owl-carousel">
                <img src="https://gamek.mediacdn.vn/133514250583805952/2021/8/17/avata-16291797027591453929839.jpg">
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="trending__product">
                        <div class="row">
                            <div class="col-lg-8 col-md-8 col-sm-8">
                                <div class="section-title">
                                    @foreach($movies->take(1) as $movie)
                                    <h4>{{$movie->T_Name}}</h4>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($movies as $movie)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ $movie->movie_thumb }}">
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{ $movie->T_Name }}</li>
                                        </ul>
                                        <h5><a href="/banner/{{ $movie->id }}">{{ $movie->movie_name }}</a></h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="filter__gallery">
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
            </div>
        </div>
    </section>
    @include('client.footer')
</body>

</html>