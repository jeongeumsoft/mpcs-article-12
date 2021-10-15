<?php

namespace Exit11\Article\Repositories;

use Exception;
use Mpcs\Core\Facades\Core;
use Exit11\Article\Models\Popup as Model;
use Mpcs\Core\Traits\RepositoryTrait;
use Illuminate\Support\Facades\DB;
use MpcsUi\Bootstrap5\Facades\Bootstrap5;

class PopupRepository implements PopupRepositoryInterface
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
            'item_list' => ['id', 'title'],
            'attribute_name' => trans('mpcs-article::word.attr.popup')
        ];
        $model = $this->model::allow()->search($enableRequestParam);

        return $this->getSelectFormatter($model, $isApiSelect, $apiSelectParams);
    }

    // Get all instances of model
    public function all()
    {
        $model = $this->model::search()->sortable(["order" => "asc"]);
        return $model->with($this->model::getDefaultLoadRelations())->paging();
    }

    // create a new record in the database
    public function create()
    {
        /* DB 트랜젝션 시작 */
        DB::beginTransaction();
        try {
            $this->model->title = $this->request['title'];
            $this->model->type = $this->request['type'];
            $this->model->content = $this->request['content'] ?? null;
            $this->model->background_color = $this->request['background_color'] ?? null;
            $this->model->url = $this->request['url'] ?? null;
            $this->model->target = $this->request['target'];
            $this->model->is_visible = $this->request['is_visible'] ?? null;
            $this->model->period_from = $this->request['period_from'];
            $this->model->period_to = $this->request['period_to'];
            $this->model->user_id = Core::user()->id;

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['image'] ?? null;
            if (substr($requestImage, 0, 10) === "data:image") {
                $base64ToFile = Bootstrap5::base64ToFile($requestImage, $this->model->upload_disk, $this->model->image_root_dir);
                if ($base64ToFile) {
                    $this->model->image = $base64ToFile;
                }
            } else {
                $this->model->image = $requestImage;
            }


            if ($this->model->save()) {
                $result = $this->model->moveToStart();
            }

            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $result ? $this->model : false;
    }

    // update record in the database
    public function update($model)
    {
        /* DB 트랜젝션 시작 */
        DB::beginTransaction();
        try {
            $model->type = $this->request['type'];
            $model->title = $this->request['title'];
            $model->target = $this->request['target'];
            $model->period_from = $this->request['period_from'];
            $model->period_to = $this->request['period_to'];
            $model->is_visible = $this->request['is_visible'] ?? null;
            $model->content = $this->request['content'] ?? null;
            $model->background_color = $this->request['background_color'] ?? null;
            $model->url = $this->request['url'] ?? null;
            $model->user_id = Core::user()->id;

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['image'] ?? null;
            if (substr($requestImage, 0, 10) === "data:image") {
                $base64ToFile = Bootstrap5::base64ToFile($requestImage, $model->upload_disk, $model->image_root_dir);
                if ($base64ToFile) {
                    $model->image = $base64ToFile;
                }
            } else {
                $model->image = $requestImage;
            }

            $result = $model->save();

            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $result ? $model : false;
    }

    // show the record with the given id
    public function get($model)
    {
        return $model;
    }

    // remove record from the database
    public function delete($model)
    {
        return $model->delete();
    }

    public function orderable($model)
    {

        /* DB 트랜젝션 시작 */
        DB::beginTransaction();
        try {
            switch ($this->request['action']) {
                case 'first':
                    $model->moveToStart();
                    $message = '아이템이 처음으로 순서 지정되었습니다.';
                    break;
                case 'last':
                    $model->moveToEnd();
                    $message = '아이템이 마지막으로 순서 지정되었습니다.';
                    break;
                case 'up':
                    $model->moveOrderUp();
                    $message = '아이템이 한칸 위로 순서 지정되었습니다.';
                    break;
                case 'down':
                    $model->moveOrderDown();
                    $message = '아이템이 한칸 아래로 순서 지정되었습니다.';
                    break;
            }
            if ($model->save()) {
                $result = [
                    'title' => '순서 적용 성공',
                    'message' => $message,
                ];
            }

            DB::commit();
        } catch (Exception $e) {
            /* DB 트랜젝션 롤 */
            DB::rollback();
            throw $e;
        }

        return $result ? $result : false;
    }
}
