<form action="{{ route('dashboard.'.$module_name_plural.'.status') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="{{ $row->id }}">
    <label class="switch">
        <input type="checkbox" class="switchType"
            value="{{ $row->status }}" {{ (isset($row) && $row->status == 0 )? 'checked' :
        '' }} name="status">
        <span class="slider round"></span>
    </label>
</form>