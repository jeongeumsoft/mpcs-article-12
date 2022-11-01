<?php

namespace Mpcs\Article\Http\Controllers\Blade;

use Mpcs\Article\Http\Controllers\Api\ArticleController as Controller;
use Mpcs\Article\Http\Requests\ArticleRequest as Request;
use Mpcs\Article\Facades\Article as Facade;
use Mpcs\Core\Facades\Core;

class ArticleController extends Controller
{

    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        $article_categories = Core::dataSelect('article_categories', [
            'is_visible' => true
        ]);
        $tags = [];

        // 그룹이 형성되지 않았을 경우
        if ($article_categories->count() == 0) {
            // 토스트메세지 전달
            Core::toast([
                'message' => "Article category is not created. Please contact the administrator.",
                'title' => "Article category is not created",
                'variant' => 'error',
            ]);
            return redirect()->route(Core::getConfig('ui_route_name_prefix') . ".home");
        }

        $currentCategory = $article_categories->where('id', $request->article_category_id)->first();

        // 그룹지정없이 들어올 경우 강제 리다이렉트
        if (!$request->article_category_id || !$currentCategory) {
            return redirect()->route(Core::getConfig('ui_route_name_prefix') . '.articles.index', ['article_category_id' => $article_categories->first()->id]);
        }

        $article_categories = $article_categories->pluck('nested_str', 'id')->toArray();

        // 카테고리 네스티드 목록
        $categories = Core::dataSelect('article_categories', [
            '_withs' => ['allChildren', 'articles'],
            '_scopes' => ['nullParent'],
            'is_visible' => true
        ]);

        return view(Facade::theme('articles.index'), compact('categories', 'article_categories', 'currentCategory', 'tags'))->withInput($request->flash());
    }

    /**
     * list
     * @param  mixed $request
     * @return view
     */
    public function list(Request $request)
    {
        $datas = $this->service->index();
        return view(Facade::theme('articles.partials.list'), compact('datas'))->withInput($request->flash());
    }
}
