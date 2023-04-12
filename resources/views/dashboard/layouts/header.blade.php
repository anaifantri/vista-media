<header class="bg-cyan-800 top-0 left-0 absolute w-full flex items-center">
    <div class="w-full">
        <!-- Logo & Tittle Start-->
        <div class="flex items-center relative justify-between">
            <div class="flex items-center px-4 max-w-[250px] w-full">
                <a href="#" class="flex font-bold text-lg py-3">
                    <div
                        class="flex mx-2 items-center w-[30px] h-[30px] rounded-full bg-white border border-slate-200 drop-shadow-xl shadow-inner">
                        <img class="w-[26px] h-[26px] flex m-auto" src="/img/logo-vista-media.png" alt="">
                    </div>
                    <span class="text-white mx-1">Vista</span>
                    <span class="text-red-500 mx-1">Media</span>
                </a>
            </div>
            <!-- Logo & Tittle End-->
            <!-- Hamburger Menu Start-->
            <div class="flex items-center px-4 w-full sm:hidden md:hidden lg:hidden">
                <button id="hamburger" name="hamburger" type="button">
                    <span class="origin-top-left hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="origin-bottom-left hamburger-line transition duration-300 ease-in-out"></span>
                </button>
            </div>
            <!-- Hamburger Menu End-->
            <!-- Right Nav Start-->
            <div class="flex px-4 w-full  text-end py-3 items-center text-white justify-end">
                <div class="group">
                    <a href="#" class="right-nav">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24">
                            <path fill="none" d="M0 0h24v24H0V0z" />
                            <path
                                d="M18 16v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.68-1.5-1.51-1.5S10.5 3.17 10.5 4v.68C7.63 5.36 6 7.92 6 11v5l-1.3 1.29c-.63.63-.19 1.71.7 1.71h13.17c.89 0 1.34-1.08.71-1.71L18 16zm-6.01 6c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zM6.77 4.73c.42-.38.43-1.03.03-1.43-.38-.38-1-.39-1.39-.02C3.7 4.84 2.52 6.96 2.14 9.34c-.09.61.38 1.16 1 1.16.48 0 .9-.35.98-.83.3-1.94 1.26-3.67 2.65-4.94zM18.6 3.28c-.4-.37-1.02-.36-1.4.02-.4.4-.38 1.04.03 1.42 1.38 1.27 2.35 3 2.65 4.94.07.48.49.83.98.83.61 0 1.09-.55.99-1.16-.38-2.37-1.55-4.48-3.25-6.05z" />
                        </svg>
                    </a>
                </div>
                <div class="group">
                    <a href="#" class="right-nav">
                        <svg class="fill-current" xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 64 64">
                            <circle cx="16" cy="31.58" r="1" />
                            <path
                                d="M45.75,19H10.32A5.3,5.3,0,0,0,5,24.26V38.74c0,2.37,2.75,4.17,4,4.87v7.06a1,1,0,0,0,1,1,1,1,0,0,0,.71-.3L18.07,44H45.75A5.26,5.26,0,0,0,51,38.74V24.46A5.28,5.28,0,0,0,45.75,19ZM13,31.58a3,3,0,1,1,3,3A3,3,0,0,1,13,31.58Zm8,0a3,3,0,1,1,3,3A3,3,0,0,1,21,31.58Zm8,0a3,3,0,1,1,3,3A3,3,0,0,1,29,31.58Zm11,3a3,3,0,1,1,3-3A3,3,0,0,1,40,34.58Z" />
                            <circle cx="40" cy="31.58" r="1" />
                            <circle cx="32" cy="31.58" r="1" />
                            <circle cx="24" cy="31.58" r="1" />
                            <path
                                d="M53.74,13h-34a5.1,5.1,0,0,0-5,4h31A7.27,7.27,0,0,1,53,24.25V38h.75A5.25,5.25,0,0,0,59,32.75V18.26A5.25,5.25,0,0,0,53.74,13Z" />
                        </svg>
                    </a>
                </div>
                <div>
                    <div class="group" id="profile" name="profile">
                        <a href="#" class="right-nav">
                            @if (auth()->user()->avatar)
                                <img class="m-auto flex rounded-full items-center w-8 h-8"
                                    src="{{ asset('storage/' . auth()->user()->avatar) }}">
                            @else
                                <img class="m-auto flex rounded-full items-center w-8 h-8" src="/img/photo_profile.png">
                            @endif
                            <Span class="hidden sm:flex ml-2">{{ auth()->user()->name }}</Span>
                            <svg name="profileArrow" id="profileArrow"
                                class="ml-1 fill-current transition duration-300 ease-in-out" role="img"
                                width="20" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                            </svg>
                        </a>
                    </div>
                    <div class="flex absolute items-center mr-3 opacity-0 transition duration-500 ease-in-out origin-center"
                        id="profileChild" name="profileChild">
                        <div
                            class="flex absolute bg-emerald-50 opacity-40 w-32 h-32 top-[15px] rounded-b-xl border drop-shadow-md">
                        </div>
                        <nav class="flex absolute top-[15px] w-36 mr-10">
                            <ul class="ml-4 text-left">
                                <li class="group">
                                    <a class="mt-2 nav-a" href="">
                                        <svg class="fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                            width="16" viewBox="0 0 24 24">
                                            <title>My Profile</title>
                                            <path
                                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                        </svg>
                                        <span class="ml-1 sm:hidden"> P </span>
                                        <span class="ml-1 hidden sm:flex"> My Profile</span>
                                    </a>
                                </li>
                                <li class="group">
                                    <a class="mt-2 nav-a" href="">
                                        <svg class="fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                            width="16" height="24" viewBox="0 0 24 24">
                                            <title>Notifikasi</title>
                                            <path
                                                d="M12 .02c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6.99 6.98l-6.99 5.666-6.991-5.666h13.981zm.01 10h-14v-8.505l7 5.673 7-5.672v8.504z" />
                                        </svg>
                                        <span class="ml-1 sm:hidden"> N </span>
                                        <span class="ml-1 hidden sm:flex"> Notifikasi</span>
                                    </a>
                                </li>
                                <li class="group">
                                    <form action="/logout" method="post">
                                        @csrf
                                        <button type="submit" class="mt-2 nav-a">
                                            <svg class="fill-current w-4" role="img" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <title>Logout</title>
                                                <path
                                                    d="M12 0C5.373 0 0 5.37 0 12s5.373 12 12 12c6.63 0 12-5.37 12-12S18.63 0 12 0zm-.84 4.67h1.68v8.36h-1.68V4.67zM12 18.155c-3.24-.002-5.865-2.63-5.864-5.868 0-2.64 1.767-4.956 4.314-5.655v1.71c-1.628.64-2.698 2.21-2.695 3.96 0 2.345 1.903 4.244 4.248 4.243 2.344-.002 4.244-1.903 4.243-4.248 0-1.745-1.07-3.312-2.694-3.95V6.63c2.55.7 4.314 3.018 4.314 5.66 0 3.24-2.626 5.864-5.865 5.864z" />
                                            </svg>
                                            <span class="ml-1 sm:hidden"> L </span>
                                            <span class="ml-1 hidden sm:flex"> Logout </span>
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
            <!-- Right Nav End-->
        </div>
    </div>
</header>
