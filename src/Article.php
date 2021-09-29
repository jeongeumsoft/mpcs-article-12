<?php

namespace Exit11\Article;

class Article
{
    /**
     * getCategoryMaxDepth
     *
     * @return int
     */
    public static function getCategoryMaxDepth()
    {
        return config('mpcsarticle.category_max_depth');
    }
}
