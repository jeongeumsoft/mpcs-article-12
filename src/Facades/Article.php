<?php

namespace Mpcs\Article\Facades;

use Illuminate\Support\Facades\Facade;

class Article extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Mpcs\Article\Article::class;
    }
}
