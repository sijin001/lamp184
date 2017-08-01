<?php

namespace App\Http\Controllers\home\movie;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class MoviePlaceController extends Controller
{
    /**
     * 影院位置展示页.
     *
     */
    public function index()
    {
        return view('home.movie.movie_place');
    }

    
}
