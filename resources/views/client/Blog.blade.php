<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @include('client.head')
    <link rel="stylesheet" href="/template/admin/template/assets/css/style.css">
</head>

<body>
    @include('client.header')
    @if (auth()->check())
    @php
    $user = Auth::user();
    @endphp
    <div class="containerr" style="height:100%">
        <div class="left-sidebar">
            <div class="important-links">
                @foreach($genre as $genre)
                <a href="/genre/{{$genre->id}}"><img src="/template/mxh-template/images/watch.png" alt="">{{$genre->T_Name}}</a>
                @endforeach
                <a href="/chat">Message</a>
            </div>
        </div>

        <!-- main-content------- -->
        <div class="content-area" style="margin-top: 50px;">
            @include('alert')
            <div class="write-post-container">
                <div class="user-profile">
                    <img src="/template/mxh-template/images/profile-pic.png" alt="">
                    <div>
                        <p> {{$user->name}}</p>
                        <small>Public</small>
                    </div>
                </div>

                <div class="post-upload-textarea">
                    <form action="">
                        @csrf
                        <textarea id="content" name="content" placeholder="Bạn đang nghĩ gì, {{$user->name}}" cols="30" rows="3"></textarea>
                        <div id="image-show"></div>
                        <div class="add-post-links">
                            <input type="file" class="form-control" id="uploads" style="display: none;">
                            <input type="hidden" name="thumb" id="thumb">
                            <label for="uploads"><img src="/template/mxh-template/images/photo.png" alt=""> Photo/Video</label>
                        </div>
                        <small id="blog-error" class="help-blog"></small>
                        <button id="btn-blog" type="submit" name="submit">Submit</button>
                    </form>
                </div>
                <script>
                    var blogUrl = '{{ route("ajax.blog") }}';
                </script>
            </div>
            @foreach($blogs as $blog)
            <div id="blogContainer" class="status-field-container write-post-container">
                <div class="user-profile-box">
                    <div class="user-profile">
                        <img src="/template/mxh-template/images/profile-pic.png" alt="">
                        <div>
                            <p>{{$blog->nameUsers}}</p>
                            <small>{{$blog->created_at}}</small>
                        </div>
                    </div>
                    @if($user->name==$blog->nameUsers)
                    <div class="body" style="display: flex; justify-content:center ; align-items: center;overflow: hidden;">
                        <div class="buttons">
                            <button class="buttons__toggle"><i class="fa fa-share-alt"></i></button>
                            <div style="color: aliceblue;" class="allbtns">
                                <a class="button" href="/delete/blog/{{$blog->id}}"><i class="fa fa-trash"></i>Delete</a>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="status-field">
                    <p>{{$blog->T_Content}}
                        <img src="{{$blog->T_Thumb}}" alt="">

                </div>
                <hr style="border: 1px solid white;">
                <div class="post-reaction">
                    <div class="activity-icons">
                        <div class="activity-icons">
                            <div id="likee">
                                <a href="/like/{{$blog->id}}" id="likes">
                                    <img src="/template/mxh-template/images/like-blue.png" alt=""> {{$blog->like}}
                                </a>
                            </div>
                            <a href="/blog/{{$blog->id}}">
                                <div style="cursor: pointer;">
                                    <img src="/template/mxh-template/images/comments.png" alt="" id="commentIcon">
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="right-sidebar">
            <div class="heading-link">
                <h4 style="color: aliceblue;">Người Sử Dụng</h4>
                <a href="">Người Dùng</a>
            </div>

            @foreach($users as $user)
            <div class="online-list">
                <div class="online">
                    <img src="/template/mxh-template/images/member-1.png" alt="">
                </div>
                <p>{{$user->name}}</p>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div style="height: 100%;" class="status-field-container write-post-container">
        <h1 style="color:white;">Xin lỗi!<br> Vui Lòng Đăng Nhập Để Sử Dụng Tính Năng Này!!</h1>
    </div>
    @endif
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="/template/admin/template/assets/js/main.js"></script>
    <script>
        document.addEventListener('click', function(event) {
            if (event.target.classList.contains('buttons__toggle')) {
                const buttonsComponent = event.target.closest('.buttons');
                if (buttonsComponent) {
                    event.target.classList.toggle('buttons__toggle--active');
                    buttonsComponent.classList.toggle('buttons--active');
                }
            }
        });
    </script>
</body>

</html>