<div class="form-group">
    <label>{{$label}}</label>
    <select  {{$attributes->merge(['class' => $class, 'name' => $name, 'id' => $id]) }} style="width: 100%;">
        <option value="" selected @if ($firstDisabled == "true") disabled @endif >{{ trans('admin.Select') }}</option>
        
        @foreach ($collection as $data)
            <option value="{{$data[$index]}}" @if ($data[$index] == $select) selected @endif>{{$data->name}}</option>
        @endforeach
    </select>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>