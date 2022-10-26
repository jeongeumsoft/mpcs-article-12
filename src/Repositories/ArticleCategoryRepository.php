<?php

namespace Mpcs\Article\Repositories;

use Mpcs\Article\Models\ArticleCategory as Model;
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

            // 기본 정보 저장
            $parentId = $this->request['parent_id'] ?? null;
            $order = $this->model::where('parent_id', $parentId)->max('order') + 1;

            if ($parentId) {
                $depth = $this->model::where('id', $parentId)->value('depth');
                $depth = (int)$depth + 1;
            } else {
                $depth = 1;
            }

            // max depth 체크
            if ($this->model::$maxDepth < $depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }

            $this->model->name = $this->request['name'];
            $this->model->description = $this->request['description'] ?? null;
            $this->model->parent_id = $parentId;
            $this->model->type = $this->request['type'];
            $this->model->page_style = $this->request['page_style'];
            $this->model->per_page = $this->request['per_page'];
            $this->model->is_visible = $this->request['is_visible'] ?? false;
            $this->model->order = $order;
            $this->model->depth = $depth;
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

            // 기본 정보 저장
            $parentId = $this->request['parent_id'] ?? null;
            $order = $this->model::where('parent_id', $parentId)->max('order') + 1;

            if ($parentId) {
                $depth = $this->model::where('id', $parentId)->value('depth');
                $depth = (int)$depth + 1;
            } else {
                $depth = 1;
            }

            // max depth 체크
            if ($this->model::$maxDepth < $depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }

            $model->name = $this->request['name'];
            $model->description = $this->request['description'] ?? null;
            $model->parent_id = $this->request['parent_id'] ?? null;
            $model->type = $this->request['type'];
            $model->page_style = $this->request['page_style'];
            $model->per_page = $this->request['per_page'];
            $model->is_visible = $this->request['is_visible'] ?? false;

            // max depth 체크
            if ($this->model::$maxDepth < $model->depth) {
                abort(422, trans('validation.max.numeric', ['attribute' => 'depth', 'max' => $this->model::$maxDepth]));
            }
            $model->save();

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
