<li data-crud-id="{{ $branch->id }}" data-parent-id="{{ $branch->parent_id }}" class="mb-1">
    <div class="d-flex justify-content-between align-items-center p-1 border rounded">
        @php
            // 자식 중 공개 체크된 것만...
            $isVisibleBranch = $branch->allChildren->where('is_visible', true);
        @endphp
        @if($isVisibleBranch->count() > 0)
            <div class="col-auto pe-2">
                <button class="btn btn-light py-0 px-1 align-middle" data-bs-toggle="collapse" href="#branch_{{ $branch->id }}" aria-expanded="false" title="펼침/접힘">
                    <i class="mdi mdi-arrow-collapse-vertical"></i>
                </button>
            </div>
        @endif
        <div class="col">
            <span data-name="name" class="setting-name breadcrumb-wrap">{{ $branch->name }}</span>
            <small class="text-muted">({{$branch->articles->count()}})</small>
        </div>
        <div class="col-auto">
            <button class="btn-nest-open btn btn-info text-white py-0 px-1 btn-product-child-open">
                <i class="mdi mdi-format-list-bulleted"></i>
            </button>
        </div>
    </div>
    @if($isVisibleBranch->count() > 0)
    <ul class="pt-1 collapse" style="list-style: none" id="branch_{{ $branch->id }}">
        @foreach($isVisibleBranch as $branch)
            @include(Article::theme('articles.partials.branch_categories'), $branch)
        @endforeach
    </ul>
    @endif
</li>