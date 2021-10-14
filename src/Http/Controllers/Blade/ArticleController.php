<?php

namespace Exit11\Article\Http\Controllers\Blade;

use Exit11\Article\Http\Controllers\Api\ArticleController as Controller;
use Exit11\Article\Http\Requests\ArticleRequest as Request;
use Exit11\Article\Facades\Article;
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
        $categories = Core::dataSelect('article_categories', ['_vendor' => 'Exit11\Article', '_withs' => ['allChildren', 'articles'], '_scopes' => ['nullParent'], 'is_visible' => true]);
        $article_categories = Core::dataSelect('article_categories', ['_vendor' => 'Exit11\Article', 'is_visible' => true])->pluck('nested_str', 'id')->toArray();
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
        $datas = $this->service->index();
        return view(Article::theme('articles.partials.list'), compact('datas'))->withInput($request->flash());
    }
}
