<?php

namespace Exit11\Article\Http\Controllers\OpenApi;

use Exit11\Article\Http\Controllers\Api\ArticleController as Controller;
use Exit11\Article\Facades\Article;
use Exit11\Article\Http\Resources\ArticleCollection as ResourceCollection;
use Exit11\Article\Http\Requests\ArticleRequest as Request;
use Exit11\Article\Models\ArticleCategory;

class ArticleController extends Controller
{
    public static $enablePolicy = false;


    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('_per_page', Article::getPerPage('api.articles'));

        if ($request->article_categories) {
            $category = ArticleCategory::find($request->article_categories);
            return (new ResourceCollection($this->service->index()))->additional(['category' => $category]);
        } else {
            return new ResourceCollection($this->service->index());
        }
    }
}
