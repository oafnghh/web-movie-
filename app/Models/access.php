<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class access extends Model
{
    use HasFactory;
    protected $table = "access";
    protected $fillable = [
        'id',
        'ip',
        'created_at'
    ];
}
