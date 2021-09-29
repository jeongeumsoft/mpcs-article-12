<?php

namespace Exit11\Article\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Mpcs\Core\Traits\ControllerTrait;
use Mpcs\Core\Facades\Core;

use Exit11\Article\Http\Requests\CategoryRequest as Request;
use Exit11\Article\Services\CategoryService as Service;
use Exit11\Article\Models\Category as Model;
use Exit11\Article\Http\Resources\Category as Resource;
use Exit11\Article\Http\Resources\CategoryCollection as ResourceCollection;

class CategoryController extends Controller
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
     * @param  mixed $category
     * @return void
     */
    public function edit(Model $category)
    {
        return new Resource($this->service->edit($category));
    }

    /**
     * show
     *
     * @param  mixed $category
     * @return void
     */
    public function show(Model $category)
    {
        return new Resource($this->service->show($category));
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
    public function update(Request $request, Model $category)
    {
        return new Resource($this->service->update($category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $category)
    {
        return Core::responseJson($this->service->destroy($category));
    }
}
