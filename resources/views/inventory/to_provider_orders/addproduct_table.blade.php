@extends('inventory.layouts.app', ['page' =>  __('inventory.product_selector'), 'pageSlug' => 'to_provider_orders', 'section' => 'documents', 'search' => 'to_provider_orders'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="height:500px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-3"><b>{{ __('inventory.tree_search') }}</b></div>
                    <div class="col-9">
                        <input type="text" autocomplete="false" id="tree_search_input" name="tree_search_input" class="form-control-sm" />
                        <button type="button" class="btn btn-simple btn-sm btn-selector" id="search_tree_button"><i class="fas fa-search"></i></button>
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
                    <div class="col-2"><b>{{ __('inventory.product_search') }}</b></div>
                    <div class="col-4">
                        <input type="text" autocomplete="false" id="product_search_input" name="product_search_input" class="form-control-sm">
                        <button type="button" class="btn btn-simple btn-sm btn-selector" id="search_product_button"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('to_provider_orders.show', ['to_provider_order' => $to_provider_order]) }}" class="btn btn-simple btn-sm text-info"><i class="fas fa-arrow-left"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                        <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 25%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.stock') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.price') }}</th>
                            <th scope="col" style="width: 15%;"></th>
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
                        @foreach ($to_provider_order->products as $item)
                            <tr id="to_provider_order_selected_product-{{ $item->product_id }}" class="pointer" ondblclick="to_provider_order_edit_product('{{$to_provider_order->id}}','{{ $item->product_id }}');">
                                <td scope="col" class="article">{{ $item->product->article }}</td>
                                <td scope="col" class="brand">{{ $item->product->brand }}</td>
                                <td scope="col" class="name">{{ $item->product->name }}</td>
                                <td scope="col" class="text-center stock">{{ $item->stock ?? 0}}</td>
                                <td scope="col" class="text-center quantity">{{ $item->quantity }}</td>
                                <td scope="col" class="text-center price">{{ $item->price }}</td>
                                <td scope="col" class="text-center total_amount">{{ $item->total_amount }}</td>
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
    const product_search_input = document.getElementById('product_search_input');
    const search_product_button = document.getElementById('search_product_button');
    
    search_product_button.addEventListener('click', function() {
        
        const search = product_search_input.value;
        
        $.ajax({
            url: '/products_filter_by_search',
            type: 'POST',
            dataType: 'json',
            data: { search: search },
            success: response => {
                $('[name = "productsTable"]').html('');
                let tbody = ''
                response.forEach(item => {
                    tbody +=
                        `<tr><td style="width: 15%;">${item.article}</a></td>
                            <td style="width: 15%;">${item.brand}</td>
                            <td style="width: 40%;"><a href="/products/${item.id}" title = "${item.description}" target="_blank">${item.name}</a></td>
                            <td style="width: 15%;">${item.stock}</td>
                            <td style="width: 15%;">${item.price}</td>
                            <td><button type="button" class="btn btn-simple btn-sm btn-selector" id="${item.id}" OnClick="to_provider_order_add_product('`+{{$to_provider_order->id}}+`','${item.id}')"><i class="fas fa-check-double"></i></button></td>
                            </tr>`;
                })
                $('[name = "productsTable"]').html(tbody)
            },
            errors: e => {
                console.log(e)
            }
        })
        console.log(`Searching for "${search}"...`);
    });
    
    product_search_input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) {
            search_product_button.click();
        }
    });
})

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

    tree_search_input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) {
            searchButton.click();
        }
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
                        "icon" : "fa fa-regular fa-file"
                    }
                },

                "plugins" : ["types", "sort", "search"],
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
                    url: '{{route('to_provider_orders.products.filter.by.group')}}',
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
                            html += `<td><a href="/products/`+data[i].id+`" target="_blank">`+data[i].name+`</a></td>`;
                            html += `<td>`+data[i].stock+`</td>`;
                            html += `<td>`+data[i].price+`</td>`;
                            html += `<td><button type="button" class="btn btn-simple btn-sm btn-selector" id="`+data[i].id+`" OnClick="to_provider_order_add_product('`+{{$to_provider_order->id}}+`','`+data[i].id+`')"><i class="fas fa-check-double"></i></button></td>`;
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
