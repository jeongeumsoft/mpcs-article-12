<div class="row">
    <div class="col-12 col-sm-auto text-center mb-3 mb-sm-0">
        <div class="ratio ratio-42x60 mx-auto mb-1" style="width: 420px;">
            <img alt="" data-crud-show-name="image_file_url">
        </div>
    </div>
    <div class="col-12 col-sm">
        <dl class="dl">
            <dt class="col-4">ID</dt>
            <dd class="col-8" data-crud-show-name="id"></dd>
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.type')) }}</dt>
            <dd class="col-8" data-crud-show-name="type"></dd>
        
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.title')) }}</dt>
            <dd class="col-8" data-crud-show-name="title"></dd>
        
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.period_from')) }}</dt>
            <dd class="col-8" data-style="date" data-crud-show-type="datetime" data-crud-show-name="period_from"></dd>
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.period_to')) }}</dt>
            <dd class="col-8" data-style="date" data-crud-show-type="datetime" data-crud-show-name="period_to"></dd>

            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.created_at')) }}</dt>
            <dd class="col-8" data-style="date" data-crud-show-type="datetime" data-crud-show-name="created_at"></dd>
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.updated_at')) }}</dt>
            <dd class="col-8" data-style="date" data-crud-show-type="datetime" data-crud-show-name="updated_at"></dd>
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.status')) }}</dt>
            <dd class="col-8" data-crud-show-name="status_released"></dd>
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.writer')) }}</dt>
            <dd class="col-8" data-crud-show-name="user[name]"></dd>
            <dt class="col-4">{{ Str::title(trans('mpcs-article::word.attr.content')) }}</dt>
            <dd class="col-8" data-crud-show-name="content"></dd>
        </dl>
    </div>
</div>

{{-- CURD 스크립트--}}
@push('after_app_scripts')
    <script>

    </script>
@endpush
