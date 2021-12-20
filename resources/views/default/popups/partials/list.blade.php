<table class="table table-borderless table-hover align-middle mb-0 w-100">
    <thead class="thead-light">
        <tr class="d-none d-md-table-row border-bottom">
            <th class="text-center min-width-rem-5 d-none d-md-table-cell">
                @sortablelink('order', trans('mpcs-article::word.attr.order'))
            </th>
            <th class="text-center min-width-rem-3 d-none d-md-table-cell">
                {{ trans('ui-bootstrap5::word.is_visible') }}
            </th>
            <th class="text-center min-width-rem-4 d-none d-md-table-cell">
                ID
            </th>
            <th class="text-center min-width-rem-4">
                {{ trans('mpcs-article::word.attr.type') }}
            </th>
            <th class="text-center">
                {{ trans('mpcs-article::word.attr.title') }}
            </th>
            <th class="text-center min-width-rem-10">
                {{ trans('mpcs-article::word.attr.period_from') }}
            </th>
            <th class="text-center min-width-rem-10">
                {{ trans('mpcs-article::word.attr.period_to') }}
            </th>
            <th class="text-center min-width-rem-3">
                {{ trans('mpcs-article::word.attr.status') }}
            </th>
            <th class="text-center min-width-rem-6">
                {{ trans('ui-bootstrap5::word.actions') }}
            </th>
        </tr>
    </thead>
    <tbody class="crud-list">
        @forelse($datas as $data)
            <tr data-crud-id="{{ $data->id }}" class="border-bottom d-block d-md-table-row">
                <td data-name='order' class="float-left float-md-none d-block d-md-table-cell">
                    <div class="btn-group">
                        <button type="button" class="btn btn-sm btn-outline-primary disabled">
                            {{ $data->order }}
                        </button>
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle dropdown-toggle-split"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="visually-hidden">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu text-center">
                            <button class="btn-crud-orderable btn btn-sm" data-action="first" data-bs-toggle="tooltip"
                                data-placement="top" title="{{ trans('campsite.attr.move_to_first') }}">
                                <i class="mdi mdi-chevron-double-up"></i>
                            </button>
                            <button class="btn-crud-orderable btn btn-sm" data-action="up" data-bs-toggle="tooltip"
                                data-placement="top" title="{{ trans('campsite.attr.move_to_up') }}">
                                <i class="mdi mdi-chevron-up"></i>
                            </button>
                            <button class="btn-crud-orderable btn btn-sm" data-action="down" data-bs-toggle="tooltip"
                                data-placement="top" title="{{ trans('campsite.attr.move_to_down') }}">
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <button class="btn-crud-orderable btn btn-sm" data-action="last" data-bs-toggle="tooltip"
                                data-placement="top" title="{{ trans('campsite.attr.move_to_last') }}">
                                <i class="mdi mdi-chevron-double-down"></i>
                            </button>
                        </div>
                    </div>
                </td>
                <td class="text-right text-md-center d-block d-md-table-cell" data-name='is_visible'>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="list_checked_visible"
                            {{ $data->is_visible ? 'checked' : '' }}>
                        <label class="form-check-label"></label>
                    </div>
                </td>
                <td data-name='id' class="text-md-center d-none d-md-table-cell">
                    {{ $data->id }}
                </td>
                <td data-name='type' class="text-md-center d-none d-md-table-cell">
                    <span class="badge bg-{{ $data->type == 'TEXT' ? 'success' : 'warning' }}">
                        {{ $data->type }}
                    </span>
                </td>
                <td class="text-start d-block d-md-table-cell">
                    <div class="row no-gutters align-items-center">
                        @if ($data->image)
                            <div class="col-auto mr-2">
                                <div class="ratio ratio-1x1" style="width: 40px; ">
                                    <img class="embed-responsive-item img-thumbnail"
                                        src="{{ $data->image_file_url }}" alt="{{ $data->title }}">
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            <p data-name='title' class="mb-0">
                                <span class="badge badge-pill bg-dark mr-1 d-md-none">{{ $data->id }}</span>
                                <span> {{ $data->title }} </span>
                            </p>
                        </div>
                    </div>
                </td>
                <td data-name='period_from' class="d-none d-md-table-cell">
                    {{ $data->period_from }}
                </td>
                <td data-name='period_to' class="d-none d-md-table-cell">
                    {{ $data->period_to }}
                </td>
                <td data-name='status_released' class="text-start text-md-center d-block d-md-table-cell">
                    <span class="badge bg-{{ $data->status_released ? 'success' : 'warning' }}">
                        {{ $data->status_released ? trans('mpcs-article::word.attr.released') : trans('mpcs-article::word.attr.nonrelease') }}
                    </span>
                </td>
                <td class="d-block d-md-table-cell text-end text-md-center">
                    <button class="btn-crud-show btn btn-icon btn-success text-white align-middle"
                        title="{{ trans('ui-bootstrap5::word.button.show') }}">
                        <i class="mdi mdi-eye"></i>
                    </button>
                    <button class="btn-crud-delete btn btn-icon btn-danger text-white align-middle"
                        title="{{ trans('ui-bootstrap5::word.button.delete') }}">
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
