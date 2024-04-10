<?php

namespace App\Http\Controllers\ClientController;

use App\Events\MessageSent;
use App\Http\Controllers\Controller;
use App\Models\blog;
use App\Models\comment;
use App\Models\genre;
use App\Models\listMovie;
use App\Models\WatchHistory;
use App\Models\movie;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\slider;
use Illuminate\Support\Facades\DB;
use App\Models\message;
use App\Models\Messages;
use Illuminate\Support\Facades\File;

class ClientController extends Controller
{
    protected $slider;
    protected $list;
    protected $genre;
    protected $movie;
    protected $comment;
    protected $blog;
    protected $user;
    protected $history;
    public function __construct(slider $slider, listMovie  $list, movie $movie, genre $genre, comment $comment, User $user, blog $blog, WatchHistory $history)
    {
        $this->slider = $slider;
        $this->list = $list;
        $this->movie = $movie;
        $this->genre = $genre;
        $this->comment = $comment;
        $this->user = $user;
        $this->blog = $blog;
        $this->history = $history;
    }
    public function index()
    {
        $movie = $this->movie->list();
        $path = public_path() . "/MovieJS/";
        if (!is_dir($path)) {
            mkdir($path, 0777, true);
        }
        File::put($path . 'movie.json', json_encode($movie));
        return view("client.main", [
            "title" => "Trang chủ",
            'genre' => $this->genre->list(),
            "sliders" => $this->slider->listActive(),
            "movies" => $movie,
            "arr" => $this->movie->arrange(),
        ]);
    }
    public function header()
    {
        return view("client.header", [
            'genre' => $this->genre->list()
        ]);
    }
    public function watch($id, $slug)
    {
        return view("client.Watching", [
            'listWatchs' => $this->list->listID($id, $slug),
            'listEp' => $this->list->list($id),
            'genre' => $this->genre->list(),
            "comments" => $this->comment->listComment($id),
            "movies" => $this->movie->list(),
        ]);
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        return view('Client.Seach', [
            'movies' => $this->movie->Search($request),
            'key' => $query,
            'genre' => $this->genre->list(),
            "arr" => $this->movie->arrange(),
        ]);
    }
    public function GenreList($id)
    {
        $movies = $this->genre->listID($id);
        $genre = $this->genre->list();
        $arr = $this->movie->arrange();
        return view('client.genre', compact('movies', 'genre', 'arr'));
    }
    public function banner($id)
    {
        $movie = movie::findOrFail($id);
        $movie->views += 1;
        $movie->save();
        $user = auth()->user();
        if ($user) {
            $watch = DB::table('watch_histories')
                ->where('user_id', $user->id)
                ->where('movie_id', $id)
                ->exists();
            if (!$watch) {
                $sql = DB::table('watch_histories')->insert([
                    'user_id' => $user->id,
                    'movie_id' => $id,
                ]);
            }
        }
        return view('client.banner', [
            "movies" => $this->movie->banner($id),
            'genre' => $this->genre->list(),
            "eps" => $this->list->EpDesc($id),
            "comments" => $this->comment->listComment($id),
            "arr" => $this->movie->arrange(),
        ]);
    }

    public function profile($id)
    {
        $sql = DB::table("comments")
            ->join('movies', 'comments.id_Movie_Comment', '=', 'movies.id')
            ->select('comments.*', 'movies.T_Name as T_Name')
            ->where("id_user", $id)->get();
        $sql2 = DB::table('watch_histories')
            ->join('movies', 'watch_histories.movie_id', '=', 'movies.id')
            ->select('movies.*', 'watch_histories.created_at as create', 'watch_histories.ep as ep')
            ->where('watch_histories.user_id', $id)->get();
        return view("client.profile", [
            "comments" => $sql,
            'histories' => $sql2
        ]);
    }
    public function updateUser(Request $request, $id)
    {
        DB::table("users")->where("id", $id)->update([
            "name" => $request->input("name"),
            "email" => $request->input("email"),
            "SDT" => $request->input("sdt"),
            "thumb" => $request->input("thumb"),
            "nameBD" => $request->input("bietdanh"),
        ]);
        return redirect()->back()->with("success", "đã cập nhật");
    }
    public function blog(Request $request)
    {
        return view("client.blog", [
            'genre' => $this->genre->list(),
            'users' => $this->user->list(),
            'blogs' => $this->blog->list(),
        ]);
    }
    public function blogComment(Request $request, $id)
    {
        return view('client.BlogComment', [
            'genre' => $this->genre->list(),
            'users' => $this->user->list(),
            'blogs' => $this->blog->blogID($id),
            'commentBlog' => $this->blog->blogComment($id),
        ]);
    }
    public function chat()
    {
        return view('client.chat');
    }
    public function deletePost(Request $request, $id)
    {
        DB::table('likes')->where('blog_id', $id)->delete();
        DB::table('comment_blog')->where('I_Blog', $id)->delete();
        DB::table('blog')->where('id', $id)->delete();
        return redirect(Route('blog'))->with('success', 'đã xoá thành công');
    }
}
