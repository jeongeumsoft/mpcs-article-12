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
        $this->addOption('_per_page', Facade::getPerPage());

        if ($request->article_categories) {
            $category = ArticleCategory::find($request->article_categories);
            return (new ResourceCollection($this->service->index()))->additional(['category' => $category]);
        } else {
            return new ResourceCollection($this->service->index());
        }
    }
}
