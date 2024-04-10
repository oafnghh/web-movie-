<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>User</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:300;400;600;700;800&display=swap" rel="stylesheet">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="/template/profile/lib/slick/slick.css" rel="stylesheet">
    <link href="/template/profile/lib/slick/slick-theme.css" rel="stylesheet">
    <link href="/template/profile/lib/lightbox/css/lightbox.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Template Stylesheet -->
    <link href="/template/profile/css/style.css" rel="stylesheet">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="51">
    @php
    $user=Auth::user()
    @endphp
    <div class="wrapper">
        <div class="sidebar">
            <div class="sidebar-header">
                <img src="{{$user->thumb}}" alt="Image">
            </div>
            <div class="sidebar-content">
                <nav class="navbar navbar-expand-md bg-dark navbar-dark">
                    <a href="#" class="navbar-brand">Navigation</a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#header">Home<i class="fa fa-home"></i></a>
                            </li>
                            @if($user->I_Role==0)
                            <li class="nav-item">
                                <a class="nav-link" href="/admin">Vào trang quản lí<i class="fa fa-home"></i></a>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="#about">Update<i class="fa fa-address-card"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#review">Review<i class="fa fa-envelope"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#history">History<i class="fa fa-envelope"></i></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{Route('logout')}}">Logout<i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <div class="content">
            <!-- Header Start -->
            <div class="header" id="header">
                <div class="content-inner">
                    <p>I'm</p>
                    <h1>{{$user->name}}</h1>
                    <h2></h2>
                    @if($user->I_Role==1)
                    <div class="typed-text">Người dùng WEB MINHHOANG</div>
                    @else
                    <div class="typed-text">admin WEB MINHHOANG</div>
                    @endif
                </div>

            </div>
            <!-- Header End -->

            <!-- Large Button Start -->
            <div class="large-btn">
                <div class="content-inner">

                </div>
            </div>
            <!-- Large Button End -->

            <!-- About Start -->
            <div class="about" id="about">
                <div class="content-inner">
                    <div class="content-header">
                        <h2>UPDATE</h2>
                    </div>
                    @include('alert')
                    <form method="POST" action="/updateUser/{{$user->id}}">
                        @csrf
                        <div class="row align-items-center">
                            <div class="col-md-6 col-lg-5">
                                <input type="file" class="form-control" id="uploads">
                            </div>
                            <div class="col-md-6 col-lg-7">
                                <div id="image-show">
                                    <a href="{{$user->thumb}}" target="_blank">
                                        <img src="{{$user->thumb}}" width="100px">
                                    </a>
                                </div>
                                <input type="hidden" name="thumb" id="thumb">
                                <input class="btn" value="Update" type="submit" name="submit">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="skills">
                                    <div class="skill-name">
                                        <p>Name</p>
                                        <p>*</p>
                                    </div>
                                    <div class="progresss" width="100%">
                                        <input name="name" value="{{$user->name}}" type="text" placeholder="Cập nhật tên tại đây..">
                                    </div>
                                    <div class="skill-name">
                                        <p>Email</p>
                                        <p>*</p>
                                    </div>
                                    <div class="progresss" width="100%">
                                        <input name="email" value="{{$user->email}}" type="email" placeholder="Cập nhật email tại đây.." required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="skills">
                                    <div class="skill-name">
                                        <p>SDT</p>
                                        <p>*</p>
                                    </div>
                                    <div class="progresss" width="100%">
                                        <input name="sdt" value="{{$user->SDT}}" type="number" placeholder="Cập nhật SDT tại đây..">
                                    </div>
                                    <div class="skill-name">
                                        <p>Biệt danh</p>
                                        <p>*</p>
                                    </div>
                                    <div class="progresss" width="100%">
                                        <input name="bietdanh" value="{{$user->nameBD}}" type="text" placeholder="Cập nhật biệt danh tại đây..">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- About End -->
            <div class="review" id="review">
                <div class="content-inner">
                    <div class="content-header">
                        <h2>Review</h2>
                    </div>
                    <div class="row align-items-center review-slider">
                        @foreach($comments as $comment)
                        <div class="col-md-12">
                            <div class="review-slider-item">
                                <div class="review-text">
                                    <p>
                                        {{$comment->comment}}
                                    </p>
                                </div>
                                <div class="review-img">
                                    <img style="border-radius: 50%;" src="{{$user->thumb}}" alt="Image">
                                    <div class="review-name">
                                        <h3>{{$user->name}}</h3>
                                        <p>{{$comment->T_Name}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div style="background-color: aliceblue;" class="review" id="history">
                <div style="background-color: azure;" class="content-inner">
                    <div class="content-header">
                        <h2>HISTORY</h2>
                    </div>
                    <div class="row align-items-center review-slider">
                        @foreach($histories as $history)
                        <div class="col-md-12">
                            <div class="review-slider-item">
                                <div class="review-img">
                                    <img src="{{$history->T_Thumb}}" alt="Image">
                                    <div class="review-name">
                                        <h3>{{$history->T_Name}}</h3>
                                        <p>{{$history->T_Description}}</p>
                                        <i><b>Xem vào lần đầu tiên {{$history->create}}</b></i><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Back to Top -->
            <a href="#" class="back-to-top"><i class="fa fa-angle-double-up"></i></a>

            <!-- JavaScript Libraries -->
            <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
            <script src="/template/profile/lib/easing/easing.min.js"></script>
            <script src="/template/profile/lib/slick/slick.min.js"></script>
            <script src="/template/profile/lib/typed/typed.min.js"></script>
            <script src="/template/profile/lib/waypoints/waypoints.min.js"></script>
            <script src="/template/profile/lib/isotope/isotope.pkgd.min.js"></script>
            <script src="/template/profile/lib/lightbox/js/lightbox.min.js"></script>

            <!-- Template Javascript -->
            <script src="/template/profile/js/main.js"></script>
            <script src="/template/admin/template/assets/js/main.js"></script>
</body>

</html>