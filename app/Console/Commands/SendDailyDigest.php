<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendDailyDigest extends Command
{
    
    protected $signature = 'send:daily-digest';
    protected $description = 'Send a daily email digest of the top posts to all users';
   
    
    
    public function __construct()
    {
        parent::__construct();
    }
    public function handle()
    {
        $posts = Post::orderBy('created_at', 'desc')->take(10)->get();
        $users = \App\Models\User::all();

        foreach ($users as $user) {
            Mail::to($user->email)->send(new DailyDigest($posts));
        }

        return 0;
    }
}
