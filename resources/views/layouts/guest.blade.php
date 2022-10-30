<!DOCTYPE html>
<html lang="en" class="light">

<head>
    <meta charset="utf-8">
    <link href="dist/images/logo.svg" rel="shortcut icon">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Rubick admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Rubick Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>JRM System</title>
    <!-- BEGIN: CSS Assets-->

    @vite('resources/backend/css/app.css')
    <!-- END: CSS Assets-->
</head>
<!-- END: Head -->

<body class="login">
    <div class="container px-sm-10">
        <div class="grid columns-2 gap-4">
           {{ $slot }}
        </div>
    </div>
    <!-- BEGIN: Dark Mode Switcher-->

    <!-- END: Dark Mode Switcher-->
    <!-- BEGIN: JS Assets-->
    @vite('resources/backend/js/app.js')
    <!-- END: JS Assets-->

</body>

</html>






{{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
{{--
<meta name="csrf-token" content="{{ csrf_token() }}"> --}}