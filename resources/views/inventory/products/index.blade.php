@extends('inventory.layouts.app', ['page' => __('inventory.products'), 'pageSlug' => 'products', 'section' => 'inventory', 'search' => 'products'])

@section('content')
@include('inventory.alerts.success')
@include('inventory.alerts.error')
<div class="row">
    <div class="col-md-4">
        <div class="card" style="height:600px;position:relative;">
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
        <div class="card" style="height:600px;position:relative;">
            <div class="card-header">
                <div class="row">
                    <div class="col-2"><b>{{ __('inventory.product_search') }}</b></div>
                    <div class="col-4">
                        <input type="text" autocomplete="false" id="product_search_input" name="product_search_input" class="form-control-sm">
                        <button type="button" class="btn btn-simple btn-sm btn-selector" id="search_product_button"><i class="fas fa-search"></i></button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-simple btn-sm btn-selector"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col" style="width: 15%;">{{ __('inventory.article') }}</th>
                            <th scope="col" style="width: 15%;">{{ __('inventory.brand') }}</th>
                            <th scope="col" style="width: 50%;">{{ __('inventory.product') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.stock') }}</th>
                            <th scope="col" style="width: 10%;">{{ __('inventory.price') }}</th>
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
        <div class="card" style="height:200px;position:relative;">
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive">
                    <table class="table">
                        <thead class=" text-primary">
                            <th scope="col">{{ __('inventory.article') }}</th>
                            <th scope="col">{{ __('inventory.brand') }}</th>
                            <th scope="col">{{ __('inventory.product') }}</th>
                            <th scope="col">{{ __('inventory.stock') }}</th>
                            <th scope="col">{{ __('inventory.price') }}</th>
                        </thead>
                        <tbody name="paramsTable"></tbody>
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
                            <td style="width: 50%;"><a href="/products/${item.id}" title = "${item.description}" target="_blank">${item.name}</a></td>
                            <td style="width: 10%;">${item.stock}</td>
                            <td style="width: 10%;">${item.price}</td>
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
                        "icon" : "fa fa-regular fa-folder"
                    }
                },
                // "plugins" : [ "dnd", "state", "types", "sort", "contextmenu", "search"],
                "plugins" : [ "dnd", "types", "sort", "contextmenu", "search"],
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
                },
                "contextmenu":
                {
                    "items": function ($node)
                    {
                        var tree = $(treeId).jstree(true);
                        return {
                            "Rename": {
                                "label": "@lang('jstreeedit.directory_rename')",
                                "action": function (obj)
                                { 
                                    tree.edit($node);
                                }
                            },
                            "Create": {
                                "label": "@lang('jstreeedit.directory_create')",
                                "action": function (obj)
                                { 
                                    $node = tree.create_node($node);
                                    tree.edit($node); 
                                }
                            },
                            "Delete": {
                                "label" : "@lang('jstreeedit.directory_delete')",
                                "action" : function(obj)
                                { 
                                    tree.delete_node($node);
                                }
                            }
                        };
                    }
                }
            })
            .bind("move_node.jstree", function(e, data)
            {
                var treeInst = $(treeId).jstree(true);                
                var parentNodeResult = null;
                if (data.parent != '#')
                {
                    var aux = treeInst.get_node(data.parent);
                    parentNodeResult = aux.original.dbid;
                }
                else
                {
                    parentNodeResult = '#';
                }
            
                $.ajax({
                    url: "{{ route('treeview.dnd') }}",
                    type:'POST',
                    data: {
                        "_token" : "{{ csrf_token() }}", 
                        "source": data.node.original.dbid, 
                        "destination": parentNodeResult,
                    },
                });
            })
            .bind("select_node.jstree", function(evt, data)
            {
                $.ajax({
                    url: '{{route('products.filter.by.group')}}',
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
                            html += `<td style="width: 15%;">`+data[i].article+`</a></td>`;
                            html += `<td style="width: 15%;">`+data[i].brand+`</td>`;
                            html += `<td style="width: 50%;"><a href="/products/`+data[i].id+`" title = "`+data[i].description+`" target="_blank">`+data[i].name+`</a></td>`;
                            html += `<td style="width: 10%;">`+data[i].stock+`</td>`;
                            html += `<td style="width: 10%;">`+data[i].price+`</td>`;                                
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
            .bind("rename_node.jstree", function (e, data)
            {    
                if (data.node.text && data.text != data.old) {    
                    $.ajax({
                        url: "{{ route('treeview.rename') }}",
                        type:'POST',
                        data: {
                            "_token" : "{{ csrf_token() }}", 
                            "dbid": data.node.original.dbid, 
                            "name": data.text,
                        },
                        success: function(data) {
                            toastr.success('@lang("jstreeedit.success_message")', '@lang("jstreeedit.success_title")');
                        },
                        error: function(data) {
                            toastr.error('@lang("jstreeedit.error_required")', '@lang("jstreeedit.error_title")');
                        }
                    });
                }    
            })
            .bind("create_node.jstree", function (e, data) {    
                var treeInst = $(treeId).jstree(true)
                var parentNode = treeInst.get_node(data.parent)
                $.ajax({
                    url: "{{ route('treeview.create') }}",
                    type:'POST',
                    data: {
                        "_token" : "{{ csrf_token() }}",
                        "dbid": data.node.original.dbid,
                        "parentid": parentNode.original.dbid, 
                        "name": data.node.text,
                    },
                    success: function(response) {
                        data.node.original = { "dbid" : response.id };
                    },
                    error: function(response) {
                        toastr.error('@lang("jstreeedit.error_message")', '@lang("jstreeedit.error_title")');
                    }
                });
            })
            .bind("delete_node.jstree", function (e, data) {
                $.ajax({
                    url: "{{ route('treeview.delete') }}",
                    type:'POST',
                    data: {
                        "_token" : "{{ csrf_token() }}", 
                        "id": data.node.original.dbid, 
                    },
                    success: function(data) {
                        toastr.success('@lang("jstreeedit.success_message")', '@lang("jstreeedit.success_title")');
                    },
                    error: function(data) {
                        toastr.error('@lang("jstreeedit.error_message")', '@lang("jstreeedit.error_title")');
                    }
                });
            });
        }
        return {
            init: function () {
                initiate_tree();
            }
        };
    }();        
    jQuery(document).ready(function() {
        KTTreeview.init();
    });
});
</script>
@endpush