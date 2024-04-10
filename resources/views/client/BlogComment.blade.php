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
                <a href="genre/{{$genre->id}}"><img src="/template/mxh-template/images/watch.png" alt="">{{$genre->T_Name}}</a>
                @endforeach
            </div>
        </div>

        <!-- main-content------- -->

        <div class="content-area" style="margin-top: 50px;">
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
                            <div style="cursor: pointer;">
                                <img src="/template/mxh-template/images/comments.png" alt="" id="commentIcon">
                            </div>
                        </div>
                    </div>
                </div>
                <div id="commentsContainer">
                    @foreach($commentBlog as $comment)
                    <div class="anime__review__item">
                        <div class="anime__review__item__pic">
                            <img src="{{$comment->thumbUsers}}" alt="">
                        </div>
                        <div class="anime__review__item__text">
                            <p>{{ $comment->T_Content }}</p>
                            <small>{{ $comment->created_at}}</small>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="commentForm" style="display: flex;">
                    <div class="user-profile">
                        <img src="/template/mxh-template/images/profile-pic.png" alt="">
                    </div>
                    <input name="blogId" value="{{$blog->id}}" type="hidden">
                    <textarea name="commentText" id="commentText" placeholder="{{$user->name}} bình luận nào...."></textarea>
                    <button type="submit" id="send"><i class="fa fa-paper-plane"></i></button>
                </div>
                <div id="comment-error"></div>
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
        const commentIcon = document.getElementById('commentIcon');
        const commentForm = document.getElementById('commentForm');
        let isFormVisible = false;
        commentIcon.addEventListener('click', function() {
            if (!isFormVisible) {
                commentForm.style.display = 'flex';
                isFormVisible = true;
            } else {
                commentForm.style.display = 'none';
                isFormVisible = false;
            }
        });


        $(document).ready(function() {
            $('#send').click(function() {
                let content = $('#commentText').val();
                $.ajax({
                    url: "/commentBlog",
                    type: 'POST',
                    data: {
                        blogId: $('input[name="blogId"]').val(),
                        commentText: content,
                    },
                    success: function(res) {
                        if (res.error) {
                            $('#comment-error').html(res.error);
                        } else {
                            $('#comment-error').html('');
                            $('#commentText').val('');
                            $('#commentsContainer').append(
                                '<div class="anime__review__item">' +
                                '<div class="anime__review__item__pic">' +
                                '<img src="' + res.thumb + '" alt="">' +
                                '</div>' +
                                '<div class="anime__review__item__text">' +
                                '<p style="color:white, font-size:20px">' + res.content + '</p>' +
                                '<small>Vừa xong</small>' +
                                '</div>' +
                                '</div>'
                            );
                        }
                    },
                    error: function(err) {
                        console.error(err);
                        $('#comment-error').html('Đã xảy ra lỗi khi gửi bình luận.');
                    }
                });
            });
        });
    </script>
</body>

</html>