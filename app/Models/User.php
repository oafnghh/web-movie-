<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'facebook_id',
        'google_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => [
                'required',
                'min:6',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{6,}$/',
            ],
        ], [
            'name' => 'Chưa nhập tên',
            'email' => 'Chưa nhập Email hoặc không đúng định dạng',
            'password' => 'Chưa nhập mật khẩu',
            'password.regex' => 'Mật khẩu cần chứa ít nhất một chữ cái viết thường, một chữ cái viết hoa và một số.',
        ]);
        try {
            DB::table('Users')->insert([
                'name' => $request->input('name'),
                'password' => bcrypt($request->input('password')),
                'email' => $request->input('email'),
                'I_Role' => '1',
            ]);
            return redirect(Route('login'));
        } catch (\Exception $e) {
            Session::flash('error', $e->getMessage());
            return false;
        }
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'I_Role' => 1,
        ])) {
            return redirect()->route("trangchu");
        } else if (Auth::attempt([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
            'I_Role' => 0,
        ])) {
            return redirect()->route("admin");
        }
        return redirect()->back()->with("error", "Sai tài Khoản hoặc mật khẩu");
    }
    public function list()
    {
        return DB::table("users")->paginate(20);
    }
    public function watchHistories()
    {
        return $this->hasMany(WatchHistory::class);
    }
}
