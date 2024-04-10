<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class genre extends Model
{
    use HasFactory;
    public function add(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);
        $name = $request->input("name");
        $slug = Str::slug($name);
        try {
            DB::table("genre")->insert([
                "T_Name" => $name,
                "s_url" => $slug,

            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Thêm Thành Côngs");
    }
    public function list()
    {
        return DB::table("genre")->get();
    }
    public function listGenre($id)
    {
        return DB::table("genre")->where('id', $id)->get();
    }
    public function listID($ID)
    {
        return DB::table('genre')
            ->join('movies', 'movies.I_Genres_ID', '=', 'genre.id')
            ->select('genre.*', 'movies.T_Name as movie_name', 'movies.T_Thumb as movie_thumb', 'movies.id as id')
            ->where('genre.s_url', $ID)
            ->get();
    }

    public function edit($id, Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);
        $name = $request->input("name");
        $slug = Str::slug($name);
        try {
            DB::table("genre")->where('id', $id)->update([
                "T_Name" => $name,
                "s_url" => $slug,
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "cập nhật Thành Côngs");
    }
    public function deletegenre($id)
    {
        try {
            $movies = DB::table("movies")->where('I_Genres_ID', $id)->get();
            foreach ($movies as $movie) {
                DB::table("comments")->where('id_Movie_Comment', $movie->id)->delete();
                DB::table("playlists")->where('I_Movie_ID', $movie->id)->delete();
            }
            $sql2 = DB::table("movies")->where('I_Genres_ID', $id)->delete();
            if ($sql2) {
                $sql = DB::table("genre")->where('id', $id)->delete();
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Thành Công');
    }
}
