<table class="table table-borderless table-hover align-middle mb-0 w-100">
    <thead class="thead-light">
        <tr class="d-none d-md-table-row border-bottom">
            <th class="text-center min-width-rem-4 d-none d-md-table-cell">
                @sortablelink('id', 'ID')
            </th>
            <th class="text-center min-width-rem-4">
                {{ trans('mpcs-article::word.attr.status') }}
            </th>
            <th class="text-center">
                @sortablelink('title', trans('mpcs-article::word.attr.title'))
            </th>
            <th class="text-center min-width-rem-6 d-none d-md-table-cell">
                {{ trans('mpcs-article::word.attr.writer') }}
            </th>
            <th class="text-center min-width-rem-8 d-none d-md-table-cell">
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
                <td data-name='status_released' class="text-start d-block d-md-table-cell">
                    <span class="badge bg-{{ $data->status_released ? 'success' : 'warning' }}">
                        {{ $data->status_released ? trans('mpcs-article::word.attr.released') : trans('mpcs-article::word.attr.nonrelease') }}
                    </span>
                </td>
                <td class="text-start d-block d-md-table-cell">
                    <div class="row no-gutters">
                        @if (Article::useThumbnail() && $data->thumbnail)
                            <div class="col-auto mr-2">
                                <div class="ratio ratio-1x1" style="width: 50px; ">
                                    <img class="img-thumbnail" src="{{ $data->thumb_image_url }}"
                                        alt="{{ $data->title }}">
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            @if (isset($data->articleCategories))
                                <p data-name='categories' class="mb-1">
                                    @forelse($data->articleCategories as $category)
                                        <span class="badge bg-info">
                                            {{ $category->nested_str }}
                                        </span>
                                    @empty
                                    @endforelse
                                </p>
                            @endif
                            <p data-name='title' class="mb-0">
                                <span class="badge badge-pill bg-dark mr-1 d-md-none">{{ $data->id }}</span>
                                <span> {{ $data->title }} </span> <small
                                    class="d-md-none">({{ $data->view_count }})</small>
                                @if ($data->summary)
                                    <button type="button" class="btn p-0" data-bs-container="body"
                                        data-bs-toggle="popover" data-bs-placement="top" title="{{ $data->title }}"
                                        data-bs-content="{{ $data->summary }}">
                                        <i class="mdi mdi-information"></i>
                                    </button>
                                @endif
                            </p>
                            @if (Article::useTag() && isset($data->tags))
                                <p data-name='tags' class="mt-1 mb-0">
                                    @forelse($data->tags as $tag)
                                        <span class="badge rounded-pill border border-light text-dark">
                                            #{{ $tag->name }}
                                        </span>
                                    @empty
                                    @endforelse
                                </p>
                            @endif
                        </div>
                    </div>
                </td>
                <td data-name='user.name' class="d-none d-md-table-cell text-center">
                    {{ $data->user->name }}
                </td>
                <td data-name='view_count' class="d-none d-md-table-cell text-center">
                    {{ number_format($data->view_count) }}
                </td>
                <td data-name='released_at' class="d-none d-md-table-cell">
                    {{ $data->released_at }}
                </td>
                <td class="d-block d-md-table-cell text-end text-md-center">
                    @can('view', $data)
                        <button class="btn-crud-show btn btn-icon btn-success text-white align-middle"
                            title="{{ trans('ui-bootstrap5::word.button.show') }}">
                            <i class="mdi mdi-eye"></i>
                        </button>
                    @endcan
                    @can('delete', $data)
                        <button class="btn-crud-delete btn btn-icon btn-danger text-white align-middle"
                            title="{{ trans('ui-bootstrap5::word.button.delete') }}">
                            <i class="mdi mdi-trash-can"></i>
                        </button>
                    @endcan
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
