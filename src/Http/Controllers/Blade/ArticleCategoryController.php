<?php

namespace Exit11\Article\Http\Controllers\Blade;

use Exit11\Article\Http\Controllers\Api\ArticleCategoryController as Controller;
use Exit11\Article\Http\Requests\ArticleCategoryRequest as Request;
use Exit11\Article\Models\ArticleCategory as Model;

class ArticleCategoryController extends Controller
{
    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        $types = Model::getAllowTypes();
        return view('mpcs-article::article_categories.index', compact('types'))->withInput($request->flash());
    }

    /**
     * list
     * @param  mixed $request
     * @return view
     */
    public function list(Request $request)
    {
        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('depth', 1);
        $this->addOption('_is_paging', false);
        $this->addOption('_withs', ['allChildren']);

        $datas = $this->service->index();

        return view('mpcs-article::article_categories.partials.list', compact('datas'))->withInput($request->flash());
    }

    /**
     * list categories
     * @param  mixed $request
     * @return view
     */
    public function listCategories(Request $request)
    {

        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('depth', 1);
        $this->addOption('_is_paging', false);
        $this->addOption('_withs', ['allChildren']);

        $datas = $this->service->index();

        return view('mpcs-article::article_categories.partials.list_categories', compact('datas'))->withInput($request->flash());
    }
}
