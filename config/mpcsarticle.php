<?php

return [
    'category_max_depth' => env('ARTICLE_CATEGORY_MAX_DEPTH', 4),

    // 썸네일 사용여부
    'use_thumbnail' =>  env('ARTICLE_USE_THUMBNAIL', false),
    // 태그 사용여부
    'use_tag' =>  env('ARTICLE_USE_TAG', false),

    // 아티클 메뉴제목 : trans($value)
    'app_title' => null,
    'subtitle' => null,
    'list_title' => null,
];
