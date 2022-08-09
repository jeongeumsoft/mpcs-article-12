<?php

namespace Mpcs\Article\Repositories;

interface ArticleFileRepositoryInterface
{
    public function select($enableRequestParam, $isApiSelect);

    public function all();

    public function create();

    public function update($model);

    public function delete($model);

    public function get($model);
}
