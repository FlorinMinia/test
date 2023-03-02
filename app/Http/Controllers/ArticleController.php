<?php

namespace App\Http\Controllers;

use App\Services\Articles\CreateArticleService;
use App\Services\Articles\ListArticlesService;
use App\Http\Requests\ArticleRequest;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ArticleController extends Controller
{
    public function __construct(
        private CreateArticleService $createArticleService = new CreateArticleService(),
        private ListArticlesService $listArticlesService = new ListArticlesService(),
    ) {}

    public function store(ArticleRequest $request)
    {
        $validatedData = $request->validated();

        $created = $this->createArticleService->handle($validatedData);

        if ($created === true) {
            return response()->json([
                'status' => 'success'
            ])->setStatusCode(Response::HTTP_CREATED, Response::$statusTexts[Response::HTTP_CREATED]);
        }

        return response()->json([
            'status' => 'failed'
        ])->setStatusCode(Response::HTTP_UNPROCESSABLE_ENTITY, Response::$statusTexts[Response::HTTP_UNPROCESSABLE_ENTITY]);
    }


    public function index(Request $request)
    {
        $results = $this->listArticlesService->handle('test');

        if ($results !== null ) {
            return response()->json([
                'status' => 'success',
                'data' => $results
            ])->setStatusCode(Response::HTTP_OK, Response::$statusTexts[Response::HTTP_OK]);
        }
    }
}
