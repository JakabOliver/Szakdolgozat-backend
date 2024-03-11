<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Contracts\View\View;

class EventController extends Controller
{

    public function index(): View
    {
        $events = Event::all();
        return view('event.index', ['events' => $events]);
    }
}
