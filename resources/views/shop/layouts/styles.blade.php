        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="format-detection" content="telephone=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @include('shop.block.favicon')

        <!--jquery-->
        <script src="{{ mix('assets/js/shopApp.js') }}" defer></script>
        <script src="{{ mix('assets/js/shopScripts.js') }}" defer></script>

        <!-- fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,400i,500,500i,700,700i&display=swap">
        
        {{--<!--font awesome -->
        <link href="{{asset('assets')}}/css/all.min.css" rel="stylesheet">--}}

        <!-- css-->
        <link rel="stylesheet" href="{{ mix('assets/css/shopApp.css') }}"><!--resources/sass/shopApp.scss-->
        <link rel="stylesheet" href="{{ mix('assets/css/shopBootstrap.css') }}">
        <link rel="stylesheet" href="{{ mix('assets/css/shopStyle.css') }}">
        <link rel="stylesheet" href="{{ mix('assets/css/shopHeader.css') }}" media="(min-width: 1200px)">
        <link rel="stylesheet" href="{{ mix('assets/css/shopMobileheader.css') }}" media="(max-width: 1199px)">
        @stack('shopcss')
        {{-- @include('shop.metrics.gtag') --}}
        {{-- @include('shop.metrics.yametrika') --}}
        {{-- @include('shop.metrics.fbpixel') --}}
        <!--seo-->
        <meta name="twitter:card" content="summary" />
        {!! SEO::generate() !!}
        