
<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h6>{{ __('inventory.edit_provider_price_settings') }}</h6>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-2">
						<button type="button" class="btn btn-selector btn-add btn-simple btn-sm" data-toggle="tooltip" data-placement="bottom" title="Import price" OnClick="import_price('{{$provider->provider_code}}')">
							<i class="fas fa-file-import"></i>
						</button>
					</div>
					<div class="col-2">
						<button class="btn btn-delete btn-add btn-simple btn-sm" title="{{ __('inventory.delete_prices') }}" OnClick="delete_prices('{{$provider->provider_code}}')">
							<i class="fas fa-times"></i>
						</button>
					</div>
					<div class="col-8">
						<form action="{{ route('providers.save_column_settings', $provider->id) }}" enctype="multipart/form-data" method="POST">
							@if(isset($provider) && !empty($columns))
							<div class="form-group table-fields">
								@foreach($columns as $column)
								<div class="entry col-md-10 offset-md-2 form-inline">
									@if((isset($provider)) && ($column["field_number"] != 0))
									<input class="form-control" name="fields[]" type="text" required="true" value="{{$column["field_number"]}}" style="width: 150px;">
									@else
									<input class="form-control" name="fields[]" type="text" required="true" placeholder="Номер поля" style="width: 150px;">
									@endif
									<select name="fields_type[]" class="form-control text-info" required="true" style="width: 250px;">
										@foreach([''				=> '',
											'article_brand'			=> 'Артикул - Бренд',
											'article'				=> 'Артикул',
											'brand'					=> 'Бренд',
											'price'					=> 'Цена',
											'provider_product_name'	=> 'Название',
											'currency'				=> 'Валюта',
											'day'					=> 'Срок',
											'available'				=> 'Наличие',
											'stock'					=> 'Склад',
											'percentgive'			=> 'Процент поставки',
											'set'					=> 'Комплектация (шт.)',
											'weight'				=> 'Вес (гр.)',
											'used'					=> 'Б/у',
											'restored'				=> 'Восстановлен',
											'damaged'				=> 'Есть повреждения',
											'noreturn'				=> 'Возврату не подлежит',
											'minimum'				=> 'Минимальное количество',
											'liters'				=> 'Объём (литров)',
											'copy'					=> 'Копия оригинала',
											'hot'					=> 'Распродажа'] as $key => $value)
										@if($key == old('key') or $key == $column["field_type"])
											<option selected value="{{$key}}">{{$value}}</option>
										@else
											<option value="{{$key}}">{{$value}}</option>
										@endif
									@endforeach
									</select>
									<button class="btn btn-success btn-add btn-simple btn-sm" type="button"><span class="fa fa-plus"></span></button>
								</div>
								@endforeach
							</div>
							@else
							<div class="form-group table-fields">
								<div class="entry col-md-10 offset-md-2 form-inline">
									<input class="form-control" name="fields[]" type="text" required="true" placeholder="Номер поля" style="width: 150px;">
									<select name="fields_type[]" class="form-control" required="true" style="width: 250px;">
										@foreach([''				=> '',
											'article_brand'			=> 'Артикул - Бренд',
											'article'				=> 'Артикул',
											'brand'					=> 'Бренд',
											'price'					=> 'Цена',
											'provider_product_name'	=> 'Название',
											'currency'				=> 'Валюта',
											'day'					=> 'Срок',
											'available'				=> 'Наличие',
											'stock'					=> 'Склад',
											'percentgive'			=> 'Процент поставки',
											'set'					=> 'Комплектация (шт.)',
											'weight'				=> 'Вес (гр.)',
											'used'					=> 'Б/у',
											'restored'				=> 'Восстановлен',
											'damaged'				=> 'Есть повреждения',
											'noreturn'				=> 'Возврату не подлежит',
											'minimum'				=> 'Минимальное количество',
											'liters'				=> 'Объём (литров)',
											'copy'					=> 'Копия оригинала',
											'hot'					=> 'Распродажа'] as $key => $value)
										<option value="{{$key}}">{{$value}}</option>
									@endforeach
									</select>
									<button class="btn btn-success btn-add btn-simple btn-sm" type="button"><span class="fa fa-plus"></span></button>
								</div>
							</div>
							@endif
							<button id="save" class="btn btn-success btn-simple btn-sm" role="button" aria-pressed="true">{{ __('inventory.save') }}</button>
							@csrf
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

@push('js')
<script defer>
//upload_price
document.addEventListener("DOMContentLoaded", () => 
{
	$(document).on('click', '.btn-add', function(e)
	{
		e.preventDefault();
		var tableFields = $('.table-fields'),
		currentEntry = $(this).parents('.entry:first'),
		newEntry = $(currentEntry.clone()).appendTo(tableFields);
		newEntry.find('input').val('');
		tableFields.find('.entry:not(:last) .btn-add').removeClass('btn-add').addClass('btn-remove').removeClass('btn-success').addClass('btn-danger').html('<span class="fa fa-minus"></span>');
	}).on('click', '.btn-remove', function(e)
	{
		$(this).parents('.entry:first').remove();
		e.preventDefault();
		return false;
	});
});
//import_price
function import_price(provider_code)
{
	const modal = $('#modaledit');
	const route = '{{ route('providers.import_price') }}';
	$.ajax({
		url: route,
		type: 'POST',
		data: {provider_code: provider_code},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			modal.modal('show');
		}
	});
};
//delete_prices
function delete_prices(provider_code)
{
	let route = '{{ route('providers.delete_prices') }}';
	$.ajax({
		url: route,
		type: 'POST',
		dataType: 'json',
		data: {provider_code: provider_code},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(flashmessage)
		{
			$('.flashmessage').html('');
			var html="";
			$.each(flashmessage,function(key,value)
			{
				html += "<tr><td>" + value + "</td></tr>";
			})
			$('.flashmessage').append(html)
		}
	});
}
</script>
@endpush