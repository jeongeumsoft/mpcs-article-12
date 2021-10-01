<dl class="dl m-1 blade-users-show">
    <dt class="col-4 col-lg-2">ID</dt>
    <dd class="col-8 col-lg-4" data-crud-show-name="id"></dd>
    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.view_count')) }}</dt>
    <dd class="col-8 col-lg-4" data-crud-show-name="view_count"></dd>

    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.categories')) }}</dt>
    <dd class="col-8 col-lg-10" data-crud-show-name="article_categories_str" data-crud-show-template=""></dd>
    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.tags')) }}</dt>
    <dd class="col-8 col-lg-10" data-crud-show-name="tags_str"></dd>

    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.slug')) }}</dt>
    <dd class="col-8 col-lg-10" data-crud-show-name="slug"></dd>

    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.released_at')) }}</dt>
    <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime" data-crud-show-name="released_at"></dd>
    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.updated_at')) }}</dt>
    <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime" data-crud-show-name="updated_at"></dd>
    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.created_at')) }}</dt>
    <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime" data-crud-show-name="created_at"></dd>
    <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.deleted_at')) }}</dt>
    <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime" data-crud-show-name="deleted_at"></dd>
</dl>

<dl class="dl m-1">
    <dd class="col-12 text-center" data-name="image"></dd>
    <dt class="col-4 col-lg-2">{{ trans('mpcs-article::word.attr.title') }}</dt>
    <dd class="col-8 col-lg-10" data-name="title"></dd>
    <dt class="col-4 col-lg-2">{{ trans('mpcs-article::word.attr.summary') }}</dt>
    <dd class="col-8 col-lg-10" data-name="summary"></dd>
    <dd class="col-12" data-name="content"></dd>
    <dt class="col-4 col-lg-2">{{ trans('mpcs-article::word.attr.article_files') }}</dt>
    <dd class="col-8 col-lg-10" data-name="article_files"></dd>
</dl>

{{-- CURD 스크립트--}}
@push('after_app_scripts')
    <script>

    </script>
@endpush
