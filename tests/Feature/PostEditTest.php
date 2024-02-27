<?php

use App\Models\{Post, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = Post::factory()->create();
});

it("has post edit route", function () {
    $response = $this->actingAs($this->user)->get("/posts/" . $this->post->id . "/edit");
    $response->assertStatus(200);
});

it("has the post details in the form", function () {
    $response = $this->actingAs($this->user)->get("/posts/" . $this->post->id . "/edit");
    $response->assertSee($this->post->title)->assertSee($this->post->body);
});

it("redirects unauthenticated user", function () {
    $response = $this->get("/posts/" . $this->post->id . "/edit");
    $response->assertStatus(302);
});

it("abort if the user does not own the post", function () {
    $user1 = User::factory()->create();
    $post = $this->user->posts()->create([
        "title" => "the post title",
        "body" => "the post body",
        "status" => "pending",
    ]);

    $this->actingAs($user1)->get('/posts/' . $post->id . '/edit')->assertStatus(403);
});
