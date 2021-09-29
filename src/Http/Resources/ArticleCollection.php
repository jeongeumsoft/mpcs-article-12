<?php

namespace Exit11\Article\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;
use Mpcs\Core\Models;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ResourceCollectionTrait;

class ArticleCollection extends ResourceCollection
{
    use ResourceCollectionTrait;
}
