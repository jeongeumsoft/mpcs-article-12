<li data-crud-id="{{ $branch->id }}" data-parent-id="{{ $branch->parent_id }}" class="mb-1">
    <div
        class="list-group-item d-flex justify-content-between align-items-center p-1 border rounded {{ $branch->id == $currentCategory->id ? 'active' : '' }}">
        @php
            // 자식 중 공개 체크된 것만...
            $isVisibleBranch = $branch->allChildren->where('is_visible', true);
        @endphp
        @if ($isVisibleBranch->count() > 0)
            <div class="col-auto">
                <button class="btn btn-light py-0 px-1 align-middle" data-bs-toggle="collapse"
                    href="#branch_{{ $branch->id }}" aria-expanded="false" title="펼침/접힘">
                    <i class="mdi mdi-arrow-collapse-vertical"></i>
                </button>
            </div>
        @endif
        <div class="col ps-2">
            <span data-name="name" class="setting-name breadcrumb-wrap">{{ $branch->name }}</span>
            <small class="text-muted">({{ $branch->articles->count() }})</small>
        </div>
        <div class="col-auto">
            <button type="button" data-list-param="article_category_id" data-list-title="{{ $branch->name }}"
                data-list-value="{{ $branch->id }}" class="btn btn-info text-white py-0 px-1">
                <i class="mdi mdi-format-list-bulleted"></i>
            </button>
        </div>
    </div>
    @if ($isVisibleBranch->count() > 0)
        <ul class="pt-1 collapse" style="list-style: none" id="branch_{{ $branch->id }}">
            @forelse ($isVisibleBranch as $branch)
                @include(Article::theme('articles.partials.branch_categories'), [
                    'branch' => $branch,
                    'currentCategoryId' => $currentCategory->id,
                ])
            @empty
            @endforelse
        </ul>
    @endif
</li>
