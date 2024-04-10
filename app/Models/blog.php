<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class blog extends Model
{
    use HasFactory;
    public function like(Request $request, $id)
    {
        $user = Auth::user();

        $blog = DB::table("blog")
            ->where('id', $id)
            ->first();

        if ($blog) {
            $hasLiked = DB::table("likes")
                ->where('user_id', $user->id)
                ->where('blog_id', $id)
                ->exists();

            if ($hasLiked) {

                $newLikeCount = $blog->like - 1;
                DB::table("likes")
                    ->where('user_id', $user->id)
                    ->where('blog_id', $id)
                    ->delete();
            } else {

                $newLikeCount = $blog->like + 1;
                DB::table("likes")->insert(['user_id' => $user->id, 'blog_id' => $id, 'like' => $newLikeCount]);
            }

            DB::table('blog')
                ->where('id', $id)
                ->update(['has_liked' => !$hasLiked, 'like' => $newLikeCount]);
            return response()->json(['like' => $newLikeCount]);
        }
    }
    public function commentBlog(Request $request)
    {
        $user = Auth::user();
        $userName = $user->name;
        $userThumb = $user->thumb;
        $blogId = $request->input('blogId'); // Match with the key sent from AJAX
        $content = $request->input('commentText'); // Match with the key sent from AJAX

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
    public function list()
    {
        return DB::table("blog")
            ->join("users", "blog.I_id_users", "=", "users.id")
            ->select("blog.*", "users.name as nameUsers")
            ->orderBy("created_at", "desc")->get();
    }
    public function blogID($id)
    {
        return DB::table("blog")
            ->join("users", "blog.I_id_users", "=", "users.id")
            ->select("blog.*", "users.name as nameUsers", "users.thumb as thumbUsers")->where('blog.id', $id)->get();
    }
    public function blogComment($id)
    {
        return DB::table("comment_blog")
            ->join("users", "comment_blog.I_id_users", "=", "users.id")
            ->select("comment_blog.*", "users.name as nameUsers", "users.thumb as thumbUsers")->where('comment_blog.I_Blog', $id)->get();
    }
}
