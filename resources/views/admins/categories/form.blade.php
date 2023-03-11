<div class="card-body">
    <div class="row">
        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
            <div class="col-lg-6">
                <x-form.input type="text" class="form-control" attribute="required"
                    name="categories[{{$localeCode}}][name]" value="{{ isset($data) ? $data->translate($localeCode)->name : old('name') }}"
                    label="{{ trans('admin.name') }} ({{$properties['native']}})"/>
            </div>
        @endforeach

        <div class="col-lg-6">
            <x-form.select class="form-control select2" id=""
            :collection="$categories" select="{{ isset($data) ? $data->parent_id : old('parent_id') }}" value="id"
            name="parent_id" label="{{ trans('admin.Category') }}"/>
        </div>
    </div>
</div>