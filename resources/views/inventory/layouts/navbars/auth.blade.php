<!-- <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent"> -->
<nav class="navbar navbar-expand-lg navbar-absolute bg-dark">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
                <button type="button" class="navbar-toggler">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </button>
            </div>
            <a class="navbar-brand" href="#">{{ $page ?? __('Dashboard') }}</a>
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
        </button>
        <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
                <li class="search-bar input-group">
                    <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="fas fa-search"></i>
                        <span class="d-lg-none d-md-block">{{ __('Search') }}</span>
                    </button>
                </li>
                <li class="nav-item">
                    <div class="togglebutton switch-change-color mt-2">
                        <input type="checkbox" name="checkbox" {{ (auth()->user()->white_color != 'false') ? '' : 'checked=""' }} class="bootstrap-switch" data-on-label="Dark" data-off-label="White">
                    </div>                    
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('receipts.create') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.new_receipt') }}"><i class="fas fa-receipt"></i></a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('sales.create') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.new_sale') }}"><i class="fas fa-file-invoice"></i></a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('client_orders.create') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.new_client_order') }}"><i class="fas fa-file-download"></i></a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('to_provider_orders.create') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.new_to_provider_order') }}"><i class="fas fa-file-upload"></i></a>
                </li>
                <li class="nav-item mt-2">
                    <a href="{{ route('admincarts.create') }}" data-toggle="tooltip" data-placement="bottom" title="{{ __('inventory.new_admincart') }}"><i class="fas fa-cart-plus"></i></a>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="q_s_menu d-none d-lg-block d-xl-block"></div>
                        <i class="fas fa-flag-checkered"></i>
                        <p class="d-lg-none">{{ __('inventory.reports') }}</p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                        <li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('transactions.transaction_statistics_report')  }}">
                                <i class="fas fa-chart-pie"></i>{{ __('inventory.transaction_statistics_report') }}
                            </a>
                        </li>
                        <li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('inventory.inventory_report')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.inventory_report') }}
							</a>
                        </li>
                        <li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('product.stocks_report')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.product_stocks_report') }}
							</a>
                        </li>
                        <li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('kpi.stats')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.kpi_stats_report') }}
							</a>
                        </li>
						<li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('sales.by.categories')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.sales_by_categories_report') }}
							</a>
                        </li>
						<li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('sales.by.products')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.sales_by_products_report') }}
							</a>
                        </li>
                        <li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('profit.by.sales')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.profit_by_sales') }}
							</a>
                        </li>
                        <li class="nav-link">
							<a class="nav-item dropdown-item text-info" href="{{ route('sales.by.clients')  }}">
                                <i class="fas fa-clipboard-list"></i>{{ __('inventory.sales_by_clients') }}
							</a>
                        </li>
                    </ul>
                </li>
                <!--  -->
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="notification d-none d-lg-block d-xl-block"></div>
                        <i class="fas fa-wave-square"></i>
                        <p class="d-lg-none"> {{ __('inventory.notifications') }} </p>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right dropdown-navbar">
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('Mike John responded to your email') }}</a>
                        </li>
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('You have 5 more tasks') }}</a>
                        </li>
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('Your friend Michael is in town') }}</a>
                        </li>
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('Another notification') }}</a>
                        </li>
                        <li class="nav-link">
                            <a href="#" class="nav-item dropdown-item">{{ __('Another one') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown nav-item">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <div class="photo">
                            <img src="{{ asset('assets/img/admin.jpg') }}" alt="{{ __('Profile Photo') }}">
                        </div>
                        <b class="caret d-none d-lg-block d-xl-block"></b>
                        <p class="d-lg-none">{{ __('Log out') }}</p>
                    </a>
                    <ul class="dropdown-menu dropdown-navbar">
                        <li class="nav-link">
                            <a href="{{ route('profile.edit') }}" class="nav-item dropdown-item">{{ __('Profile') }}</a>
                        </li>
                        <li class="dropdown-divider"></li>
                        <li class="nav-link">
                            <a href="{{ route('logout') }}" class="nav-item dropdown-item" onclick="event.preventDefault();  document.getElementById('logout-form').submit();">{{ __('Log out') }}</a>
                        </li>
                    </ul>
                </li>
                <li class="separator d-lg-none"></li>
            </ul>
        </div>
    </div>
</nav>
<div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="{{ __('Search') }}" data-type='{{ $search }}'>
                <button type="button" class="close" data-dismiss="modal" aria-label="{{ __('Close') }}">
                    <i class="fas fa-times"></i>
              </button>
            </div>
        </div>
    </div>
</div>
