<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PageVisit;
use App\Models\TrackedUser;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LoggerController extends Controller
{
    public function pageVisited(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'data'      => 'required',
            'user_id'   => 'nullable',
            'user_data' => 'nullable'
        ]);
        //when the user_id doesn't yet exists a get a 500 on the save later.
        $user = TrackedUser::firstOrCreate(['id' => $requestData['user_id']]);
        $user->updateAtributes($requestData['user_data']);
        $user->save();
        $data = $requestData['data'];
        $this->logRequest($requestData);
        PageVisit::create(['page' => $data['path'], 'user_id' => $requestData['user_id']]);
        return response()->json(['saved']);
    }

    public function event(Request $request)
    {
        $requestData = $request->validate([
            'data'    => 'required',
            'user_id' => 'nullable'
        ]);
        $this->logRequest($requestData);
        Event::create([
            'name'       => $requestData['data']['name'],
            'attributes' => json_encode($requestData['data']['attributes']),
            'user_id'    => $requestData['user_id']
        ]);
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


