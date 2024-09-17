//**// adminscripts start //**//
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// tinymce.init({selector: '.crud-richtext'});

//**/dataTables initialize/**//
document.addEventListener("DOMContentLoaded", () => {
  $('#dataTable').DataTable();
});

//**/charts initialize/**//
document.addEventListener("DOMContentLoaded", () => {
	dashboardCharts.initDashboardPageCharts();
});

document.addEventListener("DOMContentLoaded", () => {
	$(".form-select").each((i, e) => {
		new SlimSelect({
			select: e
		})
	});
});

//**/currencies/**//
function currencies_update()
{
	$.ajax({
		url: '/currencies_update',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

//**/receipt/**//
$(document).on("click", "#receipt-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#receipt-form-single-product-add').ajaxSubmit({
			url: '/receipt_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="receipt_selected_product-${response.info.product_id}" class="pointer" ondblclick="receipt_edit_product('${response.info.receipt_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function receipt_add_product(receipt_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/receipt_add_product',
		type: 'POST',
		data: {receipt_id:receipt_id,product_id:product_id},
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
       
$(document).on("click", "#receipt-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#receipt-form-product-add').ajaxSubmit({
			url: '/receipt_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="receipt_selected_product-${response.info.product_id}" class="pointer" ondblclick="receipt_edit_product('${response.info.receipt_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)

					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function receipt_edit_product(receipt_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/receipt_edit_product',
			type: 'POST',
			data: {receipt_id:receipt_id,product_id:product_id},
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
};

$(document).on("click", "#receipt-product-update", function()
{
	$('#receipt-form-product-update').ajaxSubmit({
		url: '/receipt_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #receipt_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')

                $('#selectedProductsTable div').append(`<div id="add-receipt_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#receipt-product-delete", function()
{
    $('#receipt-form-product-update').ajaxSubmit({
		url: '/receipt_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #receipt_selected_product-${response.info.product_id}`).remove()
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')
            }
		}
    })
})

function receipt_comment(receipt_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/receipt_comment',
		type: 'POST',
		data: {receipt_id:receipt_id},
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

$(document).on("click", "#receipt-comment-update", function()
{
	$('#receipt-form-comment-update').ajaxSubmit({
		url: '/receipt_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#receiptComment').html('');
				$('#receiptComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#receipt-comment-delete", function()
{
	$('#receipt-form-comment-update').ajaxSubmit({
		url: '/receipt_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#receiptComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#receipts-create-new-provider-store", function()
{
	$('#form-receipt_create_new_provider_store').ajaxSubmit({
		url: '/receipt_create_new_provider_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				var html="";
				html += '<option value="'+response.info.id+'">'+response.info.name+'</option>';
				$('[name="provider_id"]').append(html)
				$('#createNewProvider').modal('hide')
			}
		}
	});
});

/////////////////////////////////////**sale**////////////////////////////////////////////////
$(document).on("click", "#sale-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#sale-form-single-product-add').ajaxSubmit({
			url: '/sale_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="sale_selected_product-${response.info.product_id}" class="pointer" ondblclick="sale_edit_product('${response.info.sale_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function sale_add_product(sale_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/sale_add_product',
		type: 'POST',
		data: {sale_id:sale_id,product_id:product_id},
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

$(document).on("click", "#sale-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#sale-form-product-add').ajaxSubmit({
			url: '/sale_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="sale_selected_product-${response.info.product_id}" class="pointer" ondblclick="sale_edit_product('${response.info.sale_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))					
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function sale_edit_product(sale_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/sale_edit_product',
			type: 'POST',
			data: {sale_id:sale_id,product_id:product_id},
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
};

$(document).on("click", "#sale-product-update", function()
{
	$('#sale-form-product-update').ajaxSubmit({
		url: '/sale_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #sale_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price_in').html(parseFloat(response.info.price_in).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total').html(parseFloat(response.info.total).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-sale_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#sale-product-delete", function()
{
    $('#sale-form-product-update').ajaxSubmit({
		url: '/sale_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #sale_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="sale_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/sales_change_discount',
		type: 'POST',
		dataType: 'json',
		data: { discount: $('[name="sale_discount"]').val(), sale: $('[name="sale"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedProductsTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
				`<tr id="sale_selected_product-${item.product_id}" class="pointer" ondblclick="sale_edit_product('${item.sale_id}','${item.product_id}');">
						<td scope="row" class="article">${item.article}</td>
						<td scope="row" class="brand">${item.brand}</td>
						<td scope="row" class="name">${item.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(item.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(item.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price_in">${parseFloat(item.price_in).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center total">${parseFloat(item.total).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedProductsTable tbody').html(tbody)

				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			}
		}

	});
});

function sale_comment(sale_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/sale_comment',
		type: 'POST',
		data: {sale_id:sale_id},
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

$(document).on("click", "#sale-comment-update", function()
{
	$('#sale-form-comment-update').ajaxSubmit({
		url: '/sale_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#saleComment').html('');
				$('#saleComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#sale-comment-delete", function()
{
	$('#sale-form-comment-update').ajaxSubmit({
		url: '/sale_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#saleComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

//**/client_order/**//
function client_order_sale(client_order_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_order_sale',
		type: 'POST',
		data: {client_order_id:client_order_id},
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

$(document).on("click", "#client_order-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#client_order-form-single-product-add').ajaxSubmit({
			url: '/client_order_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_edit_product('${response.info.client_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function client_order_add_product(client_order_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_order_add_product',
		type: 'POST',
		data: {client_order_id:client_order_id,product_id:product_id},
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

$(document).on("click", "#client_order-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#client_order-form-product-add').ajaxSubmit({
			url: '/client_order_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_edit_product('${response.info.client_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function client_order_edit_product(client_order_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{		
		$.ajax({
			url: '/client_order_edit_product',
			type: 'POST',
			data: {client_order_id:client_order_id,product_id:product_id},
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
};

$(document).on("click", "#client_order-product-update", function()
{
	$('#client_order-form-product-update').ajaxSubmit({
		url: '/client_order_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #client_order_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')

                $('#selectedProductsTable div').append(`<div id="add-client_order_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#client_order-product-delete", function()
{
    $('#client_order-form-product-update').ajaxSubmit({
		url: '/client_order_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #client_order_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})

//**/to_provider_order/**//
function to_provider_order_receipt(to_provider_order_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_receipt',
		type: 'POST',
		data: {to_provider_order_id:to_provider_order_id},
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

//**/to_provider_order/**//
function to_provider_order_sale(to_provider_order_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_sale',
		type: 'POST',
		data: {to_provider_order_id:to_provider_order_id},
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

function to_provider_order_create_modal()
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_create_modal',
		type: 'POST',
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

$(document).on("click", "#to_provider_order-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#to_provider_order-form-single-product-add').ajaxSubmit({
			url: '/to_provider_order_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="to_provider_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="to_provider_order_edit_product('${response.info.to_provider_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function to_provider_order_add_product(to_provider_order_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/to_provider_order_add_product',
		type: 'POST',
		data: {to_provider_order_id:to_provider_order_id,product_id:product_id},
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

$(document).on("click", "#to_provider_order-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#to_provider_order-form-product-add').ajaxSubmit({
			url: '/to_provider_order_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="to_provider_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="to_provider_order_edit_product('${response.info.to_provider_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function to_provider_order_edit_product(to_provider_order_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/to_provider_order_edit_product',
			type: 'POST',
			data: {to_provider_order_id:to_provider_order_id,product_id:product_id},
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
};

$(document).on("click", "#to_provider_order-product-update", function()
{
	$('#to_provider_order-form-product-update').ajaxSubmit({
		url: '/to_provider_order_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #to_provider_order_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
				
                $('#selectedProductsTable div').append(`<div id="add-to_provider_order_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#to_provider_order-product-delete", function()
{
    $('#to_provider_order-form-product-update').ajaxSubmit({
		url: '/to_provider_order_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #to_provider_order_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})

//**// online_client_order_product_create_button //**//
function online_client_orders_product_create(online_client_order_id, product_ordered_id)
{
	const modal = $('#modaledit');        
	$.ajax({
		url: '/online_client_orders_product_create',
		type: 'POST',
		data: {online_client_order_id:online_client_order_id, product_ordered_id:product_ordered_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-category'});
			new SlimSelect({select: '#input-group'});
			modal.modal('show');

		}
	});
};

$(document).on("click", "#online_client_order_product_create_button", function()
{
	$('#form-online_client_order_product_create_store').ajaxSubmit({
		url: '/online_client_orders_product_create_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#modaledit').modal('hide')
			}
		}
	});
});

const checkId = id => {
	const list = $('table tbody tr.pointer')
	notExist = true
	list.each(function()
	{
		let tr_id = $(this).attr('id')
		if (tr_id.split('-')[1] == id)
		{
		notExist = false
		let tr = $(`#${tr_id}`)
		tr.css("background-color", "#E76F51")
		setTimeout(function() {tr.css("background-color", "")},5000)
		}
	})
	return notExist
}

// **payroll** //
function payroll_add_employee(payroll_id, employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/payroll_add_employee',
		type: 'POST',
		data: {payroll_id:payroll_id,employee_id:employee_id},
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

$(document).on("click", "#payroll-employee-add", function()
{
	$('#payroll-form-employee-add').ajaxSubmit({
		url: '/payroll_add_employee_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedemployeesTable tbody').append(`
					<tr id="payroll_selected_employee-${response.info.employee_id}" class="pointer" onclick="payroll_edit_employee('${response.info.payroll_id}','${response.info.employee_id}');">
						<td scope="row">${response.info.lastname}</td>
						<td scope="row">${response.info.firstname}</td>
						<td scope="row">${response.info.secondname}</td>
						<td scope="row" class="text-center salary">${parseFloat(response.info.salary).toFixed(2)}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function payroll_edit_employee(payroll_id,employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/payroll_edit_employee',
		type: 'POST',
		data: {payroll_id:payroll_id,employee_id:employee_id},
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

$(document).on("click", "#payroll-employee-update", function()
{
	$('#payroll-form-employee-update').ajaxSubmit({
		url: '/payroll_update_employee_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				const tr = $(`#selectedemployeesTable tbody #payroll_selected_employee-${response.info.employee_id}`)
				tr.find('.salary').html(parseFloat(response.info.salary).toFixed(2))
				$('#modaledit').modal('hide')
				$('#selectedemployeesTable div').append(`<div id="add-payroll_selected_employee-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
			}
		}
	});
});

$(document).on("click", "#payroll-employee-delete", function()
{
	$('#payroll-form-employee-update').ajaxSubmit({
		url: '/payroll_delete_employee',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$(`#selectedemployeesTable tbody #payroll_selected_employee-${response.info.employee_id}`).remove()
				$('#modaledit').modal('hide')
			}
		}
	})
});


// **salary_payment** //
function salary_payment_add_employee(salary_payment_id, employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/salary_payment_add_employee',
		type: 'POST',
		data: {salary_payment_id:salary_payment_id,employee_id:employee_id},
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

$(document).on("click", "#salary_payment-employee-add", function()
{
	$('#salary_payment-form-employee-add').ajaxSubmit({
		url: '/salary_payment_add_employee_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedemployeesTable tbody').append(`
					<tr id="salary_payment_selected_employee-${response.info.employee_id}" class="pointer" onclick="salary_payment_edit_employee('${response.info.salary_payment_id}','${response.info.employee_id}');">
						<td scope="row">
							${response.info.lastname}
						</td>
						<td scope="row">
							${response.info.firstname}
						</td>
						<td scope="row">
							${response.info.secondname}
						</td>
						<td scope="row" class="text-center salary">
							${parseFloat(response.info.salary).toFixed(2)}
						</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function salary_payment_edit_employee(salary_payment_id,employee_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/salary_payment_edit_employee',
		type: 'POST',
		data: {salary_payment_id:salary_payment_id,employee_id:employee_id},
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

$(document).on("click", "#salary_payment-employee-update", function()
{
	$('#salary_payment-form-employee-update').ajaxSubmit({
		url: '/salary_payment_update_employee_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				const tr = $(`#selectedemployeesTable tbody #salary_payment_selected_employee-${response.info.employee_id}`)
				tr.find('.salary').html(parseFloat(response.info.salary).toFixed(2))
				$('#modaledit').modal('hide')
				$('#selectedemployeesTable div').append(`<div id="add-salary_payment_selected_employee-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
			}
		}
	});
});

$(document).on("click", "#salary_payment-employee-delete", function()
{
	$('#salary_payment-form-employee-update').ajaxSubmit({
		url: '/salary_payment_delete_employee',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$(`#selectedemployeesTable tbody #salary_payment_selected_employee-${response.info.employee_id}`).remove()
				$('#modaledit').modal('hide')
			}
		}
	})
});


// ** services_receipts ** //
$(document).on("click", "#services_receipts-create-new-provider-store", function()
{
	$('#form-services_receipt_create_new_provider_store').ajaxSubmit({
		url: '/services_receipt_create_new_provider_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				var html="";
				html += '<option value="'+response.info.id+'">'+response.info.name+'</option>';
				$('[name="provider_id"]').append(html)
				$('#createNewProvider').modal('hide')
			}
		}
	});
});

function services_receipt_add_service(services_receipt_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/services_receipt_add_service',
		type: 'POST',
		data: {services_receipt_id:services_receipt_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-service'});
			modal.modal('show');
		}
	});
};
       
$(document).on("click", "#services_receipt-service-add", function()
{
	$('#services_receipt-form-service-add').ajaxSubmit({
		url: '/services_receipt_add_service_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedServicesTable tbody').append(`
					<tr id="services_receipt_selected_service-${response.info.service_id}" class="pointer" ondblclick="services_receipt_edit_service('${response.info.services_receipt_id}','${response.info.service_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
			}
		}
	});
});

function services_receipt_edit_service(services_receipt_id, service_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/services_receipt_edit_service',
		type: 'POST',
		data: {services_receipt_id:services_receipt_id,service_id:service_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-service'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#services_receipt-service-update", function()
{
	$('#services_receipt-form-service-update').ajaxSubmit({
		url: '/services_receipt_update_service_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedServicesTable tbody #services_receipt_selected_service-${response.info.service_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')

                $('#selectedServicesTable div').append(`<div id="add-services_receipt_selected_service-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#services_receipt-service-delete", function()
{
    $('#services_receipt-form-service-update').ajaxSubmit({
		url: '/services_receipt_delete_service',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedServicesTable tbody #services_receipt_selected_service-${response.info.service_id}`).remove()
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})


// ** ** //
function price_settings_addproduct(pricesetting_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/price_settings_addproduct',
		type: 'POST',
		data: {pricesetting_id:pricesetting_id,product_id:product_id},
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

//client phones
function client_addphone(client_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_addphone',
		type: 'POST',
		data: {client_id:client_id},
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

$(document).on("click", "#client-phone-store", function()
{
	$('#client-form-phone-store').ajaxSubmit({
		url: '/clients_addphone_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#clientPhonesTable tbody').append(`
					<tr id="client_selected_phone-${response.info.phone_id}" class="pointer" onclick="client_editphone('${response.info.client_id}','${response.info.phone_id}');">
						<td scope="row" class="phone">${response.info.phone}</td>
						<td scope="row" class="telegram">${response.info.telegram == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="viber">${response.info.viber == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="whatsapp">${response.info.whatsapp == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="default">${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="comment">${response.info.comment}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function client_editphone(client_id,phone_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_editphone',
		type: 'POST',
		data: {client_id:client_id,phone_id:phone_id},
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

$(document).on("click", "#client-phone-update", function()
{
	$('#client-form-phone-update').ajaxSubmit({
		url: '/clients_editphone_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#clientPhonesTable tbody #client_selected_phone-${response.info.phone_id}`)
                tr.find('.phone').html(response.info.phone)
				tr.find('.telegram').html(`${response.info.telegram == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
				tr.find('.viber').html(`${response.info.viber == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
				tr.find('.whatsapp').html(`${response.info.whatsapp == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
				tr.find('.default').html(`${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
                tr.find('.comment').html(response.info.comment)
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#client-phone-delete", function()
{
    $('#client-form-phone-update').ajaxSubmit({
		url: '/clients_phone_delete',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#clientPhonesTable tbody #client_selected_phone-${response.info.phone_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})

//client addaddress
function client_addaddress(client_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_addaddress',
		type: 'POST',
		data: {client_id:client_id},
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

$(document).on("click", "#client-address-store", function()
{
	$('#client-form-address-store').ajaxSubmit({
		url: '/clients_addaddress_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#clientAddressesTable tbody').append(`
					<tr id="client_selected_address-${response.info.address_id}" class="pointer" onclick="client_editaddress('${response.info.client_id}','${response.info.address_id}');">
						<td scope="row" class="default">${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}</td>
						<td scope="row" class="zipcode">${response.info.zipcode != null ? response.info.zipcode : ''}</td>
						<td scope="row" class="country">${response.info.country != null ? response.info.country : ''}</td>
						<td scope="row" class="state">${response.info.state != null ? response.info.state : ''}</td>
						<td scope="row" class="city">${response.info.city != null ? response.info.city : ''}</td>
						<td scope="row" class="street">${response.info.street != null ? response.info.street : ''}</td>
						<td scope="row" class="address">${response.info.address != null ? response.info.address : ''} / ${response.info.apartment != null ? response.info.apartment : ''}</td>
						<td scope="row" class="comment">${response.info.comment != null ? response.info.comment : ''}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function client_editaddress(client_id,address_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_editaddress',
		type: 'POST',
		data: {client_id:client_id,address_id:address_id},
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

$(document).on("click", "#client-address-update", function()
{
	$('#client-form-address-update').ajaxSubmit({
		url: '/clients_address_update',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#clientAddressesTable tbody #client_selected_address-${response.info.address_id}`)
				tr.find('.zipcode').html(`${response.info.zipcode != null ? response.info.zipcode : ''}`)
				tr.find('.country').html(`${response.info.country != null ? response.info.country : ''}`)
				tr.find('.state').html(`${response.info.state != null ? response.info.state : ''}`)
				tr.find('.city').html(`${response.info.city != null ? response.info.city : ''}`)
				tr.find('.street').html(`${response.info.street != null ? response.info.street : ''}`)
				tr.find('.address').html(`${response.info.address != null ? response.info.address : ''} / ${response.info.apartment != null ? response.info.apartment : ''}`)
				tr.find('.comment').html(`${response.info.comment != null ? response.info.comment : ''}`)
				tr.find('.default').html(`${response.info.default == 1 ? '<i class="far fa-check-square text-success"></i>': ''}`)
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#client-address-delete", function()
{
    $('#client-form-address-update').ajaxSubmit({
		url: '/clients_address_delete',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1)
			{
                $(`#clientAddressesTable tbody #client_selected_address-${response.info.address_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})


function client_addauto(client_id)
{
	const route					= '/clients/client_addauto';
	
	const group					= $('[name="group"]').val();
	const manufacturer			= $('[name="manufacturer"]').val();
	const model					= $('[name="model"]').val();
	const modification			= $('[name="modification"]').val();
	
	
	const plate					= $('[name="plate"]').val();
	const year					= $('[name="year"]').val();
	const vin					= $('[name="vin"]').val();
	const color					= $('[name="color"]').val();
	
	$.ajax({
		url: route,
		type: 'POST',
		data: { group:group,manufacturer:manufacturer,model:model,modification:modification,plate:plate,year:year,vin:vin,color:color,client_id:client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

// client_delete_auto
function client_delete_auto(client_id,auto_id)
{
	const route = '/clients/client_delete_auto';
	$.ajax({
		url: route,
		type: 'POST',
		data: {client_id:client_id,auto_id:auto_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

////////////////////////////////////crosses////////////////////////////////////
function product_addcross(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_addcross',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '.modal-select'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-cross-add", function()
{
	$('#product-cross-form-add').ajaxSubmit({
		url: '/product_addcross_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#crossesTable tbody').html('')
				let tbody = ''
				response.info.forEach(item => {
					tbody += 
						`<tr id="selected_cross-${item.id}" class="pointer" ondblclick="product_editcross('${item.id}','${item.uid}')">
							<td scope="row" class="article">${item.article}</td>
							<td scope="row" class="brand">${item.brand}</td>
							<td scope="row" class="name">${item.name != null ? item.name : ''}</td>
							<td scope="row" class="main_by_group">${item.main_by_group == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							<td scope="row" class="main_by_brand">${item.main_by_brand == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							</tr>`
				})
				$('#crossesTable tbody').html(tbody)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function product_editcross(cross_id,uid)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_editcross',
		type: 'POST',
		data: {cross_id:cross_id,uid:uid},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '.modal-select'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-cross-update", function()
{
	$('#product-cross-form-update').ajaxSubmit({
		url: '/product_update_cross',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#crossesTable tbody').html('')
				let tbody = ''
				response.info.forEach(item => {
					tbody += 
						`<tr id="selected_cross-${item.id}" class="pointer" ondblclick="product_editcross('${item.id}','${item.uid}')">
							<td scope="row" class="article">${item.article}</td>
							<td scope="row" class="brand">${item.brand}</td>
							<td scope="row" class="name">${item.name != null ? item.name : ''}</td>
							<td scope="row" class="main_by_group">${item.main_by_group == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							<td scope="row" class="main_by_brand">${item.main_by_brand == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							</tr>`
				})
				$('#crossesTable tbody').html(tbody)
				$('#modaledit').modal('hide')
			}
		}
	});
});

$(document).on("click", "#product-cross-delete", function()
{
    $('#product-cross-form-update').ajaxSubmit({
		url: '/product_delete_cross',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#crossesTable tbody').html('')
				let tbody = ''
				response.info.forEach(item => {
					tbody += 
						`<tr id="selected_cross-${item.id}" class="pointer" ondblclick="product_editcross('${item.id}','${item.uid}')">
							<td scope="row" class="article">${item.article}</td>
							<td scope="row" class="brand">${item.brand}</td>
							<td scope="row" class="name">${item.name != null ? item.name : ''}</td>
							<td scope="row" class="main_by_group">${item.main_by_group == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							<td scope="row" class="main_by_brand">${item.main_by_brand == 1 ? '<i class="far fa-check-square text-success"></i>' : ''}</td>
							</tr>`
				})
				$('#crossesTable tbody').html(tbody)
				$('#modaledit').modal('hide')
			}
		}
    })
})

//eans
function product_addean(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_addean',
		type: 'POST',
		data: {product_id:product_id},
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

function product_editean(product_id,ean_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_editean',
		type: 'POST',
		data: {product_id:product_id,ean_id:ean_id},
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

function product_delete_ean(product_id,ean_id)
{
	const route = '/products/product_delete_ean';
	$.ajax({
		url: route,
		type: 'POST',
		data: {product_id:product_id,ean_id:ean_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};
//gtins
function product_addgtin(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_addgtin',
		type: 'POST',
		data: {product_id:product_id},
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

function product_editgtin(product_id,gtin_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/products/product_editgtin',
		type: 'POST',
		data: {product_id:product_id,gtin_id:gtin_id},
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

function product_delete_gtin(product_id,gtin_id)
{
	const route = '/products/product_delete_gtin';
	$.ajax({
		url: route,
		type: 'POST',
		data: {product_id:product_id,gtin_id:gtin_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			location.reload();
		}
	});
};

$('[name="client_id"]').on("change", function(e)
{
	$.ajax({
		url: '/admincarts/client_vehicles',
		type: 'POST',
		data: { client_id: $('[name="client_id"]').val()},
		dataType: 'json',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			$('[name="client_auto_id"]').html('');
			var html="";
			html += '<option value="">Not Specified</option>';
			for(var i = 0; i < data.length; i++)
			{
				html += '<option value="'+data[i].id+'">'+data[i].name+'</option>';
			}
			$('[name="client_auto_id"]').append(html)
		},
		error: function(xhr, textStatus, thrownError)
		{
			alert(xhr.status);
			alert(thrownError);
		}
	});
});

function catalog_product_info(brand,article)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincarts/catalog_product_info',
		type: 'POST',
		data: {brand:brand,article:article},
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

$(document).on("click", "#products-create-new-brand-store", function()
{
	$('#form-product_create_new_brand_store').ajaxSubmit({
		url: '/product_create_new_brand_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				var html="";
				html += '<option value="'+response.info.brand+'">'+response.info.brand+'</option>';
				$('[name="brand"]').append(html)
				$('#createNewBrand').modal('hide')
			}
		}
	});
});

function client_phones_upate()
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/clients_phones_renew_settings',
		type: 'POST',
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
}

/////////////////////
var table = $('#service_parts').DataTable();
// Handle form submission event
$(document).on("click", "#client_auto_serviceparts_create_client_order", function()
{
	var form = this;
	var user_id = $('#user_id').val();
	var client_id = $('#client_id').val();
	var currency = $('#input-currency').val();
	var warehouse_id = $('#input-warehouse').val();
	let checkedRows = [];
	let table_info = [];
	var rowCount = table.rows().data().length;
	var columnCount = table.columns().data().length;
	for (let i = 0; i < rowCount; i++)
	{
		for (let y = 0; y < columnCount; y++)
		{
			if (table.cell({ row: i, column: y }).node().firstElementChild?.checked)
			{
				checkedRows.push(i);
			}
		}
	}
	checkedRows.forEach((i) => {
		let y = {
			product_id: table.cell({ row: i, column: 0 }).node().firstElementChild?.value, 
			quantity: table.cell({ row: i, column: 5 }).node().firstElementChild?.value, 
		};
		table_info.push(y); 
	});
	$.ajax({
		url: '/client_autos/servicepart_client_order_create',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: {table_info:table_info,user_id:user_id,client_id:client_id,currency:currency,warehouse_id:warehouse_id},
		success:function(data)
		{
			window.location.replace(data);
		}
	});
});

$(document).on("click", "#client_auto_serviceparts_create_sale", function()
{
	var form = this;
	var user_id = $('#user_id').val();
	var client_id = $('#client_id').val();
	var currency = $('#input-currency').val();
	var warehouse_id = $('#input-warehouse').val();
	let checkedRows = [];
	let table_info = [];
	var rowCount = table.rows().data().length;
	var columnCount = table.columns().data().length;
	for (let i = 0; i < rowCount; i++)
	{
		for (let y = 0; y < columnCount; y++)
		{
			if (table.cell({ row: i, column: y }).node().firstElementChild?.checked)
			{
				checkedRows.push(i);
			}
		}
	}
	checkedRows.forEach((i) => {
		let y = {
			product_id: table.cell({ row: i, column: 0 }).node().firstElementChild?.value, 
			quantity: table.cell({ row: i, column: 5 }).node().firstElementChild?.value, 
		};
		table_info.push(y); 
	});
	$.ajax({
		url: '/client_autos/servicepart_sale_create',
		type: 'POST',
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		data: {table_info:table_info,user_id:user_id,client_id:client_id,currency:currency,warehouse_id:warehouse_id},
		success:function(data)
		{
			window.location.replace(data);
		}
	});
});

//**// return_from_the_client //**//
function return_from_the_client_add_single_product(return_from_the_client_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/return_from_the_client_add_single_product',
		type: 'POST',
		data: {return_from_the_client_id:return_from_the_client_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#return_from_the_client-single-product-add", function()
{
	$('#return_from_the_client-form-single-product-add').ajaxSubmit({
		url: '/return_from_the_client_add_single_product_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#selectedProductsTable tbody').append(`
					<tr id="return_from_the_client_selected_product-${response.info.product_id}" class="pointer" ondblclick="return_from_the_client_edit_product('${response.info.return_from_the_client_id}','${response.info.product_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.brand}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')
			}
		}
	});
});

function return_from_the_client_edit_product(return_from_the_client_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/return_from_the_client_edit_product',
			type: 'POST',
			data: {return_from_the_client_id:return_from_the_client_id,product_id:product_id},
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
};

$(document).on("click", "#returns_from_the_client-product-update", function()
{
	$('#returns_from_the_client-form-product-update').ajaxSubmit({
		url: '/return_from_the_client_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #return_from_the_client_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
                $('#modaledit').modal('hide')
                

            }
        }
	});
});

$(document).on("click", "#returns_from_the_client-product-delete", function()
{
    $('#returns_from_the_client-form-product-update').ajaxSubmit({
		url: '/return_from_the_client_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1)
			{
                $(`#selectedProductsTable tbody #return_from_the_client_selected_product-${response.info.product_id}`).remove()
				$('#return_from_the_clientDiscountSum').html(parseFloat(response.info.return_from_the_clientDiscountSum).toFixed(2))//discount test

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
                $('#modaledit').modal('hide')
            }
		}
    })
})


//**// return_to_provider //**//
function return_to_provider_add_single_product(return_to_provider_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/return_to_provider_add_single_product',
		type: 'POST',
		data: {return_to_provider_id:return_to_provider_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#return_to_provider-single-product-add", function()
{
	$('#return_to_provider-form-single-product-add').ajaxSubmit({
		url: '/return_to_provider_add_single_product_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedProductsTable tbody').append(`
					<tr id="return_to_provider_selected_product-${response.info.product_id}" class="pointer" ondblclick="return_to_provider_edit_product('${response.info.return_to_provider_id}','${response.info.product_id}');">
						<td scope="row">
							${response.info.article}
						</td>
						<td scope="row">
							${response.info.brand}
						</td>
						<td scope="row">
							${response.info.name}
						</td>
						<td scope="row" class="text-center stock">
							${parseFloat(response.info.stock).toFixed(2)}
						</td>
						<td scope="row" class="text-center quantity">
							${parseFloat(response.info.quantity).toFixed(2)}
						</td>
						<td scope="row" class="text-center price">
							${parseFloat(response.info.price).toFixed(2)}
						</td>
						<td scope="row" class="text-center total_amount">
						${parseFloat(response.info.total_amount).toFixed(2)}
						</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function return_to_provider_edit_product(return_to_provider_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/return_to_provider_edit_product',
			type: 'POST',
			data: {return_to_provider_id:return_to_provider_id,product_id:product_id},
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
};

$(document).on("click", "#returns_to_provider-product-update", function()
{
	$('#returns_to_provider-form-product-update').ajaxSubmit({
		url: '/return_to_provider_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #return_to_provider_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-return_to_provider_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#returns_to_provider-product-delete", function()
{
    $('#returns_to_provider-form-product-update').ajaxSubmit({
		url: '/return_to_provider_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #return_to_provider_selected_product-${response.info.product_id}`).remove()
				$('#return_to_providerDiscountSum').html(parseFloat(response.info.return_to_providerDiscountSum).toFixed(2))//discount test
                $('#modaledit').modal('hide')
            }
		}
    })
})


// min_stocks //
function product_add_min_stock(product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_add_min_stock',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-warehouse'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-min_stock-add", function()
{
	$('#product-min_stock-form-add').ajaxSubmit({
		url: '/product_add_min_stock_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#minStocksTable tbody').append(`
				<tr id="selected_min_stock-{{ $min_stock->id }}" class="pointer" OnClick="product_edit_min_stock('{{$product->id}}','{{$min_stock->id}}')">
					<tr id="selected_min_stock-${response.info.min_stock_id}" class="pointer" onclick="product_edit_min_stock('${response.info.product_id}','${response.info.min_stock_id}');">
						<td scope="row" class="date">${response.info.date}</td>
						<td scope="row" class="warehouse">${response.info.warehouse}</td>						
						<td scope="row" class="quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function product_edit_min_stock(product_id,min_stock_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/product_edit_min_stock',
		type: 'POST',
		data: {product_id:product_id,min_stock_id:min_stock_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-warehouse'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#product-min_stock-update", function()
{
	$('#product-min_stock-form-update').ajaxSubmit({
		url: '/product_update_min_stock',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#minStocksTable tbody #selected_min_stock-${response.info.min_stock_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.date').html(response.info.date)
                tr.find('.warehouse').html(response.info.warehouse)
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#product-min_stock-delete", function()
{
    $('#product-min_stock-form-update').ajaxSubmit({
		url: '/product_delete_min_stock',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#minStocksTable tbody #selected_min_stock-${response.info.min_stock_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})

/////////////////////////////////////**serviceparts**////////////////////////////////////////////////
function servicepart_add(client_auto_id)
{
	const modal = $('#modaledit');

	$.ajax({
		url: '/client_autos_servicepart_add',
		type: 'POST',
		data: {client_auto_id:client_auto_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#auto-servicepart-add", function()
{
	$('#auto-servicepart-form-add').ajaxSubmit({
		url: '/client_autos_servicepart_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#servicepartsTable tbody').append(`
					<tr id="selected_servicepart-${response.info.servicepart_id}" class="pointer" OnClick="servicepart_edit('${response.info.client_auto_id}','${response.info.servicepart_id}')">
						<td scope="row" class="article">${response.info.article}</td>
						<td scope="row" class="brand">${response.info.brand}</td>
						<td scope="row" class="name">${response.info.name != null ? response.info.name : ''}</td>
						<td scope="row" class="quantity">${response.info.quantity}</td>
						
						<td scope="row" class="stock">${response.info.stock != null ? response.info.stock : '0.00'}</td>
						<td scope="row" class="price">${response.info.price != null ? response.info.price : '0.00'}</td>
						<td scope="row" class="comment">${response.info.comment != null ? response.info.comment : ''}</td>
					</tr>
				`)
				$('#modaledit').modal('hide')
			}
		}
	});
});

function servicepart_edit(client_auto_id,item_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_autos_servicepart_edit',
		type: 'POST',
		data: {client_auto_id:client_auto_id,item_id:item_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-product'});
			modal.modal('show');
		}
	});
};

$(document).on("click", "#auto-servicepart-update", function()
{
	$('#auto-servicepart-form-update').ajaxSubmit({
		url: '/client_autos_servicepart_update',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#servicepartsTable tbody #selected_servicepart-${response.info.servicepart_id}`)
				tr.find('.article').html(response.info.article)
				tr.find('.brand').html(response.info.brand)
				tr.find('.name').html(response.info.name)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
				tr.find('.stock').html(parseFloat(response.info.stock).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                
                tr.find('.comment').html(response.info.comment != null ? response.info.comment : '')
                $('#modaledit').modal('hide')
            }
        }
	});
});

$(document).on("click", "#auto-servicepart-delete", function()
{
    $('#auto-servicepart-form-update').ajaxSubmit({
		url: '/client_autos_servicepart_delete',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#servicepartsTable tbody #selected_servicepart-${response.info.servicepart_id}`).remove()
                $('#modaledit').modal('hide')
            }
		}
    })
})
/////////////////////////////////////**serviceparts**////////////////////////////////////////////////

////////////////////////////////////**repair_order**////////////////////////////////////////////////
$(document).on("click", "#repair_order-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id))
	{
		$('#repair_order-form-single-product-add').ajaxSubmit({
			url: '/repair_order_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="repair_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="repair_order_edit_product('${response.info.repair_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

					// $('#singleProduct').modal('hide')
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function repair_order_add_product(repair_order_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/repair_order_add_product',
		type: 'POST',
		data: {repair_order_id:repair_order_id,product_id:product_id},
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

$(document).on("click", "#repair_order-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id))
	{
		$('#repair_order-form-product-add').ajaxSubmit({
			url: '/repair_order_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="repair_order_selected_product-${response.info.product_id}" class="pointer" ondblclick="repair_order_edit_product('${response.info.repair_order_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

					// $('#modaledit').modal('hide')
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function repair_order_edit_product(repair_order_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/repair_order_edit_product',
			type: 'POST',
			data: {repair_order_id:repair_order_id,product_id:product_id},
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
};

$(document).on("click", "#repair_order-product-update", function()
{
	$('#repair_order-form-product-update').ajaxSubmit({
		url: '/repair_order_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #repair_order_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total').html(parseFloat(response.info.total).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-repair_order_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#repair_order-product-delete", function()
{
    $('#repair_order-form-product-update').ajaxSubmit({
		url: '/repair_order_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #repair_order_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="repair_order_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/repair_orders_change_discount',
		type: 'POST',
		dataType: 'json',
		data: { discount: $('[name="repair_order_discount"]').val(), repair_order: $('[name="repair_order"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedProductsTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
				`<tr id="repair_order_selected_product-${item.product_id}" class="pointer" ondblclick="repair_order_edit_product('${item.repair_order_id}','${item.product_id}');">
						<td scope="row" class="article">${item.article}</td>
						<td scope="row" class="brand">${item.brand}</td>
						<td scope="row" class="name">${item.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(item.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(item.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center total">${parseFloat(item.total).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedProductsTable tbody').html(tbody)

			$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
			$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
			$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
			$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
			$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
			$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
			$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
			$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
			}
		}

	});
});
//repair order services
$(document).on("click", "#repair_order-single-service-add", function()
{
	var id = $('[name="service_id"]').val();
	if (checkId(id))
	{
		$('#repair_order-form-single-service-add').ajaxSubmit({
			url: '/repair_order_add_single_service_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedServicesTable tbody').append(`
						<tr id="repair_order_selected_service-${response.info.service_id}" class="pointer" onclick="repair_order_edit_service('${response.info.repair_order_id}','${response.info.service_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center employee">${response.info.employee}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				}
			}
		});
	}
	$('#singleService').modal('hide')
});

function repair_order_add_service(repair_order_id, service_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/repair_order_add_service',
		type: 'POST',
		data: {repair_order_id:repair_order_id,service_id:service_id},
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

$(document).on("click", "#repair_order-service-add", function()
{
	$('#repair_order-form-service-add').ajaxSubmit({
		url: '/repair_order_add_service_store',
		type: 'PUT',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedServicesTable tbody').append(`
					<tr id="repair_order_selected_service-${response.info.service_id}" class="pointer" onclick="repair_order_edit_service('${response.info.repair_order_id}','${response.info.service_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center employee">${response.info.employee}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

				$('#modaledit').modal('hide')
			}
		}
	});
});

function repair_order_edit_service(repair_order_id,service_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/repair_order_edit_service',
			type: 'POST',
			data: {repair_order_id:repair_order_id,service_id:service_id},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				modal.html(data);
				modal.find('.modaledit__close').on('click', function()
				{
					modal.modal('hide');
				});
				new SlimSelect({select: '#input-employee'});
				modal.modal('show');
			}
		});
	};
};

$(document).on("click", "#repair_order-service-update", function()
{
	$('#repair_order-form-service-update').ajaxSubmit({
		url: '/repair_order_update_service_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedServicesTable tbody #repair_order_selected_service-${response.info.service_id}`)
                tr.find('.employee').html(response.info.employee)
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedServicesTable div').append(`<div id="add-repair_order_selected_service-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#repair_order-service-delete", function()
{
    $('#repair_order-form-service-update').ajaxSubmit({
		url: '/repair_order_delete_service',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedServicesTable tbody #repair_order_selected_service-${response.info.service_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="repair_order_service_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/repair_orders_change_services_discount',
		type: 'POST',
		dataType: 'json',
		data: { service_discount: $('[name="repair_order_service_discount"]').val(), repair_order: $('[name="repair_order"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedServicesTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
					`<tr id="repair_order_selected_service-${item.service_id}" class="pointer" onclick="repair_order_edit_service('${item.repair_order_id}','${item.service_id}');">
						<td scope="row">${item.article}</td>
						<td scope="row">${item.name}</td>
						<td scope="row" class="text-center employee">${item.employee}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedServicesTable tbody').html(tbody)

			$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
			$('[name="docServicesDiscountSum"]').html(parseFloat(response.docHeaderValues.docServicesDiscountSum).toFixed(2))
			$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
			$('[name="docServicesDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docServicesDiscountedTotal).toFixed(2))
			$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
			$('[name="docServicesCount"]').html(parseFloat(response.docHeaderValues.docServicesCount).toFixed(2))
			$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			$('[name="docServicesQuantity"]').html(parseFloat(response.docHeaderValues.docServicesQuantity).toFixed(2))
			$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
			}
		}
	});
});

/////////////////////////////////////**admincart**////////////////////////////////////////////////
function admincart_comment(admincart_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincart_comment',
		type: 'POST',
		data: {admincart_id:admincart_id},
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

$(document).on("click", "#admincart-comment-update", function()
{
	$('#admincart-form-comment-update').ajaxSubmit({
		url: '/admincart_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#admincartComment').html('');
				$('#admincartComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#admincart-comment-delete", function()
{
	$('#admincart-form-comment-update').ajaxSubmit({
		url: '/admincart_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#admincartComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#admincart-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id))
	{
		$('#admincart-form-single-product-add').ajaxSubmit({
			url: '/admincart_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
				$('#selectedProductsTable tbody').append(`
					<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
					<td scope="row">${response.info.article}</td>
					<td scope="row">${response.info.brand}</td>
					<td scope="row">${response.info.name}</td>
					<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
					<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
					<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
					<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
					<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});
  
function admincart_add_product(admincart_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincart_add_product',
		type: 'POST',
		data: {admincart_id:admincart_id,product_id:product_id},
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

$(document).on("click", "#admincart-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#admincart-form-product-add').ajaxSubmit({
			url: '/admincart_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					$('#modaledit').modal('hide')
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function admincart_edit_product(admincart_id, product_id)
{
	const modal = $('#modaledit');

	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/admincart_edit_product',
			type: 'POST',
			data: {admincart_id:admincart_id, product_id:product_id},
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
};

$(document).on("click", "#admincart-product-update", function()
{
	$('#admincart-form-product-update').ajaxSubmit({
		url: '/admincart_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #admincart_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price_in').html(parseFloat(response.info.price_in).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
				
                $('#selectedProductsTable div').append(`<div id="add-admincart_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#admincart-product-delete", function()
{
    $('#admincart-form-product-update').ajaxSubmit({
		url: '/admincart_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #admincart_selected_product-${response.info.product_id}`).remove()
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
            }
		}
    })
})

function admincart_search()
{
	var admincart_id = jQuery('#admincart_id').val();

	var catalog_search = document.getElementById("catalog_search").checked;//catalog_search
	var prices_search = document.getElementById("prices_search").checked;
	var oem_search = document.getElementById("oem_search").checked;//oem_search
	var ws_search = document.getElementById("ws_search").checked;//ws_search

	var admincart_product_search_input = jQuery('#admincart_product_search_input').val();
	
	if(admincart_product_search_input != '')
	{
		admincart_product_search_input = admincart_product_search_input.replace(/[^-a-zA-Z0-9.]+/g, '');
		{
			$.ajax({
				url: '/admincart_search',
				type: 'POST',
				data: {
					admincart_id:admincart_id,
					catalog_search:catalog_search,
					ws_search:ws_search,
					oem_search:oem_search,
					admincart_product_search_input:admincart_product_search_input,
					prices_search:prices_search
					},
				dataType: 'json',
				headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
				beforeSend: function ()
                {
					$('#admin_search_loader').removeClass('hidden');
				
				},
				success:function(data)
				{
					$('[name = "searchTable"]').html('');
					var html = "";
					for(var i = 0; i < data.length; i++)
					{
						html += `<tr>`;
						if(!data[i].product_id)
						{
							html += `<td>`+data[i].article+`</td>`;
						}
						else
						{
							html += `<td><a href="/products/`+data[i].product_id+`" title = "`+data[i].name+`" target="_blank">`+data[i].article+`</a></td>`;
						}
						html += `<td>`+data[i].brand+`</td>`;
						if(!data[i].name)
						{
							html += `<td> Name not set </td>`; 
						}
						else
						{
							html += `<td>`+data[i].name+`</td>`;
						}
						html += `<td>`+data[i].stocks+`</td>`;
						html += `<td>`+data[i].price+`</td>`;
						html += `<td><button type="button" class="btn btn-simple btn-selector btn-sm" OnClick="catalog_product_info('${data[i].bkey}','${data[i].akey}')"><i class="fas fa-info"></i></button></td>`;
						if(!data[i].product_id)
						{
							html += `<td><button type="button" class="btn btn-simple btn-selector btn-sm" OnClick="catalog_product_add_to_base(`+data[i].admincart_id+`,'${data[i].brand}','${data[i].article}','${data[i].name}')"><i class="fas fa-file-import"></i></button></td>`;
						}
						else
						{
							html += `<td></td>`; 
						}
						if(!data[i].product_id)
						{
							html += `<td name="tocart${data[i].pkey}"></td>`; 
						}
						else
						{
							html += `<td name="tocart${data[i].pkey}"><button type="button" class="btn btn-simple btn-selector btn-sm" OnClick="admincart_add_product(`+data[i].admincart_id+`,`+data[i].product_id+`)"><i class="fas fa-plus"></i></button></td>`;
						}
						
						html += `</tr>`;
					}
					$('[name="searchTable"]').append(html)
				},
				complete: function ()
                {
					$('#admin_search_loader').addClass('hidden')
				},
				error: function(xhr, textStatus, thrownError)
				{
					alert(xhr.status);alert(thrownError);
				}
			});
		};
	};
};

//**// admincart add from search product magic //**//

//adding from search table
function catalog_product_add_to_base(admincart_id, brand, article, product_name)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/admincarts/catalog_product_add_to_base',
		type: 'POST',
		data: {admincart_id:admincart_id, brand:brand, article:article, product_name:product_name},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-category'});
			new SlimSelect({select: '#input-group'});

			modal.modal('show');
		}
	});
};

//manual product add
function catalog_product_create(admincart_id)
{
	const modal = $('#modaledit');        
	$.ajax({
		url: '/admincarts/catalog_product_create',
		type: 'POST',
		data: {admincart_id:admincart_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
		success:function(data)
		{
			modal.html(data);
			modal.find('.modaledit__close').on('click', function()
			{
				modal.modal('hide');
			});
			new SlimSelect({select: '#input-category'});
			new SlimSelect({select: '#input-brand'});
			new SlimSelect({select: '#input-group'});
			modal.modal('show');

		}
	});
};

$(document).on("click", "#admincart-product-create-from-search", function()
{
	$('#admincart-form-product_add_tobase_from_search').ajaxSubmit({
		url: '/admincarts/catalog_product_add_to_base_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#modaledit').modal('hide')
			}
		}
	});
});

$(document).on("click", "#admincart-product-create-from-search-add", function()
{
	$('#admincart-form-product_add_tobase_from_search').ajaxSubmit({
		url: '/admincarts/catalog_product_add_to_base_and_cart_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#selectedProductsTable tbody').append(`
					<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.brand}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)

				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
			}
		}
	});
});

//admincart add manual product magic
$(document).on("click", "#admincart-product-create-manual", function()
{
	$('#admincart-form-product_create_store').ajaxSubmit({
		url: '/admincarts/catalog_product_create_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#modaledit').modal('hide')
			}
		}
	});
});

$(document).on("click", "#admincart-product-create-manual-add", function()
{
	$('#admincart-form-product_create_store').ajaxSubmit({
		url: '/admincarts/catalog_product_create_add_to_cart_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
				$('#selectedProductsTable tbody').append(`
					<tr id="admincart_selected_product-${response.info.product_id}" class="pointer" ondblclick="admincart_edit_product('${response.info.admincart_id}','${response.info.product_id}');">
						<td scope="row">${response.info.article}</td>
						<td scope="row">${response.info.brand}</td>
						<td scope="row">${response.info.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price_in">${parseFloat(response.info.price_in).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
					</tr>
				`)
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				
				$('#modaledit').modal('hide')
			}
		}
	});
});

/////////////////////////////////////**client_order_correction**////////////////////////////////////////////////
$(document).on("click", "#client_order_correction-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#client_order_correction-form-single-product-add').ajaxSubmit({
			url: '/client_order_correction_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_correction_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_correction_edit_product('${response.info.client_order_correction_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function client_order_correction_add_product(client_order_correction_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/client_order_correction_add_product',
		type: 'POST',
		data: {client_order_correction_id:client_order_correction_id,product_id:product_id},
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

$(document).on("click", "#client_order_correction-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#client_order_correction-form-product-add').ajaxSubmit({
			url: '/client_order_correction_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="client_order_correction_selected_product-${response.info.product_id}" class="pointer" ondblclick="client_order_correction_edit_product('${response.info.client_order_correction_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total">${parseFloat(response.info.total).toFixed(2)}</td>
							<td scope="row" class="text-center discount">${parseFloat(response.info.discount).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
					$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))					
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function client_order_correction_edit_product(client_order_correction_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/client_order_correction_edit_product',
			type: 'POST',
			data: {client_order_correction_id:client_order_correction_id,product_id:product_id},
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
};

$(document).on("click", "#client_order_correction-product-update", function()
{
	$('#client_order_correction-form-product-update').ajaxSubmit({
		url: '/client_order_correction_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #client_order_correction_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total').html(parseFloat(response.info.total).toFixed(2))
                tr.find('.discount').html(parseFloat(response.info.discount).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
                $('#selectedProductsTable div').append(`<div id="add-client_order_correction_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)

            }
        }
	});
});

$(document).on("click", "#client_order_correction-product-delete", function()
{
    $('#client_order_correction-form-product-update').ajaxSubmit({
		url: '/client_order_correction_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #client_order_correction_selected_product-${response.info.product_id}`).remove()
				//header
				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

                $('#modaledit').modal('hide')
            }
		}
    })
})

$('[name="client_order_correction_discount"]').on("change", function(e)
{
	$.ajax({
		url: '/client_order_corrections_change_discount',
		type: 'POST',
		dataType: 'json',
		data: { discount: $('[name="client_order_correction_discount"]').val(), client_order_correction: $('[name="client_order_correction"]').val()},
		
		success: response => {
		if (response.status == 1) {
			$('#selectedProductsTable tbody').html('')
			let tbody = ''
			response.info.forEach(item => {
				tbody += 
				`<tr id="client_order_correction_selected_product-${item.product_id}" class="pointer" ondblclick="client_order_correction_edit_product('${item.client_order_correction_id}','${item.product_id}');">
						<td scope="row" class="article">${item.article}</td>
						<td scope="row" class="brand">${item.brand}</td>
						<td scope="row" class="name">${item.name}</td>
						<td scope="row" class="text-center stock">${parseFloat(item.stock).toFixed(2)}</td>
						<td scope="row" class="text-center quantity">${parseFloat(item.quantity).toFixed(2)}</td>
						<td scope="row" class="text-center price">${parseFloat(item.price).toFixed(2)}</td>
						<td scope="row" class="text-center total">${parseFloat(item.total).toFixed(2)}</td>
						<td scope="row" class="text-center discount">${parseFloat(item.discount).toFixed(2)}</td>
						<td scope="row" class="text-center total_amount">${parseFloat(item.total_amount).toFixed(2)}</td>
					</tr>`
			})
			$('#selectedProductsTable tbody').html(tbody)

				$('[name="docDiscountSum"]').html(parseFloat(response.docHeaderValues.docDiscountSum).toFixed(2))
				$('[name="docDiscountedTotal"]').html(parseFloat(response.docHeaderValues.docDiscountedTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
			}
		}

	});
});

/////////////////////////////////////**warehouse_write_offs**////////////////////////////////////////////////
$(document).on("click", "#warehouse_write_off-single-product-add", function()
{
	var id = $('[name="productLive"]').val();
	if (checkId(id)) {
		$('#warehouse_write_off-form-single-product-add').ajaxSubmit({
			url: '/warehouse_write_off_add_single_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="warehouse_write_off_selected_product-${response.info.product_id}" class="pointer" ondblclick="warehouse_write_off_edit_product('${response.info.warehouse_write_off_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)
					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
					
					
				}
			}
		});
	}
	$('#singleProduct').modal('hide')
});

function warehouse_write_off_add_product(warehouse_write_off_id, product_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/warehouse_write_off_add_product',
		type: 'POST',
		data: {warehouse_write_off_id:warehouse_write_off_id,product_id:product_id},
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
       
$(document).on("click", "#warehouse_write_off-product-add", function()
{
	var id = $('[name="product_id"]').val();
	if (checkId(id)) {
		$('#warehouse_write_off-form-product-add').ajaxSubmit({
			url: '/warehouse_write_off_add_product_store',
			type: 'PUT',
			dataType: 'json',
			success: response => {
				if (response.status == 1) {
					$('#selectedProductsTable tbody').append(`
						<tr id="warehouse_write_off_selected_product-${response.info.product_id}" class="pointer" ondblclick="warehouse_write_off_edit_product('${response.info.warehouse_write_off_id}','${response.info.product_id}');">
							<td scope="row">${response.info.article}</td>
							<td scope="row">${response.info.brand}</td>
							<td scope="row">${response.info.name}</td>
							<td scope="row" class="text-center stock">${parseFloat(response.info.stock).toFixed(2)}</td>
							<td scope="row" class="text-center quantity">${parseFloat(response.info.quantity).toFixed(2)}</td>
							<td scope="row" class="text-center price">${parseFloat(response.info.price).toFixed(2)}</td>
							<td scope="row" class="text-center total_amount">${parseFloat(response.info.total_amount).toFixed(2)}</td>
						</tr>
					`)

					//header
					$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
					$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
					$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))
				}
			}
		});
	}
	$('#modaledit').modal('hide')
});

function warehouse_write_off_edit_product(warehouse_write_off_id,product_id)
{
	const modal = $('#modaledit');
	
	var is_finalized = jQuery('#is_finalized').val();
	
	if(!is_finalized)
	{
		$.ajax({
			url: '/warehouse_write_off_edit_product',
			type: 'POST',
			data: {warehouse_write_off_id:warehouse_write_off_id,product_id:product_id},
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
};

$(document).on("click", "#warehouse_write_off-product-update", function()
{
	$('#warehouse_write_off-form-product-update').ajaxSubmit({
		url: '/warehouse_write_off_update_product_store',
		type: 'POST',
		dataType: 'json',
		success: response => {
			if (response.status == 1) {
                const tr = $(`#selectedProductsTable tbody #warehouse_write_off_selected_product-${response.info.product_id}`)
                tr.find('.quantity').html(parseFloat(response.info.quantity).toFixed(2))
                tr.find('.price').html(parseFloat(response.info.price).toFixed(2))
                tr.find('.total_amount').html(parseFloat(response.info.total_amount).toFixed(2))
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')

                $('#selectedProductsTable div').append(`<div id="add-warehouse_write_off_selected_product-status" class="d-inline px-4 py-1 border rounded alert-${response.message[1]} text-center" role="alert">${response.message[0]}</div>`)
            }
        }
	});
});

$(document).on("click", "#warehouse_write_off-product-delete", function()
{
    $('#warehouse_write_off-form-product-update').ajaxSubmit({
		url: '/warehouse_write_off_delete_product',
		type: 'DELETE',
		dataType: 'json',
        success: response => {
            if (response.status == 1) {
                $(`#selectedProductsTable tbody #warehouse_write_off_selected_product-${response.info.product_id}`).remove()
				
				//header
				$('[name="docTotal"]').html(parseFloat(response.docHeaderValues.docTotal).toFixed(2))
				$('[name="docCount"]').html(parseFloat(response.docHeaderValues.docCount).toFixed(2))
				$('[name="docQuantity"]').html(parseFloat(response.docHeaderValues.docQuantity).toFixed(2))

				$('#modaledit').modal('hide')
            }
		}
    })
})

function warehouse_write_off_comment(warehouse_write_off_id)
{
	const modal = $('#modaledit');
	$.ajax({
		url: '/warehouse_write_off_comment',
		type: 'POST',
		data: {warehouse_write_off_id:warehouse_write_off_id},
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

$(document).on("click", "#warehouse_write_off-comment-update", function()
{
	$('#warehouse_write_off-form-comment-update').ajaxSubmit({
		url: '/warehouse_write_off_comment_update',
		type: 'post',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#warehouse_write_offComment').html('');
				$('#warehouse_write_offComment').append(`${response.comment}`);
			}
			$('#modaledit').modal('hide')
		}
	});
});

$(document).on("click", "#warehouse_write_off-comment-delete", function()
{
	$('#warehouse_write_off-form-comment-update').ajaxSubmit({
		url: '/warehouse_write_off_comment_delete',
		type: 'DELETE',
		dataType: 'json',
		success: response => {
			if (response.status == 1)
			{
				$('#warehouse_write_offComment').html('');
			}
			$('#modaledit').modal('hide')
		}
	});
});

/////////////////////////////////////**alerts**////////////////////////////////////////////////

setTimeout(() => $('#alert-error').remove(), 30000)
setTimeout(() => $('#alert-errors').remove(), 30000)
setTimeout(() => $('#alert-feedback').remove(), 5000)
setTimeout(() => $('#alert-info').remove(), 5000)
setTimeout(() => $('#alert-success').remove(), 5000)