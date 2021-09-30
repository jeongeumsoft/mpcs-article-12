<?php

namespace Exit11\Article\Repositories;

use Exit11\Article\Models\ArticleCategory as Model;
use Mpcs\Core\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use Exception;

class ArticleCategoryRepository implements ArticleCategoryRepositoryInterface
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
            'attribute_name' => trans('mpcs-article::word.attributes.category')
        ];
        $model = $this->model::search($enableRequestParam);
        return $this->getSelectFormatter($model, $isApiSelect, $apiSelectParams);
    }

    // Get all instances of model
    public function all()
    {
        $model = $this->model::search()->sortable($this->model->defaultSortable);
        // return $model->with($this->model::getDefaultLoadRelations())->paging();
        return $model->with($this->model::getDefaultLoadRelations())->paging()->filterNestedSearch($this->model);
    }

    // create a new record in the database
    public function create()
    {
        DB::beginTransaction();
        try {
            /* DB 트랜젝션 통과 */
            $this->model->name = $this->request['name'];
            $this->model->description = $this->request['description'] ?? null;
            $this->model->parent_id = $this->request['parent_id'] ?? null;
            $this->model->type = $this->request['type'];
            $this->model->is_visible = $this->request['is_visible'] ?? false;
            $this->model->save();

            // nested_info: depth(, nested_ids)
            $this->model->nested_info = $this->model->parent;

            // max depth 체크
            if ($this->model::$maxDepth < $this->model->depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }
            $this->model->save();

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
            $model->name = $this->request['name'];
            $model->description = $this->request['description'] ?? null;
            $model->parent_id = $this->request['parent_id'] ?? null;
            $model->type = $this->request['type'];
            $model->is_visible = $this->request['is_visible'] ?? false;
            $this->model->save();

            // nested_info: depth(, nested_ids)
            $this->model->nested_info = $this->model->parent;

            // max depth 체크
            if ($this->model::$maxDepth < $this->model->depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }
            $this->model->save();

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

    public function saveOrder()
    {
        /* DB 트랜젝션 시작 */
        DB::beginTransaction();
        try {
            /* DB 트랜젝션 통과 */
            $this->model::saveOrder($this->request);
            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }
        return true;
    }
}
