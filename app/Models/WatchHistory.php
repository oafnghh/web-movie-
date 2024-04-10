<?php

namespace App\Models;

use GPBMetadata\Google\Api\Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class WatchHistory extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
}
