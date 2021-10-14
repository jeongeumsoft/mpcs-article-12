<?php

namespace Exit11\Article;

use Illuminate\Support\Facades\Storage;
use MpcsUi\Bootstrap5\Facades\Bootstrap5;

class Article
{

    /**
     * menuTitle
     *
     * @param  mixed $title
     * @return void
     */
    public static function menuTitle($title = null)
    {
        return $title ? trans($title) : trans('mpcs-article::menu.articles');
    }

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
     * useThumbnail
     *
     * @return int
     */
    public static function useThumbnail()
    {
        return config('mpcsarticle.use_thumbnail') ?? false;
    }

    /**
     * useTag
     *
     * @return int
     */
    public static function useTag()
    {
        return config('mpcsarticle.use_tag') ?? false;
    }



    /**
     * noImage
     *
     * @return void
     */
    public static function noImage()
    {
        return Bootstrap5::noImage();
    }
}
