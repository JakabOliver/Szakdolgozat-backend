<?php

namespace App\Http\Controllers;

use App\Models\DTO\VisitFilterDTO;
use App\Models\PageVisit;
use App\Models\TrackedUser;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class VisitController extends Controller
{

    public function index(): View
    {
        $pages = PageVisit::getDistinctPageNames();
        $users = TrackedUser::getDistinct();
        return view('visit.index', ['pages' => $pages, 'users'=>$users]);
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
        $filter = new VisitFilterDTO($requestedData['filter']['date_from'], $requestedData['filter']['date_to'], $requestedData['filter']['page'], $requestedData['filter']['user']);
        $visits = PageVisit::filter($filter, $requestedData['limit']);

        return response()->json(['visits'=>$visits]);
    }

    public function show(PageVisit $visit): View
    {
        return view('visit.show', ['visit' => $visit]);
    }

}
