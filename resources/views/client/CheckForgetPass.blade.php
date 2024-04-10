<div style="width:600px;margin:0 auto;">
    <div style="text-align: center;">
        <h2>Xin chào </h2>
        <p>Vui lòng click vào đường link bên dưới để đặt lại tài khoản mật khẩu</p>
        <p>
            <a href="{{Route('getPass',['user'=>$user->id,'token'=>$user->token])}}" style="display:inline-block;background:green;color: #fff;padding: 7px 25px;font-weight: bold;">Lấy lại mật khẩu</a>
        </p>
    </div>
</div>