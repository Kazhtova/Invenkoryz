<div>
    <select name="{{ $term }}" id="{{ $term }}" class="form-control" onchange="window.location.href='?{{ $term }}=' + this.value">
        <option value="">{{ $defaultValue }}</option>
        @foreach ($options as $option)
        <option value="{{ $option->id }}" {{ request($term)==$option->id ? 'selected' : '' }}>
            {{ $option->$field }}
        </option>
        @endforeach
    </select>
</div>