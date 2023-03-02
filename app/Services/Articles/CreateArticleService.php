<?php

namespace App\Services\Articles;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class CreateArticleService
{
    public function handle($data)
    {
        try {
            DB::transaction(function () use ($data) {
                DB::table('articles')->insert([
                    'user_id' => $data['user_id'],
                    'title' => $data['title'],
                    'body' => $data['body']
                ]);
            });
            Cache::forget('articles');
        } catch(\Exception $e){
            return false;
        }

        return true;
    }
}
