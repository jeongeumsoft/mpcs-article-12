<?php

namespace Exit11\Article\Facades;

use Illuminate\Support\Facades\Facade;

class Article extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Exit11\Article\Article::class;
    }
}
