<hr style="border: 1px solid blue;">
<div class="row">
	<div class="col-8">
		<h3 class="mb-0">Battery parameters</h3>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<div><span class="option_capacity">01. Voltage</span></div>
		<select name="voltage" id="input-voltage" class="form-control form-control-alternative{{ $errors->has('voltage') ? ' is-invalid' : '' }}" required>
			@foreach (['6', '12', '24'] as $voltage)
				@if($voltage == old('voltage') or $voltage == $product->voltage)
					<option value="{{$voltage}}" selected>{{$voltage}}</option>
				@else
					<option value="{{$voltage}}">{{$voltage}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<div><span class="option_capacity">02. Capacity</span></div>
		<div><input class="form-control" type="text" name="capacity"></div>
	</div>
	<div class="col-3">
		<div><span class="option_starting_current">03.Starting current</span></div>
		<div><input class="form-control" type="text" name="starting_current"></div>
	</div>
	<div class="col-3">
		<div><span class="option_polarity">04. polarity</span></div>
		<select name="polarity" id="input-polarity" class="form-control form-control-alternative{{ $errors->has('polarity') ? ' is-invalid' : '' }}" required>
			@foreach (['0'=>'Reverse(Right)', '1'=>'Direct(Left)', '2'=>'Diagonal','3'=>'Reverse(Right - Truck)','4'=>'Direct(Left Truck)','6'=>'6','9'=>'9'] as $key=>$value)
				@if($key == old('key') or $key == $product->polarity)
					<option value="{{$key}}" selected>{{$value}}</option>
				@else
					<option value="{{$key}}">{{$value}}</option>
				@endif
			@endforeach
		</select>
	</div>
</div>
<div class="row">
	<div class="col-3">
		<div><span class="option_starting_current">05. Type</span></div>
		<select name="type" id="input-type" class="form-control form-control-alternative{{ $errors->has('type') ? ' is-invalid' : '' }}" required>
			@foreach (['1'=>'Кислотный', '2'=>'Кальциевый', '3'=>'Гибридный','4'=>'AGM','5'=>'Гелевый','6'=>'EFB','7'=>'Щелочной'] as $type=>$name)
				@if($type == old('type') or $type == $product->type)
					<option value="{{$type}}" selected>{{$name}}</option>
				@else
					<option value="{{$type}}">{{$name}}</option>
				@endif
			@endforeach
		</select>
	</div>
	<div class="col-3">
		<div><span class="option_width">06. Width</span></div>
		<div><input class="form-control" type="text" name="width"></div>
	</div>
	<div class="col-3">
		<div><span class="option_height">07. Height</span></div>
		<div><input class="form-control" type="text" name="height"></div>
	</div>
	<div class="col-3">
		<div><span class="option_length">08. Length</span></div>
		<div><input class="form-control" type="text" name="length"></div>
	</div>
</div>
<hr style="border: 1px solid blue;">