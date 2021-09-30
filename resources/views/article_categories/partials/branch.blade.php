<li data-crud-id="{{ $branch->id }}" data-parent-id="{{ $branch->parent_id }}" class="mb-1">
    <div class="d-flex justify-content-between align-items-center">
        @if($branch->allChildren->count() > 0)
            <div class="col-auto">
                <button class="btn btn-sm btn-icon p-0" data-bs-toggle="collapse" href="#branch_{{ $branch->id }}" aria-expanded="false" title="펼침/접힘">
                    <i class="mdi mdi-arrow-collapse-vertical"></i>
                </button>
            </div>
        @else
            <div class="col-auto" style="padding-left: 28px;"></div>
        @endif
        {{-- <div class="col-auto">
            <button type="button" class="btn btn-sm btn-icon p-0 handle">
                <i class="mdi mdi-drag-vertical"></i>
            </button>
        </div> --}}
        <div class="d-flex justify-content-between align-items-center col p-1 border rounded">
            <div class="col-auto">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" name="list_checked_visible" {{ $branch->is_visible ? 'checked' : '' }}>
                    <label class="form-check-label"></label>
                </div>
            </div>
            <div class="col">
                <div class="d-inline-block breadcrumb-wrap">
                    <span data-name="id" class="setting-id badge bg-dark mr-2">{{ $branch->id }}</span>
                    <span data-name="name" class="setting-name">{{ $branch->name }}</span>
                </div>
                @if($branch->allChildren->count() > 0)
                    <small class="text-muted">
                        ({{$branch->allChildren->count()}})
                    </small>
                @endif
                @if($branch->description)
                <button type="button" class="btn p-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title="{{$branch->name}}" data-bs-content="{{$branch->description}}">
                    <i class="mdi mdi-information"></i>
                </button>
                @endif
            </div>
            <div class="col-auto">
                <button class="btn-crud-edit btn btn-success text-white py-0 px-1 align-middle" title="편집">
                    <i class="mdi mdi-pencil"></i>
                </button>
                <button class="btn-child-create btn btn-primary text-white py-0 px-1 align-middle" title="하위 생성">
                    <i class="mdi mdi-timeline-plus"></i>
                </button>
            </div>
        </div>
    </div>
    @if($branch->allChildren->count() > 0)
    <ul class="pt-1 collapse nested-sortable" style="list-style: none" id="branch_{{ $branch->id }}">
        @foreach($branch->allChildren as $branch)
            @include('mpcs-article::article_categories.partials.branch', $branch)
        @endforeach
    </ul>
    @endif
</li>