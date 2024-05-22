<?php

use App\Models\User;

test('main page loads')->get('/')->assertOk();

it('redirects to login if not authenticated', function () {
    $response = $this->get('/dashboard');

    $response->assertStatus(302);
    $response->assertRedirect('/login');
});

test('dashboard is displayed when logged in', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/dashboard');

    $response->assertOk();
    $response->assertSee('Dashboard');
});


