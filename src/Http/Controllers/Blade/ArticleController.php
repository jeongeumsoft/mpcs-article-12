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
        $categories = Core::dataSelect('article_categories', ['_vendor' => 'Mpcs\Article', '_withs' => ['allChildren', 'articles'], '_scopes' => ['nullParent'], 'is_visible' => true]);
        $article_categories = Core::dataSelect('article_categories', ['_vendor' => 'Mpcs\Article', 'is_visible' => true])->pluck('nested_str', 'id')->toArray();
        $tags = [];

        // 그룹이 형성되지 않았을 경우
        if ($categories->count() == 0) {
            // 토스트메세지 전달
            Core::toast([
                'message' => "Article category is not created. Please contact the administrator.",
                'title' => "Article category is not created",
                'variant' => 'error',
            ]);
            return redirect()->route(Core::getConfig('ui_route_name_prefix') . ".home");
        }

        if (!$request->article_category_id) {
            $currentCategory = $categories->where('id', $categories->first()->id)->first();
        } else {
            $currentCategory = $categories->where('id', $request->article_category_id)->first();
        }

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
