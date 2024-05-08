<div class="col-sm">
    <div class="form-group">
        <label for="name">{{ $label }}</label>
        <input type="{{ $type }}" class="form-control" name="{{ $name }}" id="{{ $name }}"
            placeholder="{{ $placeholder }}" value="{{$value}}">
        <span class="text-danger">
            @error($name)
                {{ $message }}
            @enderror
        </span>
    </div>
</div>