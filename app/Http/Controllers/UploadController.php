<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\comment;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UploadController extends Controller
{
    protected $comment;
    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }
    public function store($request)
    {
        if ($request->hasFile('file')) {
            try {
                // getClientOriginalname() là để láyas tên gốc của ảnh
                $name = $request->file('file')->getClientOriginalName();
                $pathFile = 'uploads/' . date("Y/m/d");
                $path = $request->file('file')->storeAs('public/' . $pathFile, $name);
                return '/storage/' . $pathFile . '/' . $name;
            } catch (\Exception $error) {
                return false;
            }
        };
    }
    public function upload(Request $request)
    {
        $url = $this->store($request);
        if ($url !== false) {
            return response()->json([
                'error' => false,
                'url' => $url
            ]);
        } else {
            return response()->json([
                'error' => true
            ]);
        }
    }
    public function comment(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['error' => ['Chưa đăng nhập']]);
        } else {
            $commentContent = $request->input('comment');
            $movieId = $request->input('id_movie');
            $userPresent = $user->id;
            $userName = $user->name;
            if (empty($commentContent)) {
                return response()->json(['error' => ['comment không được trống']]);
            }
            try {
                $comment = DB::table('comments')->insert([
                    'comment' => $commentContent,
                    'id_Movie_Comment' => $movieId,
                    'id_user' => $userPresent,
                ]);
                if ($comment) {
                    return response()->json([
                        'data' => $commentContent,
                        'user' => $userName
                    ]);
                } else {
                    return response()->json(['error' => ['Lỗi.']]);
                }
            } catch (\Exception $e) {
                return response()->json(['error' => [$e->getMessage()]]);
            }
        }
    }
    public function blog(Request $request)
    {
        $user = Auth::user();
        if ($user) {
            $blog = $request->input('content');
            $userPresent = $user->id;
            $thumb = $request->input("thumb");
            $userName = $user->name;
            try {
                $blogger = DB::table('blog')->insert([
                    "T_Content" => $blog,
                    "T_Thumb" => $thumb,
                    "I_id_users" => $userPresent,
                    "like" => 0,
                ]);
                if ($blogger) {
                    return response()->json([
                        "blog" => $blog,
                        "thumb" => $thumb,
                        "idUser" => $userName
                    ]);
                } else {
                    return response()->json(["error" => ["Lỗi không thể đăng"]]);
                }
            } catch (\Exception $e) {
                return response()->json(["error" => [$e->getMessage()]]);
            }
        }
    }
    public function commentBlog(Request $request)
    {
        $user = Auth::user();
        $userName = $user->name;
        $userThumb = $user->thumb;
        $blogId = $request->input('blogId');
        $content = $request->input('commentText');

        $commentBlog = DB::table('comment_blog')->insert([
            'I_id_users' => $user->id,
            'I_Blog' => $blogId,
            'T_Content' => $content,
        ]);

        if ($commentBlog) {
            return response()->json([
                'content' => $content,
                'userName' => $userName,
                'thumb' => $userThumb,
            ]);
        } else {
            return response()->json([
                'error' => 'Đã xảy ra lỗi khi thêm bình luận.',
            ]);
        }
    }
}
