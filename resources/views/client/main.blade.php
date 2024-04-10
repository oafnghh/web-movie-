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
                @foreach($sliders as $slider)
                <div class="hero__items set-bg" data-setbg="{{$slider->F_Thumb}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="hero__text">
                                <div class="label">Adventure</div>
                                <h2>{{$slider->T_Name}}</h2>
                                <p>{{$slider->T_Description}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
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
                                    <h4>Trending Now</h4>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach($movies as $movie)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{$movie->T_Thumb}}">
                                        <div class="ep">{{$movie->I_EP_Pre}} / {{$movie->I_Ep}}</div>
                                        <div class="view"><i class="fa fa-eye"></i> {{$movie->views}}</div>
                                    </div>
                                    <div class="product__item__text">
                                        <ul>
                                            <li>{{$movie->genre_name}}</li>
                                        </ul>
                                        <h5><a href="/banner/{{$movie->id}}"> {{$movie->T_Name}}</a></h5>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{ $movies->links() }}

                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-8">
                    <div class="product__sidebar">
                        <div class="product__sidebar__view">
                            <div class="section-title">
                                <h5>Top Views</h5>
                            </div>
                            <div class="filter__gallery">
                                @foreach($arr as $movie)
                                <div class="product__sidebar__view__item set-bg mix day" data-setbg="{{$movie->T_Thumb}}">
                                    <div class="view"><i class="fa fa-eye"></i> {{$movie->views}}</div>
                                    <h5><a href="#">{{$movie->T_Name}}</a></h5>
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