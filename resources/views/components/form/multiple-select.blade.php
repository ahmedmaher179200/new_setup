<div class="form-group">
    <label>{{$label}}</label>
    <select multiple  {{$attributes->merge(['class' => $class, 'name' => $name, 'id' => $id]) }} style="width: 100%;">
        @foreach ($collection as $data)
            <option value="{{$data[$index]}}" @if (in_array($data[$index], $selectArr)) selected @endif>{{$data->name}}</option>
        @endforeach
    </select>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>