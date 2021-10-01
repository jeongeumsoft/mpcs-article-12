<?php

namespace Exit11\Article\Repositories;

use Exception;
use Mpcs\Core\Facades\Core;
use Exit11\Article\Facades\Article;
use Exit11\Article\Models\Article as Model;
use Illuminate\Support\Facades\DB;
use Mpcs\Core\Traits\RepositoryTrait;
use Illuminate\Support\Str;

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
            'attribute_name' => trans('mpcs-article::word.attributes.article')
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

            $this->model->title = $this->request['title'];
            $this->model->summary = $this->request['summary'];
            $this->model->content = $this->request['content'] ?? '';
            $this->model->released_at = $this->request['released_at'];

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['thumbnail'] ?? null;
            if ($requestImage) {
                if (!empty($requestImage)) {
                    if (substr($requestImage, 0, 10) === "data:image") {
                        $base64ToFile = Article::base64ToFile($requestImage, $this->model->upload_disk, $this->model->image_root_dir);
                        if ($base64ToFile) {
                            $this->model->thumbnail = $base64ToFile;
                        }
                    } else {
                        $this->model->thumbnail = $requestImage;
                    }
                    Article::generateThumb($this->model->image_root_dir, $this->model->thumbnail);
                }
            }

            if ($this->model->save()) {
                $this->model->articleCategories()->attach($this->request['categories'] ?? null);
                $this->model->retag($this->request['tags'] ?? []);

                /* 폼데이터 업로드 방식 : 메서드 post */
                $articleFiles = $this->request['article_files'] ?? null;

                foreach ((array) $articleFiles as $file) {
                    if (is_file($file)) {
                        $filename = round(microtime(true) * 1000) . "_" . Str::random(10) . "." . $file->clientExtension();

                        $modelFile = $this->model->articleFiles()->create([
                            'caption' => $file->getClientOriginalName(),
                            'name' => $filename,
                            'size' => $file->getSize(),
                            'mime' => $file->getClientMimeType(),
                        ]);
                        $modelFile->upload_disk->putFileAs($modelFile->dir_path, $file, $filename, 'public');
                    }
                }
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
            $model->summary = $this->request['summary'];
            $model->content = $this->request['content'] ?? '';
            $model->released_at = $this->request['released_at'];

            /* 이미지 Base64 방식 저장 */
            $requestImage = $this->request['thumbnail'] ?? $model->thumbnail;
            if ($requestImage) {
                if (substr($requestImage, 0, 10) === "data:image") {
                    $base64ToFile = Article::base64ToFile($requestImage, $model->upload_disk, $model->image_root_dir);
                    if ($base64ToFile) {
                        $model->thumbnail = $base64ToFile;
                    }
                } else {
                    $model->thumbnail = $requestImage;
                }
                Article::generateThumb($model->image_root_dir, $model->thumbnail);
            }

            if ($model->save()) {
                $model->articleCategories()->sync($this->request['categories'] ?? null);
                $model->retag($this->request['tags'] ?? []);

                /* 폼데이터 업로드 방식 : 메서드 post */
                $articleFiles = $this->request['article_files'] ?? null;

                foreach ((array) $articleFiles as $file) {
                    if (is_file($file)) {
                        $filename = round(microtime(true) * 1000) . "_" . Str::random(10) . "." . $file->clientExtension();

                        $modelFile = $model->articleFiles()->create([
                            'caption' => $file->getClientOriginalName(),
                            'name' => $filename,
                            'size' => $file->getSize(),
                            'mime' => $file->getClientMimeType(),
                        ]);

                        $modelFile->upload_disk->putFileAs($modelFile->dir_path, $file, $filename, 'public');
                    }
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
        return $model->loadRelations();
    }

    // remove record from the database
    public function delete($model)
    {
        return $model->delete();
    }
}
