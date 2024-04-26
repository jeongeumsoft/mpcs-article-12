<div class="row">
    @if (Article::useThumbnail())
        <div class="col-12 col-sm-auto text-center mb-3 mb-sm-0">
            <img alt="" data-crud-show-name="small_image_url" class="img-fluid" style="max-height: 270px">
        </div>
    @endif
    <div class="col-12 col-sm">
        <dl class="dl">
            <dt class="col-4 col-lg-2">ID</dt>
            <dd class="col-8 col-lg-4" data-crud-show-name="id"></dd>
            <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.view_count')) }}</dt>
            <dd class="col-8 col-lg-4" data-crud-show-name="view_count"></dd>

            <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.categories')) }}</dt>
            <dd class="col-8 col-lg-10" data-crud-show-template-id="script-template-article_categories"
                data-crud-show-type="template-html" data-crud-show-name="article_categories"></dd>

            @if (Article::useTag())
                <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.tags')) }}</dt>
                <dd class="col-8 col-lg-10" data-crud-show-template-id="script-template-tags"
                    data-crud-show-type="template-html" data-crud-show-name="tags"></dd>
            @endif

            {{-- <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.slug')) }}</dt>
            <dd class="col-8 col-lg-10" data-crud-show-name="slug"></dd> --}}

            <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.released_at')) }}</dt>
            <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime"
                data-crud-show-name="released_at"></dd>
            <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.updated_at')) }}</dt>
            <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime"
                data-crud-show-name="updated_at"></dd>
            <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.created_at')) }}</dt>
            <dd class="col-8 col-lg-4" data-style="date" data-crud-show-type="datetime"
                data-crud-show-name="created_at"></dd>
            <dt class="col-4 col-lg-2">{{ Str::title(trans('mpcs-article::word.attr.writer')) }}</dt>
            <dd class="col-8 col-lg-4" data-crud-show-name="user[name]"></dd>

            <dt class="col-4 col-lg-2">{{ trans('mpcs-article::word.attr.title') }}</dt>
            <dd class="col-8 col-lg-10" data-crud-show-name="title"></dd>
            <dt class="col-4 col-lg-2">{{ trans('mpcs-article::word.attr.summary') }}</dt>
            <dd class="col-8 col-lg-10" data-crud-show-name="summary"></dd>
            <dt class="col-12 col-lg-2">{{ trans('mpcs-article::word.attr.article_files') }}</dt>
            <dd class="col-12 col-lg-10">
                <ul class="list-group" data-crud-show-template-id="script-template-article_files"
                    data-crud-show-type="template-html" data-crud-show-name="article_files">
                </ul>
            </dd>
        </dl>
    </div>
</div>

<dl class="dl">
    <dt class="col-12">{{ trans('mpcs-article::word.attr.content') }}</dt>
    <dd class="col-12 mpcs-content-body p-4" data-crud-show-name="html"></dd>
</dl>

{{-- CURD 스크립트 --}}
@push('after_app_scripts')
    <script></script>
@endpush
