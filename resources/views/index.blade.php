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

<body>
    <div class="container-xl mx-auto position-relative flex h-screen bg-fixed bg-center bg-auto"
        style="background-image: url('https://source.unsplash.com/1280x1080?nature')">
        <div class="flex w-full absolute justify-end items-center mt-4">
            <a href="/login" class="index-link btn-warning mr-4">
                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M8 9v-4l8 7-8 7v-4h-8v-6h8zm2-7v2h12v16h-12v2h14v-20h-14z" />
                </svg>
                <span class="mx-2">Log in</span>
            </a>
        </div>
        <div class="flex w-full absolute justify-end items-center mt-4">
            <a href="/login" class="index-link btn-warning mr-4">
                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                    viewBox="0 0 24 24">
                    <path d="M8 9v-4l8 7-8 7v-4h-8v-6h8zm2-7v2h12v16h-12v2h14v-20h-14z" />
                </svg>
                <span class="mx-2">Log in</span>
            </a>
        </div>
        <div class="p-10 position-absolute m-auto">
            <div
                class="border border-transparent flex position-relative mb-5 mx-auto border-white border-opacity-50 rounded-full shadow shadow-white bg-white bg-opacity-20 w-32 h-32 md:w-40 lg:w-40 md:h-40 lg:h-40">
                <img class="w-24 md:w-32 lg:w-32 m-auto position-absolute" src="/img/logo-vista-media.png"
                    alt="">
            </div>
            <h1
                class="drop-shadow-lg shadow-black animate-pulse text-3xl md:text-5xl lg:text-5xl text-center text-white font-sans font-semibold tracking-wider">
                Comming Soon</h1>
            <p class="drop-shadow-md shadow-black text-white text-center position-absolute mt-3">our
                website is
                currently under construction</p>
        </div>
    </div>
</body>

</html>
