<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function dashboard(): View
    {
        return view('dashboard', []);
    }


    public function chart(string $type, int $range = null): JsonResponse
    {
        $data = [];
        switch ($type) {
            case 'requests':
                $data = Request::getForLastDaysGrouped($range);
                break;
            case 'events':
                $data = Event::getCountForPastMonth($range);
                break;
        }
        return response()->json($data);
    }
}
