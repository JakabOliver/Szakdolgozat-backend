<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function dashboard()
    {
        $visits=PageVisit::all();
        $events= Event::all();
        return view('dashboard', ['visits' => $visits, 'events'=>$events]);
    }
}
