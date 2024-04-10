<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Closure;
use Illuminate\Http\Request;

class Statistical extends Model
{
    use HasFactory;
    public function totalMovie()
    {
        $count = DB::table('movies')->count();
        return $count;
    }
    public function totalGenre()
    {
        $count = DB::table('genre')->count();
        return $count;
    }
    public function totalView()
    {
        $count = DB::table('movies')->select('views')->get();
        $total = 0;
        foreach ($count as $cou) {
            $total += $cou->views;
        }
        return $total;
    }
    public function getAccessData(Request $request)
    {
        $selectedYear = $request->input('year');
        $orderData = DB::table('access')
            ->selectRaw('MONTH(created_at) as month, COUNT(id) as id')
            ->whereYear('created_at', $selectedYear)
            ->groupBy('month')
            ->get();

        $result = [];
        for ($i = 1; $i <= 12; $i++) {
            $result[$i] = 0;
        }
        foreach ($orderData as $data) {
            $result[$data->month] = $data->id;
        }
        return response()->json($result);
    }
}
