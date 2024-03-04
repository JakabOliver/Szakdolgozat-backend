<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $visits=PageVisit::all();
    }
}
