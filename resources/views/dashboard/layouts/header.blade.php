<header class="top-0 left-0 absolute w-full flex items-center z-10">
    <div id="main-header" class="w-full bg-stone-900">
        <div class="flex items-center relative justify-between">
            <!-- Logo & Tittle Start-->
            <div class="flex items-center ml-2 px-2 w-full sm:max-w-[180px]">
                <a href="/dashboard" class="flex font-bold text-lg py-3">
                    <div
                        class="flex mx-2 items-center w-[30px] h-[30px] rounded-full bg-white border border-slate-200 drop-shadow-xl shadow-inner">
                        <img class="sm:w-[26px] sm:h-[26px] flex m-auto" src="/img/logo-vista-media.png" alt="">
                    </div>
                    <span class="text-white mx-1">Vista</span>
                    <span class="text-red-500 mx-1">Media</span>
                </a>
            </div>
            <!-- Logo & Tittle End-->
            <!-- Navbar Start-->
            @can('isMarketing')
                @include('dashboard.layouts.marketing-navbar')
            @endcan
            @can('isMedia')
                @include('dashboard.layouts.media-navbar')
            @endcan
            @can('isAccounting')
                @include('dashboard.layouts.accounting-navbar')
            @endcan
            @can('isWorkshop')
                @include('dashboard.layouts.workshop-navbar')
            @endcan
            @canany(['isAdmin', 'isOwner'])
                @include('dashboard.layouts.admin-navbar')
            @endcanany

            <!-- Navbar End-->
            <!-- Right Nav Start-->
            <div class="flex px-2 w-full  text-end py-3 items-center text-white justify-end">
                <div>
                    <div class="group" id="profile" name="profile" onclick="profileAction(event, this)">
                        <a href="#" class="right-nav">
                            @if (auth()->user()->avatar)
                                <img class="m-auto flex rounded-full items-center w-6 h-6 sm:w-8 sm:h-8"
                                    src="{{ asset('storage/' . auth()->user()->avatar) }}">
                            @else
                                <img class="m-auto flex rounded-full items-center w-6 h-6 sm:w-8 sm:h-8"
                                    src="/img/photo_profile.png">
                            @endif
                            <Span class="hidden md:flex ml-2">{{ auth()->user()->name }}</Span>
                            <svg name="profileArrow" id="profileArrow"
                                class="ml-1 w-4 sm:w-5 fill-current transition duration-300 ease-in-out" role="img"
                                clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                            </svg>
                        </a>
                    </div>
                    <div class="justify-end absolute mt-3 items-center transition duration-500 ease-in-out origin-center hidden"
                        id="profileChild" name="profileChild">
                        <div class="flex bg-stone-700 w-36 top-0 rounded-b-xl border drop-shadow-md">
                            <nav class="flex top-0 w-12 md:w-36">
                                <ul class="ml-4 text-left">
                                    <li class="group">
                                        <a class="mt-0 nav-a" href="/user/users/{{ auth()->user()->id }}">
                                            <svg class="fill-current" role="img" xmlns="http://www.w3.org/2000/svg"
                                                width="16" viewBox="0 0 24 24">
                                                <title>My Profile</title>
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm7.753 18.305c-.261-.586-.789-.991-1.871-1.241-2.293-.529-4.428-.993-3.393-2.945 3.145-5.942.833-9.119-2.489-9.119-3.388 0-5.644 3.299-2.489 9.119 1.066 1.964-1.148 2.427-3.393 2.945-1.084.25-1.608.658-1.867 1.246-1.405-1.723-2.251-3.919-2.251-6.31 0-5.514 4.486-10 10-10s10 4.486 10 10c0 2.389-.845 4.583-2.247 6.305z" />
                                            </svg>
                                            <span class="ml-1 hidden md:flex"> My Profile</span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <form action="/logout" method="post">
                                            @csrf
                                            <button type="submit" class="mt-1 nav-a">
                                                <svg class="fill-current w-4" role="img" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <title>Logout</title>
                                                    <path
                                                        d="M12 0C5.373 0 0 5.37 0 12s5.373 12 12 12c6.63 0 12-5.37 12-12S18.63 0 12 0zm-.84 4.67h1.68v8.36h-1.68V4.67zM12 18.155c-3.24-.002-5.865-2.63-5.864-5.868 0-2.64 1.767-4.956 4.314-5.655v1.71c-1.628.64-2.698 2.21-2.695 3.96 0 2.345 1.903 4.244 4.248 4.243 2.344-.002 4.244-1.903 4.243-4.248 0-1.745-1.07-3.312-2.694-3.95V6.63c2.55.7 4.314 3.018 4.314 5.66 0 3.24-2.626 5.864-5.865 5.864z" />
                                                </svg>
                                                <span class="ml-1 hidden md:flex"> Logout </span>
                                            </button>
                                        </form>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Right Nav End-->
        </div>
    </div>
</header>
