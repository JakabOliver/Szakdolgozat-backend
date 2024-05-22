<?php

use App\Models\User;
beforeEach(function () {
    $this->user = User::factory()->create();
    $this->defaultFilter = ['date_from'=>null, 'date_to'=>null, 'page'=>null, 'event'=>null, 'user'=>null];
});

describe('Data flow lists', function () {
    test('Visits', function ()  {
        $response = $this->actingAs($this->user)->post('/visit/list', [
            'limit'=>10,
            'filter'=> $this->defaultFilter
        ]);
        $response->assertOk();
        expect($response->json())->toBeArray();
    });
    test('Events', function ()  {
        $response = $this->actingAs($this->user)->post('/event/list', [
            'limit'=>10,
            'filter'=> $this->defaultFilter
        ]);
        $response->assertOk();
        expect($response->json())->toBeArray();
    });
});
