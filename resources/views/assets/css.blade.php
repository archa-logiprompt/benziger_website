<!doctype html>
<html class="no-js" lang="en">
<!--
██╗      ██████╗  ██████╗ ██╗██████╗ ██████╗  ██████╗ ███╗   ███╗██████╗ ████████╗
██║     ██╔═══██╗██╔════╝ ██║██╔══██╗██╔══██╗██╔═══██╗████╗ ████║██╔══██╗╚══██╔══╝
██║     ██║   ██║██║  ███╗██║██████╔╝██████╔╝██║   ██║██╔████╔██║██████╔╝   ██║
██║     ██║   ██║██║   ██║██║██╔═══╝ ██╔══██╗██║   ██║██║╚██╔╝██║██╔═══╝    ██║
███████╗╚██████╔╝╚██████╔╝██║██║     ██║  ██║╚██████╔╝██║ ╚═╝ ██║██║        ██║

-->

<head>
    <title>Benziger College Of Nursing</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="author" content="Azeezia Medical College">
    <meta name="viewport" content="width=device-width,initial-scale=1.0" />
    <meta name="description" content="">

    <link rel="shortcut icon" type="image/x-icon" href="https://azeezia.com/wp-content/uploads/2024/05/logo.png">

    <link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin>
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">



    <link rel="stylesheet" href="{{ asset('header/css/vendors.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('header/css/icon.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('header/css/style.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('header/css/responsive.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('header/css/azeezia.css') }}" />







    <link rel="stylesheet" href="{{ asset('backend/css/custom.min.css') }}" />
    <!-- <link rel="stylesheet" href="<?php //echo get_template_directory_uri();
    ?>public/css/branding-agency.css" /> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="{{ asset('js/plugin/webfont/webfont.min.js') }}"></script>

    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/kaiadmin.min.css') }}" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}" />


</head>
@yield('content')

</html>
