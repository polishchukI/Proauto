<hr style="border: 1px solid blue;">
<div class="row">
	<div class="col-8">
		<h3 class="mb-0">{{ __('inventory.provider_webservice_settings') }}</h3>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<label class="form-control-label" for="input-cache">Кэшировать цены</label>
		<select name="cache" id="input-cache" class="form-control form-control-alternative{{ $errors->has('cache') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
				@if($key == old('cache') or $key == $provider->cache)
					<option value="{{$key}}" selected>{{$value}}</option>
				@else
					<option value="{{$key}}">{{$value}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-links_take">Принимать замены</label>
		<select name="links_take" id="input-links_take" class="form-control form-control-alternative{{ $errors->has('links_take') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'No', '1'=>'Yes'] as $key=>$value)
				@if($key == old('links_take') or $key == $provider->links_take)
					<option value="{{$key}}" selected>{{$value}}</option>
				@else
					<option value="{{$key}}">{{$value}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-active">Активен</label>
		<select name="active" id="input-active" class="form-control form-control-alternative{{ $errors->has('active') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'Not', '1'=>'Active'] as $key=>$value)
				@if($key == old('active') or $key == $provider->active)
					<option value="{{$key}}" selected>{{$value}}</option>
				@else
					<option value="{{$key}}">{{$value}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<label class="form-control-label" for="input-links_side">Направление замены</label>
		<select name="links_side" id="input-links_side" class="form-control form-control-alternative{{ $errors->has('links_side') ? ' is-invalid' : '' }}" required>
			@foreach (['0' => 'Both sides', '1' => 'Right side', '2' => 'Left side'] as $key=>$value)
				@if($key == old('links_side') or $key == $provider->links_side)
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
		<label class="form-control-label" for="input-script">Файл Web Script</label>
		<select name="script" id="input-script" class="form-control form-control-alternative{{ $errors->has('script') ? ' is-invalid' : '' }}" required>
			@foreach ($webscriptfiles as $script)
				@if($script == old('script') or $script == $provider->script)
					<option value="{{$script}}" selected>{{$script}}</option>
				@else
					<option value="{{$script}}">{{$script}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<div class="form-group">
			<div><label for="query_limit" class="control-label">Лимит запроса: </label></div>
			<div><input type="number" name="query_limit" id="input-query_limit" class="form-control form-control-alternative{{ $errors->has('query_limit') ? ' is-invalid' : '' }}" placeholder="query_limit" value="{{ old('query_limit', $provider->query_limit) }}" required autofocus></div>
			@include('inventory.alerts.feedback', ['field' => 'query_limit'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<div><label for="daily_limit" class="control-label">Лимит запроса суточный: </label></div>
			<div><input type="number" name="daily_limit" id="input-daily_limit" class="form-control form-control-alternative{{ $errors->has('daily_limit') ? ' is-invalid' : '' }}" placeholder="daily_limit" value="{{ old('daily_limit', $provider->daily_limit) }}" autofocus></div>
			@include('inventory.alerts.feedback', ['field' => 'daily_limit'])
		</div>
	</div>
	<div class="col-3">
		<div class="form-group">
			<div><label for="refresh_time" class="control-label">Период обновления: </label></div>
			<div><input type="number" name="refresh_time" id="input-refresh_time" class="form-control form-control-alternative{{ $errors->has('refresh_time') ? ' is-invalid' : '' }}" placeholder="refresh_time" value="{{ old('refresh_time', $provider->refresh_time) }}" autofocus></div>
			@include('inventory.alerts.feedback', ['field' => 'refresh_time'])
		</div>
	</div>
</div>
<hr style="border: 1px solid blue;">