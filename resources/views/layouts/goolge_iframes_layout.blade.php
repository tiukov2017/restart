<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="cache-control" content="max-age=0" />
    <meta http-equiv="cache-control" content="no-cache" />
    <meta http-equiv="expires" content="0" />
    <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
    <meta http-equiv="pragma" content="no-cache" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="//cdn.rawgit.com/morteza/bootstrap-rtl/v3.3.4/dist/css/bootstrap-rtl.min.css">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"/>

    @yield('styles')

</head>

<body>


@yield('content')

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="{{ asset('js/google_api.js') }}"></script>
<script src="{{ asset('js/googleResultsPreview.js') }}"></script>
<script src="{{ asset('js/globals.js') }}" class="script"></script>
<script src="{{ asset('js/googleClasses.js') }}" class="script"></script>
<script src="{{ asset('js/googleHelpers.js') }}"></script>
<script src="{{ asset('js/googleApiService.js') }}"></script>

@yield('scripts')

</body>

</html>


