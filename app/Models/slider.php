<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class slider extends Model
{
    use HasFactory;
    public function add(Request $request)
    {
        $request->validate([
            "name" => "required",
            "Description" => "required",
            "thumb" => "required"
        ], [
            "name.required" => "Chưa nhập Tên",
            "Description.required" => "Chưa nhập chi tiết",
            "thumb.required" => "Chưa Gửi Ảnh"
        ]);
        try {
            DB::table("slider")->insert([
                "T_Name" => $request->input("name"),
                "T_Description" => $request->input("Description"),
                "F_Thumb" => $request->input("thumb"),
                "I_Active" => $request->input("active")
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "Thêm Thành Côngs");
    }
    public function list()
    {
        return DB::table("slider")->get();
    }
    public function listID($id)
    {
        return DB::table("slider")->where('id', $id)->get();
    }
    public function listActive()
    {
        return DB::table("slider")->where('I_Active', 1)->get();
    }
    public function edit($id, Request $request)
    {
        $request->validate([
            "name" => "required",
            "Description" => "required",
            "thumb" => "required"
        ], [
            "name.required" => "Chưa nhập Tên",
            "Description.required" => "Chưa nhập chi tiết",
            "thumb.required" => "Chưa Gửi Ảnh"
        ]);
        try {
            DB::table("slider")->where('id', $id)->update([
                "T_Name" => $request->input("name"),
                "T_Description" => $request->input("Description"),
                "F_Thumb" => $request->input("thumb"),
                "I_Active" => $request->input("active")
            ]);
        } catch (\Exception $e) {
            return back()->with("error", $e->getMessage());
        }
        return redirect()->back()->with("success", "cập nhật Thành Côngs");
    }
    public function deleteSlider($id)
    {
        try {
            DB::table("slider")->where('id', $id)->delete();
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
        return redirect()->back()->with('success', 'Thành Công');
    }
}
