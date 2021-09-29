<?php

namespace Exit11\Article\Repositories;

use Exception;
use Mpcs\Core\Facades\Core;
use Exit11\Article\Models\Article as Model;
use Illuminate\Support\Facades\DB;
use Mpcs\Core\Traits\RepositoryTrait;

class ArticleRepository implements ArticleRepositoryInterface
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
            // id, name [,'is_visible']
            'item_list' => ['id', 'name'],
            'attribute_name' => trans('cms.attributes.article')
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
            /* DB 트랜젝션 통과 */

            // Your code

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
        DB::beginTransaction();
        try {
            /* DB 트랜젝션 통과 */

            // Your code
            // $model->save();

            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $model->loadRelations();
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
