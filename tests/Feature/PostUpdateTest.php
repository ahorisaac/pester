<?php

use App\Models\{Post, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = Post::factory()->create();
});

it('post update route exists', function () {
    $post = $this->user->posts()->create([
        "title" => "the post title x",
        "body" => "the post body x",
        "status" => "pending",
    ]);

    $this->actingAs($this->user)->put('/posts/' . $post->id, ['title' => 'new title', 'body' => 'new body', 'status' => 'published'])->assertRedirect('/posts');
});

it("redirects unauthenticated user", function () {
    $response = $this->put("/posts/" . $this->post->id);
    $response->assertStatus(302);
});

test("validate the post details", function () {
    $post = $this->user->posts()->create([
        "title" => "the post title x",
        "body" => "the post body x",
        "status" => "pending",
    ]);

    $this->actingAs($this->user)->put('/posts/' . $post->id)->assertSessionHasErrors(['title', 'body', 'status']);
});

it("abort if the user does not own the post", function () {
    $user1 = User::factory()->create();
    $post = $this->user->posts()->create([
        "title" => "the post title",
        "body" => "the post body",
        "status" => "pending",
    ]);

    $this->actingAs($user1)->put('/posts/' . $post->id)->assertStatus(403);
});

it("can update the post", function () {
    $post = $this->user->posts()->create([
        "title" => "the post title x",
        "body" => "the post body x",
        "status" => "pending",
    ]);

    $this->actingAs($this->user)->put(
        '/posts/' . $post->id,
        [
            'title' => 'new title',
            'body' => 'new body',
            'status' => 'published'
        ]
    )->assertRedirect('/posts');

    $this->assertDatabaseHas('posts',
    [
        'id' => $post->id,
        'title' => 'new title',
        'body' => 'new body',
        'status' => 'published'
    ]);
});
