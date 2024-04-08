<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\PageVisit;
use App\Models\TrackedUser;
use GeoIp2\Database\Reader;
use GeoIp2\Exception\AddressNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use MaxMind\Db\Reader\InvalidDatabaseException;

class LoggerController extends Controller
{
    public function pageVisited(Request $request): JsonResponse
    {
        $requestData = $request->validate([
            'data'               => 'required|array',
            'user_id'            => 'nullable',
            'user_data'          => 'nullable|array',
            'browser_data'       => 'nullable|array',
        ]);
        $this->logRequest($requestData);
        $this->storeUserData($requestData['user_id'], $requestData['user_data']);
        $ip = $request->ip();
        $country = $this->getCountry($ip);

        PageVisit::create([
            'page'         => $requestData['data']['path'],
            'user_id'      => $requestData['user_id'],
            'browser_info' => $requestData['browser_data'],
            'ip_address'   => $ip,
            'country'      => $country,
        ]);
        return response()->json(['saved']);
    }

    public function event(Request $request)
    {
        $requestData = $request->validate([
            'data'               => 'required',
            'user_id'            => 'nullable',
            'user_data'          => 'nullable',
            'generic_attributes' => 'nullable|array',
            'browser_data'       => 'nullable',
        ]);
        $this->logRequest($requestData);
        $this->storeUserData($requestData['user_id'], $requestData['user_data']);
        $attributes = array_merge($requestData['data']['attributes'], $requestData['generic_attributes']);
        $ip = $request->ip();
        $country = $this->getCountry($ip);

        Event::create([
            'name'         => $requestData['data']['name'],
            'attributes'   => $attributes,
            'user_id'      => $requestData['user_id'],
            'browser_info' => $requestData['browser_data'],
            'ip_address'   => $ip,
            'country'      => $country,
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

    private function getCountry(string $ip): string
    {
        try {
            $reader = new Reader(config('services.geoip2.database_path'));
            $record = $reader->country($ip);
        } catch (AddressNotFoundException|InvalidDatabaseException $e) {
            Log::error('country not found for IP address' . $ip, [$e]);
            return '';
        }
        return $record->country->name;
    }

}


