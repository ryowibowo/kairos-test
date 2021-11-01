<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Kairos Tes - @yield('title') </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    @include('includes.style')
    <style>
        label.error {
             color: #dc3545;
             font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <!--
			Tip 1: You can change the background color of the main header using: data-background-color="blue | purple | light-blue | green | orange | red"
		-->
        <div class="main-header" data-background-color="light-blue">
            <!-- Logo Header -->
            @include('includes.logo')
            <!-- End Logo Header -->

            <!-- Navbar Header -->
            @include('includes.navbar')
            <!-- End Navbar -->
        </div>

        <!-- Sidebar -->
        @include('includes.sidebar')
        <!-- End Sidebar -->
        <div class="main-panel">
            <div class="content">
                <div class="page-inner">
                    @yield('content')
				</div>
            </div>
        </div>
    </div>

    <!--scrtipt -->
    @stack('before-script')

    @include('includes.script')
    
    @stack('after-script')
</body>

</html>