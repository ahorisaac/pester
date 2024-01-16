<?php

use App\Models\User;

test('unauthenticated user cannot store a post', function () {
    $response = $this->post('/posts');

    $response->assertStatus(302);
});

test('authenticated user can create a post', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/posts', [
        'user_id' => $user->id,
        'title' => 'test title',
        'body' => 'test body',
        'status' => 'is_published',
    ]);

    $response->assertRedirect('/');

    $this->assertDatabaseHas('posts', ["title" => "test title"]);
});
