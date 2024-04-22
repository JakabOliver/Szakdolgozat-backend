<?php

namespace App\Http\Controllers;

use App\Models\DTO\EventFilterDTO;
use App\Models\Event;
use App\Models\TrackedUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class EventController extends Controller
{

    public function index(): View
    {
        $events = Event::getDistinctNames();
        $users = TrackedUser::getDistinct();
        return view('event.index', ['events' => $events, 'users' => $users]);
    }


    public function list(Request $request): JsonResponse
    {
        $requestedData = $request->validate([
            'filter' => 'array',
            'limit'=>'required|integer',
            // 'sort' => 'nullabel|array',
        ]);
        if($requestedData['filter']['date_from'] !== null){
            $requestedData['filter']['date_from'] = new Carbon($requestedData['filter']['date_from']);
        }
        if($requestedData['filter']['date_to'] !== null){
            $requestedData['filter']['date_to'] = new Carbon($requestedData['filter']['date_to']);
        }
        $filter = new EventFilterDTO($requestedData['filter']['date_from'], $requestedData['filter']['date_to'], $requestedData['filter']['event'], $requestedData['filter']['user']);
        $events = Event::filter($filter, $requestedData['limit']);

        return response()->json(['events'=>$events]);
    }

    public function show(Event $event): View
    {
        return view('event.show', ['event' => $event]);
    }
}
