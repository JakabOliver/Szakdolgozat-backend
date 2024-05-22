<?php

use App\Models\User;
beforeEach(function () {
    $this->user = User::factory()->create();
});

describe('Charts', function () {
    test('Requests', function ()  {
        $response = $this->actingAs($this->user)->get('/dashboard/chart/requests/7');
        $response->assertOk();
        expect($response->json())->toBeArray();
    });
    test('Events', function () {
        $response = $this->actingAs($this->user)->get('/dashboard/chart/events/1');
        $response->assertOk();
        expect($response->json())->toBeArray();
    });

    test('Page visits', function () {
        $response = $this->actingAs($this->user)->get('/dashboard/chart/pageVisits/index');
        $response->assertOk();
        expect($response->json())->toBeArray();
    });
});
