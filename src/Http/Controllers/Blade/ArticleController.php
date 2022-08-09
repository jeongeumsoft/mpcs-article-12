<?php

namespace Mpcs\Article\Http\Controllers\Blade;

use Mpcs\Article\Http\Controllers\Api\ArticleController as Controller;
use Mpcs\Article\Http\Requests\ArticleRequest as Request;
use Mpcs\Article\Facades\Article;
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
        return view(Article::theme('articles.index'), compact('categories', 'article_categories', 'tags'))->withInput($request->flash());
    }

    /**
     * list
     * @param  mixed $request
     * @return view
     */
    public function list(Request $request)
    {
        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('_per_page', Article::getPerPage('blade.articles'));

        $datas = $this->service->index();
        return view(Article::theme('articles.partials.list'), compact('datas'))->withInput($request->flash());
    }
}
