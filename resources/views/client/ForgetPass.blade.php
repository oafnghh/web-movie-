<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('client.head')
</head>

<body>
    <section class="normal-breadcrumb set-bg" data-setbg="/template/anime-main/img/normal-breadcrumb.jpg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="normal__breadcrumb__text">
                        <h2>Quên Mật Khẩu</h2>
                        <p>Welcome to the official Anime blog.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('alert')
    <section class="login spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="login__form">
                        <h3>Nhập địa chỉ Email</h3>
                        <form action="" method="POST">
                            @csrf
                            <div class="input__item">
                                <input type="text" name="email" placeholder="Email address">
                                <span class="icon_mail"></span>
                            </div>
                            <button type="submit" class="site-btn">Gửi mã xác thực</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>