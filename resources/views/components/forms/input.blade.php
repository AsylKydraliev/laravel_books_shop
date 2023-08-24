<div>
    @if($label)
        <label for="{{ $id }}" class="form-label">{{ $label }}</label>
    @endif
    <input
        type="{{ $type }}"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        class="form-control @error($name) is-invalid @enderror"
    />
    @error($name)
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>
