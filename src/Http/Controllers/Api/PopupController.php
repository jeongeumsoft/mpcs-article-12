<?php

namespace Exit11\Article\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Mpcs\Core\Traits\ControllerTrait;
use Exit11\Article\Http\Requests\PopupRequest as Request;
use Exit11\Article\Services\PopupService as Service;
use Exit11\Article\Models\Popup as Model;
use Mpcs\Core\Facades\Core;
use Exit11\Article\Http\Resources\Popup as Resource;
use Exit11\Article\Http\Resources\PopupCollection as ResourceCollection;

class PopupController extends Controller
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
        $this->addOption('_is_paging', false);
        $this->addOption('sort', ["order" => "desc"]);
        return new ResourceCollection($this->service->index());
    }

    /**
     * edit
     *
     * @param  mixed $popup
     * @return void
     */
    public function edit(Model $popup)
    {
        return new Resource($this->service->edit($popup));
    }

    /**
     * show
     *
     * @param  mixed $popup
     * @return void
     */
    public function show(Model $popup)
    {
        return new Resource($this->service->show($popup));
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
    public function update(Request $request, Model $popup)
    {
        return new Resource($this->service->update($popup));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $popup)
    {
        return Core::responseJson($this->service->destroy($popup));
    }

    /**
     * orderable
     *
     * @param  mixed $request
     * @return void
     */
    public function orderable(Request $request, Model $popup)
    {
        return Core::responseJson($this->service->orderable($popup));
    }
}
