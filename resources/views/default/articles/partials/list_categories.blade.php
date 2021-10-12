<div class="aside-category panel-wrap mb-2">
        <div class="panel-heading d-flex align-items-start justify-content-between">
            <h4 class="h4">
                카테고리
            </h4>
            <button class="btn btn-search-expend" type="button" data-bs-toggle="collapse" data-bs-target="#articleCategoriesWrap">
              <i class="mdi mdi-chevron-up"></i>
            </button>
        </div>
        <div id="articleCategoriesWrap" class="panel-body p-1 collapse show">
                <ul class="p-0 mb-0" style="list-style: none">
                        @each(Article::theme('articles.partials.branch_categories'), $datas, 'branch')
                </ul>
        </div>
</div>

