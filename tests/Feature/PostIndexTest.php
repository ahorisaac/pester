<?php

use App\Models\{Post, User};
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->user = User::factory()->create();
    $this->post = Post::factory()->create();
});

it('has post index page', function () {
    $response = $this->get("/posts");
    $response->assertStatus(200);
});

it("can we see the new post", function () {
    $post = Post::factory()->create();
    $this->get("/posts")->assertSeeText($post->title)->assertSeeText($post->body);
});
