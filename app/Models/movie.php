<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class movie extends Model
{
    use HasFactory;
    public function add(Request $request)
    {
        $request->validate([
            "name" => "required",
            "thumb" => "required",
        ]);
        $name = $request->input("name");
        $slug = Str::slug($name);
        try {
            DB::table("movies")->insert([
                "T_Name" => $name,
                "T_Description" => $request->input("Description"),
                "D_ReleaseDate" => $request->input("ReleaseDate"),
                "I_Duration" => $request->input("Time"),
                "T_Language" => $request->input("language"),
                "I_Ep" => $request->input("Ep"),
                "T_Directer" => $request->input("Directer"),
                "T_Thumb" => $request->input("thumb"),
                "I_Genres_ID" => $request->input('genresID'),
                's_url' => $slug,
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Thêm Thành Côngs");
    }
    public function list()
    {
        return DB::table("movies")->join('genre', 'movies.I_Genres_ID', '=', 'genre.id')
            ->select('movies.*', 'genre.T_Name as genre_name')->orderBy('movies.created_at', 'desc')->paginate(5);
    }
    public function banner($id)
    {
        return DB::table("movies")->join('genre', 'movies.I_Genres_ID', '=', 'genre.id')
            ->select('movies.*', 'genre.T_Name as genre_name')
            ->where('movies.id', $id)
            ->get();
    }
    public function edit($id, Request $request)
    {
        $request->validate([
            "name" => "required",
            "thumb" => "required",
        ]);
        try {
            DB::table("movies")->where('id', $id)->update([
                "T_Name" => $request->input("name"),
                "T_Description" => $request->input("Description"),
                "D_ReleaseDate" => $request->input("ReleaseDate"),
                "I_Duration" => $request->input("Time"),
                "T_Language" => $request->input("language"),
                "I_Ep" => $request->input("Ep"),
                "T_Directer" => $request->input("Directer"),
                "T_Thumb" => $request->input("thumb"),
                "I_Genres_ID" => $request->input('genresID')
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "cập nhật Thành Côngs");
    }
    public function deletemovies($id)
    {
        try {
            DB::table('playlists')->where('I_Movie_ID', $id)->delete();
            DB::table("movies")->where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Thành Công');
    }
    public function listID($id)
    {
        return DB::table('movies')->where('id', $id)->get();
    }

    public function listGere()
    {
        return DB::table('genre')->get();
    }
    public function Search(Request $request)
    {
        $query = $request->input('query');

        $moviess = DB::table('movies')
            ->join('genre', 'movies.I_Genres_ID', '=', 'genre.id')
            ->where('movies.T_Name', 'like', '%' . $query . '%')
            ->select('movies.*', 'genre.T_Name as genre_name')
            ->get();
        return $moviess;
    }
    public function view($id)
    {
        DB::table('movies')
            ->where('id', $id)
            ->increment('views');
        return redirect(route("banner"));
    }

    public function arrange()
    {
        return DB::table('movies')->orderBy('views', 'desc')->paginate(3);
    }
    public function watchHistories()
    {
        return $this->hasMany(WatchHistory::class);
    }
}
