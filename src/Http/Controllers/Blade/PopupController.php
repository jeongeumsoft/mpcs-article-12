<?php

namespace Exit11\Article\Http\Controllers\Blade;

use Exit11\Article\Http\Controllers\Api\PopupController as Controller;
use Exit11\Article\Http\Requests\PopupRequest as Request;
use Exit11\Article\Facades\Article;

class PopupController extends Controller
{

    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        return view(Article::theme('popups.index'))->withInput($request->flash());
    }

    /**
     * list
     * @param  mixed $request
     * @return view
     */
    public function list(Request $request)
    {
        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('_per_page', Article::getPerPage('blade.popups'));
        $this->addOption('sort', ["order" => "desc"]);
        $datas = $this->service->index();
        return view(Article::theme('popups.partials.list'), compact('datas'))->withInput($request->flash());
    }
}
