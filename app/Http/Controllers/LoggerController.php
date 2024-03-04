<?php

namespace App\Http\Controllers;

use App\Models\PageVisit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoggerController extends Controller
{
    public function pageVisited(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'data' => 'required'
        ]);
        $data = $requestData['data'];
        $this->logRequest($data);
        PageVisit::create(['page' => $data['path']]);
        return response()->json(['saved']);
    }

    /**
     * @param array $data
     * @return void
     */
    public function logRequest(array $data): void
    {
        \App\Models\Request::create(['data' => json_encode($data)]);
    }
}


