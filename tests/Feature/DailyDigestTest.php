<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Facades\Mail;
use App\Mail\DailyDigest;

class DailyDigestTest extends TestCase
{
    use RefreshDatabase;
    public function it_sends_a_daily_digest_email()
    {
        Mail::fake();

        $users = User::factory()->count(3)->create();
        $posts = Post::factory()->count(10)->create();

        $this->artisan('send:daily-digest');

        Mail::assertSent(DailyDigest::class, 3);
        Mail::assertSent(DailyDigest::class, function ($mail) use ($posts) {
            return $mail->posts->count() === 10;
        });
    }
}
