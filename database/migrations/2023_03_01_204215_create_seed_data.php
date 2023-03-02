<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Article;
use Illuminate\Support\Facades\Cache;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = User::create([
            'email' => 'test@email.test',
        ]);

        $article_1 = Article::create([
            'user_id' => $user->id,
            'title' => 'Title article 1',
            'body' => 'Body article 1',
            'published_at' => date('Y-m-d H:i:s'),
        ]);
        sleep(2);
        $article_2 = Article::create([
            'user_id' => $user->id,
            'title' => 'Title post 2',
            'body' => 'Body article 2',
            'published_at' => date('Y-m-d H:i:s'),
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Article::all()->each(function($article){
            $article->delete();
        });

        User::all()->each(function($user){
            $user->delete();
        });

        Cache::flush();
    }
};
