@extends('inventory.layouts.app', ['page' =>  __('inventory.product_selector'), 'pageSlug' => 'client_orders', 'section' => 'documents', 'search' => 'client_orders'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <input type="search" id="tree_search_input" name="tree_search_input" class="form-control-sm" />
                        <button type="button" class="btn btn-link btn-sm text-success" id="search_tree_button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <div id="product_groups_tree"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-8">
                        <h4 class="card-title">{{ __('inventory.product_list') }}</h4>
                    </div>
                    <div class="col-4 text-right">
                        <a href="{{ route('client_orders.show', ['client_order' => $client_order]) }}" class="btn btn-simple btn-sm text-info"><i class="fas fa-arrow-left"></i>{{ __('inventory.back_to_document') }}</a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.stock') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.price') }}</th>
                        </thead>
                        <tbody name="productsTable"></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card" style="height:250px;position:relative;">
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive" id="selectedProductsTable">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 40%;">{{ __('inventory.product') }}</th>
                            <th scope="col text-center" style="width: 5%;">{{ __('inventory.stock') }}</th>
                            <th scope="col text-center" style="width: 5%;">{{ __('inventory.quantity') }}</th>
                            <th scope="col text-center" style="width: 10%;">{{ __('inventory.price') }}</th>
                            <th scope="col text-center" style="width: 10%;">{{ __('inventory.total') }}</th>
                        </thead>
                        <tbody>
                        @foreach ($client_order->products as $item)
                            <tr id="client_order_selected_product-{{ $item->product_id }}" class="pointer" onclick="client_order_edit_product('{{$client_order->id}}','{{ $item->product_id }}');">
                                <td scope="col" class="article">
                                    {{ $item->product->article }}
                                </td>
                                <td scope="col" class="brand">
                                    {{ $item->product->brand }}
                                </td>
                                <td scope="col" class="name">
                                    {{ $item->product->name }}
                                </td>
                                <td scope="col" class="text-center stock">
                                    {{ $item->stock ?? 0}}
                                </td>
                                <td scope="col" class="text-center quantity">
                                    {{ $item->quantity }}
                                </td>
                                <td scope="col" class="text-center price">
                                    {{ $item->price }}
                                </td>
                                <td scope="col" class="text-center total_amount">
                                    {{ $item->total_amount }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script defer>
document.addEventListener("DOMContentLoaded", () => 
{
    "use strict";
    var tree = {!! $treeJS !!};
    var treeId = '#product_groups_tree';
    var nodeSelected = undefined;

    const searchButton = document.getElementById('search_tree_button');
    const searchInput = document.getElementById('tree_search_input');
    searchButton.addEventListener('click', () => {
        const inputValue = searchInput.value;
        $(treeId).jstree("search",inputValue);
    });
    var KTTreeview = function ()
    {
        var initiate_tree = function()
        {
            $(treeId).jstree({
                "core" : {
                    "themes" :
                    {
                        "responsive": false
                    },
                    "check_callback" : function (operation, node, node_parent, node_position, more)
                    {
                        if (operation === 'delete_node')
                        {
                            if (confirm('@lang("jstreeedit.confirmation_title")') == true)
                            {
                                return true;
                            }
                            else
                            {
                                return false;
                            }
                        }
                        else
                        {
                            return true;
                        }
                    },
                    'data': tree,
                },
                "types" :
                {
					"default" :
                    {
                        "icon" : "fa fa-regular fa-folder"
                    },
                    "file" :
                    {
                        "icon" : "fa fa-regular fa-folder"
                    }
                },

                "plugins" : ["state", "types", "sort", "search"],
                "sort" : function(a, b)
                {                
                    if (a && b && this)
                    {
                        var a1 = this.get_node(a);
                        var b1 = this.get_node(b);
                        if (a1.icon == b1.icon)
                        {
                            return a1.text.toLowerCase().localeCompare(b1.text.toLowerCase());
                        }
                        else
                        {
                            return a1.icon.toLowerCase().localeCompare(b1.icon.toLowerCase());
                        }
                    }
                }
            })
            .bind("select_node.jstree", function(evt, data)
            {
                console.log(data.node.original.dbid);
                $.ajax({
                    url: '{{route('client_orders.products.filter.by.group')}}',
                    type: 'POST',
                    data: {selected_group:data.node.original.dbid},
                    dataType: 'json',
                    headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
                    success:function(data)
                    {
                        $('[name = "productsTable"]').html('');
                        var html = "";
                        for(var i = 0; i < data.length; i++)
                        {
                            html += `<tr>`;
                            html += `<td>`+data[i].article+`</td>`;
                            html += `<td>`+data[i].brand+`</td>`;
                            html += `<td>`;
                            html +=`<a href="/products/`+data[i].id+`" target="_blank" class="btn btn-link text-info" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.edit') }}">`;
                            html += data[i].name;
                            html += `</a></td>`;
                            html += `<td>`+data[i].stock+`</td>`;
                            html += `<td>`+data[i].price+`</td>`;
                            html += `<td><button type="button" class="btn btn-link btn-sm text-success" id="`+data[i].id+`" OnClick="client_order_add_product('`+{{$client_order->id}}+`','`+data[i].id+`')"><i class="fas fa-check-double"></i></button></td>`;
                            html += `</tr>`;
                        }
                        $('[name="productsTable"]').append(html)
                    },
                    error: function(xhr, textStatus, thrownError)
                    {
                        alert(xhr.status);alert(thrownError);
                    }
                });
                nodeSelected = data.node;
                $("#tree-subtitle").html(data.node.text)
            })
        }
        return {
            init: function () {
                initiate_tree();
            }
        };
    }();        
    jQuery(document).ready(function()
    {
        KTTreeview.init();
    });
});
</script>
@endpush
