<?php

namespace Exit11\Article\Services;

use Mpcs\Core\Facades\Core;
use Exit11\Article\Repositories\CategoryRepositoryInterface as RepositoryInterface;
use Mpcs\Core\Traits\ServiceTrait;

class CategoryService
{
    use ServiceTrait;

    protected $configs = [
        // resourceAbilityMap policy 추가 : 기본 crud 이외 액션 추가
        'resource_ability_map' => [
            'list' => 'viewAny',
        ],
        // resourceMethodsWithoutModels 모델을 사용하지 않는 policy method 추가
        'resource_methods_without_models' => [
            'list'
        ],
    ];

    public function __construct(RepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        return $this->repository->all();
    }

    /**
     * edit
     *
     * @param  mixed $model
     * @return void
     */
    public function edit($model)
    {
        return $this->repository->get($model);
    }

    /**
     * edit
     *
     * @param  mixed $model
     * @return void
     */
    public function show($model)
    {
        return $this->repository->get($model);
    }

    /**
     * store
     *
     * @return void
     */
    public function store()
    {
        $model = $this->repository->create();

        if ($model) {
            return $model;
        }

        Core::crudAbort();
    }

    /**
     * update
     *
     * @param  mixed $model
     * @return void
     */
    public function update($model)
    {
        if (request()->has('list_checked_visible')) {
            $model = $this->repository->updateVisible($model);
        } else {
            $model = $this->repository->update($model);
        }

        if ($model) {
            return $model;
        }

        Core::crudAbort();
    }

    /**
     * destroy
     *
     * @return void
     */
    public function destroy($model)
    {
        $id = $model->id;
        if ($this->repository->delete($model)) {
            return [
                'id' => $id,
            ];
        }
        Core::crudAbort();
    }
}
