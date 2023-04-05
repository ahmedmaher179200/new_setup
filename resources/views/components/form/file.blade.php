<div class="form-group">
    <label for="username">{{$label}}</label>
    <input type="file" {{$attributes->merge(['class' => $class, 'name' => $name]) }} {{$attribute}}>
    @error($name)
        <span style="color: red; margin: 20px;">
            {{ $message }}
        </span>
    @enderror
</div>
