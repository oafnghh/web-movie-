<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    protected $genre;
    public function __construct(genre $genre)
    {
        $this->genre = $genre;
    }
    public function Login(Request $request)
    {
        return view("client.login", [
            'genre' => $this->genre->list()
        ]);
    }
    public function SignUp(Request $request)
    {
        return view("client.signup", [
            'genre' => $this->genre->list()
        ]);
    }
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
    {
        try {

            $user = Socialite::driver('facebook')->user();

            $finduser = User::where('email', $user->email)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('/');
            } else {
                $newUser = DB::table('users')->insert([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'I_Role' => 1,
                    'password' => encrypt('123456789')
                ]);
                Auth::login($newUser);

                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
                return redirect()->intended('/');
            } else {
                $newUser = DB::table('users')->insert([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'I_Role' => 1,
                    'password' => encrypt('123456789')
                ]);
                Auth::login($newUser);
                return redirect()->intended('/');
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function forgetPass()
    {
        return view('Client.ForgetPass');
    }
    public function actived(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:users'
        ], [
            'email.required' => 'Vui lòng nhập email',
            'email.exists' => 'Email này không tồn tại'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {
            $token = strtoupper(Str::random(10));
            $user->token = $token;
            $user->save();

            Mail::send('client.CheckForgetPass', compact('user'), function ($email) use ($user) {
                $email->subject('LMH Watch - Lấy lại mật khẩu của bạn !');
                $email->to($user->email, $user->name);
            });

            return redirect()->back()->with('success', 'Vui lòng kiểm tra email để nhận mã OTP');
        }

        return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
    }
    public function getPass(User $user, $token)
    {
        if ($user->Token === $token) {
            return view('client.password');
        }
        return abort(404);
    }
    public function postGetPass($token, Request $request)
    {
        $request->validate([
            'password' => 'required'
        ], [
            'password' => 'Chưa nhập password',
        ]);
        DB::table('users')->update([
            'password' => bcrypt($request->password),
            'token' => null,
        ]);
        return redirect()->route('login')->with('success', 'Vui lòng đăng nhập lại');
    }
}
