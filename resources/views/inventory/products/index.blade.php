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
                        <button type="button" class="btn btn-simple btn-sm btn-selector" id="search_product_with_crosses_button"><i class="fas fa-arrows-alt-h"></i></button>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('products.create') }}" class="btn btn-simple btn-sm btn-selector"><i class="fas fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="table-full-width table-responsive ps">
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
                <nav id="context-menu" class="context-menu">
                    <ul class="context-menu__items">
                        <li class="context-menu__item">
                            <a href="#" class="context-menu__link" data-action="View"><i class="fa fa-eye"></i> {{ __('inventory.view') }}</a>
                        </li>
                        <li class="context-menu__item">
                            <a href="#" class="context-menu__link" data-action="Edit"><i class="fa fa-edit"></i> {{ __('inventory.edit') }}</a>
                        </li>
                        <li class="context-menu__item">
                            <a href="#" class="context-menu__link" data-action="Delete"><i class="fa fa-times"></i> {{ __('inventory.delete') }}</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card" style="height:200px;position:relative;">
            <div class="card-body" style="max-height:100%;overflow:auto;">
                <div class="row">
                    <div class="col-md-2">
                        <ul class="nav nav-pills nav-pills-primary flex-column">
                            <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#stocks">{{ __('inventory.stocks') }}</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#prices">{{ __('inventory.prices') }}</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#crosses">{{ __('inventory.crosses') }}</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#provider_prices">{{ __('inventory.provider_prices') }}</a></li>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <div class="tab-content">
                            <div class="tab-pane active" id="stocks">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th scope="col">{{ __('inventory.warehouse') }}</th>
                                        <th scope="col">{{ __('inventory.stock') }}</th>
                                    </thead>
                                    <tbody name="stocksTable"></tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="prices">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th scope="col">{{ __('inventory.price_type') }}</th>
                                        <th scope="col">{{ __('inventory.price') }}</th>
                                    </thead>
                                    <tbody name="pricesTable"></tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="crosses">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th scope="col">{{ __('inventory.article') }}</th>
                                        <th scope="col">{{ __('inventory.brand') }}</th>
                                        <th scope="col">{{ __('inventory.name') }}</th>
                                        <th scope="col">{{ __('inventory.stock') }}</th>
                                        <th scope="col">{{ __('inventory.price') }}</th>
                                        <th scope="col">{{ __('inventory.description') }}</th>
                                    </thead>
                                    <tbody name="crossesTable"></tbody>
                                </table>
                            </div>
                            <div class="tab-pane" id="provider_prices">
                                <table class="table">
                                    <thead class=" text-primary">
                                        <th scope="col">{{ __('inventory.provider') }}</th>
                                        <th scope="col">{{ __('inventory.date') }}</th>
                                        <th scope="col">{{ __('inventory.day') }}</th>
                                        <th scope="col">{{ __('inventory.provider_price_type') }}</th>
                                        <th scope="col">{{ __('inventory.warehouse') }}</th>
                                        <th scope="col">{{ __('inventory.price_in') }}</th>
                                        <th scope="col">{{ __('inventory.price_out') }}</th>
                                    </thead>
                                    <tbody name="providerPricesTable"></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    // H E L P E R    F U N C T I O N S
    function clickInsideElement( e, className )
    {
        var el = e.srcElement || e.target;
        if ( el.classList.contains(className) )
        {
            return el;
        }
        else
        {
            while ( el = el.parentNode )
            {
                if ( el.classList && el.classList.contains(className) )
                {
                    return el;
                }
            }
        }
        return false;
    }
    
    // Get's exact position of event
    function getPosition(e)
    {
        var posx = 0;
        var posy = 0;
        if (!e) var e = window.event;
        
        if (e.pageX || e.pageY)
        {
            posx = e.pageX;
            posy = e.pageY;
        } else if (e.clientX || e.clientY)
        {
            posx = e.clientX + document.body.scrollLeft + document.documentElement.scrollLeft;
            posy = e.clientY + document.body.scrollTop + document.documentElement.scrollTop;
        }
        console.log(posx);
        console.log(posy);
        return {x:posx, y:posy}
    }
    // C O R E    F U N C T I O N S
    // Variables
    
    var contextMenuClassName        = "context-menu";
    var contextMenuItemClassName    = "context-menu__item";
    var contextMenuLinkClassName    = "context-menu__link";
    var contextMenuActive           = "context-menu--active";
    
    var ItemItemClassName           = "product_item";
    var ItemItemInContext;
    
    var clickCoords;
    var clickCoordsX;
    var clickCoordsY;
    
    var menu                        = document.querySelector("#context-menu");
    var menuItems                   = menu.querySelectorAll(".context-menu__item");
    var menuState                   = 0;
    var menuWidth;
    var menuHeight;
    var menuPosition;
    var menuPositionX;
    var menuPositionY;
    
    var windowWidth;
    var windowHeight;

    // Initialise our application's code
    function init()
    {
        contextListener();
        clickListener();
        keyupListener();
        resizeListener();
    }
    
    // Listens for contextmenu events
    function contextListener()
    {
       document.addEventListener("contextmenu", function(e)
       {
           ItemItemInContext = clickInsideElement( e, ItemItemClassName );
           if ( ItemItemInContext )
           {
               e.preventDefault();
               toggleMenuOn();
               positionMenu(e);
           }
           else
          {
               ItemItemInContext = null;
               toggleMenuOff();
           }
       });
    }

    // Listens for click events
    function clickListener()
    {
        document.addEventListener( "click", function(e)
        {
            var clickeElIsLink = clickInsideElement( e, contextMenuLinkClassName );
            if ( clickeElIsLink )
            {
                e.preventDefault();
                menuItemListener( clickeElIsLink );
            }
            else
            {
                var button = e.which || e.button;
                if ( button === 1 )
                {
                    toggleMenuOff();
                }
            }
        });
    }
    // Listens for keyup events
    function keyupListener()
    {
        window.onkeyup = function(e)
        {
            if ( e.keyCode === 27 )
            {
                toggleMenuOff();
            }
        }
    }
    // Window resize event listener
    function resizeListener()
    {
        window.onresize = function(e)
        {
            toggleMenuOff();
        };
    }
    // Turns the custom context menu on
    function toggleMenuOn()
    {
        if ( menuState !== 1 )
        {
            menuState = 1;
            menu.classList.add( contextMenuActive );
        }
    }
    // Turns the custom context menu off
    function toggleMenuOff()
    {
        if ( menuState !== 0 )
        {
            menuState = 0;
            menu.classList.remove( contextMenuActive );
        }
    }
    // Positions the menu properly
    
    function positionMenu(e)
    {
        clickCoords         = getPosition(e);
        clickCoordsX        = clickCoords.x;
        clickCoordsY        = clickCoords.y;
        menuWidth           = menu.offsetWidth + 4;
        menuHeight          = menu.offsetHeight + 4;
        windowWidth         = window.innerWidth;
        windowHeight        = window.innerHeight;
        
        if ( (windowWidth - clickCoordsX) < menuWidth )
        {
            menu.style.left = windowWidth - menuWidth + "px";
        }
        else
        {
            menu.style.left = clickCoordsX + "px";
        }
        if ( (windowHeight - clickCoordsY) < menuHeight )
        {
            menu.style.top = windowHeight - menuHeight + "px";
        }
        else
        {
            menu.style.top = clickCoordsY + "px";
        }
    }
    
    // Dummy action function that logs an action when a menu item link is clicked
    function menuItemListener( link )
    {
        if (link.getAttribute("data-action") == "View" )
        {
            open('/products/'+ ItemItemInContext.getAttribute("id") +'/')//, target="_blank")
        }
        if (link.getAttribute("data-action") == "Edit" )
        {
            open('/products/'+ ItemItemInContext.getAttribute("id") +'/edit')//, target="_blank")
        }
        // console.log( "Item ID - " + ItemItemInContext.getAttribute("id") + ", Item action - " + link.getAttribute("data-action"));
        toggleMenuOff();
    }
    
    
  init();

});
</script>
<style>
.context-menu {
  display: none;
  position: absolute;
  z-index: 10;
  padding: 12px 0;
  width: 240px;
  background-color: #fff;
  border: solid 1px #dfdfdf;
  box-shadow: 1px 1px 2px #cfcfcf;
}

.context-menu--active {
  display: block;
}

.context-menu__items {
  list-style: none;
  margin: 0;
  padding: 0;
}

.context-menu__item {
  display: block;
  margin-bottom: 4px;
}

.context-menu__item:last-child {
  margin-bottom: 0;
}

.context-menu__link {
  display: block;
  padding: 4px 12px;
  color: #0066aa;
  text-decoration: none;
}

.context-menu__link:hover {
  color: #fff;
  background-color: #0066aa;
}
</style>
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
                        `<tr class="product_item" id="${item.id}">
                            <td style="width: 15%;">${item.article}</a></td>
                            <td style="width: 15%;">${item.brand}</td>
                            <td style="width: 50%;"><a href="/products/${item.id}" title = "${item.description}" target="_blank">${item.name}</a></td>
                            <td style="width: 10%;">${item.stock}</td>
                            <td style="width: 10%;">${item.price}</td>
                        </tr>`;
                })
                $('[name = "productsTable"]').html(tbody)
                const rows = document.querySelectorAll('tr');
                rows.forEach(row => {
                    row.addEventListener('click', handleClick);
                    row.addEventListener('dblclick', handleDoubleClick);
                });
            },
            errors: e => {
                console.log(e)
            }
        })
    });
    
    product_search_input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) {
            search_product_button.click();
        }
    });
})

//search with crosses
document.addEventListener("DOMContentLoaded", () => 
{
    const product_search_input = document.getElementById('product_search_input');
    const search_product_with_crosses_button = document.getElementById('search_product_with_crosses_button');
    
    search_product_with_crosses_button.addEventListener('click', function() {
        
        const search = product_search_input.value;
        
        $.ajax({
            url: '/products_filter_by_search_with_crosses',
            type: 'POST',
            dataType: 'json',
            data: { search: search },
            success: response => {
                $('[name = "productsTable"]').html('');
                let tbody = ''
                response.forEach(item => {
                    tbody +=
                        `<tr class="product_item" id="${item.id}">
                            <td style="width: 15%;">${item.article}</a></td>
                            <td style="width: 15%;">${item.brand}</td>
                            <td style="width: 50%;"><a href="/products/${item.id}" title = "${item.description}" target="_blank">${item.name}</a></td>
                            <td style="width: 10%;">${item.stock}</td>
                            <td style="width: 10%;">${item.price}</td>
                        </tr>`;
                })
                $('[name = "productsTable"]').html(tbody)
                const rows = document.querySelectorAll('tr');
                rows.forEach(row => {
                    row.addEventListener('click', handleClick);
                    row.addEventListener('dblclick', handleDoubleClick);
                });
            },
            errors: e => {
                console.log(e)
            }
        })
    });
    
    product_search_input.addEventListener('keyup', function(event) {
        if (event.keyCode === 13) {
            search_product_with_crosses_button.click();
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
                    "themes" :{ "responsive": false },
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
                            html += `<tr class="product_item" id=`+data[i].id+`>`;
                            html += `<td style="width: 15%;">`+data[i].article+`</a></td>`;
                            html += `<td style="width: 15%;">`+data[i].brand+`</td>`;
                            html += `<td style="width: 50%;"><a href="/products/`+data[i].id+`" title = "`+data[i].description+`" target="_blank">`+data[i].name+`</a></td>`;
                            html += `<td style="width: 10%;">`+data[i].stock+`</td>`;
                            html += `<td style="width: 10%;">`+data[i].price+`</td>`;                                
                            html += `</tr>`;
                        }
                        $('[name="productsTable"]').append(html);

                        const rows = document.querySelectorAll('tr');
                        rows.forEach(row => {
                            row.addEventListener('click', handleClick);
                            row.addEventListener('dblclick', handleDoubleClick);
                            // row.addEventListener('contextmenu', handleContextmenu);
                        });
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

/////////////
function handleClick(event)
{
	var product_id = event.currentTarget.id;
	$.ajax({
		url: '/products/get_product_info',
		type: 'POST',
		data: {product_id:product_id},
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(response)
		{
            //stocks
			$('[name = "stocksTable"]').html('');
			var html = "";
			for(var i = 0; i < response.product_stocks.length; i++)
			{
				html += '<tr>';
				html += '<td>'+response.product_stocks[i].warehouse_name+'</td>';
				html += '<td>'+response.product_stocks[i].warehouse_stock+'</td>';
				html += '</tr>';
			}
			$('[name="stocksTable"]').append(html);

            //crosses
			$('[name = "crossesTable"]').html('');
			var html = "";
			for(var i = 0; i < response.product_crosses.length; i++)
			{
                html += '<tr>';
				html += '<td>'+response.product_crosses[i].article+'</td>';
				html += '<td>'+response.product_crosses[i].brand+'</td>';
				html += '<td>'+response.product_crosses[i].name+'</td>';
				html += '<td>'+response.product_crosses[i].stock+'</td>';
				html += '<td>'+response.product_crosses[i].price+'</td>';
				html += '<td>'+response.product_crosses[i].description+'</td>';
				html += '</tr>';
			}
			$('[name="crossesTable"]').append(html);

			$('[name = "pricesTable"]').html('');
			var html = "";
			for(var i = 0; i < response.product_prices.length; i++)
			{
                html += '<tr>';
				html += '<td>'+response.product_prices[i].price_type+' /'+response.product_prices[i].currency+'/</td>';
				html += '<td>'+response.product_prices[i].price+'</td>';
				html += '</tr>';
			}
			$('[name="pricesTable"]').append(html);

			$('[name = "providerPricesTable"]').html('');
			var html = "";
			for(var i = 0; i < response.providers_prices.length; i++)
			{
                html += '<tr>';
                html += '<td>'+response.providers_prices[i].provider+' /'+response.providers_prices[i].provider_price_type+'/</td>';
                html += '<td>'+response.providers_prices[i].date+'</td>';
                html += '<td>'+response.providers_prices[i].stock+'</td>';
                html += '<td>'+response.providers_prices[i].day+'</td>';
                html += '<td>'+response.providers_prices[i].available+'</td>';
				html += '<td>'+response.providers_prices[i].price_in+' /'+response.providers_prices[i].currency+'/</td>';
				html += '<td>'+response.providers_prices[i].price_out+'</td>';
				html += '</tr>';
			}
			$('[name="providerPricesTable"]').append(html);
		}
	});
}

function handleDoubleClick(event)
{
    open('/products/'+event.currentTarget.id+'/edit', target="_blank")
}
</script>
@endpush