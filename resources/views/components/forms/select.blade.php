<div>
    @if($label)
        <label for="{{ $name }}">{{ $label }}</label>
    @endif
    <select
        class="form-select"
        name="{{ $name }}"
        aria-label="{{ $label }}"
        id="{{ $id }}"
    >
        {{ $slot }}
    </select>
</div>
