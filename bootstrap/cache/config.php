<?php return array (
  'app' => 
  array (
    'name' => 'Proauto Web Shop',
    'admin_name' => 'Proauto Web Shop Inventory Management',
    'env' => 'local',
    'debug' => true,
    'url' => 'http://proauto.shop',
    'asset_url' => NULL,
    'timezone' => 'UTC',
    'locale' => 'ru',
    'setlocale' => 'ru_RU.UTF-8',
    'fallback_locale' => 'ru',
    'faker_locale' => 'ru_RU',
    'key' => 'base64:hTeUDta/9YI+gv/3zJRUBd6/7s80pbG6F9czOJ57uHE=',
    'cipher' => 'AES-256-CBC',
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Redis' => 'Illuminate\\Support\\Facades\\Redis',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Currency' => 'Torann\\Currency\\Facades\\Currency',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'clients' => 
      array (
        'driver' => 'session',
        'provider' => 'clients',
      ),
      'api' => 
      array (
        'driver' => 'token',
        'provider' => 'users',
        'hash' => false,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\User',
      ),
      'clients' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\Client\\Client',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
      'clients' => 
      array (
        'provider' => 'clients',
        'table' => 'clients_password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => 'D:\\xampp\\htdocs\\proauto\\storage\\framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
    ),
    'prefix' => 'proauto_web_shop_cache',
  ),
  'currency' => 
  array (
    'default' => 'RUB',
    'api_key' => '51c9953f1bce436e871a71aec936f1e0',
    'driver' => 'database',
    'cache_driver' => NULL,
    'drivers' => 
    array (
      'database' => 
      array (
        'class' => 'Torann\\Currency\\Drivers\\Database',
        'connection' => 'system',
        'table' => 'currencies',
      ),
      'filesystem' => 
      array (
        'class' => 'Torann\\Currency\\Drivers\\Filesystem',
        'disk' => NULL,
        'path' => 'currencies.json',
      ),
    ),
    'formatter' => NULL,
    'formatters' => 
    array (
      'php_intl' => 
      array (
        'class' => 'Torann\\Currency\\Formatters\\PHPIntl',
      ),
    ),
  ),
  'database' => 
  array (
    'default' => 'system',
    'connections' => 
    array (
      'system' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'system',
        'username' => 'root',
        'password' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
      'catalog' => 
      array (
        'driver' => 'mysql',
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'td2018',
        'username' => 'root',
        'password' => '',
        'unix_socket' => '',
        'charset' => 'utf8',
        'collation' => 'utf8_general_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
        ),
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'proauto_web_shop_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 0,
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => 1,
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'cloud' => 's3',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\xampp\\htdocs\\proauto\\storage\\app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => 'D:\\xampp\\htdocs\\proauto\\storage\\app/public',
        'url' => 'http://proauto.shop/storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
      ),
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'inventory_settings' => 
  array (
    'slogan' => 'Мы будем рады Вашим предложениям, чтоб стать еще лучше!',
    'phone' => '+7 949 741-87-37',
    'phone2' => '+38 (071) 741-87-37',
    'email' => 'proauto.shop@outlook.com',
    'emailname' => 'proauto.shop',
    'shop_address' => false,
    'city' => 'г.Горловка',
    'state' => 'Донецкая обл',
    'country' => 'Украина',
    'zipcode' => '84646',
    'workinghours' => 'Пн-Сб 09:00 - 17:00',
    'day_off' => 'Вс: выходной',
    'facebook' => 'https://www.facebook.com/ProAutoService2020',
    'twitter' => 'https://twitter.com/service_proauto',
    'youtube' => 'https://www.youtube.com/',
    'instagram' => 'https://www.instagram.com',
    'vk' => 'https://vk.com/proautoservice2020',
    'telegram' => 'https://t.me/proauto_ch',
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'daily',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => 'D:\\xampp\\htdocs\\proauto\\storage\\logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => 'D:\\xampp\\htdocs\\proauto\\storage\\logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'critical',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
    ),
  ),
  'mail' => 
  array (
    'driver' => 'smtp',
    'host' => 'smtp.mailtrap.io',
    'port' => '2525',
    'from' => 
    array (
      'address' => 'hello@example.com',
      'name' => 'Example',
    ),
    'encryption' => NULL,
    'username' => NULL,
    'password' => NULL,
    'sendmail' => '/usr/sbin/sendmail -bs',
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => 'D:\\xampp\\htdocs\\proauto\\resources\\views/vendor/mail',
      ),
    ),
    'log_channel' => NULL,
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'your-queue-name',
        'region' => 'us-east-1',
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database',
      'database' => 'system',
      'table' => 'failed_jobs',
    ),
  ),
  'seotools' => 
  array (
    'meta' => 
    array (
      'defaults' => 
      array (
        'title' => 'ProAutoShop',
        'titleBefore' => false,
        'description' => 'Интернет магазин запчастей для иномарок',
        'separator' => ' | ',
        'keywords' => 
        array (
        ),
        'canonical' => NULL,
        'robots' => false,
      ),
      'webmaster_tags' => 
      array (
        'google' => NULL,
        'bing' => NULL,
        'alexa' => NULL,
        'pinterest' => NULL,
        'yandex' => NULL,
        'norton' => NULL,
      ),
      'add_notranslate_class' => false,
    ),
    'opengraph' => 
    array (
      'defaults' => 
      array (
        'title' => 'ProAutoShop',
        'description' => 'Интернет магазин запчастей для иномарок',
        'url' => NULL,
        'type' => 'WebPage',
        'site_name' => 'ProAutoShop',
        'images' => 
        array (
        ),
      ),
    ),
    'twitter' => 
    array (
      'defaults' => 
      array (
        'image' => 'https://proauto.shop/images/opengraph.png',
        'description' => 'Интернет магазин запчастей для иномарок',
        'url' => NULL,
        'site' => '@service_proauto',
        'images' => 
        array (
        ),
      ),
    ),
    'json-ld' => 
    array (
      'defaults' => 
      array (
        'title' => 'ProAutoShop',
        'description' => 'Интернет магазин запчастей для иномарок',
        'url' => NULL,
        'type' => 'WebPage',
        'images' => 
        array (
        ),
      ),
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => 'D:\\xampp\\htdocs\\proauto\\storage\\framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'proauto_web_shop_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => NULL,
  ),
  'shop_settings' => 
  array (
    'slogan' => 'Мы будем рады Вашим предложениям, чтоб стать еще лучше!',
    'name' => 'ProautoShop',
    'phone' => '+7 949 741-87-37',
    'phone2' => '+38 (071) 741-87-37',
    'email' => 'proauto.shop@outlook.com',
    'emailname' => 'proauto.shop',
    'shop_address' => false,
    'city' => 'г.Горловка',
    'state' => 'Донецкая обл',
    'country' => 'Украина',
    'zipcode' => '84646',
    'workinghours' => 'Пн-Сб 09:00 - 17:00',
    'day_off' => 'Вс: выходной',
    'facebook' => 'https://www.facebook.com/ProAutoService2020',
    'twitter' => 'https://twitter.com/service_proauto',
    'youtube' => 'https://www.youtube.com/',
    'instagram' => 'https://www.instagram.com',
    'vk' => 'https://vk.com/proautoservice2020',
    'telegram' => 'https://t.me/proauto_ch',
  ),
  'tecdoc' => 
  array (
    'service_url' => 'https://webservice.tecalliance.services/pegasus-3-0/services/TecdocToCatDLB.jsonEndpoint',
    'api_key' => NULL,
    'provider_id' => NULL,
    'country' => NULL,
    'lang' => NULL,
  ),
  'tecdoc_config' => 
  array (
    'country_specifics' => 
    array (
      0 => '0',
      1 => '1',
      2 => '7',
      3 => '11',
    ),
    'lang_id' => '16',
    'ctype' => '0',
    'models_from' => '1998',
    'hide_trade' => true,
    'notusa' => '1',
    'hide_usa' => '1',
    'images_server' => 'boschautoparts.pp.ua/images/',
    'hide_noprices' => '0',
    'hide_prices_noavail' => '0',
    'hide_analogs_of_analogs' => '1',
    'show_item_props' => '1',
    'hide_notecdoc_online_prices' => '1',
    'request_ws_only_searched' => '1',
    'search_in_crosses' => '1',
    'show_filter_brands' => '1',
    'filter_brands_letters_limit' => '30',
    'img_resave' => '1',
    'tdmxbaseisused' => false,
    'hide_originals' => false,
    'items_props_count' => true,
    'search_sorting' => '1',
    'favorite_items' => 
    array (
      0 => 'VW',
      1 => 'FORD',
      2 => 'AUDI',
      3 => 'BMW',
      4 => 'OPEL',
      5 => 'RENAULT',
      6 => 'PEUGEOT',
      7 => 'MAZDA',
      8 => 'HONDA',
      9 => 'TOYOTA',
      10 => 'SEAT',
      11 => 'MERCEDES-BENZ',
      12 => 'FIAT',
      13 => 'MITSUBISHI',
      14 => 'NISSAN',
      15 => 'SUZUKI',
      16 => 'CHEVROLET',
      17 => 'SUBARU',
      18 => 'KIA',
      19 => 'HYUNDAI',
      20 => 'SKODA',
      21 => 'CHERY',
      22 => 'CITROEN',
      23 => 'VOLVO',
    ),
  ),
  'telegram' => 
  array (
    'bots' => 
    array (
      'mybot' => 
      array (
        'username' => 'TelegramBot',
        'token' => 'YOUR-BOT-TOKEN',
        'certificate_path' => 'YOUR-CERTIFICATE-PATH',
        'webhook_url' => 'YOUR-BOT-WEBHOOK-URL',
        'commands' => 
        array (
        ),
      ),
    ),
    'default' => 'mybot',
    'async_requests' => false,
    'http_client_handler' => NULL,
    'resolve_command_dependencies' => true,
    'commands' => 
    array (
      0 => 'Telegram\\Bot\\Commands\\HelpCommand',
    ),
    'command_groups' => 
    array (
    ),
    'shared_commands' => 
    array (
    ),
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => 'D:\\xampp\\htdocs\\proauto\\resources\\views',
    ),
    'compiled' => 'D:\\xampp\\htdocs\\proauto\\storage\\framework\\views',
  ),
  'debugbar' => 
  array (
    'enabled' => NULL,
    'except' => 
    array (
      0 => 'telescope*',
      1 => 'horizon*',
    ),
    'storage' => 
    array (
      'enabled' => true,
      'driver' => 'file',
      'path' => 'D:\\xampp\\htdocs\\proauto\\storage\\debugbar',
      'connection' => NULL,
      'provider' => '',
      'hostname' => '127.0.0.1',
      'port' => 2304,
    ),
    'editor' => 'phpstorm',
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'include_vendors' => true,
    'capture_ajax' => true,
    'add_ajax_timing' => false,
    'error_handler' => false,
    'clockwork' => false,
    'collectors' => 
    array (
      'phpinfo' => true,
      'messages' => true,
      'time' => true,
      'memory' => true,
      'exceptions' => true,
      'log' => true,
      'db' => true,
      'views' => true,
      'route' => true,
      'auth' => false,
      'gate' => true,
      'session' => true,
      'symfony_request' => true,
      'mail' => true,
      'laravel' => false,
      'events' => false,
      'default_request' => false,
      'logs' => false,
      'files' => false,
      'config' => false,
      'cache' => false,
      'models' => true,
      'livewire' => true,
    ),
    'options' => 
    array (
      'auth' => 
      array (
        'show_name' => true,
      ),
      'db' => 
      array (
        'with_params' => true,
        'backtrace' => true,
        'backtrace_exclude_paths' => 
        array (
        ),
        'timeline' => false,
        'duration_background' => true,
        'explain' => 
        array (
          'enabled' => false,
          'types' => 
          array (
            0 => 'SELECT',
          ),
        ),
        'hints' => false,
        'show_copy' => false,
      ),
      'mail' => 
      array (
        'full_log' => false,
      ),
      'views' => 
      array (
        'timeline' => false,
        'data' => false,
      ),
      'route' => 
      array (
        'label' => true,
      ),
      'logs' => 
      array (
        'file' => NULL,
      ),
      'cache' => 
      array (
        'values' => true,
      ),
    ),
    'inject' => true,
    'route_prefix' => '_debugbar',
    'route_domain' => NULL,
    'theme' => 'auto',
    'debug_backtrace_limit' => 50,
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'public_path' => NULL,
    'convert_entities' => true,
    'options' => 
    array (
      'font_dir' => 'D:\\xampp\\htdocs\\proauto\\storage\\fonts',
      'font_cache' => 'D:\\xampp\\htdocs\\proauto\\storage\\fonts',
      'temp_dir' => 'C:\\Users\\3C8A~1\\AppData\\Local\\Temp',
      'chroot' => 'D:\\xampp\\htdocs\\proauto',
      'allowed_protocols' => 
      array (
        'file://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'http://' => 
        array (
          'rules' => 
          array (
          ),
        ),
        'https://' => 
        array (
          'rules' => 
          array (
          ),
        ),
      ),
      'log_output_file' => NULL,
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_paper_orientation' => 'portrait',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => true,
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
    ),
    'send_logs_as_events' => true,
  ),
  'ignition' => 
  array (
    'editor' => 'vscode',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'migrations-generator' => 
  array (
    'migration_template_path' => 'D:\\xampp\\htdocs\\proauto\\vendor\\kitloong\\laravel-migrations-generator\\config/../stubs/migration.generate.stub',
    'migration_anonymous_template_path' => 'D:\\xampp\\htdocs\\proauto\\vendor\\kitloong\\laravel-migrations-generator\\config/../stubs/migration.generate.anonymous.stub',
    'migration_target_path' => 'D:\\xampp\\htdocs\\proauto\\database/migrations',
    'filename_pattern' => 
    array (
      'table' => '[datetime]_create_[name]_table.php',
      'view' => '[datetime]_create_[name]_view.php',
      'procedure' => '[datetime]_create_[name]_proc.php',
      'foreign_key' => '[datetime]_add_foreign_keys_to_[name]_table.php',
    ),
  ),
  'iseed::config' => 
  array (
    'path' => '/database/seeders',
    'chunk_size' => 500,
  ),
  'trustedproxy' => 
  array (
    'proxies' => NULL,
    'headers' => 30,
  ),
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
