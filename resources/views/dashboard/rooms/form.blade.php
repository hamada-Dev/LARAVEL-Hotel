{{ csrf_field() }}


<div class="row">

    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.type')</label>
            <select class="form-control @error('type_id') is-invalid @enderror" name="type_id">
                <option value="">@lang('site.type')</option>
                @foreach(App\Models\Type::get() as $type)
                <option value="{{$type->id}}" {{ (isset($row) && $row->type_id == $type->id ) ? 'selected' : '' }}>
                    {{$type->name}}
                </option>
                @endforeach
            </select>
            @error('type_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>


    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.branch')</label>
            <select class="form-control  @error('branch_id') is-invalid @enderror" name="branch_id">
                <option value="">@lang('site.branch')</option>
                @foreach(App\Models\Branch::get() as $branch)
                <option value="{{$branch->id}}" {{ (isset($row) && $row->branch_id == $branch->id ) ? 'selected' : ''
                    }}>
                    {{$branch->name}}
                </option>
                @endforeach
            </select>
            @error('branch_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>



@php
    $roomColumns = ['area', 'person_number', 'room_price', 'person_price', 'room_number'];
@endphp

<div class="row">
    @foreach ($roomColumns as $column)
    <div class="col-md-6">
        <div class="form-group">
            <label>@lang('site.'.$column)</label>
            <input type="number" min="1" step="0.1" class="form-control @error($column) is-invalid @enderror" name="{{ $column }}"
                value="{{ isset($row) ? $row->$column : old($column) }}">

            @error($column)
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    @endforeach
</div>



<div class="row">

    <div class="form-group form-inline">
        @foreach (App\Models\Feature::get() as $index => $feature)
        <div class="col-md-2">
            <label for="{{$feature->id}}">{{ $feature->name }}</label>
            <input id="{{$feature->id}}" type="checkbox" class="form-group  " name="feature_id[]" {{ isset($row) &&
                (in_array($feature->id, $row->feature_id_relation)) ? 'checked' : '' }} value="{{ $feature->id }}">
        </div>
        @endforeach
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