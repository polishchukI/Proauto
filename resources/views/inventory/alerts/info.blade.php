@if (session($key ?? 'info'))
    <div class="alert alert-info" role="alert" id="alert-info">
    <i class="fas fa-info"></i>
    <button type="button" class="close" data-dismiss="alert">×</button>
        {!! session($key ?? 'info') !!}
    </div>
@endif