<!-- <div id="preloder">
        <div class="loader"></div>
    </div> -->

<!-- Header Section Begin -->
<header class="header">
    <div class="container">
        <div class="row">
            <div class="col-lg-2">
                <div class="header__logo">
                    <a href="./index.html">
                        <img src="img/logo.png" alt="">
                    </a>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="header__nav">
                    <nav class="header__menu mobile-menu">
                        <ul>
                            <li class="active"><a href="/">Trang Chủ</a></li>
                            <li><a href="./categories.html">Thể Loại <span class="arrow_carrot-down"></span></a>
                                <ul class="dropdown">
                                    @foreach($genre as $genre)
                                    <li><a href="/genre/{{$genre->s_url}}">{{$genre->T_Name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                            <li><a href="/blog">Blog</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="col-lg-2">
                @if (auth()->check())
                @php
                $user = Auth::user();
                @endphp
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <a href="/profile/{{$user->id}}"><span class="icon_profile"></span></a>
                </div>
                @else
                <div class="header__right">
                    <a href="#" class="search-switch"><span class="icon_search"></span></a>
                    <a href="/login"><span class="icon_profile"></span></a>
                </div>
                @endif
            </div>
        </div>
        <div id="mobile-menu-wrap"></div>
    </div>
    <div class="search-model">
        <div style="display: flex;flex-direction: column;" class="h-100 d-flex align-items-center justify-content-center">
            <div class="search-close-switch"><i class="icon_close"></i></div>
            <form method="GET" action="{{Route('Search')}}" class="search-model-form">
                <input type="text" name="query" id="search-input" placeholder="Search here.....">
            </form>
            <ul class="list-group" id="result" style="overflow-y: scroll; display: none;width: 38%;height:200px">
            </ul>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').keyup(function() {
                var search = $('#search-input').val();
                if (search !== '') {
                    var expression = new RegExp(search, "i");
                    $('#result').css('display', 'none'); // Ẩn kết quả trước khi tìm kiếm mới
                    $('#result').html(''); // Xóa nội dung hiện tại của #result
                    $.getJSON('/MovieJS/movie.json', function(data) {
                        $.each(data.data, function(key, value) {
                            if (value.T_Name.search(expression) !== -1) {
                                $('#result').css('display', 'inherit');
                                $('#result').append('<a style="text-decoration: none;font-size:15px;color:white;text-align:center;" href="/banner/' + value.id + '"><li style="cursor:pointer;background-color: black;border-bottom:1px solid white" class="list-group-item link-class"><img style="width:90px" src="' + value.T_Thumb + '">' + value.T_Name + '</li></a>');
                            }
                        });
                    })
                } else {
                    $('#result').css('display', 'none');
                }
            });
        });
    </script>
</header>