<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase; 
use App\Models\User;
use App\Models\Post;


class PostTest extends TestCase
{
    use RefreshDatabase;
    public function a_user_can_create_a_post()
    {
        $this->be($user = User::factory()->create());

        $response = $this->post('/posts', [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'title' => 'Test Post',
            'body' => 'This is a test post.',
            'user_id' => $user->id,
        ]);
    }
    public function a_user_can_view_their_posts()
    {
        $this->be($user = User::factory()->create());
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->get('/posts');

        $response->assertStatus(200);
        $response->assertSee($post->title);
    }
    public function a_user_can_update_their_post()
    {
        $this->be($user = User::factory()->create());
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->put("/posts/{$post->id}", [
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ]);

        $response->assertRedirect('/posts');
        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
            'body' => 'Updated Body',
        ]);
    }
    public function a_user_can_delete_their_post()
    {
        $this->be($user = User::factory()->create());
        $post = Post::factory()->create(['user_id' => $user->id]);

        $response = $this->delete("/posts/{$post->id}");

        $response->assertRedirect('/posts');
        $this->assertDatabaseMissing('posts', ['id' => $post->id]);
    }
    
}
