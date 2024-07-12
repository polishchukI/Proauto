$("#catalogSearch").on('submit',  function (e)
{
	e.preventDefault();
	SearchNumber();
	return false;
});
$("#mobileCatalogSearch").on('submit',  function (e)
{
	e.preventDefault();
	MobileSearchNumber();
	return false;
});
function SearchNumber()
{
    var number = jQuery('#numsearch').val();
    if(number!='')
	{
        number = number.replace(/[^-a-zA-Z0-9.]+/g, '');
        location = '/part-search/'+number;
    }
};
function MobileSearchNumber()
{
    var number = jQuery('#mobsearch').val();
    if(number!='')
	{
        number = number.replace(/[^-a-zA-Z0-9.]+/g, '');
		location = '/part-search/'+number;
    }
};
///////////////////garage
function deletegarage(vin)
{
	const route = '/garage/deletegarage';
	$.ajax({
		url: route,
		type: 'POST',
		data: {vin: vin},
		success:function(data)
		{
			location.reload();
		}
	});
};
function addtogarage()
{
	const route = '/garage/togarage';
	const id  = $('[name="manufacturer"]').val();
	const year = $('[name="year"]').val();
	const model = $('[name="model"]').val();
	const type = $('[name="modification"]').val();
	const vin = $('[name="vin"]').val();
	
	$.ajax({
		url: route,
		type: 'POST',
		data: { id:id,year:year,model:model,type:type,vin:vin},
		success:function(data)
		{
			location.reload();
		}
	});
};
//finder
// document.addEventListener("DOMContentLoaded", () => 
// {
// 	$('[name="group"]').on("change", function(e)
// 	{
// 		$.ajax({
// 			url: '/finder/manufacturers',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: { group: $('[name="group"]').val()},
// 			success:function(data)
// 			{
// 				$('[name="manufacturer"]').html('');
// 				var html="";
// 				html += '<option value="none">Select Brand</option>';
// 				for(var i = 0; i < data.length; i++)
// 				{
// 					html += '<option value="'+data[i].id+'">'+data[i].manufacturer+'</option>';
// 				}
// 				$('[name="manufacturer"]').append(html)
// 			},
// 			error: function(xhr, textStatus, thrownError)
// 			{
// 				alert(xhr.status);
// 				alert(thrownError);
// 			}
// 		});
// 	});
// 	$('[name="manufacturer"]').on("change", function(e)
// 	{
// 		$.ajax({
// 			url: '/finder/models',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val()},
// 			success:function(data)
// 			{
// 				$('[name="model"]').html('');
// 				var html="";
// 				html += '<option value="none">Select Model</option>';
// 				for(var i = 0; i < data.length; i++)
// 				{
// 					html += '<option value="'+data[i].id+'">'+data[i].model+'</option>';
// 				}
// 				$('[name="model"]').append(html)
// 			},
// 			error: function(xhr, textStatus, thrownError)
// 			{
// 				alert(xhr.status);
// 				alert(thrownError);
// 			}
// 		});
// 	});
// 	$('[name="model"]').on("change", function(e)
// 	{
// 		$.ajax({
// 			url: '/finder/modifications',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val(), model_id: $('[name="model"]').val()},
// 			success:function(data){
// 				$('[name="modification"]').html('');
// 				var html="";
// 				html += '<option value="none">Select Engine</option>';
// 				for(var i = 0; i < data.length; i++)
// 				{
// 					html += '<option value="'+data[i].id+'">'+data[i].text+' ('+data[i].kW+' kW) '+' '+data[i].eng_code+' '+'</option>';
// 				}
// 				$('[name="modification"]').append(html)
// 			},
// 			error: function(xhr, textStatus, thrownError)
// 			{
// 				alert(xhr.status);
// 				alert(thrownError);
// 			}
// 		});
// 	});
// 	$('[name="modification"]').on("change", function(e)
// 	{
// 		$.ajax({
// 			url: '/finder/sections',
// 			type: 'POST',
// 			dataType: 'json',
// 			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val(), model_id: $('[name="model"]').val(), modification_id: $('[name="modification"]').val()},
// 			success:function(data){
// 				$('[name="section"]').html('');
// 				var html="";
// 				html += '<option value="none">Select Section</option>';
// 				for(var i = 0; i < data.length; i++)
// 				{
// 					html += '<option value="'+data[i].id+'"><strong>'+data[i].text+'</strong></option>';
// 				}
// 				$('[name="section"]').append(html)
// 			},
// 			error: function(xhr, textStatus, thrownError)
// 			{
// 				alert(xhr.status);
// 				alert(thrownError);
// 			}
// 		});
// 	});
// });



document.addEventListener("DOMContentLoaded", () => 
{
	$('[name="group"]').on("change", function(e)
	{
		$.ajax({
			url: '/finder/groups',
			type: 'POST',
			dataType: 'json',
			data: { group: $('[name="group"]').val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				$('[name="manufacturer"]').html('');
				var html="";
				html += '<option value="none">Select '+$('[name="group"]').val()+' brand</option>';
				for(var i = 0; i < data.length; i++)
				{
					html += '<option value="'+data[i].id+'">'+data[i].manufacturer+'</option>';
				}
				$('[name="manufacturer"]').append(html)
			},
			error: function(xhr, textStatus, thrownError)
			{
				alert(xhr.status);
				alert(thrownError);
			}
		});
	});
	$('[name="manufacturer"]').on("change", function(e)
	{
		$.ajax({
			url: '/finder/models',
			type: 'POST',
			dataType: 'json',
			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				$('[name="model"]').html('');
				var html="";
				html += '<option value="none">Select model</option>';
				for(var i = 0; i < data.length; i++)
				{
					html += '<option value="'+data[i].id+'">'+data[i].model+'</option>';
				}
				$('[name="model"]').append(html)
			},
			error: function(xhr, textStatus, thrownError)
			{
				alert(xhr.status);
				alert(thrownError);
			}
		});
	});
	$('[name="model"]').on("change", function(e)
	{
		$.ajax({
			url: '/finder/modifications',
			type: 'POST',
			dataType: 'json',
			data: {group: $('[name="group"]').val(), manufacturer_id: $('[name="manufacturer"]').val(), model_id: $('[name="model"]').val()},
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			success:function(data)
			{
				$('[name="modification"]').html('');
				var html="";
				html += '<option value="none">Select Engine</option>';
				for(var i = 0; i < data.length; i++)
				{
					html += '<option value="'+data[i].id+'">'+data[i].modification+'</option>';
				}
				$('[name="modification"]').append(html)
			},
			error: function(xhr, textStatus, thrownError)
			{
				alert(xhr.status);
				alert(thrownError);
			}
		});
	});
});
