<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <title>VISTA MEDIA | {{ $title }}</title>
    <link rel="stylesheet" href="../../../../../css/style.css">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
</head>

<body>
    <!-- Header start-->
    @if (auth()->check())
        @include('dashboard.layouts.header')
    @endif
    <!-- Header end-->
    <!-- Sidebar start-->
    <div class="flex relative z-10">
        @include('dashboard.layouts.sidebar')
    </div>
    <!-- Sidebar End-->
    <!-- Main start-->
    <div id="main-wrapper" class="w-full h-full top-0 relative z-0">
        {{-- <div class="flex relative"> --}}
        <!-- Sidebar start-->
        {{-- @include('dashboard.layouts.sidebar') --}}
        <!-- Sidebar End-->
        <!-- Main Section start -->
        <div class="relative ml-14">
            @yield('container')
        </div>
        <!-- Main Section end -->
        {{-- </div> --}}
    </div>
    <!-- Main end-->
    <!-- Footer start-->
    <div
        class="w-full fixed fixed-bottom bg-cyan-800 items-center text-center bottom-0 z-50 p-1 drop-shadow-xl shadow-inner">
        <h1 class="text-center text-white font-sans text-sm">&copy 2023 PT. Vista Media | www.vistamedia.co.id</h1>
    </div>
    <!-- Footer end-->

    <!-- Javascript start-->
    <script src="/js/dashboard.js"></script>
    <!-- Javascript end-->

</body>

</html>
