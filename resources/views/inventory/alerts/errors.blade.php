@if ($errors->any())
    <div class="alert alert-danger" role="alert" id="alert-errors">
        <i class="fas fa-exclamation"></i>
        <button type="button" class="close" data-dismiss="alert">×</button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif