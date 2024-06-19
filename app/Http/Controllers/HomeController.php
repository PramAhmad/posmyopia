<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        return response()->json(DB::select("SHOW COLUMNS FROM members"));
        return view('home');
    }
}
