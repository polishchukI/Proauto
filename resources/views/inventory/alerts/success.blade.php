@if (session($key ?? 'status'))
    <div class="alert alert-success" role="alert" id="alert-success">
        <i class="far fa-bell"></i>
        <button type="button" class="close" data-dismiss="alert">×</button>
        {!! session($key ?? 'status') !!}
    </div>
@endif