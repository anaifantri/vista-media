<div class="div-nav-a" title="Data Pengguna">
    <a class="nav-a" href="/user/users">
        <svg role="img" class="nav-svg transition duration-300 ease-in-out {{ Request::is('user*') ? 'active' : '' }}"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <title>USER</title>
            <path
                d="M5.331 3.987H4.012v-1.32h1.32zm7.605 16.001c-1.78-.08-3.15-.532-4.21-1.185.718 3.118 3.405 4.65 3.535 4.723l.792.437c6.063-.405 9.611-4.318 9.611-9.436v-1.109c-1.441 4.7-4.795 6.793-9.728 6.57M4.006 9.605h1.332v2.94h1.336V7.627H8.01v9.612C8.009 21.8 12 24 12 24c-6.705 0-10.664-4.065-10.664-9.473V3.65H2.67v7.274h1.336zM2.67 1.334H1.336V0H2.67zm2.661 6.953h-1.32v-1.32h1.32zm1.334-1.98h-1.32v-1.32h1.32zm1.343-1.66H6.674v-1.32h1.335zM6.674 2.654H5.338v-1.32h1.336zM22.147 13.26l.517-1.688V.015c-6.045 0-6.674 2.317-6.674 4.531V17.24c0 .657-.064 1.354-.197 2.037 3.205-.583 5.296-2.565 6.354-6.016Z" />
        </svg>
    </a>
    <li id="liUser" class="group hidden" onclick="showHideDropdown(this)">
        <a href="#" class="nav-a mx-2 {{ Request::is('user*') ? 'active' : '' }}">
            <span class="flex w-40"> DATA PENGGUNA </span>
            <svg id="userArrow" name="userArrow" class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Arrow</title>
                <path
                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
            </svg>
        </a>
        <!-- User Child Start -->
        <ul id="userChild" class="hidden">
            @can('isUserMenu')
                <li class="group" title="Pengguna">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('/user*') ? 'active' : '' }}" href="/user/users">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
                        </svg>
                        <span class="flex w-40"> PENGGUNA </span>
                    </a>
                </li>
            @endcan
        </ul>
        <!-- User Child End -->
    </li>
</div>
