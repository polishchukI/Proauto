
<div class="sidebar" data="primary">
    <!-- <div class="navbar-minimize-fixed" style="opacity: 1;">
    <button class="minimize-sidebar btn btn-link btn-just-icon">
        <i class="fas fa-ellipsis-v visible-on-sidebar-regular text-muted"></i>
        <i class="fas fa-list-ul visible-on-sidebar-mini text-muted"></i>
    </button>
</div> -->
    <div class="sidebar-wrapper">
        <ul class="nav">
            <li @if ($pageSlug == 'dashboard') class="active " @endif>
                <!--a href="route('home')"-->
                <a href="/">
                    <i class="fas fa-chart-bar"></i>
                    <p>{{ __('inventory.dashboard') }}</p>
                </a>
            </li>
            <!--admincarts-->
            <li>
                <a data-toggle="collapse" href="#admincarts" {{ $section == 'admincarts' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-shopping-cart"></i>
                    <span class="nav-link-text">{{ __('inventory.admincarts') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'admincarts' ? 'show' : '' }}" id="admincarts">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'admincarts_fullist') class="active " @endif>
                            <a href="{{ route('admincarts.index') }}">
                                <i class="fas fa-shopping-cart"></i>
                                <p>{{ __('inventory.admincarts') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'admincarts_newcart') class="active " @endif>
                            <a href="{{ route('admincarts.create') }}">
                                <i class="fas fa-cart-plus"></i>
                                <p>{{ __('inventory.new_admincart') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--salary_management-->
            <li>
                <a data-toggle="collapse" href="#blog" {{ $section == 'blog' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-blog"></i>
                    <span class="nav-link-text">{{ __('inventory.blog') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'blog' ? 'show' : '' }}" id="blog">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'blog_posts') class="active " @endif>
                            <a href="{{ route('blog_posts.index') }}">
                                <i class="fas fa-file"></i>
                                <p>{{ __('inventory.blog_posts') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'blog_tags') class="active " @endif>
                            <a href="{{ route('blog_tags.index') }}">
                                <i class="fas fa-tags"></i>
                                <p>{{ __('inventory.blog_tags') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--salary_management-->
            <li>
                <a data-toggle="collapse" href="#salary_management" {{ $section == 'salary_management' ? 'aria-expanded=true' : '' }}>
                <i class="fas fa-piggy-bank"></i>
                    <span class="nav-link-text">{{ __('inventory.salary_management') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'salary_management' ? 'show' : '' }}" id="salary_management">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'employees') class="active " @endif>
                            <a href="{{ route('employees.index')  }}">
                                <i class="fas fa-coins"></i>
                                <p>{{ __('inventory.employees') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'payrolls') class="active " @endif>
                            <a href="{{ route('payrolls.index')  }}">
                                <i class="fas fa-coins"></i>
                                <p>{{ __('inventory.payrolls') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'salary_payments') class="active " @endif>
                            <a href="{{ route('salary_payments.index')  }}">
                                <i class="fas fa-money-check-alt"></i>
                                <p>{{ __('inventory.salary_payments') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--shop_settings>
            <li>
                <a data-toggle="collapse" href="#shop_settings" {{ $section == 'shop_settings' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-store"></i>
                    <span class="nav-link-text">{{ __('inventory.shop_settings') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'shop_settings' ? 'show' : '' }}" id="shop_settings">
                    <ul class="nav pl-4">

                    </ul>
                </div>
            </li-->
            <!--transactions-->
            <li>
                <a data-toggle="collapse" href="#transactions" {{ $section == 'transactions' ? 'aria-expanded=true' : '' }}>
                <i class="fas fa-piggy-bank"></i>
                    <span class="nav-link-text">{{ __('inventory.transactions') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'transactions' ? 'show' : '' }}" id="transactions">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'transactions') class="active " @endif>
                            <a href="{{ route('transactions.index')  }}">
                                <i class="fas fa-list-ul"></i>
                                <p>{{ __('inventory.all_transactions') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'expenses') class="active " @endif>
                            <a href="{{ route('transactions.type', ['type' => 'expense'])  }}">
                                <i class="fas fa-coins"></i>
                                <p>{{ __('inventory.expenses') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'incomes') class="active " @endif>
                            <a href="{{ route('transactions.type', ['type' => 'income'])  }}">
                                <i class="fas fa-money-check-alt"></i>
                                <p>{{ __('inventory.income') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'transfers') class="active " @endif>
                            <a href="{{ route('transfer.index')  }}">
                            <i class="fas fa-exchange-alt"></i>
                                <p>{{ __('inventory.transfers') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'payments') class="active " @endif>
                            <a href="{{ route('transactions.type', ['type' => 'payment'])  }}">
                                <i class="far fa-money-bill-alt"></i>
                                <p>{{ __('inventory.payments') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'methods') class="active " @endif>
                            <a href="{{ route('methods.index') }}">
                                <i class="fas fa-wallet"></i>
                                <p>{{ __('inventory.methods_accounts') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'coupons') class="active " @endif>
                            <a href="{{ route('coupons.index')  }}">
                                <i class="fas fa-ticket-alt"></i>
                                <p>{{ __('inventory.coupons') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--inventory-->
            <li>
                <a data-toggle="collapse" href="#inventory" {{ $section == 'inventory' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-box-open"></i>
                    <span class="nav-link-text">{{ __('inventory.inventory') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'inventory' ? 'show' : '' }}" id="inventory">
                    <ul class="nav pl-4">
                        <!-- products multilevel -->
                        <li @if ($pageSlug == 'products') class="active " @endif>
                            <a data-toggle="collapse" aria-expanded="false" href="#multicollapseProducts" class="collapsed">
                                <span class="sidebar-normal"><i class="fas fa-boxes"></i>{{ __('inventory.products') }}
                                    <b class="caret"></b>
                                </span>
                            </a>
                            <div class="collapse" id="multicollapseProducts" style="">
                                <ul class="nav">
									<li @if ($pageSlug == 'products') class="active " @endif>
										<a href="{{ route('products.index') }}">
											<i class="fas fa-boxes"></i>
											<p>{{ __('inventory.products') }}</p>
										</a>
									</li>
									<li @if ($pageSlug == 'product_price_groups') class="active " @endif>
										<a href="{{route('product_price_groups.index')}}">
										<i class="fas fa-tags"></i>
											<p>{{ __('inventory.product_price_groups') }}</p>
										</a>
									</li>
									<li @if ($pageSlug == 'product_categories') class="active " @endif>
										<a href="{{route('product_categories.index')}}">
										<i class="fas fa-tags"></i>
											<p>{{ __('inventory.productcategories') }}</p>
										</a>
									</li>
                                    <li @if ($pageSlug == 'product_stocks_manager') class="active " @endif>
                                        <a href="{{ route('product.stocks.manager') }}">
                                            <i class="fas fa-boxes"></i>
                                            <p>{{ __('inventory.product_stocks_manager') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'product_crosses_manager') class="active " @endif>
                                        <a href="{{ route('product.crosses.manager') }}">
                                            <i class="fas fa-boxes"></i>
                                            <p>{{ __('inventory.product_crosses_manager') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <!-- brands multilevel -->
                        <li @if ($pageSlug == 'brands') class="active " @endif>
                            <a data-toggle="collapse" aria-expanded="false" href="#multicollapseBrands" class="collapsed">
                                <span class="sidebar-normal"><i class="far fa-copyright"></i>{{ __('inventory.brands') }}
                                    <b class="caret"></b>
                                </span>
                            </a>
                            <div class="collapse" id="multicollapseBrands" style="">
                                <ul class="nav">
                                    <li @if ($pageSlug == 'brands') class="active " @endif>
                                        <a href="{{ route('brands.index') }}">
                                            <i class="far fa-copyright"></i><p>{{ __('inventory.brands') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'new_brand') class="active " @endif>
                                        <a href="{{ route('brands.create') }}">
                                        <i class="fas fa-plus"></i><p>{{ __('inventory.new_brand') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'brand_renames') class="active " @endif>
                                        <a href="{{ route('brand_renames.index') }}">
                                            <i class="fas fa-exchange-alt"></i><p>{{ __('inventory.brand_renames') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li @if ($pageSlug == 'currencies') class="active " @endif>
                            <a href="{{ route('currencies.index') }}">
                                <i class="fas fa-euro-sign"></i>
                                <p>{{ __('inventory.currencies') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'warehouses') class="active " @endif>
                            <a href="{{ route('warehouses.index') }}">
                            <i class="fas fa-warehouse"></i>
                                <p>{{ __('inventory.warehouses') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
			<!--documents-->
            <li>
                <a data-toggle="collapse" href="#documents" {{ $section == 'documents' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-folder-open"></i>
                    <span class="nav-link-text">{{ __('inventory.documents') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'documents' ? 'show' : '' }}" id="documents">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'receipts') class="active " @endif>
                            <a href="{{ route('receipts.index') }}">
                                <i class="fas fa-receipt"></i>
                                <p>{{ __('inventory.receipts') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'to_provider_orders') class="active " @endif>
                            <a href="{{ route('to_provider_orders.index') }}">
                                <i class="fas fa-file-upload"></i>
                                <p>{{ __('inventory.to_provider_orders') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'returns_to_provider') class="active " @endif>
                            <a href="{{ route('returns_to_provider.index')  }}">
                                <i class="fas fa-redo"></i>
                                <p>{{ __('inventory.returns_to_provider') }}</p>
                            </a>
                        </li>                                    
                        <li @if ($pageSlug == 'sales') class="active " @endif>
                            <a href="{{ route('sales.index')  }}">
                                <i class="fas fa-file-invoice"></i>
                                <p>{{ __('inventory.sales') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'client_orders') class="active " @endif>
                            <a href="{{ route('client_orders.index')  }}">
                                <i class="fas fa-file-download"></i>
                                <p>{{ __('inventory.client_orders') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'online_client_orders') class="active " @endif>
                            <a href="{{ route('online_client_orders.index')  }}">
                                <i class="fas fa-file-word"></i>
                                <p>{{ __('inventory.online_client_orders') }}</p>
                            </a>
                        </li>
						<li @if ($pageSlug == 'repair_orders') class="active " @endif>
                            <a href="{{ route('repair_orders.index') }}">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <p>{{ __('inventory.repair_orders') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'returns_from_the_client') class="active " @endif>
                            <a href="{{ route('returns_from_the_client.index')  }}">
                                <i class="fas fa-undo"></i>
                                <p>{{ __('inventory.returns_from_the_client') }}</p>
                            </a>
                        </li>

						<li @if ($pageSlug == 'order_statuses') class="active " @endif>
                            <a href="{{ route('order_statuses.index') }}">
                                <i class="fas fa-tag"></i>
                                <p>{{ __('inventory.orderstatuses') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--services-->
            <li>
                <a data-toggle="collapse" href="#services" {{ $section == 'services' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-folder-open"></i>
                    <span class="nav-link-text">{{ __('inventory.services') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'services' ? 'show' : '' }}" id="services">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'services_receipts') class="active " @endif>
                            <a href="{{ route('services_receipts.index') }}">
                                <i class="fas fa-receipt"></i>
                                <p>{{ __('inventory.services_receipts') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'services_sales') class="active " @endif>
                            <a href="{{ route('services_sales.index')  }}">
                                <i class="fas fa-file-invoice"></i>
                                <p>{{ __('inventory.services_sales') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'services') class="active " @endif>
                            <a href="{{ route('services.index')  }}">
                                <i class="fas fa-sort-amount-down-alt"></i>
                                <p>{{ __('inventory.services') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
			<!--contragents-->
            <li>
                <a data-toggle="collapse" href="#contragents" {{ $section == 'contragents' ? 'aria-expanded=true' : '' }}>
                    <i class="far fa-user"></i>
                    <span class="nav-link-text">{{ __('inventory.contragents') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'contragents' ? 'show' : '' }}" id="contragents">
                    <ul class="nav pl-4">

                        <!-- contragents multilevel -->
                        <li @if ($pageSlug == 'clients') class="active " @endif>
                            <a data-toggle="collapse" aria-expanded="false" href="#multicollapseClients" class="collapsed">
                                <span class="sidebar-normal"><i class="far fa-copyright"></i>{{ __('inventory.clients') }}
                                    <b class="caret"></b>
                                </span>
                            </a>
                            <div class="collapse" id="multicollapseClients" style="">
                                <ul class="nav">
                                <li @if ($pageSlug == 'clients-list') class="active " @endif>
                                        <a href="{{ route('clients.index')  }}">
                                        <i class="far fa-user"></i>
                                            <p>{{ __('inventory.clients') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'clients-create') class="active " @endif>
                                        <a href="{{ route('clients.create')  }}">
                                        <i class="fas fa-plus"></i>
                                            <p>{{ __('inventory.new_client') }}</p>
                                        </a>
                                    </li>
                                    <li @if ($pageSlug == 'client_autos') class="active " @endif>
                                        <a href="{{ route('client_autos.index') }}">
                                        <i class="fas fa-car-alt"></i>
                                            <p>{{ __('inventory.client_autos') }}</p>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    </ul>
					<ul class="nav pl-4">
						<li @if ($pageSlug == 'providers') class="active " @endif>
							<a href="{{ route('providers.index') }}">
                            <i class="fas fa-truck-loading"></i>
                                <p>{{ __('inventory.providers') }}</p>
							</a>
						</li>
                    </ul>
                </div>
            </li>
            <!--special-->
            <li>
                <a data-toggle="collapse" href="#special" {{ $section == 'special' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-folder-open"></i>
                    <span class="nav-link-text">{{ __('inventory.catalogue_special') }}</span>
                    <b class="caret mt-1"></b>
                </a>
                <div class="collapse {{ $section == 'special' ? 'show' : '' }}" id="special">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'tyres') class="active " @endif>
                            <a href="{{ route('special.tyres.index') }}">
                                <i class="fas fa-tag"></i>
                                <p>{{ __('inventory.tyres') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <!--users-->
            <li>
                <a data-toggle="collapse" href="#users" {{ $section == 'users' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-users"></i>
                    <span class="nav-link-text">{{ __('inventory.users') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'users' ? 'aria-expanded=true' : '' }}" id="users">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'profile') class="active " @endif>
                            <a href="{{ route('profile.edit')  }}">
                                <i class="fas fa-user-edit"></i>
                                <p>{{ __('inventory.my_profile') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-list') class="active " @endif>
                            <a href="{{ route('users.index')  }}">
                                <i class="fas fa-user-cog"></i>
                                <p>{{ __('inventory.manage_users') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'users-create') class="active " @endif>
                            <a href="{{ route('users.create')  }}">
                                <i class="fas fa-user-plus"></i>
                                <p>{{ __('inventory.new_user') }}</p>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a data-toggle="collapse" href="#inventory_settings" {{ $section == 'inventory_settings' ? 'aria-expanded=true' : '' }}>
                    <i class="fas fa-cogs"></i>
                    <span class="nav-link-text">{{ __('inventory.settings') }}</span>
                    <b class="caret mt-1"></b>
                </a>

                <div class="collapse {{ $section == 'inventory_settings' ? 'show' : '' }}" id="inventory_settings">
                    <ul class="nav pl-4">
                        <li @if ($pageSlug == 'inventory_settings') class="active " @endif>
                            <a href="{{ route('inventory_settings.index')  }}">
                                <i class="fas fa-warehouse"></i>
                                <p>{{ __('inventory.inventory_settings') }}</p>
                            </a>
                        </li>
                        <li @if ($pageSlug == 'shop_settings') class="active " @endif>
                            <a href="{{ route('shop_settings.index') }}">
                                <i class="fas fa-store"></i>
                                <p>{{ __('inventory.shop_settings') }}</p>
                            </a>
                        </li>
                    </ul>
                    
                </div>
            </li>
            <li @if ($pageSlug == 'phpinfo') class="active " @endif>
                <a href="/phpinfo">
                    <i class="fas fa-chart-bar"></i>
                    <p>{{ __('inventory.phpinfo') }}</p>
                </a>
            </li>
        </ul>
    </div>
</div>
