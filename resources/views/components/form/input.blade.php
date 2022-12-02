<div class="form-group">
    <label for="username">{{$label}}</label>
    <input {{$attributes->merge(['type' => $type, 'value' => $value, 'class' => $class, 'name' => $name]) }} {{$attribute}}>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>
