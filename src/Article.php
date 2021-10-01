<?php

namespace Exit11\Article;

use Illuminate\Support\Facades\Storage;

class Article
{

    /**
     * VIEW THEME 설정
     * @return string {default: 'default'}
     */
    public static function theme($view, $template = null)
    {
        $viewTemplate = empty($template) ? 'default' : $template;
        return 'mpcs-article::' . $viewTemplate . '.' . $view;
    }

    /**
     * getCategoryMaxDepth
     *
     * @return int
     */
    public static function getCategoryMaxDepth()
    {
        return config('mpcsarticle.category_max_depth');
    }


    /**
     * noImage
     *
     * @return void
     */
    public static function noImage()
    {
        return Storage::disk('upload')->url('noimage.jpg');
    }
}
