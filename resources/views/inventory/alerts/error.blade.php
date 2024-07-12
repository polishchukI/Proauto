@if (session($key ?? 'error'))
    <div class="alert alert-danger" role="alert" id="alert-error">
        <i class="fas fa-exclamation"></i>
        <button type="button" class="close" data-dismiss="alert">×</button>
        {!! session($key ?? 'error') !!}
    </div>
@endif