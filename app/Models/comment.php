<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class comment extends Model
{
    use HasFactory;
    public function listComment($id)
    {
        return DB::table('comments')
        ->join('users','comments.id_user','=','users.id')
        ->select('comments.*','users.name as username')
        ->where('comments.id_Movie_Comment',$id)->get();
    }
}