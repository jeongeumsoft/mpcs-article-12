<?php

namespace Exit11\Article\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use Mpcs\Core\Traits\ControllerTrait;
use Mpcs\Core\Facades\Core;

use Exit11\Article\Http\Requests\ArticleFileRequest as Request;
use Exit11\Article\Services\ArticleFileService as Service;
use Exit11\Article\Models\ArticleFile as Model;
use Exit11\Article\Http\Resources\ArticleFile as Resource;
use Exit11\Article\Http\Resources\ArticleFileCollection as ResourceCollection;

class ArticleFileController extends Controller
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
        return new ResourceCollection($this->service->index());
    }

    /**
     * edit
     *
     * @param  mixed $article_file
     * @return void
     */
    public function edit(Model $article_file)
    {
        return new Resource($this->service->edit($article_file));
    }

    /**
     * show
     *
     * @param  mixed $article_file
     * @return void
     */
    public function show(Model $article_file)
    {
        return new Resource($this->service->show($article_file));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return new Resource($this->service->store());
        $resource = new Resource($this->service->store());
        return response()->json([
            'success' => true,
            'id' => $resource->id,
            'newUuid' => $resource->id,
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Model $article_file)
    {
        return new Resource($this->service->update($article_file));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Model $article_file)
    {
        return Core::responseJson($this->service->destroy($article_file));
    }
}
