<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <title>VISTA MEDIA | {{ $title }}</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="/img/favicon.ico" type="image/x-icon">
</head>

<body class="bg-zinc-100">
    <!-- Container start -->
    <div class="container bg-zinc-100 mx-auto flex h-screen w-full position-relative">
        <div
            class="m-auto w-60 h-[340px] sm:h-[500px] sm:w-[360px] bg-zinc-100 position-absolute p-5 rounded-xl drop-shadow-xl sm:shadow-2xl items-center justify-center sm:rounded-2xl">
            <!-- Logo start-->
            <div
                class="drop-shadow-lg m-auto sm:mt-5 w-20 h-20 sm:w-[90px] sm:h-[90px] flex position-relative bg-white rounded-full border">
                <div
                    class="drop-shadow-md m-auto w-[72px] h-[72px] sm:w-[82px] sm:h-[82px] rounded-full border items-center flex">
                    <img class="w-16 h-16 sm:w-[74px] sm:h-[74px]" src="/img/logo-vista-media.png" alt="">
                </div>
            </div>
            <!-- Logo end-->
            <!-- Text tittle start-->
            <div class="m-auto sm:mt-4 position-relative flex p-2 items-center justify-center">
                <h2 class="tracking-widest font-bold text-xl sm:text-2xl text-gray-500">Please Login</h2>
            </div>
            <!-- Text tittle end-->
            <!-- Form login start-->
            @if (session()->has('loginError'))
                <div class="flex items-center justify-center m-auto">
                    <div class="flex alert-danger">
                        <div class="flex m-auto text-red-800">
                            <svg class="w-6 fill-current mx-1" clip-rule="evenodd" fill-rule="evenodd"
                                beaa14f1a55f2b250cf9a72c3d80716468efbc1bbeaa14f1a55f2b250cf9a72c3d80716468efbc1b
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m2.095 19.886 9.248-16.5c.133-.237.384-.384.657-.384.272 0 .524.147.656.384l9.248 16.5c.064.115.096.241.096.367 0 .385-.309.749-.752.749h-18.496c-.44 0-.752-.36-.752-.749 0-.126.031-.252.095-.367zm9.907-6.881c-.414 0-.75.336-.75.75v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5c0-.414-.336-.75-.75-.75zm-.002-3c-.552 0-1 .448-1 1s.448 1 1 1 1-.448 1-1-.448-1-1-1z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="font-semibold mx-1">Warning!!</span> {{ session('loginError') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="m-auto relative items-center justify-center flex">
                <form action="/login" method="post">
                    @csrf
                    <!-- Input username start-->
                    <div
                        class="mt-2 h-10 sm:w-[238px] w-[192px] sm:h-12 shadow-inner inset-10 sm:mt-6 rounded-2xl items-center justify-center flex">
                        <input name="username" id="username"
                            class="shadow-inner sm:w-[230px] sm:h-10 tracking-wider text-gray-500 h-8 rounded-xl pl-2 outline-none w-[184px]"
                            type="text" placeholder="Username" autofocus required>
                    </div>
                    <!-- Input username end-->
                    <!-- Input password start-->
                    <div
                        class="mt-2 h-10 sm:w-[238px] w-[192px] sm:h-12 shadow-inner inset-10 sm:mt-6 rounded-2xl items-center justify-center flex">
                        <input
                            class="shadow-inner sm:w-[230px] sm:h-10 tracking-wider text-gray-500 h-8 rounded-xl pl-2 outline-none w-[184px]"
                            type="password" placeholder="Password" name="password" id="password" required>
                    </div>
                    <!-- Input password end-->
                    <!-- Button login start-->
                    <div class="flex items-center justify-center">
                        <button
                            class="w-full m-auto text-white font-semibold sm:text-lg tracking-widest bg-cyan-500 sm:w-[230px] mt-5 sm:h-10 sm:mt-8 p-1 position-relative rounded-3xl drop-shadow-xl hover:bg-cyan-600 cursor-pointer"
                            type="submit">
                            Login
                        </button>
                    </div>
                    <!-- Button login end-->
                </form>
            </div>
            <!-- Form login end-->
        </div>
    </div>
    <!-- Container end -->

</body>

</html>
