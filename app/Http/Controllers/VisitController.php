<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use Illuminate\Contracts\View\View;

class VisitController extends Controller
{

    public function index(): View
    {
        $visits = PageVisit::all();
        return view('visit.index', ['visits' => $visits]);
    }

}
