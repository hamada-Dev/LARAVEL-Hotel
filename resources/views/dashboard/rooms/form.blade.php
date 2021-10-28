{{ csrf_field() }}


<div class="row">
    @foreach (config('translatable.locales') as $index => $locale)
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.' . $locale . '.name')</label>
            <input type="text" class="form-control @error($locale . ' .name') is-invalid
        @enderror " name=" {{ $locale }}[name]"
                value="{{ isset($row) ? $row->translate($locale)->name : old($locale . '.name') }}">

            @error($locale . '.name')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    @endforeach
</div>


<div class="row">
    @foreach (config('translatable.locales') as $locale)
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.' . $locale . '.description')</label>
            <textarea class="form-control  @error($locale . ' .description') is-invalid  @enderror "
                name=" {{ $locale }}[description]" cols="30"
                rows="10">{{ isset($row) ? $row->translate($locale)->description : old($locale . '.description') }}</textarea>
            @error($locale .'.description')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    @endforeach
</div>


<div class="row">

    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.type')</label>
            <select class="form-control" name="type_id">
                <option value="">@lang('site.type')</option>
                @foreach(App\Models\Type::get() as $type)
                <option value="{{$type->id}}" {{ (isset($row) && $row->type_id == $type->id ) ? 'selected' : '' }}>
                    {{$type->name}}
                </option>
                @endforeach
            </select>
        
        </div>
    </div> 
    
    
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.branch')</label>
            <select class="form-control" name="branch_id">
                <option value="">@lang('site.branch')</option>
                @foreach(App\Models\Branch::get() as $branch)
                <option value="{{$branch->id}}" {{ (isset($row) && $row->branch_id == $branch->id ) ? 'selected' : '' }}>
                    {{$branch->name}}
                </option>
                @endforeach
            </select>
        
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="">
            <label>@lang('site.image')</label>
            <input type="file" name="image" class="form-control image @error('image') is-invalid @enderror">
            @error('image')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    <div class="form-group col-md-3">
        <img src="{{ isset($row) ? $row->image_path : asset('uploads/type_images/default.png') }}" style="width: 115px;height: 80px;position: relative;
                    top: 14px;" class="img-thumbnail image-preview">
    </div>
</div>