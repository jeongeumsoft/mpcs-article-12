<?php

return [

    // 공개된 API 사용 여부
    'enable_open_api' => false,

    'category_max_depth' => env('ARTICLE_CATEGORY_MAX_DEPTH', 4),

    // 썸네일 사용여부
    'use_thumbnail' =>  env('ARTICLE_USE_THUMBNAIL', false),
    'thumbnail' => [
        'width' => 512,
        'height' => 512,
    ],

    // 태그 사용여부
    'use_tag' =>  env('ARTICLE_USE_TAG', false),

    // 관리자 콘솔 페이지 갯수
    'per_page' => 15,
];
