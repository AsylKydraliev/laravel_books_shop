<div>
    @if($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <textarea
        id="{{ $id }}"
        name="{{ $name }}"
        class="form-control @error($name) is-invalid @enderror"
        rows="{{ $rows }}"
        cols="{{ $cols }}"
    >{{ $value }}</textarea>
    @error($name)
    <small class="text-danger">{{ $message  }}</small>
    @enderror
</div>
