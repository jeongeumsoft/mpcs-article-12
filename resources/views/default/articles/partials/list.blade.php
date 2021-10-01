<table class="table table-borderless table-hover align-middle mb-0 w-100">
    <thead class="thead-light">
        <tr class="d-none d-md-table-row border-bottom">
            <th class="text-center min-width-rem-4 d-none d-md-table-cell">
                @sortablelink('id', 'ID')
            </th>
            <th class="text-center min-width-rem-4">
                {{trans('mpcs-article::word.attr.status')}}
            </th>
            <th class="text-center">
                @sortablelink('title', trans('mpcs-article::word.attr.title'))
            </th>
            <th class="text-center min-width-rem-6 d-none d-md-table-cell">
                @sortablelink('view_count', trans('mpcs-article::word.attr.view_count'))
            </th>
            <th class="text-center min-width-rem-10">
                @sortablelink('released_at', trans('mpcs-article::word.attr.released_at'))
            </th>
            <th class="text-center min-width-rem-6">
                {{ trans('ui-bootstrap5::word.actions') }}
            </th>
        </tr>
    </thead>
    <tbody class="crud-list">
        @forelse($datas as $data)
            <tr data-crud-id="{{ $data->id }}" class="border-bottom d-block d-md-table-row">
                <td data-name='id' class="text-md-center d-none d-md-table-cell">
                    {{ $data->id }}
                </td>
                <td data-name='status_released' class="text-left d-block d-md-table-cell">
                    <span class="badge bg-{{$data->status_released ? "success" : "warning"}}">
                        {{ $data->status_released ? trans("mpcs-article::word.attr.released") : trans("mpcs-article::word.attr.nonrelease") }}
                    </span>
                </td>
                <td class="text-left d-block d-md-table-cell">
                    <div class="row no-gutters">
                        @if($data->thumbnail)
                            <div class="col-auto mr-2">
                                <div class="embed-responsive embed-responsive-1by1" style="width: 80px; ">
                                    <img class="embed-responsive-item img-thumbnail" src="{{ $data->thumb_image_url }}" alt="{{ $data->title }}">
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            <p data-name='categories' class="mb-0">
                                @if(isset($data->categories))
                                    @forelse($data->categories as $category)
                                    <span class="badge bg-info">
                                        {{ $category->name }}
                                    </span>
                                    @empty
                                    @endforelse
                                @endif
                            </p>
                            <p data-name='title' class="mt-2 mb-2">
                                <span class="badge badge-pill bg-dark mr-1 d-md-none">{{ $data->id }}</span>
                                <span> {{ $data->title }} </span> <small class="d-md-none">({{ $data->view_count }})</small>
                                @if($data->summary)
                                <button type="button" class="btn p-0" data-bs-container="body" data-bs-toggle="popover" data-bs-placement="top" title="{{$data->title}}" data-bs-content="{{$data->summary}}">
                                    <i class="mdi mdi-information"></i>
                                </button>
                                @endif
                            </p>
                        </div>
                    </div>
                </td>
                <td data-name='view_count' class="d-none d-md-table-cell text-center">
                    {{ $data->view_count }}
                </td>
                <td data-name='released_at' class="d-none d-md-table-cell">
                    {{ $data->released_at }}
                </td>
                <td class="d-block d-md-table-cell text-right text-md-center">
                    <button class="btn-crud-show btn btn-icon btn-success text-white align-middle"
                        title="{{ trans('core::word.show') }}">
                        <i class="mdi mdi-eye"></i>
                    </button>
                    <button class="btn-crud-delete btn btn-icon btn-danger text-white align-middle"
                        title="{{ trans('core::word.delete') }}">
                        <i class="mdi mdi-trash-can"></i>
                    </button>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" class="text-center">{{ trans('ui-bootstrap5::word.crud.none_data') }}</td>
            </tr>
        @endforelse
    </tbody>
</table>

@isset($datas)
    <div class="mt-3 d-flex justify-content-center">
        {{ $datas->render(Bootstrap5::theme('partials.paginator')) }}
    </div>
@endisset
