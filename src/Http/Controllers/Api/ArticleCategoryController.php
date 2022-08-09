<?php

namespace Mpcs\Article\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Mpcs\Core\Traits\ControllerTrait;
use Mpcs\Core\Facades\Core;

use Mpcs\Article\Http\Requests\ArticleCategoryRequest as Request;
use Mpcs\Article\Services\ArticleCategoryService as Service;
use Mpcs\Article\Models\ArticleCategory as Model;
use Mpcs\Article\Http\Resources\ArticleCategory as Resource;
use Mpcs\Article\Http\Resources\ArticleCategoryCollection as ResourceCollection;

class ArticleCategoryController extends Controller
{
    use ControllerTrait;
    protected $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
        $this->controllerTraitInit();
    }

    /**
     * index
     * @param  mixed $request
     * @return view
     */
    public function index(Request $request)
    {
        /* API 조회시 */
        // 모델 조회시 옵션설정(페이징여부, 검색조건)
        $this->addOption('_is_paging', false);
        $this->addOption('depth', 1);
        $this->addOption('_withs', ['allChildren']);
        return new ResourceCollection($this->service->index());
    }

    /**
     * edit
     *
     * @param  mixed $article_category
     * @return void
     */
    public function edit(Model $article_category)
    {
        return new Resource($this->service->edit($article_category));
    }

    /**
     * show
     *
     * @param  mixed $article_category
     * @return void
     */
    public function show(Model $article_category)
    {
        return new Resource($this->service->show($article_category));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return new Resource($this->service->store());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $article_category)
    {
        return new Resource($this->service->update($article_category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $article_category)
    {
        return Core::responseJson($this->service->destroy($article_category));
    }

    /**
     * saveOrder
     *
     * @param  mixed $request
     * @return void
     */
    public function saveOrder(Request $request)
    {
        return Core::responseJson($this->service->saveOrder());
    }
}
