@extends('inventory.layouts.app', ['page' => 'Product group Information', 'pageSlug' => 'product_groups', 'section' => 'inventory', 'search' => 'product_groups'])

@section('content')
@push('admincss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush
<div class="row">
    <div class="col-md-4" style="height:592px;position:relative;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Search</h4>
                    </div>
                    <div class="col-6">
                        <input type="text" id="tree_search_input" value="" class="input" style="margin:0em auto 1em auto; display:block; padding:4px; border-radius:4px; border:1px solid silver;">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-full-width table-responsive">
                    <div id="product_groups_tree"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8" style="height:592px;position:relative;">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h4 class="card-title">Products</h4>
                    </div>
                    <div class="col-6">
                        
                    </div>
                </div>
            </div>
            <div class="card-body">
                    <div class="table-full-width table-responsive">
                        <table class="table">
                            <thead class=" text-primary">
                                <th scope="col">Article</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Product</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Base Price</th>
                            </thead>
                            <tbody name="productsTable"></tbody>
                        </table>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/jstree.min.js"></script>
<script>
	$( document ).ready(function()
	{
        "use strict";
        var tree = {!! $treeJS !!};
        var treeId = '#product_groups_tree';
        var nodeSelected = undefined;
        var to = false;//search
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
                    "plugins" : [ "dnd", "state", "types", "sort", "contextmenu", "search"],
                   //search
                   "search" : function()
                    {
                        $('#tree_search_input').keyup(function ()
                        {
                            if(to)
                            {
                                clearTimeout(to);
                            }
                            to = setTimeout(function ()
                            {
                                var v = $('#tree_search_input').val();
                                $(treeId).jstree(true).search(v);
                            }, 250);
                        });
                    },
                   //search
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
                    if (data.parent != '#') {
                        var aux = treeInst.get_node(data.parent);
                        parentNodeResult = aux.original.dbid;
                    } else {
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
                        success: function(data)
                        {
                            console.log(data);
                        }
                    });
                })
                .bind("select_node.jstree", function(evt, data)
                {
                    console.log(data.node.original.dbid);
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
                                html += `<td>`+data[i].article+`</td>`;
                                html += `<td>`+data[i].brand+`</td>`;
                                html += `<td>`+data[i].name+`</td>`;
                                html += `<td>`+data[i].stock+`</td>`;
                                html += `<td>`+data[i].price+`</td>`;
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
                            // "id": dbid,//create test
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