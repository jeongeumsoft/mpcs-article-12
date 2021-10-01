<li data-crud-id="{{ $branch->id }}" data-parent-id="{{ $branch->parent_id }}" class="mb-1">
    <div class="d-flex justify-content-between align-items-center p-1 border rounded">
        @if($branch->allChildren->count() > 0)
            <div class="col-auto pe-2">
                <button class="btn btn-light py-0 px-1 align-middle" data-bs-toggle="collapse" href="#branch_{{ $branch->id }}" aria-expanded="false" title="펼침/접힘">
                    <i class="mdi mdi-arrow-collapse-vertical"></i>
                </button>
            </div>
        @endif
        <div class="col">
            <span data-name="name" class="setting-name breadcrumb-wrap">{{ $branch->name }}</span>
        </div>
        <div class="col-auto">
            <button class="btn-nest-open btn btn-info text-white py-0 px-1 btn-product-child-open">
                <i class="mdi mdi-format-list-bulleted"></i>
            </button>
        </div>
    </div>
    @if($branch->allChildren->count() > 0)
    <ul class="pt-1 collapse" style="list-style: none" id="branch_{{ $branch->id }}">
        @foreach($branch->allChildren as $branch)
            @include('mpcs-article::article_categories.partials.branch_categories', $branch)
        @endforeach
    </ul>
    @endif
</li>