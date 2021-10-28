{{ csrf_field() }}

<div class="row">
    @include('dashboard.partials._session_error')
</div>
<div class="row">

    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.room')</label>
            <select class="form-control  @error('room_id') is-invalid @enderror" name="room_id">
                <option value="">@lang('site.choose') @lang('site.room')</option>
                @foreach(App\Models\Room::get() as $room)
                <option data-person="{{ $room->person_number }}" value="{{$room->id}}" {{ ((isset($row) && $row->id == $room->id ) || (old('room_id') ==  $room->id)) ? 'selected' : '' }}>
                    {{$room->room_number}}
                </option>
                @endforeach
            </select>

            @error('room_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror

        </div>
    </div>


    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.client')</label>
            <select class="form-control  @error('user_id') is-invalid @enderror" name="user_id">
                <option value="">@lang('site.choose') @lang('site.client')</option>
                @foreach(App\User::client()->get() as $user)
                <option value="{{$user->id}}" {{ ((isset($row) && $row->user_id == $user->id ) || (old('user_id') == $user->id)) ? 'selected' : ''}}>
                    {{$user->name}}
                </option>
                @endforeach
            </select>
            @error('user_id')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror

        </div>
    </div>
</div>


<div class="row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.person_number')</label>
            <input type="number" class="form-control @error('person_number') is-invalid @enderror"  min="1" name="person_number"  value="{{ isset($row) ? $row->person_number : old('person_number') }}">
            @error('person_number')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
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

    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.paid')</label>
            <input type="number" class="form-control @error('paid') is-invalid @enderror"  min="1" name="paid"  value="{{ isset($row) ? $row->paid : old('paid') }}">
            @error('paid')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.start_at')</label>
            <input type="date" class="form-control @error('start_at') is-invalid @enderror"  name="start_at" min="{{ date('Y-m-d', time()) }}"  value="{{ isset($row) ? date('Y-m-d', strtotime($row->start_at)) : old('start_at') }}">
            @error('start_at')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
    
    <div class="form-group col-md-6">
        <div class="form-group">
            <label for="">@lang('site.end_at')</label>
            <input type="date" class="form-control @error('end_at') is-invalid @enderror"  name="end_at"  min="{{ date('Y-m-d', time()) }}"   value="{{ isset($row) ? date('Y-m-d', strtotime($row->end_at)) : old('end_at') }}">
            @error('end_at')
            <small class=" text text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </small>
            @enderror
        </div>
    </div>
</div>

@push('script')
    <script>

        $('select[name="room_id"]').on('change', function(e){
            var x =  $(this).find(':selected').data('person');
            $('input[name="person_number"]').attr('max', x);
            console.log(x);
        })

    </script>
@endpush