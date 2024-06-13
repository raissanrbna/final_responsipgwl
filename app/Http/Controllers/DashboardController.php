<?php

namespace App\Http\Controllers;

use App\Models\Points;
use App\Models\Polylines;
use App\Models\Polygons;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->points = new Points(); //Variabel untuk memanggil model yang menyimpan point pada database
        $this->polylines = new Polylines();
        $this->polygons= new Polygons();

    }

    public function index()
    {
        $data = [
            "title"=>"Dasboard",
            "total_points"=>$this->points->count(), //Membuat variabel total point untuk menghitung total point dengan memanggil variabel this point lalu di count
            "total_polylines"=>$this->polylines->count(),
            "total_polygons"=>$this->polygons->count(),
        ];

        return view( 'dashboard', $data);
    }
}
