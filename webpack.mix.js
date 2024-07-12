const mix = require('laravel-mix');
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management For Adminside
 |--------------------------------------------------------------------------
 */
mix.js('resources/js/adminApp.js', 'public/assets/js');

mix.scripts(['resources/js/adminChartsTheme.js',
			'resources/js/adminSlimselect.min.js',
			'resources/js/adminJstree.min.js',
			'resources/js/adminDatatables.min.js',
			'resources/js/adminSweetalert2.js',
			// 'resources/js/adminBlack-dashboard.min.js',
			// 'resources/js/adminPerfect-scrollbar.jquery.min.js',
			// 'resources/js/adminBootstrap-notify.js',
			'resources/js/adminScripts.js'], 'public/assets/js/adminScripts.js');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management For Shop
 |--------------------------------------------------------------------------
 */
mix.js('resources/js/shopApp.js', 'public/assets/js').sass('resources/sass/shopApp.scss', 'public/assets/css');
   
mix.scripts([
			  'resources/js/shopScripts.js',
			  'resources/js/shopMain.js',
			  'resources/js/shopCatalog.js',
			  'resources/js/shopJstree.min.js',
			  'resources/js/shopNouislider.min.js',
					], 'public/assets/js/shopScripts.js');

mix.styles([
      'resources/css/shopStyle.css',
      'resources/css/shopPrices.css',
      'resources/css/shopLamps.css',
   ],'public/assets/css/shopStyle.css');

mix.styles('resources/css/shopBootstrap.css','public/assets/css/shopBootstrap.css');/*width error*/

mix.styles('resources/css/shopHeader.css','public/assets/css/shopHeader.css');

mix.styles('resources/css/shopMobileheader.css','public/assets/css/shopMobileheader.css');

/*
 |--------------------------------------------------------------------------
 | Mix Service Information
 |--------------------------------------------------------------------------
 */ 
if (mix.inProduction()) {
   mix.version();
}