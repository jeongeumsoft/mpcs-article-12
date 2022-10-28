{{-- Show : 카테고리명 --}}
<script type="text/template" id="script-template-article_categories">
    @{{#each this}}
    <span class="badge bg-info">
        @{{nested_str}}
    </span> 
    @{{/each}}
</script>

{{-- Show : 태그 --}}
<script type="text/template" id="script-template-tags">
    @{{#each this}}
    <span class="badge rounded-pill border border-dark text-dark">
        #@{{ name }}
    </span> 
    @{{/each}}
</script>

{{-- Show : Uploader --}}
<script type="text/template" id="script-template-article_files">
    @{{#each this}}
    <li class="list-group-item d-flex justify-content-between align-items-center">
        @{{#if is_image_type}}
        <div class="col-auto mr-2">
            <button type="button" class="btn p-0 me-1" data-bs-toggle="popover" data-bs-html="true"
                data-bs-content='<img class="img-fluid"
                src="@{{small_image_url}}" alt="@{{title}}">'>
                <img class="img-thumbnail" style="width: 40px; height: 40px;"
                    src="@{{thumb_image_url}}" alt="@{{title}}">
            </button>
        </div>
        @{{/if}}
        <div class="col">
            @{{original_name}} <span class="badge bg-body text-dark">@{{size}}</span> 
        </div>
        <div class="col-auto">
            <a class="btn btn-sm btn-icon btn-danger" href="@{{file_url}}" target="_blank">
                <i class="mdi mdi-eye"></i>
            </a>
            <a class="btn btn-sm btn-icon btn-primary" href="@{{download_url}}" download="@{{original_name}}">
                <i class="mdi mdi-download"></i>
            </a>
        </div>
    </li>
    @{{/each}}
</script>

{{-- Edit : Uploader --}}
<script type="text/template" id="script-template-edit-article_files">
    @{{#each this}}
    <li data-template-wrap="item" class="list-group-item d-flex justify-content-between align-items-center mb-1">
        <div class="col">
            @{{caption}} <span class="badge bg-body text-dark">@{{size}}</span> 
        </div>
        <div class="col-auto">
            <a class="btn btn-sm btn-icon btn-primary" href="@{{download_url}}" download="@{{caption}}">
                <i class="mdi mdi-download"></i>
            </a>
            <button data-template-btn="delete" data-template-target="item" data-template-field-name="delete_article_files[]" data-template-value="@{{id}}" type="button" class="btn btn-sm btn-icon btn-danger">
                <i class="mdi mdi-trash-can"></i>
            </button>
        </div>
    </li>
    @{{/each}}
</script>
