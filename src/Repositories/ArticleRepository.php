<?php

namespace Exit11\Article\Repositories;

use Exception;
use Mpcs\Core\Facades\Core;
use MpcsUi\Bootstrap5\Facades\Bootstrap5;
use Exit11\Article\Models\Article as Model;
use Exit11\Article\Models\ArticleFile;
use Exit11\PushSse\Facades\PushSse;
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
            'item_list' => ['id', 'title'],
            'attribute_name' => trans('mpcs-article::word.attr.article')
        ];
        $model = $this->model::allow()->search($enableRequestParam);

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
            $this->model->title = $this->request['title'];
            $this->model->summary = $this->request['summary'] ?? null;
            $this->model->content = $this->request['content'] ?? null;
            $this->model->html = $this->request['html'] ?? null;
            $this->model->released_at = $this->request['released_at'];
            $this->model->user_id = Core::user()->id;

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['thumbnail'] ?? null;
            if ($requestImage) {
                if (!empty($requestImage)) {
                    if (substr($requestImage, 0, 10) === "data:image") {
                        $base64ToFile = Bootstrap5::base64ToFile($requestImage, $this->model->upload_disk, $this->model->image_root_dir);
                        if ($base64ToFile) {
                            $this->model->thumbnail = $base64ToFile;
                        }
                    } else {
                        $this->model->thumbnail = $requestImage;
                    }
                    Bootstrap5::generateThumb($this->model->image_root_dir, $this->model->thumbnail);
                }
            }

            if ($this->model->save()) {
                $this->model->articleCategories()->attach($this->request['article_category_ids'] ?? null);
                $this->model->retag($this->request['tag_list'] ?? []);

                if (isset($this->request['article_files'])) {
                    ArticleFile::whereIn('id', $this->request['article_files'])->update(['article_id' => $this->model->id]);
                }
            }


            // PushSse 클래스가 있는지 확인
            if (class_exists('Exit11\PushSse\Facades\PushSse') && config('mpcspushsse.enabled')) {
                // PushSse 클래스가 있으면 푸시 전송
                $is_push_notification = $this->request['is_push_notification'] ?? false;
                $is_push_notification = $is_push_notification ? true : false;
                $uidxs = [];
                array_push($uidxs, Core::user()->uidx);
                PushSse::sseQueue($this->model->title, trans('mpcs-article::word.attr.push_title'), [
                    'is_private' => false,
                    'notification' => $is_push_notification,
                    'pushed_at' => $this->model->released_at,
                    'url' => route(Bootstrap5::routePrefix() . '.articles.index'),
                    'uuids' => $uidxs,
                ]);
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
        DB::beginTransaction();
        try {
            $model->title = $this->request['title'];
            $model->summary = $this->request['summary'] ?? $model->summary;
            $model->content = $this->request['content'] ?? $model->content;
            $model->html = $this->request['html'] ?? $model->html;
            $model->released_at = $this->request['released_at'];
            $model->user_id = Core::user()->id;

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['thumbnail'] ?? $model->thumbnail;
            if ($requestImage) {
                if (substr($requestImage, 0, 10) === "data:image") {
                    $base64ToFile = Bootstrap5::base64ToFile($requestImage, $model->upload_disk, $model->image_root_dir);
                    if ($base64ToFile) {
                        $model->thumbnail = $base64ToFile;
                    }
                } else {
                    $model->thumbnail = $requestImage;
                }
                Bootstrap5::generateThumb($model->image_root_dir, $model->thumbnail);
            }

            if ($model->save()) {
                $model->articleCategories()->sync($this->request['article_category_ids'] ?? null);
                $model->retag($this->request['tag_list'] ?? []);

                if (isset($this->request['delete_article_files'])) {
                    ArticleFile::whereIn('id', $this->request['delete_article_files'])->update(['article_id' => null]);
                }

                if (isset($this->request['article_files'])) {
                    ArticleFile::whereIn('id', $this->request['article_files'])->update(['article_id' => $model->id]);
                }
            }

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
        // 뷰카운트 추가
        $viewCount = $model->view_count;
        $model->view_count = ++$viewCount;
        $model->save();
        return $model->loadRelations();
    }

    // remove record from the database
    public function delete($model)
    {
        return $model->delete();
    }
}
