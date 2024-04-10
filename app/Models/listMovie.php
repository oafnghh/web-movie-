<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class listMovie extends Model
{
    use HasFactory;
    public function add(Request $request)
    {
        $request->validate([
            "name" => "required",
            "I_Movie_ID" => "required"
        ]);
        $name = $request->input("name");
        $slug = Str::slug($name);
        try {
            DB::table("playlists")->insert([
                "t_Name" => $name,
                "I_Ep_Present" => $request->input("I_Ep_Present"),
                "T_Video" => $request->input("link"),
                "I_Movie_ID" => $request->input("I_Movie_ID"),
                "s_url" => $slug,
            ]);
            DB::table("movies")->where('id', $request->input('I_Movie_ID'))->update([
                "I_EP_Pre" => $request->input("I_Ep_Present"),
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Thêm Thành Côngs");
    }
    public function list($id)
    {
        return DB::table("playlists")->where('I_Movie_ID', $id)->get();
    }
    public function list2()
    {
        return DB::table("playlists")->get();
    }
    public function EpDesc($id)
    {
        return DB::table('playlists')->where('I_movie_ID', $id)->get();
    }
    public function listsID($id,)
    {
        return DB::table("playlists")
            ->where("id", $id)
            ->get();
    }
    public function listID($id, $idMovie)
    {
        return DB::table("playlists")
            ->join('movies', 'playlists.I_Movie_ID', '=', 'movies.id')
            ->where('I_Movie_ID', $id)
            ->where('playlists.s_url', $idMovie)
            ->select('playlists.*', 'movies.T_Thumb as movieThumb', 'movies.T_Name as movieName')
            ->get();
    }
    public function edit($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $name = $request->input("name");
        $slug = Str::slug($name);
        try {
            DB::table("playlists")->where('id', $id)->Update([
                "t_Name" => $name,
                "I_Ep_Present" => $request->input("I_Ep_Present"),
                "T_Video" => $request->input("thumb"),
                "I_Movie_ID" => $request->input("I_Movie_ID"),
                's_url' => $slug
            ]);
            DB::table("movies")->where('id', $request->input('I_Movie_ID'))->update([
                "I_EP_Pre" => $request->input("I_Ep_Present"),
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "cập nhật Thành Côngs");
    }
    public function deletelistMovie($id)
    {
        try {
            DB::table("playlists")->where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Thành Công');
    }
    public function listMovie()
    {
        return DB::table('movies')->get();
    }
}
