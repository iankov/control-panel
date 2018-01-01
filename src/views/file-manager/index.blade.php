@extends('icp::master')

@section('title', 'File Manager')

@section('content')

    <!-- jQuery and jQuery UI (REQUIRED) -->
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css" />
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>

    <!-- elFinder CSS (REQUIRED) -->
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/barryvdh/elfinder/css/elfinder.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('packages/barryvdh/elfinder/themes/windows-10/css/theme.css') }}">

    <!-- elFinder JS (REQUIRED) -->
    <script src="{{ asset('packages/barryvdh/elfinder/js/elfinder.min.js') }}"></script>

    @if($locale)
        <!-- elFinder translation (OPTIONAL) -->
        <script src="{{ asset("packages/barryvdh/elfinder/js/i18n/elfinder.$locale.js") }}"></script>
    @endif

    <!-- elFinder initialization (REQUIRED) -->
    <script type="text/javascript" charset="utf-8">
        // Documentation for client options:
        // https://github.com/Studio-42/elFinder/wiki/Client-configuration-options
        $().ready(function() {
            $('#elfinder').elfinder({
                // set your elFinder options here
                height: '70%',
                @if($locale)
                lang: '{{ $locale }}', // locale
                @endif
                customData: {
                    _token: '{{ csrf_token() }}'
                },
                url : '{{ $connector_url }}',  // connector URL
                soundPath: '{{ asset('packages/barryvdh/elfinder/sounds') }}'
            });
        });
    </script>

    <!-- Element where elFinder will be created (REQUIRED) -->
    <div id="elfinder" style="border: none;"></div>

@endsection