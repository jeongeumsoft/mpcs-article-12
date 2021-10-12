<?php

namespace Exit11\Article\Repositories;

use Exit11\Article\Models\ArticleFile as Model;
use Mpcs\Core\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Exception;

class ArticleFileRepository implements ArticleFileRepositoryInterface
{
    use RepositoryTrait;

    public function __construct(Model $model)
    {
        $this->repositoryInit($model);
    }

    // Get all instances of model
    public function select($enableRequestParam = false, $isApiSelect = false)
    {
        $apiSelectParams = [
            'item_list' => ['id', 'name', 'is_visible'],
            'attribute_name' => trans('mpcs-article::word.attributes.article_file')
        ];
        $model = $this->model::search($enableRequestParam);
        return $this->getSelectFormatter($model, $isApiSelect, $apiSelectParams);
    }

    // Get all instances of model
    public function all()
    {
        $model = $this->model::search()->sortable();
        return $model->with($this->model::getDefaultLoadRelations())->paging();
    }

    // create a new record in the database
    public function create()
    {
        DB::beginTransaction();
        try {
            $articleFile = $this->request['upload_file'] ?? null;
            if (is_file($articleFile)) {
                $filename = round(microtime(true) * 1000) . "_" . Str::random(10) . "." . $articleFile->clientExtension();
                $this->model->caption = $articleFile->getClientOriginalName();
                $this->model->name = $filename;
                $this->model->size = $articleFile->getSize();
                $this->model->mime = $articleFile->getClientMimeType();
                $this->model->save();
                $this->model->upload_disk->putFileAs($this->model->dir_path, $articleFile, $filename, 'public');
            }
            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $this->model->loadRelations();
    }

    // update record in the database
    public function update($model)
    {
    }

    // show the record with the given id
    public function get($model)
    {
        return $model->loadRelations();
    }

    // remove record from the database
    public function delete($model)
    {
        return $model->delete();
    }
}
