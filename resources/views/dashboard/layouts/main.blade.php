<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>VISTA MEDIA | Dashboard</title>
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
    <link href="/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Header start-->
    @include('dashboard.layouts.header');
    <!-- Header end-->
    <!-- Main start-->
    <div class="w-full">
        <div class="flex relative mt-8">
            <!-- Sidebar start-->
            @include('dashboard.layouts.sidebar')
            <!-- Sidebar End-->
            <!-- Main Section start -->
            <div class="mx-4 px-4 w-full z-0 relative">
                @yield('container')
            </div>
            <!-- Main Section end -->
        </div>
    </div>
    <!-- Main end-->
    <!-- Footer start-->
    <div
        class="w-full fixed fixed-bottom bg-cyan-800 items-center text-center bottom-0 z-20 p-1 drop-shadow-xl shadow-inner">
        <h1 class="text-center text-white font-sans text-sm">&copy 2023 PT. Vista Media | www.vistamedia.co.id</h1>
    </div>
    <!-- Footer end-->

    <!-- Javascript start-->
    <script src="/js/dashboard.js"></script>
    <!-- Javascript end-->

</body>

</html>
