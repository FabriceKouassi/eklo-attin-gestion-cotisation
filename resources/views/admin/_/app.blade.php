<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <meta name="msapplication-TileImage" content="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">
    <link rel="apple-touch-icon" sizes="60x60" href="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">
    <link rel="icon" type="image/png" sizes="60x60" href="{{ asset('storage/images/website/logo sans ecriture inhp.png') }}">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('global.name') }} | {{ $title }}</title>


    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/plugin/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Custom styles for this page -->
    <link href="{{ asset('admin/plugin/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{asset('admin/plugin/select2@4.0.13/select2.min.css')}}" rel="stylesheet" />
    <link href="{{asset('admin/plugin/datepicker-master/dist/datepicker.min.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('admin/plugin/jquery-confirm@3.3.2/jquery-confirm.min.css') }}">
    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/richtext.min.css') }}" rel="stylesheet">

    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">

</head>

<body id="page-top">

    @if (Auth::user()->enabled === 0)
        <div class="compte-desactive">
            <p>
                Bonjour <span>Mr {{ Auth::user()->nom }} {{ Auth::user()->prenoms }}</span> votre compte est momentanement désactivé. <br>
                Merci de contacter votre administrateur ! <br>
            </p>
            <a href="{{ route('front.index') }}" class="my-3">Retour sur le site web</a>
        </div>
    @else
        {{-- @if (Auth::user()->role == 'admin')
            @php
                return redirect()->route('company.new');
            @endphp
        @endif --}}
        <div id="wrapper">
            @include('admin/_.nav')

            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    @include('admin/_.head')

                    @yield('content')
                </div>
                <!-- End of Main Content -->

                @include('admin/_.footer')
            </div>
        </div>
    @endif


    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>




    <!-- Bootstrap core JavaScript-->

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="{{ asset('admin/plugin/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin/plugin/jquery-easing/jquery.easing.min.js') }}"></script>
    <!-- Page level plugins -->
    <script src="{{ asset('admin/plugin/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/plugin/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <!-- Select 2 -->
    <script src="{{asset('admin/plugin/select2@4.0.13/select2.min.js')}}"></script>
    <!-- Date picker -->
    <script src="{{asset('admin/plugin/datepicker-master/dist/datepicker.min.js')}}"></script>
    <script src="{{asset('admin/plugin/datepicker-master/i18n/datepicker.fr-FR.js')}}"></script>
    <!-- Input mask -->
    <script src="{{asset('admin/plugin/Inputmask-5.x/dist/jquery.inputmask.min.js')}}"></script>
    <script src="{{asset('admin/plugin/Inputmask-5.x/dist/inputmask.min.js')}}"></script>
    <script src="{{asset('admin/plugin/Inputmask-5.x/dist/bindings/inputmask.binding.js')}}"></script>
    <!-- Jquery confirm -->
    <script src="{{ asset('admin/plugin/jquery-confirm@3.3.2/jquery-confirm.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin/js/script.js') }}"></script>
    <!-- rich text editor plugin-->
    <script src="{{ asset('admin/js/jquery.richtext.js') }}"></script>

    @if(Session::has('ess-msg'))
        <script>
            $( document ).ready(function() {
                $.confirm({
                    title: 'Message!',
                    typeAnimated: true,
                    content: "<?= Session::get('ess-msg') ?>",
                    buttons: {
                        somethingElse: {
                            text: 'Fermer',
                            action: function(){
                            }
                        }
                    }
                });
            });
        </script>
    @endif

    @if ($errors->any())
        <script>
            $( document ).ready(function() {
                $.confirm({
                    title: 'Erreur!',
                    typeAnimated: true,
                    content: "<?= Session::get('ess-msg-error') ?>",
                    buttons: {
                        somethingElse: {
                            text: 'Fermer',
                            action: function(){
                            }
                        }
                    }
                });
            });
        </script>
    @endif
    <script>
        $(document).ready(function() {
            $('.text-editor').richText();
        });

        $('document').ready(function()
        {
            $('textarea').each(function(){
                    $(this).val($(this).val().trim());
                }
            );
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.text-editor2').richText();
        });

        $('document').ready(function()
        {
            $('textarea').each(function(){
                    $(this).val($(this).val().trim());
                }
            );
        });
    </script>

    <script src="{{ asset('admin/js/limiteImageCharger.js') }}"></script>

</body>

</html>
