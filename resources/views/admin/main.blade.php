<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @include('admin.head')
</head>

<body>
    @if(auth()->check() && auth()->user()->I_Role == 0)
    <div class="container-scroller">
        @include('admin.sitebar')
        <div class="container-fluid page-body-wrapper">
            @include('admin.header')
            <div class="main-panel">
                @include('alert')
                <div class="row">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card-body py-0 px-0 px-sm-3">
                            <div class="row align-items-center justify-content-center" style="margin-top: 50px">
                                @yield('content')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div style="display: flex;min-height: 100vh;justify-content: center;flex-direction: column;align-items: center;">
        <h1>Đây là trang của ADMIN!! Bạn Không Có Quyền để Vào Trang Này</h1>
        <h2>404</h2>
    </div>
    @endif
</body>
@include('admin.footer')

</html>