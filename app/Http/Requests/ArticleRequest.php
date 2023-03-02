<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'numeric'],
            'title' => ['required', 'string', 'max:120'],
            'body' => ['required', 'string', 'max:1000'],
        ];
    }
}
