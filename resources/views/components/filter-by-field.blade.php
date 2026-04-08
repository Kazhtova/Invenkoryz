<div>
    <input type="text" name="{{ $term }}" id="{{ $term }}" class="form-control" placeholder="{{ $placeholder }}" value="{{ 
        request($term) }}" onkeydown="if(event.key === 'Enter'){window.location.href = '?{{ $term }}=' + this.value}">
</div>