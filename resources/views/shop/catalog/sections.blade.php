@extends('shop.template')

@section('content')
@push('shopcss')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css" />
@endpush
<div class="site__body">
	<div class="block-header block-header--has-breadcrumb block-header--has-title">
		<div class="container">
			<div class="block-header__body">
			@include('shop.layouts.breadcrumbs')
		</div>
	</div>

<div class="container">
	<div class="card mb-4" id="garage">
		<div class="card-body card-body--padding--2">
			<h2 class="card-title">{{$ResultArray["title"]}}</h2>
			<div class="row">
				<div class="col-4">
					<div class="subsbox" style="background-image:url({{$ResultArray["car_logo_src"]}});"></div>
					<table>
						<tbody>
							<tr><td>Бренд</td><td style="text-transform: uppercase" name="brand" id="brand" value="{{$ResultArray["ubrand"]??"-"}}">{{$ResultArray["ubrand"]??"-"}}</td></tr>
							<tr><td>Модель</td><td name="model" id="model" value="{{$ResultArray["model"]??"-"}}">{{$ResultArray["model"]??"-"}}</td></tr>
							<tr><td>Модификация</td><td>{{$ResultArray["capacity"]??"-"}}</td></tr>
							<tr><td>Выпуск</td><td>{{$ResultArray["constructioninterval"]??"-"}}</tr>
							<tr><td>Привод</td><td>{{$ResultArray["drivetype"]??"-"}}</td></tr>
							<tr><td>Кузов</td><td>{{$ResultArray["bodytype"]??"-"}}</td></tr>
							<tr><td>Код двигателя</td><td style="text-transform: uppercase">{{$ResultArray["enginecode"]??"-"}}</td></tr>
							<tr><td>Объем</td><td>{{$ResultArray["capacity_technical"]??"-"}}</tr>
							<tr><td>Цилиндров</td><td>{{$ResultArray["numberofcylinders"]??"-"}}</td></tr>
							<tr><td>Клапанов</td><td>{{$ResultArray["numberofvalves"]}}</tr>
							<tr><td>Топливоподача</td><td>{{$ResultArray["fuelmixture"]??"-"}}</td></tr>
							<tr><td>Мощность</td><td>{{$ResultArray["power"]??"-"}}</td></tr>
							<tr><td>Тип топлива</td><td>{{$ResultArray["fueltype"]??"-"}}</td></tr>
						</tbody>
					</table>
				</div>
                <div class="col-8">
                    <div><b>{{ __('catalog.select_category') }}</b></div>
                    <div id="product_groups_tree"></div>
                </div>
			</div>
		</div>
	</div>
	<div class="block block-split block-split--has-sidebar">
		<div class="block-space block-space--layout--divider-nl"></div>
        <div class="container">
			<div class="block-space block-space--layout--divider-nl"></div>
			@include('shop.blog.news')
            <div class="block-space block-space--layout--divider-nl"></div>
        </div>
    </div>
</div>
@stop

<!-- push -->
@push('shopjs')
<script defer>
document.addEventListener("DOMContentLoaded", () => 
{
        "use strict";
        var tree = {!! $treeJS !!};
        var treeId = '#product_groups_tree';
        var nodeSelected = undefined;        
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
                        // so that create works
                        "check_callback" : function (operation, node, node_parent, node_position, more)
                        {
                                return true;
                        },
                        'data': tree,
                    },
                    "types" :
                    {
                        "default" :
                        {
                            "icon" : "fa fa-folder text-primary"
                        },
                        "file" :
                        {
                            "icon" : "fa fa-file text-primary"
                        }
                    },
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
                })
                .bind("select_node.jstree", function(evt, data)
                {
                    console.log(data.node.original.dbid);
                    nodeSelected = data.node.original.dbid;
                    //**//
                    var childrens_arr = data.node.original.children;
                    console.log(childrens_arr);
                    if ( childrens_array.lenght == 0)
                    {
                        var href = data.node.original.href;
                        if(href != '#'){ window.location = href; }
                    }
                    //**//
                    $("#tree-subtitle").html(data.node.text)
                })
            }
            return {
                //main function to initiate the module
                init: function ()
                {
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