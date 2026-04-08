<div>
    <select name="perPage" id="perPage" class="form-control" onchange="window.location.href = '?perPage'  this.value"
    style="width: 100px;">
        <option value="" disabled>Per Page</option>
        @foreach ($PerPageOption as $item)
        <option value="{{ $item }}">{{ $item }}</option>
        @endforeach
    </select>
</div>