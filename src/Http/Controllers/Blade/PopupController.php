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
        $datas = $this->service->index();
        return view(Article::theme('popups.partials.list'), compact('datas'))->withInput($request->flash());
    }
}
