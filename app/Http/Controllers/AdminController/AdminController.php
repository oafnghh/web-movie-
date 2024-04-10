<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\access;
use App\Models\genre;
use App\Models\listMovie;
use App\Models\movie;
use App\Models\slider;
use App\Models\Statistical;
use Illuminate\Http\Request;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class AdminController extends Controller
{
    protected $slider;
    protected $movie;
    protected $listMovie;
    protected $genre;
    protected $statis;
    public function __construct(slider $slider, movie $movie, listMovie $listMovie, genre $genre, Statistical $statis)
    {
        $this->slider = $slider;
        $this->movie = $movie;
        $this->listMovie = $listMovie;
        $this->genre = $genre;
        $this->statis = $statis;
    }
    public function index()
    {
        return view("admin.main");
    }
    public function noen()
    {
        return view("admin.noen");
    }
    // Thêm slides
    public function addSlider(Request $request)
    {
        return view('admin.slider.add');
    }
    // Xem Danh Sách Slides
    public function listSlider()
    {
        return view('admin.slider.list', [
            'sliders' => $this->slider->list()
        ]);
    }
    // Chỉnh Sửa Slides
    public function editSlider($id, Request $request)
    {
        return view('admin.slider.edit', [
            'sliders' => $this->slider->listID($id)
        ]);
    }
    // Thêm Movie(Dạng poster không phải video)
    public function addMovie(Request $request)
    {
        return view('admin.movie.add', [
            'ID_Genres' => $this->movie->listGere()
        ]);
    }
    // Danh Sach Movie(Dạng poster không phải video)
    public function listMovie()
    {
        return view('admin.Movie.list', [
            'Movies' => $this->movie->list()
        ]);
    }
    // Chỉnh Sửa Movie(Dạng poster không phải video)
    public function editMovie($id, Request $request)
    {
        return view('admin.Movie.edit', [
            'Movies' => $this->movie->listID($id),
            'ID_Genres' => $this->movie->listGere()
        ]);
    }
    // Thêm video vào movie
    public function addlistmovie(Request $request)
    {
        return view('admin.listmovie.add', [
            'ListNames' => $this->listMovie->listMovie(),
        ]);
    }
    // xem danh sách các video
    public function listlistmovie()
    {
        return view('admin.listmovie.list', [
            'listMovies' => $this->listMovie->list2()
        ]);
    }
    // chỉnh sửa video
    public function editlistmovie($id, Request $request,)
    {
        return view('admin.listmovie.edit', [
            'lists' => $this->listMovie->listsID($id),
            'ListNames' => $this->listMovie->listMovie()
        ]);
    }
    // thêm thể loại
    public function addgenre(Request $request)
    {
        return view('admin.genre.add');
    }
    // danh sách thể loại
    public function listgenre()
    {
        return view('admin.genre.list', [
            'genres' => $this->genre->list()
        ]);
    }
    // chỉnh sửa thể loại
    public function editgenre($id, Request $request)
    {
        return view('admin.genre.edit', [
            'genres' => $this->genre->listGenre($id)
        ]);
    }
    // Thống kê
    public function statisMain(Request $request)
    {
        return view('admin.statistical.main', [
            'totalMovies' => $this->statis->totalMovie(),
            'totalGenre' => $this->statis->totalGenre(),
            'totalView' => $this->statis->totalView(),
            'orderData' => $this->statis->getAccessData($request),
        ]);
    }
    public function chartday(Request $request)
    {
        $data = $request->all();
        $formdate = $data['formdate'];
        $to_date = $data['to_date'];

        $orders = access::whereBetween('created_at', [$formdate, $to_date])->orderBy('created_at', 'ASC')->get();

        $chart_data = [];

        foreach ($orders as $order) {
            $date = $order->created_at->format('Y-m-d');

            if (!array_key_exists($date, $chart_data)) {
                // If the date does not exist in the chart data, initialize it
                $chart_data[$date] = [
                    'created_at' => $date,
                    'id_count' => 0, // Initialize the id_count for the date
                ];
            }

            // Accumulate the 'tongtien' for the date
            $chart_data[$date]['id_count']++;
        }

        // Convert the associative array to a numeric array


        // Chuỗi JSON đầu vào
        $chart_data1 = array_values($chart_data);
        return response()->json($chart_data1);
    }
    public function chartdayhai(Request $request)
    { $data = $request->all();

        try {
            $dashboardValue = $data['dashboard_value'] ?? null;
        
            if ($dashboardValue == '7ngay') {
                $get = access::whereBetween('created_at', [Carbon::now('Asia/Ho_Chi_Minh')->subDay(7), Carbon::now('Asia/Ho_Chi_Minh')])->orderBy('created_at', 'ASC')->get();
            } elseif ($dashboardValue == 'thangtruoc') {
                $get = access::whereBetween('created_at', [Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth(), Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()])->orderBy('created_at', 'ASC')->get();
            } elseif ($dashboardValue == 'thangnay') {
                $get = access::whereBetween('created_at', [Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth(), Carbon::now('Asia/Ho_Chi_Minh')])->orderBy('created_at', 'ASC')->get();
            } else {
                $get = access::whereBetween('created_at', [Carbon::now('Asia/Ho_Chi_Minh')->subDay(365), Carbon::now('Asia/Ho_Chi_Minh')])->orderBy('created_at', 'ASC')->get();
            }
        
            $chart_data = [];
            foreach ($get as $order) {
                $date = $order->created_at->format('Y-m-d');
        
                if (!array_key_exists($date, $chart_data)) {
                    $chart_data[$date] = [
                        'created_at' => $date,
                        'id_count' => 0,
                    ];
                }
                $chart_data[$date]['id_count']++;

            }
            $chartDate1 = array_values($chart_data);
            
            return response()->json($chartDate1);
            // Your existing code here

        }catch (\Exception $e) {
            // Handle exceptions, log or return an error response
}return response()->json(['error' => 'An error occurred.'], 500);
} 




}