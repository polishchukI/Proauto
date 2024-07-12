@if ($errors->has($field))
    <span class="invalid-feedback"  role="alert" id="alert-feedback">
    <i class="fas fa-comments"></i>
        <button type="button" class="close" data-dismiss="alert">×</button>
        {{ $errors->first($field) }}
    </span>
@endif