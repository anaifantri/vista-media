<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- @vite('resources/css/app.css') --}}
    <title>VISTA MEDIA | {{ $title }}</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    @php
        $dir = 'img/bg'; // public/images
        if ($files = \Storage::disk('web')->allFiles($dir)) {
            $path = $files[array_rand($files)];
        }
    @endphp
    <div class="container-xl mx-auto position-relative flex w-full h-screen bg-center bg-auto"
        style="background-image: url({{ asset($path) }})">
        @auth
            <div class="flex w-full absolute justify-end items-center mt-4">
                <a class="right-nav text-stone-200 btn-primary" href="/dashboard/{{ encrypt($company->id) }}">
                    <svg class="fill-current w-5 mx-2" role="img" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <title>DASHBOARD</title>
                        <path
                            d="M11.9922 1.3945a.7041.7041 0 00-.498.211L.1621 13.0977A.5634.5634 0 000 13.494a.567.567 0 00.5664.5664H2.67v8.0743c0 .2603.2104.4707.4707.4707h7.9473v-3.6836L8.037 15.8672a2.42 2.42 0 01-.9473.1933c-1.3379 0-2.4218-1.0868-2.4218-2.4257 0-1.339 1.084-2.4239 2.4218-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 .3359-.068.6563-.1915.9472l1.7676 1.7676v-5.375C10.2 10.615 9.5723 9.744 9.5723 8.7266c0-1.339 1.0859-2.4258 2.4238-2.4258 1.338 0 2.4219 1.0868 2.4219 2.4258 0 1.0174-.6259 1.8884-1.5137 2.248v5.375l1.7656-1.7676a2.4205 2.4205 0 01-.1914-.9472c0-1.339 1.086-2.4239 2.4238-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 1.3389-1.084 2.4257-2.422 2.4257a2.42 2.42 0 01-.9472-.1933l-3.0508 3.0547v3.6836h7.9473a.4702.4702 0 00.4707-.4707v-8.0743h2.1113a.5686.5686 0 00.3965-.162c.2233-.2185.2262-.5775.0078-.8008l-2.5156-2.5723V6.4707c0-.2603-.2104-.4727-.4707-.4727h-1.9649c-.2603 0-.4707.2124-.4707.4727v1.1035L12.5 1.6035a.7056.7056 0 00-.5078-.209zm.0039 6.3614c-.5352 0-.9688.4351-.9688.9707 0 .5355.4336.9687.9688.9687a.9683.9683 0 00.9687-.9687c0-.5356-.4335-.9707-.9687-.9707zM7.0898 12.666a.9683.9683 0 00-.9687.9688c0 .5355.4336.9707.9687.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688zm9.8125 0c-.5351 0-.9707.4332-.9707.9688 0 .5355.4356.9707.9707.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688Z" />
                    </svg>
                    <span class="flex group"> MY DASHBOARD </span>
                </a>
                <form action="/logout" method="post">
                    @csrf
                    <button class="right-nav text-stone-200 btn-danger">
                        <svg class="fill-current w-5 mx-2" role="img" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <title>LOGOUT</title>
                            <path
                                d="M12 0C5.373 0 0 5.37 0 12s5.373 12 12 12c6.63 0 12-5.37 12-12S18.63 0 12 0zm-.84 4.67h1.68v8.36h-1.68V4.67zM12 18.155c-3.24-.002-5.865-2.63-5.864-5.868 0-2.64 1.767-4.956 4.314-5.655v1.71c-1.628.64-2.698 2.21-2.695 3.96 0 2.345 1.903 4.244 4.248 4.243 2.344-.002 4.244-1.903 4.243-4.248 0-1.745-1.07-3.312-2.694-3.95V6.63c2.55.7 4.314 3.018 4.314 5.66 0 3.24-2.626 5.864-5.865 5.864z" />
                        </svg>
                        <span class="flex group"> LOGOUT </span>
                    </button>
                </form>
                {{-- <form action="/logout" method="post">
                    @csrf
                    <button type="submit" class="mt-1 btn-danger">
                        <svg class="fill-current w-5" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Logout</title>
                            <path
                                d="M12 0C5.373 0 0 5.37 0 12s5.373 12 12 12c6.63 0 12-5.37 12-12S18.63 0 12 0zm-.84 4.67h1.68v8.36h-1.68V4.67zM12 18.155c-3.24-.002-5.865-2.63-5.864-5.868 0-2.64 1.767-4.956 4.314-5.655v1.71c-1.628.64-2.698 2.21-2.695 3.96 0 2.345 1.903 4.244 4.248 4.243 2.344-.002 4.244-1.903 4.243-4.248 0-1.745-1.07-3.312-2.694-3.95V6.63c2.55.7 4.314 3.018 4.314 5.66 0 3.24-2.626 5.864-5.865 5.864z" />
                        </svg>
                        <span class="ml-1 hidden md:flex"> Logout </span>
                    </button>
                </form> --}}
            </div>
        @else
            <div class="flex w-full absolute justify-end items-center mt-4">
                <a href="/login" class="index-link btn-warning mr-4">
                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path d="M8 9v-4l8 7-8 7v-4h-8v-6h8zm2-7v2h12v16h-12v2h14v-20h-14z" />
                    </svg>
                    <span class="mx-2">Log in</span>
                </a>
            </div>
        @endauth
        <div class="p-10 position-absolute m-auto">
            <div
                class="border border-transparent flex position-relative mb-5 mx-auto border-white border-opacity-50 rounded-full shadow shadow-white bg-white bg-opacity-20 w-32 h-32 md:w-40 lg:w-40 md:h-40 lg:h-40">
                <img class="w-24 md:w-32 lg:w-32 m-auto position-absolute" src="/img/logo-vista-media.png"
                    alt="">
            </div>
            @auth
                <h1
                    class="drop-shadow-lg shadow-black animate-pulse text-3xl md:text-5xl lg:text-5xl text-center text-white font-sans font-semibold tracking-wider">
                    WELCOME BACK, {{ auth()->user()->name }}</h1>
            @else
                <h1
                    class="drop-shadow-lg shadow-black animate-pulse text-3xl md:text-5xl lg:text-5xl text-center text-white font-sans font-semibold tracking-wider">
                    Comming Soon</h1>
                <p class="drop-shadow-md shadow-black text-white text-center position-absolute mt-3">our
                    website is
                    currently under construction</p>
            @endauth
        </div>
    </div>
</body>

</html>
