<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::routes();
$domain       = env('APP_DOMAIN', 'proauto.shop');
$admin_domain = env('APP_ADMIN_DOMAIN', 'inventory.proauto.shop');

Route::domain($admin_domain)->group(function ()
{
	Route::get('/',																												'Inventory\HomeController@index')->name('home')->middleware('auth');
	Route::get('/phpinfo',																										'Inventory\HomeController@phpinfo')->name('phpinfo')->middleware('auth');

	Route::get('/login',																										['as' => 'admin.login',	'uses' => 'Auth\LoginController@ShowLoginPage']);
	Route::post('login',																										['as' => 'login.send', 'uses' => 'Auth\LoginController@login']);
	 
	Route::group(['middleware' => 'auth'], function ()
	{
		Route::post('logout',																									['as' => 'admin.logout','uses' => 'Auth\LoginController@logout']);
  
		Route::get('profile',																									['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
		Route::post('changeTheme',																								['as' => 'change.theme', 'uses' => 'ProfileController@changeTheme']);
		Route::match(['put', 'patch'], 'profile',																				['as' => 'profile.update', 'uses' => 'ProfileController@update']);
		Route::match(['put', 'patch'], 'profile/password',																		['as' => 'profile.password', 'uses' => 'ProfileController@password']);
		Route::resource('/inventory_settings',																					'Inventory\InventorySettingsController')->except(['show']);
		Route::resource('/shop_settings',																						'Shop\ShopSettingsController');
		Route::resource('/coupons',																								'Inventory\CouponsController')->except(['show']);		

		//salary_management
		Route::resource('/employees',																							'Inventory\EmployeesController')->except(['destroy']);
		Route::post('workerLiveSearch',																							['as' => 'employees.workerLiveSearch', 'uses' => 'Inventory\EmployeesController@workerLiveSearch']);
		Route::get('/employees/{employee}/fire',																				['as' => 'employees.fire', 'uses' => 'Inventory\EmployeesController@fire']);

		Route::resource('/payrolls',																							'Salary\PayrollsController')->except(['update']);//+
		Route::get('/payrolls/{payroll}/employee_selector',																		['as' => 'payrolls.employees.selector', 'uses' => 'Salary\PayrollsController@employee_selector']);//+
		Route::post('/payroll_add_employee',																					['as' => 'payrolls.add.employee', 'uses' => 'Salary\PayrollsController@payroll_add_employee']);//+
		Route::put('/payroll_add_employee_store',																				['as' => 'payrolls.add.employee.store', 'uses' => 'Salary\PayrollsController@payroll_add_employee_store']);//+
		Route::post('/payroll_edit_employee',																					['as' => 'payrolls.employee.edit', 'uses' => 'Salary\PayrollsController@payroll_edit_employee']);//+
		Route::post('/payroll_update_employee_store',																			['as' => 'payrolls.employee.update', 'uses' => 'Salary\PayrollsController@payroll_update_employee_store']);//+
		Route::delete('/payroll_delete_employee',																				['as' => 'payrolls.employee.delete', 'uses' => 'Salary\PayrollsController@payroll_delete_employee']);//+
		Route::get('/payrolls/{payroll}/clear_employees_table',																	['as' => 'payrolls.employees.clear', 'uses' => 'Salary\PayrollsController@payrolls_employees_clear']);
		Route::get('/payrolls/{payroll}/finalize',																				['as' => 'payrolls.finalize','uses'=>'Salary\PayrollsController@finalize']);
		// Route::get('/payrolls/{payroll}/salary_payment',																		['as' => 'payrolls.salary_payment','uses'=>'Salary\PayrollsController@salary_payment']);
		Route::get('/payrolls/{payroll}/print',																					['as' => 'payrolls.print','uses'=>'Salary\PayrollsController@print']);
		
		
		Route::resource('/salary_payments',																						'Salary\SalaryPaymentsController')->except(['update']);
		Route::get('/salary_payments/{salary_payment}/employee_selector',														['as' => 'salary_payments.employees.selector', 'uses' => 'Salary\SalaryPaymentsController@employee_selector']);//+
		Route::post('/salary_payment_add_employee',																				['as' => 'salary_payments.add.employee', 'uses' => 'Salary\SalaryPaymentsController@salary_payment_add_employee']);//+
		Route::put('/salary_payment_add_employee_store',																		['as' => 'salary_payments.add.employee.store', 'uses' => 'Salary\SalaryPaymentsController@salary_payment_add_employee_store']);//+
		Route::post('/salary_payment_edit_employee',																			['as' => 'salary_payments.employee.edit', 'uses' => 'Salary\SalaryPaymentsController@salary_payment_edit_employee']);//+
		Route::post('/salary_payment_update_employee_store',																	['as' => 'salary_payments.employee.update', 'uses' => 'Salary\SalaryPaymentsController@salary_payment_update_employee_store']);//+
		Route::delete('/salary_payment_delete_employee',																		['as' => 'salary_payments.employee.delete', 'uses' => 'Salary\SalaryPaymentsController@salary_payment_delete_employee']);//+
		Route::get('/salary_payments/{salary_payment}/clear_employees_table',													['as' => 'salary_payments.employees.clear', 'uses' => 'Salary\SalaryPaymentsController@salary_payments_employees_clear']);
		Route::get('/salary_payments/{salary_payment}/finalize',																['as' => 'salary_payments.finalize','uses'=>'Salary\SalaryPaymentsController@finalize']);
		Route::get('/salary_payments/{salary_payment}/print',																	['as' => 'salary_payments.print','uses'=>'Salary\SalaryPaymentsController@print']);
		Route::get('/salary_payments/{salary_payment}/pay',																		['as' => 'salary_payments.pay','uses'=>'Salary\SalaryPaymentsController@pay']);
		Route::post('/salary_payments/{salary_payment}/payment_store',															['as' => 'salary_payments.payment.store', 'uses' => 'Salary\SalaryPaymentsController@payment_store']);
		

		// ** references ** //
		Route::resource('/blog_tags',																							'Inventory\BlogTagsController')->except(['show']);
		Route::resource('/blog_posts',																							'Inventory\BlogPostController')->except(['show']);
		Route::get('blog_posts/ckeditor/create',																				['as' => 'post.ckeditor.create', 'uses' => 'CkeditorController@create']);
		Route::post('blog_posts/ckeditor',																						['as' => 'post.ckeditor.upload', 'uses' => 'CkeditorController@upload']);

		Route::resource('currencies',																							'Inventory\CurrenciesController');
		Route::post('/currencies_update',																						['as' => 'currencies.update', 'uses' => 'Inventory\CurrenciesController@currencies_update']);
		Route::resource('/order_statuses',																						'Inventory\OrdersStatusController');
		Route::resource('users',																								'UserController');
		Route::resource('/brands',																								'Brands\BrandsController')->except(['show']);
		Route::resource('/brand_renames',																						'Brands\BrandRenamesController')->except(['show']);
		Route::get('/update_bkeys',																								['as' => 'brands.bkeys', 'uses' => 'BrandsController@update_bkeys']);
		Route::get('/brands/ckeditor/create',																					['as' => 'brands.ckeditor.create', 'uses' => 'BrandsController@createforbrand']);
		Route::post('/brands/ckeditor',																							['as' => 'brands.ckeditor.upload', 'uses' => 'BrandsController@uploadfor']);
		Route::resource('/methods',																								'Inventory\MethodController');
		Route::resource('/warehouses',																							'Inventory\WarehousesController');

		Route::get('/product_crosses_manager',																					['as' => 'product.crosses.manager', 'uses' => 'Inventory\ProductCrossesManagementController@index']);
		Route::get('/product_crosses_manager/create',																			['as' => 'product.crosses.manager.create', 'uses' => 'Inventory\ProductCrossesManagementController@create']);
		Route::get('/product_crosses_manager/{cross}/show',																		['as' => 'product.crosses.manager.show', 'uses' => 'Inventory\ProductCrossesManagementController@show']);
		Route::get('/product_crosses_manager/{cross}/edit',																		['as' => 'product.crosses.manager.edit', 'uses' => 'Inventory\ProductCrossesManagementController@edit']);
		Route::get('/product_crosses_manager/{cross}/destroy',																	['as' => 'product.crosses.manager.destroy', 'uses' => 'Inventory\ProductCrossesManagementController@destroy']);
	
		// product_groups
		// Route::resource('/product_groups',																						'Inventory\ProductGroupsController')->except(['index','create','edit','delete']);//+
		Route::get('/treeview/show_tree',																						['as' => 'treeview.show_tree', 'uses' => 'Inventory\ProductGroupsController@show_tree']);
		Route::post('/treeview/dnd',																							['as' => 'treeview.dnd', 'uses' => 'Inventory\ProductGroupsController@treeviewDnd']);
		Route::post('/treeview/rename',																							['as' => 'treeview.rename', 'uses' => 'Inventory\ProductGroupsController@treeviewRename']);
		Route::post('/treeview/delete',																							['as' => 'treeview.delete', 'uses' => 'Inventory\ProductGroupsController@treeviewDelete']);
		Route::post('/treeview/create',																							['as' => 'treeview.create', 'uses' => 'Inventory\ProductGroupsController@treeviewCreate']);
		// products
		Route::resource('/products',																							'Inventory\ProductController');
		Route::post('productLiveSearch',																						['as' => 'products.productLiveSearch', 'uses' => 'Inventory\ProductController@productLiveSearch']);
		Route::get('/product_stocks_management',																				['as' => 'product.stocks.manager', 'uses' => 'Inventory\ProductController@product_stocks_management']);
		Route::post('/product_stocks_management_calculate',																		['as' => 'product.stocks.manager.calculate', 'uses' => 'Inventory\ProductController@product_stocks_management_calculate']);
		Route::post('/product_create_new_brand_store',																			['as' => 'products.create.new.brand.store', 'uses' => 'Inventory\ProductController@product_create_new_brand_store']);
		Route::post('/products_filter_by_group',																				['as' => 'products.filter.by.group', 'uses' => 'Inventory\ProductController@products_filter_by_group']);
		Route::post('/products_filter_by_search',																				['as' => 'products.filter.by.search', 'uses' => 'Inventory\ProductController@products_filter_by_search']);

		Route::post('/product_addcross',																						['as' => 'products.add.cross', 'uses' => 'Inventory\ProductController@product_addcross']);
		Route::post('/product_addcross_store',																					['as' => 'products.add.cross.store', 'uses' => 'Inventory\ProductController@product_addcross_store']);
		Route::post('/product_editcross',																						['as' => 'products.cross.edit', 'uses' => 'Inventory\ProductController@product_editcross']);
		Route::post('/product_update_cross',																					['as' => 'products.cross.update', 'uses' => 'Inventory\ProductController@product_update_cross']);
		Route::delete('/product_delete_cross',																					['as' => 'products.cross.delete', 'uses' => 'Inventory\ProductController@product_delete_cross']);
		
		//min_stock
		Route::post('/product_add_min_stock',																					['as' => 'products.add.min_stock', 'uses' => 'Inventory\ProductController@product_add_min_stock']);
		Route::put('/product_add_min_stock_store',																				['as' => 'products.add.min_stock.store', 'uses' => 'Inventory\ProductController@product_add_min_stock_store']);
		Route::post('/product_edit_min_stock',																					['as' => 'products.min_stock.edit', 'uses' => 'Inventory\ProductController@product_edit_min_stock']);
		Route::post('/product_update_min_stock',																				['as' => 'products.min_stock.update', 'uses' => 'Inventory\ProductController@product_update_min_stock']);
		Route::delete('/product_delete_min_stock',																				['as' => 'products.min_stock.delete', 'uses' => 'Inventory\ProductController@product_delete_min_stock']);
		
		
		Route::post('/update_properties',																						['as' => 'product.update.properties', 'uses' => 'Inventory\ProductController@update_properties']);
		Route::resource('/product_categories',																					'Inventory\ProductCategoryController');
		Route::resource('/product_price_groups',																				'Inventory\ProductPriceGroupController')->except(['show']);
		
		//clients
		Route::resource('clients',																								'ClientController');
		Route::post('clientLiveSearch',																							['as' => 'clients.clientLiveSearch', 'uses' => 'ClientController@clientLiveSearch']);
		
		Route::post('/clients_addphone',																						['as' => 'clients.add.phone', 'uses' => 'ClientController@addphone']);
		Route::post('/clients_addphone_store',																					['as' => 'clients.add.phone.store', 'uses' => 'ClientController@addphone_store']);
		Route::post('/clients_editphone',																						['as' => 'clients.phone.edit', 'uses' => 'ClientController@edit_phone']);
		Route::post('/clients_editphone_store',																					['as' => 'clients.phone.update', 'uses' => 'ClientController@editphone_store']);
		Route::delete('/clients_phone_delete',																					['as' => 'clients.phone.delete', 'uses' => 'ClientController@phone_delete']);
		Route::post('/clients/renewRregistrationDate',																			['as' => 'clients.renew.registration.date', 'uses' => 'ClientController@renewRregistrationDate']);
		Route::post('/clients/notifyClient',																					['as' => 'clients.notify', 'uses' => 'ClientController@notifyClient']);
		///change telephone prefix(ex. +38071 -> +7949)
		Route::post('/clients_phones_renew_settings',																			['as' => 'clients.phones.renew.settings', 'uses' => 'ClientController@phones_renew_settings']);
		Route::post('/clients/phones_renew',																					['as' => 'clients.phones.renew', 'uses' => 'ClientController@phones_renew']);
		//address
		Route::post('/clients_addaddress',																						['as' => 'clients.add.address', 'uses' => 'ClientController@addaddress']);
		Route::post('/clients_addaddress_store',																				['as' => 'clients.add.address.store', 'uses' => 'ClientController@addaddress_store']);
		Route::post('/clients_editaddress',																						['as' => 'clients.address.edit', 'uses' => 'ClientController@edit_address']);
		Route::post('/clients_address_update',																					['as' => 'clients.address.update', 'uses' => 'ClientController@address_update']);
		Route::delete('/clients_address_delete',																				['as' => 'clients.address.delete', 'uses' => 'ClientController@address_delete']);
		//autos
		Route::post('/clients/client_addauto',																					['as' => 'clients.add.auto', 'uses' => 'ClientController@client_addauto']);
		Route::post('/clients/client_delete_auto',																				['as' => 'clients.auto.delete', 'uses' => 'ClientController@client_delete_auto']);

		Route::resource('/client_autos',																						'Inventory\ClientAutosController');
		//serviceparts
		Route::post('/client_autos_servicepart_add',																			['as' => 'client_autos.servicepart.add', 'uses' => 'Inventory\ClientAutosController@servicepart_add']);
		Route::post('/client_autos_servicepart_store',																			['as' => 'client_autos.servicepart.store', 'uses' => 'Inventory\ClientAutosController@servicepart_store']);
		Route::post('/client_autos_servicepart_edit',																			['as' => 'client_autos.servicepart.edit', 'uses' => 'Inventory\ClientAutosController@servicepart_edit']);
		Route::post('/client_autos_servicepart_update',																			['as' => 'client_autos.servicepart.update', 'uses' => 'Inventory\ClientAutosController@servicepart_update']);
		Route::delete('/client_autos_servicepart_delete',																			['as' => 'client_autos.servicepart.delete', 'uses' => 'Inventory\ClientAutosController@servicepart_delete']);
		Route::post('/client_autos/servicepart_client_order_create',															['as' => 'client_autos.servicepart.client_order.create', 'uses' => 'Inventory\ClientAutosController@servicepart_client_order_create']);
		Route::post('/client_autos/servicepart_sale_create',																	['as' => 'client_autos.servicepart.sale.create', 'uses' => 'Inventory\ClientAutosController@servicepart_sale_create']);

		//transactions
		Route::resource('/transactions/transfer',																				'Inventory\TransferController');
		Route::resource('/transactions',																						'Inventory\TransactionController')->except(['create']);
		Route::get('/transactions/{type}',																						['as' => 'transactions.type', 'uses' => 'Inventory\TransactionController@type']);
		Route::get('/transactions/{type}/create',																				['as' => 'transactions.create', 'uses' => 'Inventory\TransactionController@create']);
		Route::get('/transactions/{transaction}/edit',																			['as' => 'transactions.edit', 'uses' => 'Inventory\TransactionController@edit']);

		/*catalog*/
		Route::get('/catalog',																									['as' => 'catalog', 'uses' => 'Catalog\CatalogController@GetCatalogPage']);
		// Route::get('/models_update',																							['as' => 'models.update', 'uses' => 'Catalog\CatalogController@ModelsUpdate']);
		// Route::get('/catalog/{group}',																						['as' => 'manufacturers', 'uses' => 'Catalog\ManufacturersController@GetManufacturersPage']);
		// Route::get('/catalog/{group}/{manufacturer}',																		['as' => 'models', 'uses' => 'Catalog\ModelsController@GetModelsPage']);
		// Route::get('/catalog/{group}/{manufacturer}/{model}',																['as' => 'modifications', 'uses' => 'Catalog\ModificationsController@GetModificationsPage']);

		//providers
		Route::resource('/providers',																							'Inventory\ProviderController');
		Route::post('/providers/upload_price',																					['as' => 'providers.upload_price', 'uses' => 'Inventory\ProviderController@upload_price']);
		Route::post('/providers/{id}/save_column_settings',																		['as' => 'providers.save_column_settings', 'uses' => 'Inventory\ProviderController@save_column_settings']);
		Route::post('/providers/delete_prices',																					['as' => 'providers.delete_prices', 'uses' => 'Inventory\ProviderController@delete_prices']);
		Route::post('/providers/import_price',																					['as' => 'providers.import_price', 'uses' => 'Inventory\ImportController@import_price']);
				
		// ** documents ** //
		Route::resource('/online_client_orders',																				'Inventory\OnlineClientOrdersController')->except(['create','edit','delete']);//+
		Route::get('/online_client_orders/{online_client_order}/unfinalize',													['as' => 'online_client_orders.unfinalize', 'uses' => 'Inventory\OnlineClientOrdersController@unfinalize']);
		Route::get('/online_client_orders/{online_client_order}/print',															['as' => 'online_client_orders.print', 'uses' => 'Inventory\OnlineClientOrdersController@print_online_client_order']);//+
		Route::get('/online_client_orders/{online_client_order}/pay',															['as' => 'online_client_orders.pay', 'uses' => 'Inventory\OnlineClientOrdersController@pay_online_client_order']);//payment to provider
		Route::get('/online_client_orders/{online_client_order}/client_order',													['as' => 'online_client_orders.client_order', 'uses' => 'Inventory\OnlineClientOrdersController@client_order']);//payment to provider
		Route::get('/online_client_orders/{online_client_order}/clear_products_table',											['as' => 'online_client_orders.product.clear', 'uses' => 'Inventory\OnlineClientOrdersController@clear_products_table']);//+
		Route::get('/online_client_orders/{online_client_order}/product_selector',												['as' => 'online_client_orders.product.selector', 'uses' => 'Inventory\OnlineClientOrdersController@online_client_orders_product_selector']);//+
		Route::post('/online_client_orders_product_create',																		['as' => 'online_client_orders.product.create', 'uses' => 'Inventory\OnlineClientOrdersController@online_client_orders_product_create']);//+
		Route::post('/online_client_orders_product_create_store',																['as' => 'online_client_orders.product.create.store', 'uses' => 'Inventory\OnlineClientOrdersController@online_client_orders_product_create_store']);//+
		
		//receipts
		Route::resource('receipts',																								'Inventory\ReceiptController')->except(['edit','update']);//+
		Route::post('/receipt_create_new_provider_store',																		['as' => 'receipts.create.new.provider.store', 'uses' => 'Inventory\ReceiptController@receipt_create_new_provider_store']);
		
		Route::get('/receipts/{receipt}/clear_products_table',																	['as' => 'receipts.product.clear', 'uses' => 'Inventory\ReceiptController@clear_products_table']);//+
		Route::get('/receipts/{receipt}/product_selector',																		['as' => 'receipts.product.selector', 'uses' => 'Inventory\ReceiptController@receipt_product_selector']);//+
		Route::get('/receipts/{receipt}/print',																					['as' => 'receipts.print', 'uses' => 'Inventory\ReceiptController@print_receipt']);//+
		Route::get('/receipts/{receipt}/pay',																					['as' => 'receipts.pay', 'uses' => 'Inventory\ReceiptController@addtransaction']);//payment to provider
		Route::get('/receipts/{receipt}/return_to_provider',																	['as' => 'receipts.return_to_provider', 'uses' => 'Inventory\ReceiptController@return_to_provider']);//+
		Route::post('/receipts/{receipt}/transaction_store',																	['as' => 'receipts.transaction.store', 'uses' => 'Inventory\ReceiptController@storetransaction']);
		Route::get('/receipts/{receipt}/finalize',																				['as' => 'receipts.finalize', 'uses' => 'Inventory\ReceiptController@finalize']);//+
		Route::get('/receipts/{receipt}/unfinalize',																			['as' => 'receipts.unfinalize', 'uses' => 'Inventory\ReceiptController@unfinalize']);//+
		//add_to_provider_ordered_product
		Route::get('/receipts/{receipt}/add_to_provider_ordered_product_table',													['as' => 'receipts.to_provider.ordered.product.selector', 'uses' => 'Inventory\ReceiptController@add_to_provider_ordered_product_table']);//+
		Route::put('/add_to_provider_ordered_product',																			['as' => 'receipts.add.to_provider.ordered.product', 'uses' => 'Inventory\ReceiptController@add_to_provider_ordered_product']);//+
		
		//receipt_work_with_product_table		
		Route::post('/receipt_products_filter_by_group',																		['as' => 'receipts.products.filter.by.group', 'uses' => 'Inventory\ReceiptController@receipt_products_filter_by_group']);
		Route::post('/receipt_add_product',																						['as' => 'receipts.add.product', 'uses' => 'Inventory\ReceiptController@receipt_add_product']);//+
		Route::put('/receipt_add_product_store',																				['as' => 'receipts.add.product.store', 'uses' => 'Inventory\ReceiptController@receipt_add_product_store']);//+
		Route::put('/receipt_add_single_product_store',																			['as' => 'receipts.add.single.product.store', 'uses' => 'Inventory\ReceiptController@receipt_add_single_product_store']);//+
		Route::post('/receipt_edit_product',																					['as' => 'receipts.product.edit', 'uses' => 'Inventory\ReceiptController@receipt_edit_product']);//+
		Route::post('/receipt_update_product_store',																			['as' => 'receipts.product.update', 'uses' => 'Inventory\ReceiptController@receipt_update_product_store']);//+
		Route::delete('/receipt_delete_product',																				['as' => 'receipts.product.delete', 'uses' => 'Inventory\ReceiptController@receipt_delete_product']);//+
		//receipt_document_actions
		// Route::get('/receipts/{receipt}/edit_pay',																			['as' => 'receipts.edit_pay', 'uses' => 'Inventory\ReceiptController@edittransaction']);
		// Route::post('/receipts/{receipt}/transaction_update',																['as' => 'receipts.transaction.update', 'uses' => 'Inventory\ReceiptController@updatetransaction']);

		//RepairOrder
		Route::resource('/repair_orders',																						'Inventory\RepairOrderController')->except(['edit','update']);
		Route::post('repair_orders_change_discount',																			['as' => 'repair_orders.change.discount', 'uses' => 'Inventory\RepairOrderController@change_discount']);
		Route::get('/repair_orders/{repair_order}/finalize',																	['as' => 'repair_orders.finalize', 'uses' => 'Inventory\RepairOrderController@finalize']);
		Route::get('/repair_orders/{repair_order}/print',																		['as' => 'repair_orders.print', 'uses' => 'Inventory\RepairOrderController@print_repair_order']);//+
		Route::get('/repair_orders/{repair_order}/pay',																			['as' => 'repair_orders.pay', 'uses' => 'Inventory\RepairOrderController@addtransaction']);//+
		Route::get('/repair_orders/{repair_order}/return_from_the_client',														['as' => 'repair_orders.return_from_the_client', 'uses' => 'Inventory\RepairOrderController@return_from_the_client']);//+
		Route::post('/repair_orders/{repair_order}/transaction_store',															['as' => 'repair_orders.transaction.store', 'uses' => 'Inventory\RepairOrderController@storetransaction']);
		Route::get('/repair_orders/{repair_order}/clear_products_table',														['as' => 'repair_orders.product.clear', 'uses' => 'Inventory\RepairOrderController@clear_products_table']);//+
		Route::get('/repair_orders/{repair_order}/product_selector',															['as' => 'repair_orders.product.selector', 'uses' => 'Inventory\RepairOrderController@repair_order_product_selector']);//+
		//add_client_ordered_product
		Route::get('/repair_orders/{repair_order}/add_client_ordered_product_table',											['as' => 'repair_orders.client.ordered.product.selector', 'uses' => 'Inventory\RepairOrderController@add_client_ordered_product_table']);//+
		Route::put('/repair_order_add_client_ordered_product',																	['as' => 'repair_orders.add.client.ordered.product', 'uses' => 'Inventory\RepairOrderController@repair_order_add_client_ordered_product']);//+
		
		//repair_order_work_with_product_table
		Route::post('/repair_order_products_filter_by_group',																	['as' => 'repair_orders.products.filter.by.group', 'uses' => 'Inventory\RepairOrderController@repair_order_products_filter_by_group']);
		Route::put('repair_order_add_single_product_store',																		['as' => 'repair_orders.add.single.product.store', 'uses' => 'Inventory\RepairOrderController@repair_order_add_single_product_store']);//+
		
		Route::post('/repair_order_add_product',																				['as' => 'repair_orders.add.product', 'uses' => 'Inventory\RepairOrderController@repair_order_add_product']);//+
		Route::put('/repair_order_add_product_store',																			['as' => 'repair_orders.add.product.store', 'uses' => 'Inventory\RepairOrderController@repair_order_add_product_store']);//+
		Route::post('/repair_order_edit_product',																				['as' => 'repair_orders.product.edit', 'uses' => 'Inventory\RepairOrderController@repair_order_edit_product']);//+
		Route::post('/repair_order_update_product_store',																		['as' => 'repair_orders.product.update', 'uses' => 'Inventory\RepairOrderController@repair_order_update_product_store']);//+
		Route::delete('/repair_order_delete_product',																			['as' => 'repair_orders.product.delete', 'uses' => 'Inventory\RepairOrderController@repair_order_delete_product']);//+

		////////service
		Route::post('repair_orders_change_services_discount',																	['as' => 'repair_orders.change.service.discount', 'uses' => 'Inventory\RepairOrderController@change_service_discount']);

		Route::get('/repair_orders/{repair_order}/clear_services_table',														['as' => 'repair_orders.service.clear', 'uses' => 'Inventory\RepairOrderController@clear_services_table']);//+
		Route::get('/repair_orders/{repair_order}/service_selector',															['as' => 'repair_orders.service.selector', 'uses' => 'Inventory\RepairOrderController@repair_order_service_selector']);//+
		//add_client_ordered_service
		Route::get('/repair_orders/{repair_order}/add_client_ordered_service_table',											['as' => 'repair_orders.client.ordered.service.selector', 'uses' => 'Inventory\RepairOrderController@add_client_ordered_service_table']);//+
		Route::put('/repair_order_add_client_ordered_service',																	['as' => 'repair_orders.add.client.ordered.service', 'uses' => 'Inventory\RepairOrderController@repair_order_add_client_ordered_service']);//+
		
		//repair_order_work_with_service_table
		Route::post('/repair_order_services_filter_by_group',																	['as' => 'repair_orders.services.filter.by.group', 'uses' => 'Inventory\RepairOrderController@repair_order_services_filter_by_group']);
		Route::put('repair_order_add_single_service_store',																		['as' => 'repair_orders.add.single.service.store', 'uses' => 'Inventory\RepairOrderController@repair_order_add_single_service_store']);//+
		
		Route::post('/repair_order_add_service',																				['as' => 'repair_orders.add.service', 'uses' => 'Inventory\RepairOrderController@repair_order_add_service']);//+
		Route::put('/repair_order_add_service_store',																			['as' => 'repair_orders.add.service.store', 'uses' => 'Inventory\RepairOrderController@repair_order_add_service_store']);//+
		Route::post('/repair_order_edit_service',																				['as' => 'repair_orders.service.edit', 'uses' => 'Inventory\RepairOrderController@repair_order_edit_service']);//+
		Route::post('/repair_order_update_service_store',																		['as' => 'repair_orders.service.update', 'uses' => 'Inventory\RepairOrderController@repair_order_update_service_store']);//+
		Route::delete('/repair_order_delete_service',																			['as' => 'repair_orders.service.delete', 'uses' => 'Inventory\RepairOrderController@repair_order_delete_service']);//+

		/////////////////////////////////////////////////////////////////////**////////////////////////////////////////////// */

		//sales
		Route::resource('sales',																								'Inventory\SaleController')->except(['edit','update']);
		Route::post('sales_change_discount',																					['as' => 'sales.change.discount', 'uses' => 'Inventory\SaleController@change_discount']);
		Route::get('/sales/{sale}/finalize',																					['as' => 'sales.finalize', 'uses' => 'Inventory\SaleController@finalize']);
		Route::get('/sales/{sale}/print',																						['as' => 'sales.print', 'uses' => 'Inventory\SaleController@print_sale']);//+
		Route::get('/sales/{sale}/pay',																							['as' => 'sales.pay', 'uses' => 'Inventory\SaleController@addtransaction']);//+
		Route::get('/sales/{sale}/return_from_the_client',																		['as' => 'sales.return_from_the_client', 'uses' => 'Inventory\SaleController@return_from_the_client']);//+
		Route::post('/sales/{sale}/transaction_store',																			['as' => 'sales.transaction.store', 'uses' => 'Inventory\SaleController@storetransaction']);
		Route::get('/sales/{sale}/clear_products_table',																		['as' => 'sales.product.clear', 'uses' => 'Inventory\SaleController@clear_products_table']);//+
		Route::get('/sales/{sale}/product_selector',																			['as' => 'sales.product.selector', 'uses' => 'Inventory\SaleController@sale_product_selector']);//+
		//add_client_ordered_product
		Route::get('/sales/{sale}/add_client_ordered_product_table',															['as' => 'sales.client.ordered.product.selector', 'uses' => 'Inventory\SaleController@add_client_ordered_product_table']);//+
		Route::put('/sale_add_client_ordered_product',																				['as' => 'sales.add.client.ordered.product', 'uses' => 'Inventory\SaleController@sale_add_client_ordered_product']);//+
		
		//sale_work_with_product_table
		Route::post('/sale_products_filter_by_group',																			['as' => 'sales.products.filter.by.group', 'uses' => 'Inventory\SaleController@sale_products_filter_by_group']);
		Route::put('sale_add_single_product_store',																				['as' => 'sales.add.single.product.store', 'uses' => 'Inventory\SaleController@sale_add_single_product_store']);//+
		
		Route::post('/sale_add_product',																						['as' => 'sales.add.product', 'uses' => 'Inventory\SaleController@sale_add_product']);//+
		Route::put('/sale_add_product_store',																					['as' => 'sales.add.product.store', 'uses' => 'Inventory\SaleController@sale_add_product_store']);//+
		Route::post('/sale_edit_product',																						['as' => 'sales.product.edit', 'uses' => 'Inventory\SaleController@sale_edit_product']);//+
		Route::post('/sale_update_product_store',																				['as' => 'sales.product.update', 'uses' => 'Inventory\SaleController@sale_update_product_store']);//+
		Route::delete('/sale_delete_product',																					['as' => 'sales.product.delete', 'uses' => 'Inventory\SaleController@sale_delete_product']);//+
		
		//returns_from_the_client
		Route::resource('returns_from_the_client',																							'Inventory\ReturnFromTheClientController')->except(['edit','create','update']);//+
		Route::get('/returns_from_the_client/{return_from_the_client}/show',																['as' => 'returns_from_the_client.show', 'uses' => 'Inventory\ReturnFromTheClientController@show']);//+
		Route::get('/returns_from_the_client/{return_from_the_client}/clear_products_table',												['as' => 'returns_from_the_client.product.clear', 'uses' => 'Inventory\ReturnFromTheClientController@clear_products_table']);//+
		Route::get('/returns_from_the_client/{return_from_the_client}/print',																['as' => 'returns_from_the_client.print', 'uses' => 'Inventory\ReturnFromTheClientController@print_return_from_the_client']);//+
		Route::get('/returns_from_the_client/{return_from_the_client}/pay',																	['as' => 'returns_from_the_client.pay', 'uses' => 'Inventory\ReturnFromTheClientController@addtransaction']);//payment to provider
		Route::post('/returns_from_the_client/{return_from_the_client}/transaction_store',													['as' => 'returns_from_the_client.transaction.store', 'uses' => 'Inventory\ReturnFromTheClientController@storetransaction']);
		Route::get('/returns_from_the_client/{return_from_the_client}/finalize',															['as' => 'returns_from_the_client.finalize', 'uses' => 'Inventory\ReturnFromTheClientController@finalize']);//+
		Route::delete('/returns_from_the_client/{return_from_the_client}/destroy',																['as' => 'returns_from_the_client.destroy', 'uses' => 'Inventory\ReturnFromTheClientController@destroy']);//+
		//return_from_the_client_work_with_product_table		
		Route::post('/return_from_the_client_add_single_product',																			['as' => 'returns_from_the_client.add.single.product', 'uses' => 'Inventory\ReturnFromTheClientController@return_from_the_client_add_single_product']);//+
		Route::put('/return_from_the_client_add_single_product_store',																		['as' => 'returns_from_the_client.add.single.product.store', 'uses' => 'Inventory\ReturnFromTheClientController@return_from_the_client_add_single_product_store']);//+
		Route::post('/return_from_the_client_edit_product',																					['as' => 'returns_from_the_client.product.edit', 'uses' => 'Inventory\ReturnFromTheClientController@return_from_the_client_edit_product']);//+
		Route::post('/return_from_the_client_update_product_store',																			['as' => 'returns_from_the_client.product.update', 'uses' => 'Inventory\ReturnFromTheClientController@return_from_the_client_update_product_store']);//+
		Route::delete('/return_from_the_client_delete_product',																				['as' => 'returns_from_the_client.product.delete', 'uses' => 'Inventory\ReturnFromTheClientController@return_from_the_client_delete_product']);//+
		//return_from_the_client_document_actions
		// Route::get('/returns_from_the_client/{return_from_the_client}/edit_pay',																['as' => 'returns_from_the_client.edit_pay', 'uses' => 'Inventory\ReturnFromTheClientController@edittransaction']);
		// Route::post('/returns_from_the_client/{return_from_the_client}/transaction_update',													['as' => 'returns_from_the_client.transaction.update', 'uses' => 'Inventory\ReturnFromTheClientController@updatetransaction']);
		
		//returns_to_provider
		Route::resource('returns_to_provider',																							'Inventory\ReturnToProviderController')->except(['edit','create','update']);//+
		Route::get('/returns_to_provider/{return_to_provider}/show',																['as' => 'returns_to_provider.show', 'uses' => 'Inventory\ReturnToProviderController@show']);//+
		Route::get('/returns_to_provider/{return_to_provider}/clear_products_table',												['as' => 'returns_to_provider.product.clear', 'uses' => 'Inventory\ReturnToProviderController@clear_products_table']);//+
		Route::get('/returns_to_provider/{return_to_provider}/print',																['as' => 'returns_to_provider.print', 'uses' => 'Inventory\ReturnToProviderController@print_return_to_provider']);//+
		Route::get('/returns_to_provider/{return_to_provider}/pay',																	['as' => 'returns_to_provider.pay', 'uses' => 'Inventory\ReturnToProviderController@addtransaction']);//payment to provider
		Route::post('/returns_to_provider/{return_to_provider}/transaction_store',													['as' => 'returns_to_provider.transaction.store', 'uses' => 'Inventory\ReturnToProviderController@storetransaction']);
		Route::get('/returns_to_provider/{return_to_provider}/finalize',															['as' => 'returns_to_provider.finalize', 'uses' => 'Inventory\ReturnToProviderController@finalize']);//+
		Route::delete('/returns_to_provider/{return_to_provider}/destroy',																['as' => 'returns_to_provider.destroy', 'uses' => 'Inventory\ReturnToProviderController@destroy']);//+
		//return_to_provider_work_with_product_table		
		Route::post('/return_to_provider_add_single_product',																			['as' => 'returns_to_provider.add.single.product', 'uses' => 'Inventory\ReturnToProviderController@return_to_provider_add_single_product']);//+
		Route::put('/return_to_provider_add_single_product_store',																		['as' => 'returns_to_provider.add.single.product.store', 'uses' => 'Inventory\ReturnToProviderController@return_to_provider_add_single_product_store']);//+
		Route::post('/return_to_provider_edit_product',																					['as' => 'returns_to_provider.product.edit', 'uses' => 'Inventory\ReturnToProviderController@return_to_provider_edit_product']);//+
		Route::post('/return_to_provider_update_product_store',																			['as' => 'returns_to_provider.product.update', 'uses' => 'Inventory\ReturnToProviderController@return_to_provider_update_product_store']);//+
		Route::delete('/return_to_provider_delete_product',																				['as' => 'returns_to_provider.product.delete', 'uses' => 'Inventory\ReturnToProviderController@return_to_provider_delete_product']);//+
		//return_to_provider_document_actions
		// Route::get('/returns_to_provider/{return_to_provider}/edit_pay',																['as' => 'returns_to_provider.edit_pay', 'uses' => 'Inventory\ReturnToProviderController@edittransaction']);
		// Route::post('/returns_to_provider/{return_to_provider}/transaction_update',													['as' => 'returns_to_provider.transaction.update', 'uses' => 'Inventory\ReturnToProviderController@updatetransaction']);


		//client_orders
		Route::resource('/client_orders',																						'Inventory\ClientOrdersController')->except(['edit', 'update']);
		// Route::get('/client_orders/create',																						['as' => 'client_orders.create', 'uses' => 'Inventory\ClientOrdersController@create']);
		// Route::get('/client_orders/{client_order}/show',																		['as' => 'client_orders.show', 'uses' => 'Inventory\ClientOrdersController@show']);
		Route::get('/client_orders/{client_order}/finalize',																	['as' => 'client_orders.finalize', 'uses' => 'Inventory\ClientOrdersController@finalize']);
		Route::get('/client_orders/{client_order}/print',																		['as' => 'client_orders.print', 'uses' => 'Inventory\ClientOrdersController@print']);
		Route::get('/client_orders/{client_order}/pay',																			['as' => 'client_orders.pay', 'uses' => 'Inventory\ClientOrdersController@addtransaction']);
		Route::post('/client_order_sale',																						['as' => 'client_orders.sale', 'uses' => 'Inventory\ClientOrdersController@client_order_sale']);
		Route::get('/client_orders/{client_order}/to_provider',																	['as' => 'client_orders.to_provider', 'uses' => 'Inventory\ClientOrdersController@order_to_provider']);
		Route::post('/client_orders/{client_order}/transaction_store',															['as' => 'client_orders.transaction.store', 'uses' => 'Inventory\ClientOrdersController@storetransaction']);
		Route::get('/client_orders/{client_order}/edit_pay',																	['as' => 'client_orders.edit_pay', 'uses' => 'Inventory\ClientOrdersController@edittransaction']);
		Route::post('/client_orders/{client_order}/transaction_update',															['as' => 'client_orders.transaction.store', 'uses' => 'Inventory\ClientOrdersController@updatetransaction']);
		Route::get('/client_orders/{client_order}/clear_products_table',														['as' => 'client_orders.product.clear', 'uses' => 'Inventory\ClientOrdersController@clear_products_table']);//+
		Route::get('/client_orders/{client_order}/product_selector',															['as' => 'client_orders.product.selector', 'uses' => 'Inventory\ClientOrdersController@client_order_product_selector']);//+
		//client_order_work_with_product_table
		Route::post('/client_order_products_filter_by_group',																	['as' => 'client_orders.products.filter.by.group', 'uses' => 'Inventory\ClientOrdersController@client_order_products_filter_by_group']);
		Route::put('/client_order_add_single_product_store',																	['as' => 'client_orders.add.single.product.store', 'uses' => 'Inventory\ClientOrdersController@client_order_add_single_product_store']);//+
		
		Route::post('/client_order_add_product',																				['as' => 'client_orders.add.product', 'uses' => 'Inventory\ClientOrdersController@client_order_add_product']);//+
		Route::put('/client_order_add_product_store',																			['as' => 'client_orders.add.product.store', 'uses' => 'Inventory\ClientOrdersController@client_order_add_product_store']);//+
		Route::post('/client_order_edit_product',																				['as' => 'client_orders.product.edit', 'uses' => 'Inventory\ClientOrdersController@client_order_edit_product']);//+
		Route::post('/client_order_update_product_store',																		['as' => 'client_orders.product.update', 'uses' => 'Inventory\ClientOrdersController@client_order_update_product_store']);//+
		Route::delete('/client_order_delete_product',																			['as' => 'client_orders.product.delete', 'uses' => 'Inventory\ClientOrdersController@client_order_delete_product']);//+
		
		//to_provider_orders
		Route::resource('/to_provider_orders',																					'Inventory\ToProviderOrdersController')->except(['edit', 'update']);
		Route::post('/to_provider_order_receipt',																				['as' => 'to_provider_orders.receipt', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_receipt']);
		Route::get('/to_provider_orders/{to_provider_order}/show',																['as' => 'to_provider_orders.show', 'uses' => 'Inventory\ToProviderOrdersController@show']);
		Route::get('/to_provider_orders/{to_provider_order}/finalize',															['as' => 'to_provider_orders.finalize', 'uses' => 'Inventory\ToProviderOrdersController@finalize']);
		Route::get('/to_provider_orders/{to_provider_order}/unfinalize',														['as' => 'to_provider_orders.unfinalize', 'uses' => 'Inventory\ToProviderOrdersController@unfinalize']);
		Route::get('/to_provider_orders/{to_provider_order}/print',																['as' => 'to_provider_orders.print', 'uses' => 'Inventory\ToProviderOrdersController@print']);
		Route::get('/to_provider_orders/{to_provider_order}/pay',																['as' => 'to_provider_orders.pay', 'uses' => 'Inventory\ToProviderOrdersController@addtransaction']);
		Route::post('/to_provider_orders/{to_provider_order}/transaction_store',												['as' => 'to_provider_orders.transaction.store', 'uses' => 'Inventory\ToProviderOrdersController@storetransaction']);
		Route::get('/to_provider_orders/{to_provider_order}/edit_pay',															['as' => 'to_provider_orders.edit_pay', 'uses' => 'Inventory\ToProviderOrdersController@edittransaction']);
		Route::post('/to_provider_orders/{to_provider_order}/transaction_update',												['as' => 'to_provider_orders.transaction.store', 'uses' => 'Inventory\ToProviderOrdersController@updatetransaction']);
		Route::get('/to_provider_orders/{to_provider_order}/clear_products_table',												['as' => 'to_provider_orders.product.clear', 'uses' => 'Inventory\ToProviderOrdersController@clear_products_table']);//+
		Route::get('/to_provider_orders/{to_provider_order}/product_selector',													['as' => 'to_provider_orders.product.selector', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_product_selector']);//+
		
		//to_provider_order_work_with_product_table
		Route::post('/to_provider_order_products_filter_by_group',																['as' => 'to_provider_orders.products.filter.by.group', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_products_filter_by_group']);
		Route::post('/to_provider_order_add_product',																			['as' => 'to_provider_orders.add.product', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_add_product']);//+
		Route::put('/to_provider_order_add_product_store',																		['as' => 'to_provider_orders.add.product.store', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_add_product_store']);//+
		Route::put('/to_provider_order_add_single_product_store',																['as' => 'to_provider_orders.add.single.product.store', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_add_single_product_store']);//+
		Route::post('/to_provider_order_edit_product',																			['as' => 'to_provider_orders.product.edit', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_edit_product']);//+
		Route::post('/to_provider_order_update_product_store',																	['as' => 'to_provider_orders.product.update', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_update_product_store']);//+
		Route::delete('/to_provider_order_delete_product',																		['as' => 'to_provider_orders.product.delete', 'uses' => 'Inventory\ToProviderOrdersController@to_provider_order_delete_product']);//+
		//add_client_ordered_product
		Route::get('/to_provider_orders/{to_provider_order}/add_client_ordered_product_table',									['as' => 'to_provider_orders.client.ordered.product.selector', 'uses' => 'Inventory\ToProviderOrdersController@add_client_ordered_product_table']);//+
		Route::put('/add_client_ordered_product',																				['as' => 'to_provider_orders.add.client.ordered.product', 'uses' => 'Inventory\ToProviderOrdersController@add_client_ordered_product']);//+
		Route::delete('/delete_client_to_provider_order_selected_product',														['as' => 'to_provider_orders.delete.client.ordered.product', 'uses' => 'Inventory\ToProviderOrdersController@delete_client_to_provider_order_selected_product']);//+
		Route::get('/to_provider_orders/{to_provider_order}/finalize_selection_client_ordered_products',						['as' => 'to_provider_orders.finalize_selection_client_ordered_products', 'uses' => 'Inventory\ToProviderOrdersController@finalize_selection_client_ordered_products']);//+
		Route::get('/to_provider_orders/{to_provider_order}/cancel_selection_client_ordered_products',							['as' => 'to_provider_orders.cancel_selection_client_ordered_products', 'uses' => 'Inventory\ToProviderOrdersController@cancel_selection_client_ordered_products']);//+
		// --------------------- //
		Route::group(['middleware' => 'auth', 'namespace' => 'Special', 'as' => 'special.'], function ()
		{
			Route::resource('/tyres',																							'TyresController');

			// Route::get('/lamps',																								['as' => 'lamps',				'uses' => 'LampsController@ShowLampsList']);
			// Route::match(['get', 'post'],'/tyres',																				['as' => 'tyres',				'uses' => 'TyresController@TyresFullList']);
			// Route::match(['get', 'post'],'/rims',																				['as' => 'rims',				'uses' => 'RimsController@RimsFullList']);			
			// Route::match(['get', 'post'],'/oils',																				['as' => 'oils',				'uses' => 'OilsController@OilsFullList']);

			// Route::get('/tools',																								['as' => 'tools',				'uses' => 'ToolsController@ToolsFullList']);
			// Route::post('/tools/filter',																						['as' => 'tools.filter',		'uses' => 'ToolsController@ToolsFilterList']);

			// Route::get('/batteries',																							['as' => 'batteries',			'uses' => 'BatteriesController@ToolsFullList']);
			// Route::post('/batteries/filter',																					['as' => 'batteries.filter',	'uses' => 'BatteriesController@ToolsFilterList']);
		});

		//admincarts
		Route::group(['namespace' => 'Inventory'], function ()
		{
			//admincarts++
			Route::resource('admincarts',																						'AdminCartController')->except(['edit','update']);
			Route::get('/admincarts/{admincart}/print',																			['as' => 'admincarts.print', 'uses' => 'AdminCartController@admincart_print']);//+
			Route::get('/admincarts/{admincart}/finalize',																		['as' => 'admincarts.finalize', 'uses' => 'AdminCartController@finalize']);
			Route::delete('/admincarts/{admincart}/destroy',																	['as' => 'admincarts.destroy', 'uses' => 'AdminCartController@destroy']);
			
			Route::get('/admincarts/{admincart}/sale',																			['as' => 'admincarts.sale', 'uses' => 'AdminCartController@sale']);
			// Route::post('/admincart_create_client_order',																		['as' => 'admincarts.create.client.order', 'uses' => 'AdminCartController@admincart_create_client_order']);
			
			Route::post('/admincart_search',																					['as' => 'admincarts.search', 'uses' => 'AdminCartController@admincart_search']);
			Route::post('/admincarts/client_vehicles',																			['as' => 'admincarts.client.vehicles', 'uses' => 'AdminCartController@client_vehicles']);
			Route::post('/admincarts/catalog_product_info',																		['as' => 'admincarts.product.info', 'uses' => 'AdminCartController@catalog_product_info']);
			//test create product from search
			Route::post('/admincarts/catalog_product_add_to_base',																['as' => 'admincarts.product.add.tobase', 'uses' => 'AdminCartController@catalog_product_add_to_base']);
			Route::post('/admincarts/catalog_product_add_to_base_store',														['as' => 'admincarts.product.add.tobase.store', 'uses' => 'AdminCartController@catalog_product_add_to_base_store']);
			Route::post('/admincarts/catalog_product_add_to_base_and_cart_store',												['as' => 'admincarts.product.add.tobase.and.cart.store', 'uses' => 'AdminCartController@catalog_product_add_to_base_and_cart_store']);
			//test manual create product, store it, and add to cart
			Route::post('/admincarts/catalog_product_create',																	['as' => 'admincarts.product.create', 'uses' => 'AdminCartController@catalog_product_create']);
			Route::post('/admincarts/catalog_product_create_store',																['as' => 'admincarts.product.create.store', 'uses' => 'AdminCartController@catalog_product_create_store']);
			Route::post('/admincarts/catalog_product_create_add_to_cart_store',													['as' => 'admincarts.product.create.add.tocart.store', 'uses' => 'AdminCartController@catalog_product_create_add_to_cart_store']);
			
			Route::get('/admincarts/{admincart}/product_search',																	['as' => 'admincarts.product.search', 'uses' => 'AdminCartController@admincart_product_search']);//+
			Route::get('/admincarts/{admincart}/product_selector',																	['as' => 'admincarts.product.selector', 'uses' => 'AdminCartController@admincart_product_selector']);//+
			Route::get('/admincarts/{admincart}/clear_products_table',																['as' => 'admincarts.product.clear', 'uses' => 'AdminCartController@clear_products_table']);//+
			Route::post('/admincart_products_filter_by_group',																		['as' => 'admincarts.products.filter.by.group', 'uses' => 'AdminCartController@admincart_products_filter_by_group']);
			Route::post('/admincart_add_product',																					['as' => 'admincarts.add.product', 'uses' => 'AdminCartController@admincart_add_product']);//+
			Route::put('/admincart_add_product_store',																				['as' => 'admincarts.add.product.store', 'uses' => 'AdminCartController@admincart_add_product_store']);//+
			Route::put('/admincart_add_single_product_store',																		['as' => 'admincarts.add.single.product.store', 'uses' => 'AdminCartController@admincart_add_single_product_store']);//+
			Route::post('/admincart_edit_product',																					['as' => 'admincarts.product.edit', 'uses' => 'AdminCartController@admincart_edit_product']);//+
			Route::post('/admincart_update_product_store',																			['as' => 'admincarts.product.update', 'uses' => 'AdminCartController@admincart_update_product_store']);//+
			Route::delete('/admincart_delete_product',																				['as' => 'admincarts.product.delete', 'uses' => 'AdminCartController@admincart_delete_product']);//+
			//comment
			Route::post('/admincart_comment',																						['as' => 'admincarts.comment', 'uses' => 'AdminCartController@admincart_comment']);//+
			Route::post('/admincart_comment_update',																				['as' => 'admincarts.comment.update', 'uses' => 'AdminCartController@admincart_comment_update']);//+
			Route::delete('/admincart_comment_delete',																				['as' => 'admincarts.comment.delete', 'uses' => 'AdminCartController@admincart_comment_delete']);//+

		});

	});

	Route::group(['namespace' => 'Catalog', 'prefix' => 'finder'], function ()
	{
		Route::get('/',																											'FinderController@GetYears');
		Route::post('/groups',																									'FinderController@GetManufacturers');
		Route::post('/manufacturers',																							'FinderController@GetManufacturers');
		Route::post('/models',																									'FinderController@GetModels');
		Route::post('/modifications',																							'FinderController@getModifications');
		Route::post('/sections',																								'FinderController@GetSections');
	});

	//reports
	Route::group(['middleware' => 'auth', 'prefix' => 'reports'], function ()
	{
		Route::get('/transaction_statistics_report/{year?}/{month?}/{day?}',													['as' => 'transactions.transaction_statistics_report',		'uses' => 'Inventory\TransactionController@transaction_statistics_report']);
		Route::get('/stocks_report/{year?}/{month?}/{day?}',																	['as' => 'inventory.inventory_report',			'uses' => 'Inventory\ReportsController@sales_stats_report']);

		Route::get('/product_stocks_report',																					['as' => 'product.stocks_report',					'uses' => 'Inventory\ReportsController@product_stocks_report']);
		Route::post('/product_stocks_report_show',																				['as' => 'product.stocks_report.show',				'uses' => 'Inventory\ReportsController@product_stocks_report_show']);
		Route::get('/product_stocks_report_print',																				['as' => 'product.stocks_report.print',				'uses' => 'Inventory\ReportsController@product_stocks_report_print']);
		
		
		Route::get('/settlements',																								['as' => 'settlements',								'uses' => 'Inventory\ReportsController@settlements']);
		Route::post('/settlements_show',																						['as' => 'settlements.show',						'uses' => 'Inventory\ReportsController@settlements_show']);

		Route::get('/revenues/{year?}/{month?}/{day?}',																			['as' => 'stocks.revenues',							'uses' => 'Inventory\ReportsController@revenues']);
		
		Route::get('/kpi_stats',																								['as' => 'kpi.stats',								'uses' => 'Inventory\ReportsController@kpi_stats']);
		Route::post('/kpi_stats_show',																							['as' => 'kpi.stats.show',							'uses' => 'Inventory\ReportsController@kpi_stats_show']);

		Route::get('/sales_by_categories',																						['as' => 'sales.by.categories',								'uses' => 'Inventory\ReportsController@sales_by_categories']);
		Route::post('/sales_by_categories_show',																				['as' => 'kpi.by.categories.show',							'uses' => 'Inventory\ReportsController@sales_by_categories_show']);

		Route::get('/sales_by_products',																						['as' => 'sales.by.products',								'uses' => 'Inventory\ReportsController@sales_by_products']);
		Route::post('/sales_by_products_show',																					['as' => 'kpi.by.products.show',							'uses' => 'Inventory\ReportsController@sales_by_products_show']);

		Route::get('/sales_by_clients',																							['as' => 'sales.by.clients',								'uses' => 'Inventory\ReportsController@sales_by_clients']);
		Route::post('/sales_by_clients_show',																					['as' => 'sales.by.clients.show',							'uses' => 'Inventory\ReportsController@sales_by_clients_show']);
		
		Route::get('/profit_by_sales',																							['as' => 'profit.by.sales',									'uses' => 'Inventory\ReportsController@profit_by_sales']);
		Route::post('/profit_by_sales_show',																					['as' => 'profit.by.sales.show',							'uses' => 'Inventory\ReportsController@profit_by_sales_show']);
		Route::get('/profit_by_sales_print',																					['as' => 'profit.by.sales.print',							'uses' => 'Inventory\ReportsController@profit_by_sales_print']);


	});
	
	//services_management
	Route::resource('/services',																								'Inventory\ServicesController');
	Route::post('serviceLiveSearch',																							['as' => 'services.serviceLiveSearch', 'uses' => 'Inventory\ServicesController@serviceLiveSearch']);

	//services_receipt
	Route::resource('/services_receipts',																						'Inventory\ServicesReceiptsController');
	Route::post('/services_receipt_create_new_provider_store',																	['as' => 'services_receipts.create.new.provider.store', 'uses' => 'Inventory\ServicesReceiptsController@services_receipt_create_new_provider_store']);
	Route::get('/services_receipts/{services_receipt}/clear_services_table',													['as' => 'services_receipts.service.clear', 'uses' => 'Inventory\ServicesReceiptsController@clear_services_table']);
	Route::get('/services_receipts/{services_receipt}/print',																	['as' => 'services_receipts.print', 'uses' => 'Inventory\ServicesReceiptsController@print_receipt']);
	Route::get('/services_receipts/{services_receipt}/pay',																		['as' => 'services_receipts.pay', 'uses' => 'Inventory\ServicesReceiptsController@addtransaction']);
	Route::post('/services_receipts/{services_receipt}/transaction_store',														['as' => 'services_receipts.transaction.store', 'uses' => 'Inventory\ServicesReceiptsController@storetransaction']);
	Route::get('/services_receipts/{services_receipt}/finalize',																['as' => 'services_receipts.finalize', 'uses' => 'Inventory\ServicesReceiptsController@finalize']);

	Route::post('/services_receipt_add_service',																				['as' => 'services_receipts.add.service', 'uses' => 'Inventory\ServicesReceiptsController@services_receipt_add_service']);
	Route::put('/services_receipt_add_service_store',																			['as' => 'services_receipts.add.service.store', 'uses' => 'Inventory\ServicesReceiptsController@services_receipt_add_service_store']);
	Route::post('/services_receipt_edit_service',																				['as' => 'services_receipts.service.edit', 'uses' => 'Inventory\ServicesReceiptsController@services_receipt_edit_service']);
	Route::post('/services_receipt_update_service_store',																		['as' => 'services_receipts.service.update', 'uses' => 'Inventory\ServicesReceiptsController@services_receipt_update_service_store']);
	Route::delete('/services_receipt_delete_service',																			['as' => 'services_receipts.service.delete', 'uses' => 'Inventory\ServicesReceiptsController@services_receipt_delete_service']);

	//services_sale
	Route::resource('/services_sales',																							'Inventory\ServicesSaleController');

	//Cache cleaning
	Route::get('/clear', function() { Artisan::call('cache:clear'); Artisan::call('config:cache'); Artisan::call('view:clear'); Artisan::call('route:clear'); });
});

Route::domain($domain)->group(function ()
{
	Route::group(['namespace' => 'AuthClient', 'prefix' => 'account', 'as' => 'account.'], function ()
	{
		Route::get('/', function () { return redirect('/account/dashboard'); }); //dashboard redirect if only account address

		// Authentication routes...
		Route::get('/login',													['as' => 'login',							'uses' => 'AccountController@ShowLoginPage']);
		Route::post('login',													['as' => 'login.send',						'uses' => 'LoginController@login']);
		Route::post('logout',													['as' => 'logout',							'uses' => 'LoginController@logout']);
		// Registration routes...
		Route::get('registerpage',												['as' => 'registerpage',					'uses' => 'AccountController@ShowRegisterPage']);//register page
		Route::post('register',													['as' => 'register.send',					'uses' => 'RegisterController@register']);// register send
		// Send email with reset url routes...
		Route::get('password/email',											['as' => 'password.request',				'uses' => 'ForgotPasswordController@showLinkRequestForm']);
		Route::post('password/email',											['as' => 'password.email',					'uses' => 'ForgotPasswordController@sendResetLinkEmail']);
		// Password reset routes...
		Route::get('password/reset/{token}',									['as' => 'password.reset',					'uses' => 'ResetPasswordController@showResetForm']);
		Route::post('password/reset',											['as' => 'password.update',					'uses' => 'ResetPasswordController@reset']);		

		Route::get('/addresses',												['as' => 'addresses',						'uses' => 'AddressesController@index']);
		Route::get('/addresses/add',											['as' => 'addresses.add',					'uses' => 'AddressesController@create']);
		Route::post('/addresses/store',											['as' => 'addresses.store',					'uses' => 'AddressesController@store']);
		Route::get('/addresses/{id}/edit',										['as' => 'addresses.edit',					'uses' => 'AddressesController@edit']);
		Route::post('/addresses/{id}/update',									['as' => 'addresses.update',				'uses' => 'AddressesController@update']);
		Route::post('/addresses/remove',										['as' => 'addresses.remove',				'uses' => 'AddressesController@delete']);
		///
		Route::get('/dashboard',												['as' => 'dashboard',						'uses' => 'AccountController@index']);
		Route::get('/garage',													['as' => 'garage',							'uses' => 'GarageController@index']);
		Route::get('/orders',													['as' => 'orders',							'uses' => 'OnlineOrdersController@index']);
		Route::get('/orders/{order_id}',										['as' => 'order',							'uses' => 'OnlineOrdersController@ShowOrder']);
		Route::get('/profile',													['as' => 'profile',							'uses' => 'ProfileController@index']);
		Route::post('/profile/update',											['as' => 'profile.update',					'uses' => 'ProfileController@update']);
		
		Route::get('/changepassword',											['as' => 'changepassword',					'uses' => 'ChangePasswordController@index']);
		Route::get('/changepassword/store',										['as' => 'changepassword.store',			'uses' => 'ChangePasswordController@store']);
	});

	//cart routes
	Route::prefix('/cart')->group(function()
	{
		Route::get('/',																									['as' => 'showcart',			'uses' => 'Shop\CartController@ShowCartPage']);
		Route::post('/addtocart',																						['as' => 'addtocart',			'uses' => 'Shop\CartController@AddToCart']);
		Route::post('/deletefromcart',																					['as' => 'deletefromcart',		'uses' => 'Shop\CartController@DeleteFromCart']);
		Route::post('/clearcart',																						['as' => 'clearcart',			'uses' => 'Shop\CartController@ClearCart']);
	});

	Route::prefix('/')->group(function()
	{
		Route::get('/',																										['as' => 'home', 'uses' => 'Shop\ShopController@ShowHomePage']);
		Route::get('/sitemap',																								['as' => 'sitemap', 'uses' => 'Shop\ShopController@ShowHomePage']);//sitemap for future
		Route::get('/contact',																								['as' => 'contactpage', 'uses' => 'Shop\ShopController@ShowContactPage']);
		Route::get('/about',																								['as' => 'aboutpage', 'uses' => 'Shop\ShopController@ShowAboutPage']);
		Route::get('/delivery-info',																						['as' => 'deliveryinfo', 'uses' => 'Shop\ShopController@ShowDeliveryInfoPage']);
		Route::get('/privacy-policy',																						['as' => 'privacypolicy', 'uses' => 'Shop\ShopController@ShowPrivacyPage']);
		Route::get('/returns',																								['as' => 'returns', 'uses' => 'Shop\ShopController@ShowReturnsPage']);
		Route::get('/track-order',																							['as' => 'trackorder', 'uses' => 'Shop\ShopController@ShowTrackOrderPage']);
		Route::get('/compare',																								['as' => 'compare', 'uses' => 'Shop\ShopController@ShowComparePage']);
		Route::get('/services',																								['as' => 'services', 'uses' => 'Shop\ShopController@ShowServicesPage']);
		Route::get('/prices',																								['as' => 'serviceprices', 'uses' => 'Shop\ShopController@ShowPricesPage']);
		Route::get('/featured',																								['as' => 'featured', 'uses' => 'Shop\ShopController@GetFeaturedProducts']);
		Route::get('/bestsellers',																							['as' => 'bestsellers', 'uses' => 'Shop\ShopController@Bestsellers']);
		
		Route::prefix('/')->group(function()
		{
			Route::post('/contact/send',																					['as' => 'contact.send', 'uses' => 'Shop\MessagesController@ContactPageSendMessage']);
			Route::post('/noparts/send',																					['as' => 'noparts.send', 'uses' => 'Shop\MessagesController@NopartsSendMessage']);
			Route::post('/askprice',																						['as' => 'askprice.send', 'uses' => 'Shop\MessagesController@AskpriceSendMessage']);
			Route::post('/trackorder',																						['as' => 'trackorder.send', 'uses' => 'Shop\MessagesController@TrackorderSendMessage']);
		});

		//coupons
		Route::group(['namespace' => 'Shop', 'prefix' => 'coupon', 'as' => 'coupon.'], function ()
		{
			Route::post('/addcoupon',						['as' => 'addcoupon', 'uses' => 'CouponsController@addcoupon']);
			Route::delete('/deletecoupon',					['as' => 'deletecoupon', 'uses' => 'CouponsController@deletecoupon']);
		});

		Route::group(['namespace' => 'Shop', 'prefix' => 'wishlist', 'as' => 'wishlist.'], function ()
		{
			Route::get('/',																									['as' => 'show', 'uses' => 'WishListController@ShowWishListPage']);
			Route::post('/addtowishlist',																					['as' => 'addtowishlist', 'uses' => 'WishListController@AddToWishList']);
			Route::post('/deletefromwishlist',																				['as' => 'deletefromwishlist', 'uses' => 'WishListController@DeleteFromWishlist']);
		});

		//blog
		Route::group(['namespace' => 'Shop', 'prefix' => 'blog'], function ()
		{
			Route::get('/',																									['as' => 'blog', 'uses' => 'BlogController@ShowPostsPage']);
			Route::post('/addcomment',																						['as' => 'blog.addcomment', 'uses' => 'BlogController@AddComment']);
			Route::get('/{slug}',																							['as' => 'blogpost', 'uses' => 'BlogController@ShowPostPage']);
			Route::get('/category/{categorytitle}',																			['as' => 'blogbycategory', 'uses' => 'BlogController@ShowPostsByCategory']);
			Route::get('/tag/{tagtitle}',																					['as' => 'blogbytag', 'uses' => 'BlogController@ShowPostsByTag']);
		});

		Route::group(['namespace' => 'Shop', 'prefix' => 'checkout', 'middleware' => 'auth.client'], function ()
		{
			Route::get('/',																									['as' => 'checkout', 'uses' => 'CheckoutController@index']);
			Route::post('/placeorder',																						['as' => 'placeorder', 'uses' => 'CheckoutController@placeorder']);
			Route::get('/download_order/{order_id}',																		['as' => 'print.invoice', 'uses' => 'InvoiceController@download_order'])->where('order_id', '[0-9]+');
		});
		
		Route::group(['namespace' => 'Shop', 'prefix' => 'brands'], function ()
		{
			Route::get('/',																									['as' => 'brandspage', 'uses' => 'BrandsController@ShowBrandsPage']);
			Route::get('/{slug}',																							['as' => 'singlebrand', 'uses' => 'BrandsController@ShowBrandPage']);
			Route::post('/rate',																							['as' => 'ratebrand', 'uses' => 'BrandsController@ratebrand']);
		});
		
		//Роуты для прямого поиска номера
		Route::get('/part-search/{number}',																					['as' => 'search.number', 'uses' => 'Catalog\SearchController@SearchNumber']);
		Route::match(['get', 'post'], '/part-search',																		['as' => 'search.number.filter', 'uses' => 'Catalog\SearchController@SearchNumberFilter']);
		Route::get('/search/{brand}/{number}',																				['as' => 'search.analogparts', 'uses' => 'Catalog\SearchController@SearchBrandNumber']);
		Route::post('/search/{brand}/{number}',																				['as' => 'search.analogparts.filtered', 'uses' => 'Catalog\SearchController@SearchBrandNumber']);//фильтрованная страница
		Route::get('/product/{brand}/{number}',																				['as' => 'product.page', 'uses' => 'Catalog\ProductController@GetProductPage']);//страница товара

		//catalog routes
		Route::group(['namespace' => 'Catalog', 'prefix' => 'catalog', 'as' => 'catalog.'], function ()
		{
			Route::get('/',																									['as' => 'groups', 'uses' => 'CatalogController@GetShopCatalogPage']);//was ->name('parts')
			Route::get('/{group}',																							['as' => 'manufacturers', 'uses' => 'ManufacturersController@GetShopManufacturers']);
			Route::get('/{group}/{manufacturer}',																			['as' => 'models', 'uses' => 'ModelsController@GetShopModels']);
			Route::get('/{group}/{manufacturer}/{model}',																	['as' => 'modifications', 'uses' => 'ModificationsController@GetShopModifications']);
			Route::get('/{group}/{manufacturer}/{model}/{modification}',													['as' => 'rootsections', 'uses' => 'SectionsController@GetSectionstree']);
			Route::get('/{group}/{manufacturer}/{model}/{modification}/{section}',											['as' => 'subsections', 'uses' => 'SubsectionsController@GetSubsections']);
			Route::get('/{group}/{manufacturer}/{model}/{modification}/{section}/{subsection}',								['as' => 'subsections', 'uses' => 'SectionPartsController@GetSectionParts']);


			Route::post('/rateproduct',																						['as' => 'rateproduct', 'uses' => 'ProductController@rateproduct']);
			Route::post('/quickview',																						['as' => 'quickview', 'uses' => 'QuickviewController@quickview']);
			Route::post('/analogview',																						['as' => 'analogview', 'uses' => 'QuickviewController@analogview']);
			Route::post('/applicability',																					['as' => 'applicability', 'uses' => 'QuickviewController@applicability']);
			Route::post('/pricesview',																						['as' => 'pricesview', 'uses' => 'QuickviewController@pricesview']);
			Route::post('/askprice',																						['as' => 'askprice', 'uses' => 'QuickviewController@askprice']);

		});



		Route::group(['namespace' => 'Catalog', 'prefix' => 'finder'], function ()
		{
			Route::get('/',																											'FinderController@GetYears');
			Route::post('/groups',																									'FinderController@GetManufacturers');
			// Route::post('/manufacturers',																							'FinderController@GetManufacturers');
			Route::post('/models',																									'FinderController@GetModels');
			Route::post('/modifications',																							'FinderController@getModifications');
			// Route::post('/sections',																								'FinderController@GetSections');
			Route::post('/gotocatalog',																								['as' => 'finder.gotocatalog', 'uses' => 'FinderController@GoToCatalog']);
		});



		//дополнительные каталоги - переделать
		Route::group(['namespace' => 'Special', 'as' => 'special.'], function ()
		{
			Route::get('/lamps',																								['as' => 'lamps',				'uses' => 'LampsController@ShowLampsList']);
			Route::match(['get', 'post'],'/tyres',																				['as' => 'tyres',				'uses' => 'TyresController@TyresFullList']);
			Route::match(['get', 'post'],'/rims',																				['as' => 'rims',				'uses' => 'RimsController@RimsFullList']);			
			Route::match(['get', 'post'],'/oils',																				['as' => 'oils',				'uses' => 'OilsController@OilsFullList']);

			Route::get('/tools',																								['as' => 'tools',				'uses' => 'ToolsController@ToolsFullList']);
			Route::post('/tools/filter',																						['as' => 'tools.filter',		'uses' => 'ToolsController@ToolsFilterList']);

			Route::get('/batteries',																							['as' => 'batteries',			'uses' => 'BatteriesController@ToolsFullList']);
			Route::post('/batteries/filter',																					['as' => 'batteries.filter',	'uses' => 'BatteriesController@ToolsFilterList']);
		});

		//Cache cleaning
		Route::get('/clear', function() { Artisan::call('cache:clear'); Artisan::call('config:cache'); Artisan::call('view:clear'); Artisan::call('route:clear'); });
	});
});
