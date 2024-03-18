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

    public function show(Event $event): View
    {
        return view('event.show', ['event' => $event]);
    }
}
