<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <meta name="csrf-token" content="{{ csrf_token() }}">
		
		@include('shop.block.favicon')
        
		<title>{{ $page }} | {{ config('app.admin_name') }}</title>
        <!-- npm JS start -->
        <script src="{{ mix('assets/js/adminApp.js') }}" defer></script>
        <script src="{{ mix('assets/js/adminScripts.js') }}" defer></script>
        
        <link href="{{ asset('assets') }}/css/jsTreeStyle/jsTreeStyle.min.css" rel="stylesheet" />
		<link href="{{ asset('assets') }}/css/dataTablesStyle.min.css" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/slimSelectStyle.min.css" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/black-dashboard.min.css" rel="stylesheet" />
        <link href="{{ asset('assets') }}/css/theme.css" rel="stylesheet" />
        
		<link href="{{ asset('assets') }}/fonts/fontawesome-free/css/all.min.css" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;200;300;400;500;600&display=swap" rel="stylesheet"> 
        <!-- js tree css -->
        @stack('admincss')
    </head>
    @auth()
    <body class="{{ (auth()->user()->white_color == 'true') ? 'white-content' : '' }}">
    @else
    <body>
    @endauth	
    
        @auth()
        <div class="wrapper">
            @include('inventory.layouts.navbars.sidebar')
            <div class="main-panel">
                @auth()
                @include('inventory.layouts.navbars.auth')
                @endauth
                <div class="content">
                        @yield('content')
                    </div>
                    <footer class="footer">
                        <div class="container-fluid">
                            <ul class="nav">
                                <li class="nav-item"></li>
                                <li class="nav-item"></li>
                                <li class="nav-item"></li>
                                <li class="nav-item"></li>
                            </ul>
                            <div class="copyright">
                                © 2023 Copyright. All Rights Reserved
                            </div>
                        </div>
                    </footer>
                </div>
            </div>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <div class="wrapper wrapper-full-page">
                <div class="full-page {{ $contentClass ?? '' }}">
                    <div class="content">
                        <div class="container">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
        @endauth
		
		<!---->
		<div class="modal modal-black fade" id="modaledit" role="dialog" aria-hidden="true" data-bs-focus="false"></div>
		<!---->
        <script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.jquery.min.js" defer></script>
        <script src="{{ asset('assets') }}/js/plugins/bootstrap-switch.js" defer></script>

        <!--  Notifications Plugin    -->
        <script src="{{ asset('assets') }}/js/plugins/bootstrap-notify.js" defer></script>

        <script src="{{ asset('assets') }}/js/black-dashboard.min.js?v=1.0.0" defer></script>
        <script src="{{ asset('assets') }}/js/sweetalert2.js" defer></script>
        <script defer>
        document.addEventListener("DOMContentLoaded", () => 
        {
            $().ready(function()
            {
                $sidebar = $('.sidebar');
                $navbar = $('.navbar');
                $main_panel = $('.main-panel');

                $full_page = $('.full-page');

                $sidebar_responsive = $('body > .navbar-collapse');
                sidebar_mini_active = true;
                white_color = false;

                window_width = $(window).width();

                fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

                $('.fixed-plugin a').click(function(event)
                {
                    if ($(this).hasClass('switch-trigger'))
                    {
                        if (event.stopPropagation)
                        {
                            event.stopPropagation();
                        } else if (window.event)
                        {
                            window.event.cancelBubble = true;
                        }
                    }
                });

                // $('.fixed-plugin .background-color span').click(function()
                // {
                //     $(this).siblings().removeClass('active');
                //     $(this).addClass('active');

                //     var new_color = $(this).data('color');

                //     if ($sidebar.length != 0)
                //     {
                //         $sidebar.attr('data', new_color);
                //     }

                //     if ($main_panel.length != 0)
                //     {
                //         $main_panel.attr('data', new_color);
                //     }

                //     if ($full_page.length != 0)
                //     {
                //         $full_page.attr('filter-color', new_color);
                //     }

                //     if ($sidebar_responsive.length != 0)
                //     {
                //         $sidebar_responsive.attr('data', new_color);
                //     }
                // });

                // $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function()
                // {
                //     var $btn = $(this);

                //     if (sidebar_mini_active == true) {
                //         $('body').removeClass('sidebar-mini');
                //         sidebar_mini_active = false;
                //         blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
                //     } else {
                //         $('body').addClass('sidebar-mini');
                //         sidebar_mini_active = true;
                //         blackDashboard.showSidebarMessage('Sidebar mini activated...');
                //     }

                //     // we simulate the window Resize so the charts will get updated in realtime.
                //     var simulateWindowResize = setInterval(function()
                //     {
                //         window.dispatchEvent(new Event('resize'));
                //     }, 180);

                //     // we stop the simulation of Window Resize after the animations are completed
                //     setTimeout(function()
                //     {
                //         clearInterval(simulateWindowResize);
                //     }, 1000);
                // });

                $('.switch-change-color input').on("switchChange.bootstrapSwitch", function()
                {
                        var $btn = $(this);
                        if (white_color == true)
                        {
                            setTimeout(function()
                            {
                                $('body').removeClass('white-content');
                            }, 900);
                            white_color = false;
                        }
                        else
                        {
                            setTimeout(function()
                            {
                                $('body').addClass('white-content');
                            }, 900);
                            white_color = true;                            
                        }
                        changeTheme(white_color);                        
                });

                function changeTheme(white_color)
                {
                    $.ajax({
                        url: '/changeTheme',
                        type: 'POST',
                        headers: {'X-CSRF-TOKEN': $('meta[name = "csrf-token"]').attr('content')},
                        data: {white_color:white_color},
                        success:function(data){}
                    });
                };
            });
        });

        </script>
        @stack('js')
    </body>
</html>
