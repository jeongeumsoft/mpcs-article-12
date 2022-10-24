<?php

namespace Mpcs\Article\Http\Controllers\OpenApi;

use Mpcs\Article\Http\Controllers\Api\ArticleController as Controller;
use Mpcs\Article\Facades\Article as Facade;
use Mpcs\Article\Http\Resources\ArticleCollection as ResourceCollection;
use Mpcs\Article\Http\Requests\ArticleRequest as Request;
use Mpcs\Article\Models\ArticleCategory;

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
        $article_category = ArticleCategory::find($request->article_categories);
        $this->addOption('_per_page', $article_category->per_page);
        if ($request->article_categories) {
            $this->addOption('article_category_id', $request->article_categories);
        }

        return new ResourceCollection($this->service->index());
    }
}
