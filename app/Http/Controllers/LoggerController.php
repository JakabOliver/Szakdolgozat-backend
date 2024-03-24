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
            'data'         => 'required|array',
            'user_id'      => 'nullable|string',
            'user_data'    => 'nullable|array',
            'browser_data' => 'nullable|array',
        ]);
        $this->logRequest($requestData);
        $this->storeUserData($requestData['user_id'], $requestData['user_data']);

        PageVisit::create([
            'page'         => $requestData['data']['path'],
            'user_id'      => $requestData['user_id'],
            'browser_info' => $requestData['browser_data']
        ]);
        return response()->json(['saved']);
    }

    public function event(Request $request)
    {
        $requestData = $request->validate([
            'data'         => 'required',
            'user_id'      => 'nullable',
            'user_data'    => 'nullable',
            'browser_data' => 'nullable',
        ]);
        $this->logRequest($requestData);
        $this->storeUserData($requestData['user_id'], $requestData['user_data']);

        Event::create([
            'name'         => $requestData['data']['name'],
            'attributes'   => json_encode($requestData['data']['attributes']),
            'user_id'      => $requestData['user_id'],
            'browser_info' => $requestData['browser_data']
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

    /**
     * @param string $userId
     * @param array $userData
     * @return void
     */
    public function storeUserData(string $userId, array $userData): void
    {
        //when the user_id doesn't yet exists a get a 500 on the save later.
        $user = TrackedUser::firstOrCreate(['id' => $userId]);
        $user->updateAtributes($userData);
        $user->save();
    }
}


