<!DOCTYPE html>
<html lang="en">
    
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Mladen's Guitar Shop</title>
    
    <!-- LINKS -->
    
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('/') }}vendor/bootstrap/css/bootstrap.css" rel="stylesheet">
    <!-- Fontawesome core CSS -->
    <link href="{{ asset('/') }}vendor/bootstrap/css/font-awesome.min.css" rel='stylesheet'>
    <!--GOOGLE FONT -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <!--Slide Show Css -->
    <link href="{{ asset('/') }}css/main-style.css" rel='stylesheet'>
    <!-- custom CSS here -->
    <link href="{{ asset('') }}css/style.css" rel='stylesheet'>
    
    <!-- ENDLINKS -->
    
</head>
    
<body>
    
    @include('components.nav')
        
    <!-- GLAVNI_KONTEJNER -->
    
    <div class="container">

        <div class="col-lg-12">
            @empty(!session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endempty

            @empty(!session('success'))
                <div class="alert alert-success">{{ session('success') }} </div>
            @endempty

            @empty(!session('message'))
                <div class="alert alert-success">{{ session('success') }} </div>
            @endempty
        </div>
        @yield('container_1')
        
        <div class="row">
            
    <!-- SIDEBAR OVDE -->

        @include('components.sidebar')

    <!-- CONTAINER OVDE -->
            <div class="col-md-9">
                <div class="row">
        @yield('container_2')
                </div>
            </div>

        </div>
        
    </div>
    
    <!-- ENDGLAVNI_KONTEJNER -->
    
    
    <!-- PRE_FOOTER -->
    
    <div class="col-md-12 download-app-box text-center">
        
    </div>
    
    <!-- ENDPRE_FOOTER -->

    
    <!-- FOOTER -->
    
    @include('components.footer')
    
    <!-- ENFOOTER-->
    
    
    <!-- JSCRIPTS -->
    @section('appendJs')
    <!--Core JavaScript file  -->
    <script src="{{ asset('/') }}vendor/jquery/jquery-1.10.2.js" >
    </script>
    <!--bootstrap JavaScript file  -->
    <script src="{{ asset('/') }}vendor/bootstrap/js/bootstrap.js" ></script>
    <!--Slider JavaScript file  -->
    <script src="{{ asset('/') }}js/modernizr.custom.63321.js"></script>
    <script src="assets/ItemSlider/js/jquery.catslider.js"></script>
    <script src="{{ asset('/') }}js/jquery.catslider.js"></script>
    <script>
        $(function () {

            $('#mi-slider').catslider();

        });
		</script>
    @show
    <!-- ENDJSCRIPTS -->
    
</body>
</html>
