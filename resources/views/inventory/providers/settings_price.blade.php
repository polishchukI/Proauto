<hr style="border: 1px solid blue;">
<div class="row">
	<div class="col-8">
		<h6 class="heading-small text-info mb-4">{{ __('inventory.provider_price_settings') }}</h6>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<div class="form-group{{ $errors->has('default_stock') ? ' has-danger' : '' }}">
			<label class="form-control-label" for="input-default_stock">{{ __('inventory.price_default_stock') }}</label>
			<input type="text" name="default_stock" id="input-default_stock" class="form-control form-control-alternative{{ $errors->has('default_stock') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.price_any_name') }}" value="{{ old('default_stock', $provider->default_stock) }}" required autofocus>
			@include('inventory.alerts.feedback', ['field' => 'default_stock'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group{{ $errors->has('column_separator') ? ' has-danger' : '' }}">
			<label for="column_separator" class="control-label">{{ __('inventory.price_column_separator') }}</label>
			<input class="form-control" required="required" name="column_separator" type="text" value="{{ old('column_separator', ';') }}">
			@include('inventory.alerts.feedback', ['field' => 'column_separator'])
		</div>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-price_encoding">{{ __('inventory.price_encoding') }}</label>
		<select name="price_encoding" id="input-price_encoding" class="form-control form-control-alternative{{ $errors->has('price_encoding') ? ' is-invalid' : '' }}" required>
			@foreach (['UTF-8', 'CP1251'] as $price_encoding)
				@if($price_encoding == old('price_encoding') or $price_encoding == $provider->price_encoding)
					<option value="{{$price_encoding}}" selected>{{$price_encoding}}</option>
				@else
					<option value="{{$price_encoding}}">{{$price_encoding}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-remote">{{ __('inventory.price_remote') }}</label>
		<select name="remote" id="input-remote" class="form-control form-control-alternative{{ $errors->has('remote') ? ' is-invalid' : '' }}" required>
			@foreach (['Local'=>'Локальный', 'Remote'=>'Удаленный'] as $key => $value)
				@if($key == old('key') or $key == $provider->remote)
					<option value="{{$key}}" selected>{{$value}}</option>
				@else
					<option value="{{$key}}">{{$value}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<!-----3----->						
<div class="row">
	<div class="col-3">
		<div class="form-group{{ $errors->has('article_brand_separator') ? ' has-danger' : '' }}">
			<label class="form-control-label" for="input-article_brand_separator">{{ __('inventory.price_article_brand_separator') }}</label>
			<input type="text" name="article_brand_separator" id="input-article_brand_separator" class="form-control form-control-alternative{{ $errors->has('article_brand_separator') ? ' is-invalid' : '' }}" value="{{ old('article_brand_separator', $provider->article_brand_separator) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'article_brand_separator'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<label for="file_name" class="control-label">{{ __('inventory.price_file_name') }}</label>
			<input type="text" name="file_name" id="input-file_name" class="form-control form-control-alternative{{ $errors->has('file_name') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.price_any_name') }}" value="{{ old('file_name', $provider->file_name) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'file_name'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<label for="file_password" class="control-label">{{ __('inventory.price_file_password') }}</label>
			<input type="text" name="file_password" id="input-file_password" class="form-control form-control-alternative{{ $errors->has('file_password') ? ' is-invalid' : '' }}" value="{{ old('file_password', $provider->file_password) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'file_password'])
		</div>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-delete_on_start">{{ __('inventory.price_delete_on_start') }}</label>
		<select name="delete_on_start" id="input-delete_on_start" class="form-control form-control-alternative{{ $errors->has('delete_on_start') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'Нет', '1'=>'Да'] as $delete_on_start)
				@if($delete_on_start == old('delete_on_start') or $delete_on_start == $provider->delete_on_start)
					<option value="{{$delete_on_start}}" selected>{{$delete_on_start}}</option>
				@else
					<option value="{{$delete_on_start}}">{{$delete_on_start}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<!-----4----->
<div class="row">
	<div class="col-3">
		<div class="form-group{{ $errors->has('start_from') ? ' has-danger' : '' }}">
			<label class="form-control-label" for="input-start_from">{{ __('inventory.price_start_from') }}</label>
			<input type="number" name="start_from" id="input-start_from" class="form-control form-control-alternative{{ $errors->has('start_from') ? ' is-invalid' : '' }}" value="{{ old('start_from', $provider->start_from) }}"  autofocus>
			@include('inventory.alerts.feedback', ['field' => 'start_from'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<label for="stop_before" class="control-label">{{ __('inventory.price_stop_before') }}</label>
			<input type="number" name="stop_before" id="input-stop_before" class="form-control form-control-alternative{{ $errors->has('stop_before') ? ' is-invalid' : '' }}" value="{{ old('stop_before', $provider->stop_before) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'stop_before'])
		</div>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-delete_quotes">{{ __('inventory.price_delete_quotes') }}</label>
		<select name="delete_quotes" id="input-delete_quotes" class="form-control form-control-alternative{{ $errors->has('delete_quotes') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'Нет', '1'=>'Да'] as $delete_quotes)
				@if($delete_quotes == old('delete_quotes') or $delete_quotes == $provider->delete_quotes)
					<option value="{{$delete_quotes}}" selected>{{$delete_quotes}}</option>
				@else
					<option value="{{$delete_quotes}}">{{$delete_quotes}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-consider_hot">{{ __('inventory.price_sale') }}</label>
		<select name="consider_hot" id="input-consider_hot" class="form-control form-control-alternative{{ $errors->has('consider_hot') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'Нет', '1'=>'Да'] as $consider_hot)
				@if($consider_hot == old('consider_hot') or $consider_hot == $provider->consider_hot)
					<option value="{{$consider_hot}}" selected>{{$consider_hot}}</option>
				@else
					<option value="{{$consider_hot}}">{{$consider_hot}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<label class="form-control-label" for="input-article_brand_side">{{ __('inventory.price_article_brand_side') }}</label>
		<select name="article_brand_side" id="input-article_brand_side" class="form-control form-control-alternative{{ $errors->has('article_brand_side') ? ' is-invalid' : '' }}" required>
			@foreach (['Left'=>'Слева на право', 'Right'=>'Справа на лево']  as $article_brand_side)
				@if($article_brand_side == old('article_brand_side') or $article_brand_side == $provider->article_brand_side)
					<option value="{{$article_brand_side}}" selected>{{$article_brand_side}}</option>
				@else
					<option value="{{$article_brand_side}}">{{$article_brand_side}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<div class="form-group{{ $errors->has('default_brand') ? ' has-danger' : '' }}">
			<label for="default_brand" class="control-label">{{ __('inventory.price_default_brand') }}</label>
			<input type="text" name="default_brand" id="input-default_brand" class="form-control form-control-alternative{{ $errors->has('default_brand') ? ' is-invalid' : '' }}" placeholder="{{ __('inventory.price_any_name') }}" value="{{ old('default_brand', $provider->default_brand) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'default_brand'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<label for="default_available" class="control-label">{{ __('inventory.price_default_available') }}</label>
			<input type="number" name="default_available" id="input-default_available" class="form-control form-control-alternative{{ $errors->has('default_available') ? ' is-invalid' : '' }}" value="{{ old('default_available', $provider->default_available) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'default_available'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<label for="range_discount_from" class="control-label">{{ __('inventory.price_range_discount_from') }}</label>
			<input type="number" name="range_discount_from" id="input-range_discount_from" class="form-control form-control-alternative{{ $errors->has('range_discount_from') ? ' is-invalid' : '' }}" value="{{ old('range_discount_from', $provider->range_discount_from) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'range_discount_from'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<label for="range_discount_from" class="control-label">{{ __('inventory.price_range_discount_to') }}</label>
			<input type="number" name="range_discount_to" id="input-range_discount_to" class="form-control form-control-alternative{{ $errors->has('range_discount_to') ? ' is-invalid' : '' }}" value="{{ old('range_discount_to', $provider->range_discount_to) }}" autofocus>
			@include('inventory.alerts.feedback', ['field' => 'range_discount_to'])
		</div>
	</div>
</div>
<hr style="border: 1px solid blue;">
<div class="row">
	<form method="POST" action="{{ route('providers.upload_price') }}" accept-charset="UTF-8" class="form-horizontal" enctype="multipart/form-data">
	<input name="_method" type="hidden" value="PATCH">
	@csrf
	<div class="col-4">
		<input style="visible" type="file" name="price" id="price" accept=".csv, .txt, .xls, .xlsx, .zip, .rar">
	</div>
	<div class="col-4">
		<div class="form-group{{ $errors->has('file_path') ? 'has-error' : ''}}">
			<div><input class="form-control" type="text" id="file_path" name="file_path" value="{{ old('file_path', $provider->file_path) }}" autofocus></div>
			<div>{!! $errors->first('file_path', '<p class="help-block">:message</p>') !!}</div>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group">
			<div><button id="upload" value="Upload" class="btn btn-sm btn-simple btn-success">{{ __('inventory.upload_price') }}</button></div>
		</div>
	</div>
	<div class="col-2">
		<div class="form-group">
			<a href="http://php.net/manual/en/ini.core.php#ini.upload-max-filesize" target="_blank" class="ttip" title="upload_max_filesize"><?=(int)(ini_get('upload_max_filesize'))?>Mb</a> / 
			<a href="http://php.net/manual/en/ini.core.php#ini.post-max-size" target="_blank" class="ttip" title="post_max_size"><?=(int)(ini_get('post_max_size'))?>Mb</a> / 
			<a href="http://php.net/manual/en/ini.core.php#ini.memory-limit" target="_blank" class="ttip" title="memory_limit"><?=(int)(ini_get('memory_limit'))?>Mb</a>
		</div>
	</div>
</div>
<hr style="border: 1px solid blue;">
@push('js')
<script>
document.getElementById("upload").addEventListener("click", function(event)
{
	event.preventDefault();
	let route = '{{ route('providers.upload_price')}}';
	var form_data = new FormData();                  // Creating object of FormData class
	var file_data = $("#price").prop("files")[0];   // Getting the properties of file from file field
	form_data.append("file", file_data)              // Appending parameter named file with properties of file_field to form_data	
	
	$.ajax({
		url: route,
		type: 'POST',
		dataType: 'script',
		data: form_data,
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		contentType: false,
		processData: false,
		success: function (data)
		{
			console.log(data);
			// $('#filepath').val(JSON.parse(data));
			$('#file_path').val(JSON.parse(data));
			
		},
		error: function (data)
		{
			console.log(error);
		}
	})
})
</script>
@endpush