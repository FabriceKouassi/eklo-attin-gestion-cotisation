<!DOCTYPE html>
<html lang="fr">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="{{ env('APP_NAME') }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
	<meta name="description" content="Site web officiel de l'INHP">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <meta property="og:locale" content="fr_FR">
	<meta property="og:site_name" content="INHP">
	<meta property="og:title" content="{{ env('APP_NAME') }}">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:image" content="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="547">
    <meta property="og:image:height" content="293">
    <meta property="og:image:alt" content="Logo INHP">

    <title>{{ env('APP_NAME') }} | {{ $referencement->title ?? $title }}</title>

        <meta name="description" content="{{ $referencement->meta_description ?? '' }}">

        <meta property="og:description" content="{{ $referencement->meta_description ?? '' }}">

        <meta name="keywords" lang="fr" content="{{ str_replace('&#039;', '\'', $referencement->meta_keywords ?? '') }}">
        @if ($pIndex == 'accueil')
            <meta name="identifier-url" content="{{ $referencement->meta_identifier_url ?? '' }}">
        @endif
        <meta name="robots" content="{{ $referencement->meta_robots ?? '' }}">
        <meta name="category" content="{{ $referencement->meta_category ?? '' }}">
        <meta name="reply-to" content="{{ $referencement->meta_reply_to ?? '' }}">

    @empty($referencement)
        <meta name="description" content="INHP">
        <meta name="keywords" content="INHP">
        <meta name="robots" content="INDEX,FOLLOW">
    @endempty

    <meta name="msapplication-TileImage" content="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">

    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">
    <link rel="icon" type="image/png" sizes="60x60" href="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">


    <link rel="icon" type="image/png" href="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">
    <link href="{{ asset('model/css/index.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css" />

    <link rel="stylesheet" href="{{ asset('model/css/toastr.css') }}">
    <script src="{{ asset('admin/js/jquery.js') }}"></script>
    <script src="{{ asset('model/js/toastr.js') }}"></script>

    @stack('link-script-agenda-calendar')
    @stack('gallery-css')
    

</head>

<body>

    @include('front._.menu')

    <div class="base-body">
        @yield('content')
    </div>

    @include('front._.footer')

    @stack('script-mobile-menu')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
    <script src="{{ asset('model/js/carousel.js') }}"></script>

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function () {
            var calendar = new ej.calendars.Calendar();

                // Render initialized calendar.
                calendar.appendTo('#datepicker')

            $("#owl-demo").owlCarousel({

                navigation: true,

                slideSpeed: 300,
                paginationSpeed: 400,

                items: 1,
                itemsDesktop: false,
                itemsDesktopSmall: false,
                itemsTablet: false,
                itemsMobile: false

            });
        });
    </script>
    <script src="{{ asset('model/js/script.js') }}"></script>

    <div class="" style="visibility: hidden;">
        <span>{!! Toastr::message() !!}</span>
    </div>

    @stack('script-agenda-calendar')
    @stack('gallery-script')
    @stack('scripts-search-document')
    @stack('scripts-checked-is-not-robot')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var currentPage = window.location.pathname; // Récupère le chemin de la page actuelle
            var menuLinks = document.querySelectorAll('nav ul li a'); // Sélectionne tous les liens du menu

            // Parcourt tous les liens du menu
            menuLinks.forEach(function (link) {
                var linkPage = link.getAttribute('data-page');

                // Vérifie si le lien correspond à la page actuelle
                if (currentPage.includes(linkPage)) {
                    link.classList.add('active'); // Ajoute la classe "active" au lien correspondant
                }
            });
        });
    </script>
</body>

</html>
