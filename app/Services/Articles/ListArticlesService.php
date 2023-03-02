<?php

namespace App\Services\Articles;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;


class ListArticlesService
{
    public function handle($search)
    {
        if (Cache::has('articles')) {
            return Cache::get('articles');
        }

        try {
            $results = DB::table('articles')
                ->rightJoin('users', 'articles.user_id', '=', 'users.id')
                ->orderBy('published_at', 'desc')
                ->select('articles.*', 'users.email')
                ->get();
            Cache::forever('articles', $results);
            return $results;
        } catch(\Exception $e){
            return false;
        }
    }
}
