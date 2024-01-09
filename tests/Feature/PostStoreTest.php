<?php

test('unauthenticated user cannot store a post', function () {
    $response = $this->post('/posts');

    $response->assertStatus(302);
});

test('authenticated user can create a post', function () {
    $response = $this->actingAs(\App\Models\User::factory()->create())->post('/posts');

    $response->assertStatus(200);
});
