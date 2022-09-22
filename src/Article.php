<?php

namespace Mpcs\Article;

use Illuminate\Support\Facades\Storage;
use Mpcs\Bootstrap5\Facades\Bootstrap5;

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
     * perPage
     *
     * @param  mixed $configString
     * @param  mixed $default
     * @return void
     */
    public static function getPerPage()
    {
        return config('mpcsarticle.per_page') ?? 15;
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
