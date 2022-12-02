<div class="form-group">
    <label>{{ trans('admin.Roles') }}</label>
    <select  {{$attributes->merge(['class' => $class, 'name' => $name]) }} style="width: 100%;">
        @foreach ($collection as $data)
            <option value="{{$data->id}}" @if ($data->id == $value) selected @endif>{{$data->name}}</option>
        @endforeach
    </select>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>