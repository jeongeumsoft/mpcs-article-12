<?php

namespace Exit11\Article\Repositories;

interface ArticleRepositoryInterface
{
    public function select($enableRequestParam, $isApiSelect);

    public function all();

    public function create();

    public function update($model);

    public function updateVisible($model);

    public function delete($model);

    public function get($model);
}
