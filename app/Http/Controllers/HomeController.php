<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        $visits=PageVisit::all();
        return view('dashboard', ['visits' => $visits]);
    }
}
