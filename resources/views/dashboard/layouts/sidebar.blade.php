@canany(['isAdmin', 'isMedia', 'isMarketing', 'isOwner', 'isWorkshop', 'isAccounting'])
    <div name="nav-menu" id="nav-menu" class="flex fixed h-screen pb-24 pt-2 px-2 top-14">
        <div class="bg-teal-50 rounded-2xl overflow-y-auto border">
            <div class="flex fixed p-2 rounded-2xl items-center bg-teal-50 z-10">
                <button class="" id="hamburger" name="hamburger" type="button">
                    <span class="origin-top-left hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="hamburger-line transition duration-300 ease-in-out"></span>
                    <span class="origin-bottom-left hamburger-line transition duration-300 ease-in-out"></span>
                </button>
                <span id="menu" name="menu" class="w-40 mx-2 justify-center hidden border-b"> MAIN MENU </span>
            </div>
            <nav class="mt-10 relative z-0">
                <ul class="block">
                    <div>
                        <!-- Sidebar Dashboard start-->
                        <div class="nav-a mx-2">
                            <a class="nav-a" href="/dashboard">
                                <svg class="nav-svg transition duration-300 ease-in-out {{ Request::is('dashboard') ? 'active' : '' }}"
                                    role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>DASHBOARD</title>
                                    <path
                                        d="M11.9922 1.3945a.7041.7041 0 00-.498.211L.1621 13.0977A.5634.5634 0 000 13.494a.567.567 0 00.5664.5664H2.67v8.0743c0 .2603.2104.4707.4707.4707h7.9473v-3.6836L8.037 15.8672a2.42 2.42 0 01-.9473.1933c-1.3379 0-2.4218-1.0868-2.4218-2.4257 0-1.339 1.084-2.4239 2.4218-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 .3359-.068.6563-.1915.9472l1.7676 1.7676v-5.375C10.2 10.615 9.5723 9.744 9.5723 8.7266c0-1.339 1.0859-2.4258 2.4238-2.4258 1.338 0 2.4219 1.0868 2.4219 2.4258 0 1.0174-.6259 1.8884-1.5137 2.248v5.375l1.7656-1.7676a2.4205 2.4205 0 01-.1914-.9472c0-1.339 1.086-2.4239 2.4238-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 1.3389-1.084 2.4257-2.422 2.4257a2.42 2.42 0 01-.9472-.1933l-3.0508 3.0547v3.6836h7.9473a.4702.4702 0 00.4707-.4707v-8.0743h2.1113a.5686.5686 0 00.3965-.162c.2233-.2185.2262-.5775.0078-.8008l-2.5156-2.5723V6.4707c0-.2603-.2104-.4727-.4707-.4727h-1.9649c-.2603 0-.4707.2124-.4707.4727v1.1035L12.5 1.6035a.7056.7056 0 00-.5078-.209zm.0039 6.3614c-.5352 0-.9688.4351-.9688.9707 0 .5355.4336.9687.9688.9687a.9683.9683 0 00.9687-.9687c0-.5356-.4335-.9707-.9687-.9707zM7.0898 12.666a.9683.9683 0 00-.9687.9688c0 .5355.4336.9707.9687.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688zm9.8125 0c-.5351 0-.9707.4332-.9707.9688 0 .5355.4356.9707.9707.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688Z" />
                                </svg>
                            </a>
                            <li id="liDashboard" data-name="liDashboard" class="group hidden">
                                <a href="#" class="nav-a mx-2 {{ Request::is('dashboard') ? 'active' : '' }}">
                                    <span class="flex w-40"> DASHBOARD </span>
                                </a>
                            </li>
                        </div>
                        <!-- Sidebar Dashboard End-->

                        <!-- Sidebar Media OOH start-->
                        <div class="div-nav-a">
                            <a class="nav-a" href="/dashboard/media/billboards">
                                <svg class="nav-svg transition duration-300 ease-in-out {{ Request::is('dashboard/media*') ? 'active' : '' }}"
                                    role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>DATA MEDIA</title>
                                    <path
                                        d="M8.051 5.238c-1.328 1.566-2.186 3.883-2.246 6.48v.564c.061 2.598.918 4.912 2.246 6.479 1.721 2.236 4.279 3.654 7.139 3.654 1.756 0 3.4-.537 4.807-1.471C17.879 22.846 15.074 24 12 24c-.192 0-.383-.004-.57-.014C5.064 23.689 0 18.436 0 12 0 5.371 5.373 0 12 0h.045c3.055.012 5.84 1.166 7.953 3.055-1.408-.93-3.051-1.471-4.81-1.471-2.858 0-5.417 1.42-7.14 3.654h.003zM24 12c0 3.556-1.545 6.748-4.002 8.945-3.078 1.5-5.946.451-6.896-.205 3.023-.664 5.307-4.32 5.307-8.74 0-4.422-2.283-8.075-5.307-8.74.949-.654 3.818-1.703 6.896-.205C22.455 5.25 24 8.445 24 12z" />
                                </svg>
                            </a>

                            <li class="group hidden" id="liMedia" name="liMedia" onclick="showHideDropdown(this)">
                                <a href="#" class="nav-a mx-2 {{ Request::is('dashboard/media*') ? 'active' : '' }}">
                                    <span class="flex w-40"> DATA MEDIA </span>
                                    <svg id="mediaArrow" name="mediaArrow"
                                        class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Arrow</title>
                                        <path
                                            d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                    </svg>
                                </a>

                                <!-- Child Media OOH start-->
                                <ul class="hidden" id="mediaChild" name="mediaChild">
                                    <!-- Data Lokasi Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm10.881-2.501c0-1.492-.739-2.83-1.902-3.748l.741-.752c1.395 1.101 2.28 2.706 2.28 4.5s-.885 3.4-2.28 4.501l-.741-.753c1.163-.917 1.902-2.256 1.902-3.748zm-3.381 2.249l.74.751c.931-.733 1.521-1.804 1.521-3 0-1.195-.59-2.267-1.521-3l-.74.751c.697.551 1.141 1.354 1.141 2.249s-.444 1.699-1.141 2.249zm-16.479 1.499l-.741.753c-1.395-1.101-2.28-2.707-2.28-4.501s.885-3.399 2.28-4.5l.741.752c-1.163.918-1.902 2.256-1.902 3.748s.739 2.831 1.902 3.748zm.338-3.748c0-.896.443-1.698 1.141-2.249l-.74-.751c-.931.733-1.521 1.805-1.521 3 0 1.196.59 2.267 1.521 3l.74-.751c-.697-.55-1.141-1.353-1.141-2.249zm16.641 14.501c0 2.209-3.581 4-8 4s-8-1.791-8-4c0-1.602 1.888-2.98 4.608-3.619l1.154 1.824c-.401.068-.806.135-1.178.242-3.312.949-3.453 2.109-.021 3.102 2.088.603 4.777.605 6.874-.001 3.619-1.047 3.164-2.275-.268-3.167-.296-.077-.621-.118-.936-.171l1.156-1.828c2.723.638 4.611 2.016 4.611 3.618z" />
                                            </svg>
                                            <span class="flex w-36"> DATA LOKASI </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Data Lokasi Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/locations/home/All">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Semua Katagori </span>
                                                </a>
                                            </li>
                                            @foreach ($categories as $category)
                                                <li class="group">
                                                    <a class="nav-a ml-5" href="/locations/home/{{ $category->name }}">
                                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                        </svg>
                                                        <span class="flex w-40"> {{ $category->name }} </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- Child Data Lokasi End -->
                                    </li>
                                    <!-- Data Lokasi end -->

                                    <!-- Area Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M18.305 20.418c-.992.615-2.16.97-3.411.97-3.588 0-6.5-2.919-6.5-6.514s2.912-6.513 6.5-6.513c3.587 0 6.5 2.918 6.5 6.513 0 1.254-.354 2.425-.967 3.419l3.573 3.58-2.121 2.126-3.574-3.581zm-8.904-.436c-3.216-.19-6.025-1.903-7.716-4.427l4.349-2.511c.38.493.849.914 1.383 1.237-.015.197-.023.396-.023.596 0 1.972.762 3.766 2.007 5.105zm5.493-9.592c2.484 0 4.5 2.02 4.5 4.509 0 2.489-2.016 4.509-4.5 4.509s-4.5-2.02-4.5-4.509c0-2.489 2.016-4.509 4.5-4.509zm-1.5 6.989h-1v-2.004h1v2.004zm2 0h-1v-3.006h1v3.006zm2 0h-1v-4.96h1v4.96zm-7.894-17.367v5.013c-2.525.251-4.5 2.384-4.5 4.975 0 .787.182 1.531.507 2.194l-4.336 2.503c-.747-1.401-1.171-3-1.171-4.697 0-5.351 4.213-9.727 9.5-9.988zm4.772 7.391c-.796-1.306-2.174-2.219-3.772-2.378v-5.013c5.077.251 9.164 4.296 9.48 9.356-1.337-1.236-3.124-1.991-5.086-1.991-.209 0-.417.009-.622.026z" />
                                            </svg>
                                            <span class="flex w-36"> DATA AREA </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Area Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/area">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Area </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/cities">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Kota </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Area End -->
                                    </li>
                                    <!-- Area end -->

                                    <!-- Media Legality Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 22v-16h14v7.543c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-5.362zm16-7.614v-10.386h-18v20h8.189c3.163 0 9.811-7.223 9.811-9.614zm-10 1.614h-4v-1h4v1zm6-4h-10v1h10v-1zm0-3h-10v1h10v-1zm1-7h-17v19h-2v-21h19v2z" />
                                            </svg>
                                            <span class="flex w-36"> DATA LEGALITAS </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Media Legality Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> KATAGORI IZIN </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> DAFTAR IZIN </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> SEWA LAHAN </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Media Legality End -->
                                    </li>
                                    <!-- Media Legality end -->

                                    <!-- Setting Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 13.616v-3.232c-1.651-.587-2.693-.752-3.219-2.019v-.001c-.527-1.271.1-2.134.847-3.707l-2.285-2.285c-1.561.742-2.433 1.375-3.707.847h-.001c-1.269-.526-1.435-1.576-2.019-3.219h-3.232c-.582 1.635-.749 2.692-2.019 3.219h-.001c-1.271.528-2.132-.098-3.707-.847l-2.285 2.285c.745 1.568 1.375 2.434.847 3.707-.527 1.271-1.584 1.438-3.219 2.02v3.232c1.632.58 2.692.749 3.219 2.019.53 1.282-.114 2.166-.847 3.707l2.285 2.286c1.562-.743 2.434-1.375 3.707-.847h.001c1.27.526 1.436 1.579 2.019 3.219h3.232c.582-1.636.749-2.69 2.027-3.222h.001c1.262-.524 2.12.101 3.698.851l2.285-2.286c-.743-1.563-1.375-2.433-.848-3.706.527-1.271 1.588-1.44 3.221-2.021zm-12 3.384c-2.762 0-5-2.239-5-5s2.238-5 5-5 5 2.239 5 5-2.238 5-5 5zm3-5c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3z" />
                                            </svg>
                                            <span class="flex w-36"> PENGATURAN </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Setting Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/companies">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> PERUSAHAAN </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/media-categories">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> KATAGORI MEDIA </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/media-sizes">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> UKURAN </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/leds">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> JENIS LED </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Setting End -->
                                    </li>
                                    <!-- Setting end -->
                                </ul>
                                <!-- Child Media OOH end-->
                            </li>
                        </div>
                        <!-- Sidebar Media OOH End-->

                        <!-- Sidebar Marketing start-->
                        <div class="div-nav-a">
                            <a class="nav-a {{ Request::is('dashboard/marketing*') ? 'active' : '' }}" href="">
                                <svg role="img" class="nav-svg transition duration-300 ease-in-out"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>PEMASARAN</title>
                                    <path
                                        d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm6.23 16.244a.371.371 0 0 1-.373.372H16.29a.371.371 0 0 1-.372-.372v-4.828c0-.04-.046-.06-.08-.033l-3.32 3.32a.742.742 0 0 1-1.043 0l-3.32-3.32c-.027-.027-.08-.007-.08.033v4.828a.371.371 0 0 1-.372.372H6.136a.371.371 0 0 1-.372-.372V7.757c0-.206.166-.372.372-.372h1.076a.75.75 0 0 1 .525.22l4.13 4.13a.18.18 0 0 0 .26 0l4.13-4.13c.14-.14.325-.22.525-.22h1.075c.206 0 .372.166.372.372z" />
                                </svg>
                            </a>

                            <li class="group hidden" id="liMarketing" name="liMarketing"
                                onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/marketing*') ? 'active' : '' }}">
                                    <span class="flex w-40"> DATA PEMASARAN </span>
                                    <svg id="marketingArrow" name="marketingArrow"
                                        class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Arrow</title>
                                        <path
                                            d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                    </svg>
                                </a>
                                <!-- Child Marketing Start -->
                                <ul class="hidden" id="marketingChild" name="marketingChild">
                                    <!-- Vendor Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M5 15.613c0-.788.061-1.243.992-1.458 1.074-.249 2.075-.466 1.591-1.381-1.476-2.785-.392-4.274 1.166-4.274 1.054 0 1.874.681 1.874 1.936 0 2.907-1.605 1.551-1.623 5.564v1h-4v-1.387zm14 1.387h-9v-1c0-1.373-.11-2.129 1.322-2.46 1.433-.331 2.27-.621 1.623-1.841-1.966-3.713-.521-5.699 1.555-5.699 2.117 0 3.527 2.062 1.556 5.699-.666 1.227.218 1.518 1.621 1.841 1.411.326 1.323 1.067 1.323 2.46v1zm-6 4.949v-2.949h-2v2.949c-4.717-.472-8.479-4.232-8.949-8.949h2.949v-2h-2.949c.47-4.718 4.232-8.479 8.949-8.95v2.95h2v-2.95c4.717.471 8.479 4.232 8.949 8.95h-2.949v2h2.949c-.47 4.717-4.232 8.477-8.949 8.949zm-1-21.949c-6.627 0-12 5.372-12 12 0 6.627 5.373 12 12 12s12-5.373 12-12c0-6.628-5.373-12-12-12z" />
                                            </svg>
                                            <span class="flex w-36"> DATA VENDOR </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Vendor Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/vendor-categories">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> KATAGORI VENDOR </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/vendors">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> DAFTAR VENDOR </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Vendor End -->
                                    </li>
                                    <!-- Vendor end -->

                                    <!-- Clients Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 16.488l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm1-7.869v-1.714c-.006-1.557.062-2.447 1.854-2.861 1.963-.453 4.315-.859 3.384-2.577-2.761-5.092-.787-7.979 2.177-7.979 2.907 0 4.93 2.78 2.177 7.979-.904 1.708 1.378 2.114 3.384 2.577 1.799.415 1.859 1.311 1.853 2.879 0 .13-.011 1.171 0 1.665-.483-.309-1.442-.552-2.187.106-.535.472-.568.504-1.783 1.629-1.75-.831-4.456-1.883-6.214-2.478-.896-.304-2.04-.308-2.962.075l-1.683.699z" />
                                            </svg>
                                            <span class="flex w-36"> DATA KLIEN </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Clients Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/client-categories">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> KATAGORI KLIEN </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/clients">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> DAFTAR KLIEN </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Clients End -->
                                    </li>
                                    <!-- Clients end -->

                                    <!-- Penawaran Start -->
                                    <li id="penawaran" name="penawaran" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z" />
                                            </svg>
                                            <span class="flex w-36"> PENAWARAN </span>
                                            <svg id="penawaranArrow" name="penawaranArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Penawaran Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/quotations/home/All">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Semua Katagori </span>
                                                </a>
                                            </li>
                                            @foreach ($categories as $category)
                                                <li class="group">
                                                    <a class="nav-a ml-5" href="/quotations/home/{{ $category->name }}">
                                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                        </svg>
                                                        <span class="flex w-40"> {{ $category->name }} </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- Child Penawaran End -->
                                    </li>
                                    <!-- Penawaran end -->

                                    <!-- Penjualan start -->
                                    <li id="penjualan" name="penjualan" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd">
                                                <path
                                                    d="M12.628 21.412l5.969-5.97 1.458 3.71-12.34 4.848-4.808-12.238 9.721 9.65zm-1.276-21.412h-9.352v9.453l10.625 10.547 9.375-9.375-10.648-10.625zm4.025 9.476c-.415-.415-.865-.617-1.378-.617-.578 0-1.227.241-2.171.804-.682.41-1.118.584-1.456.584-.361 0-1.083-.408-.961-1.218.052-.345.25-.697.572-1.02.652-.651 1.544-.848 2.276-.106l.744-.744c-.476-.476-1.096-.792-1.761-.792-.566 0-1.125.227-1.663.677l-.626-.627-.698.699.653.652c-.569.826-.842 2.021.076 2.938 1.011 1.011 2.188.541 3.413-.232.6-.379 1.083-.563 1.475-.563.589 0 1.18.498 1.078 1.258-.052.386-.26.763-.621 1.122-.451.451-.904.679-1.347.679-.418 0-.747-.192-1.049-.462l-.739.739c.463.458 1.082.753 1.735.753.544 0 1.087-.201 1.612-.597l.54.538.697-.697-.52-.521c.743-.896 1.157-2.209.119-3.247zm-9.678-7.476c.938 0 1.699.761 1.699 1.699 0 .938-.761 1.699-1.699 1.699-.938 0-1.699-.761-1.699-1.699 0-.938.761-1.699 1.699-1.699z" />
                                            </svg>
                                            <span class="flex w-36"> PENJUALAN </span>
                                            <svg id="penjualanArrow" name="penjualanArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Penjualan Child Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/sales-data/home/All">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Semua Katagori </span>
                                                </a>
                                            </li>
                                            @foreach ($categories as $category)
                                                <li class="group">
                                                    <a class="nav-a ml-5" href="/sales-data/home/{{ $category->name }}">
                                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path
                                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                        </svg>
                                                        <span class="flex w-40"> {{ $category->name }} </span>
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <!-- Penjualan Child End -->
                                    </li>
                                    <!-- Penjualan end -->

                                    <!-- SPK start -->
                                    <li id="materi" name="materi" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m6 18v3c0 .621.52 1 1 1h14c.478 0 1-.379 1-1v-14c0-.478-.379-1-1-1h-3v-3c0-.478-.379-1-1-1h-14c-.62 0-1 .519-1 1v14c0 .621.52 1 1 1zm10.5-12h-9.5c-.62 0-1 .519-1 1v9.5h-2.5v-13h13z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="flex w-36"> SPK </span>
                                            <svg id="materiArrow" name="materiArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Penggantian Materi Child Start -->
                                        <ul class="hidden" id="materiChild" name="materiChild">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> SPK Cetak </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> SPK Pasang </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Penggantian Materi Child End -->
                                    </li>
                                    <!-- SPK end -->

                                    <!-- Quotation Reports start -->
                                    <li id="quotReport" name="quotReport" class="group"
                                        onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                                            </svg>
                                            <span class="flex w-36"> LAP. PENAWARAN </span>
                                            <svg id="quotReportArrow" name="quotReportArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Quotation Reports Child Start -->
                                        <ul class="hidden" id="quotReportChild" name="quotReportChild">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Billboard </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/sales/reports/">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Videotron </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Signage </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Cetak & Pasang </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Quotation Reports Child End -->
                                    </li>
                                    <!-- Quotation Reports end -->

                                    <!-- Sales Reports start -->
                                    <li id="saleReports" name="saleReports" class="group"
                                        onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                                            </svg>
                                            <span class="flex w-36"> LAP. PENJUALAN </span>
                                            <svg id="saleReportsArrow" name="saleReportsArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Sales Reports Child Start -->
                                        <ul class="hidden" id="saleReportChild" name="saleReportChild">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/sales/reports/">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Billboard </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Videotron </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Signage </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Cetak & Pasang </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Sales Reports Child End -->
                                    </li>
                                    <!-- Sales Reports end -->

                                    <!-- SPK Reports start -->
                                    <li id="spkReports" name="spkReports" class="group"
                                        onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                                            </svg>
                                            <span class="flex w-36"> LAP. SPK </span>
                                            <svg id="spkReportsArrow" name="spkReportsArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- SPK Reports Child Start -->
                                        <ul class="hidden" id="spkReportChild" name="spkReportChild">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> SPK Cetak </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/sales/reports/">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> SPK Pasang </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- SPK Reports Child End -->
                                    </li>
                                    <!-- SPK Reports end -->

                                    <!-- Setting Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 13.616v-3.232c-1.651-.587-2.693-.752-3.219-2.019v-.001c-.527-1.271.1-2.134.847-3.707l-2.285-2.285c-1.561.742-2.433 1.375-3.707.847h-.001c-1.269-.526-1.435-1.576-2.019-3.219h-3.232c-.582 1.635-.749 2.692-2.019 3.219h-.001c-1.271.528-2.132-.098-3.707-.847l-2.285 2.285c.745 1.568 1.375 2.434.847 3.707-.527 1.271-1.584 1.438-3.219 2.02v3.232c1.632.58 2.692.749 3.219 2.019.53 1.282-.114 2.166-.847 3.707l2.285 2.286c1.562-.743 2.434-1.375 3.707-.847h.001c1.27.526 1.436 1.579 2.019 3.219h3.232c.582-1.636.749-2.69 2.027-3.222h.001c1.262-.524 2.12.101 3.698.851l2.285-2.286c-.743-1.563-1.375-2.433-.848-3.706.527-1.271 1.588-1.44 3.221-2.021zm-12 3.384c-2.762 0-5-2.239-5-5s2.238-5 5-5 5 2.239 5 5-2.238 5-5 5zm3-5c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3z" />
                                            </svg>
                                            <span class="flex w-36"> PENGATURAN </span>
                                            <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Setting Start -->
                                        <ul class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/quotation-categories">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> KATAGORI </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/printing-products">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> BAHAN CETAK </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/printing-prices">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> HARGA CETAK </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> HARGA PASANG </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Setting End -->
                                    </li>
                                    <!-- Setting end -->
                                </ul>
                                <!-- Child Marketing End -->
                            </li>
                        </div>
                        <!-- Sidebar Marketing End-->

                        <!-- Sidebar Accounting start-->
                        <div class="div-nav-a">
                            <a class="nav-a" href="">
                                <svg role="img" class="nav-svg transition duration-300 ease-in-out"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>KEUANGAN</title>
                                    <path
                                        d="M6.898.437S7.87.534 8.26 1.505c0 0 1.069 2.526 2.04 4.955 1.42 3.33 3.22 7.615 4.67 11.078H1.167c-.778 0-1.166-.486-1.166-.486.777 1.36 3.012 5.636 3.012 5.636.388.486.777.776 1.36.776 1.264 0 3.208-1.262 3.208-1.262l7.409-4.619c1.412 3.372 2.5 5.98 2.5 5.98H24c.097-.097-9.327-22.446-9.424-22.544-.097-.097-.292-.582-.972-.582zm-.29.875c-.583 0-.778.485-.875.582L.39 14.526c-.291.874-.097 1.943 1.458 1.943h4.177l3.693-8.841A453.32 453.32 0 0 0 7.58 2.38c-.097-.291-.389-1.068-.972-1.068z" />
                                </svg>
                            </a>
                            <li id="liAccounting" name="liAccounting" class="group hidden"
                                onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/accounting*') ? 'active' : '' }}">
                                    <span class="flex w-40"> DATA KEUANGAN </span>
                                    <svg id="accountingArrow" name="accountingArrow"
                                        class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Arrow</title>
                                        <path
                                            d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                    </svg>
                                </a>
                                <!-- Accounting Child Start -->
                                <ul id="accountingChild" name="accountingChild" class="hidden">
                                    <!-- Penagihan Start -->
                                    <li id="penagihan" name="penagihan" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-t-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" fill="#000000" viewBox="0 0 32 32"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <g data-name="18. Bill" id="_18._Bill">
                                                    <path
                                                        d="M16,7h2a1,1,0,0,0,0-2H17a1,1,0,0,0-2,0v.18A3,3,0,0,0,16,11a1,1,0,0,1,0,2H14a1,1,0,0,0,0,2h1a1,1,0,0,0,2,0v-.18A3,3,0,0,0,16,9a1,1,0,0,1,0-2Z" />
                                                    <path
                                                        d="M31,24H28V3a3,3,0,0,0-3-3H3A3,3,0,0,0,0,3V9a1,1,0,0,0,1,1H4V29a3,3,0,0,0,3,3H29a3,3,0,0,0,3-3V25A1,1,0,0,0,31,24ZM2,3A1,1,0,0,1,4,3V8H2ZM8,25v4a1,1,0,0,1-.31.71A.93.93,0,0,1,7,30a1,1,0,0,1-1-1V3a3,3,0,0,0-.18-1H25a1,1,0,0,1,1,1V24H9A1,1,0,0,0,8,25Zm22,4a1,1,0,0,1-.31.71A.93.93,0,0,1,29,30H9.83A3,3,0,0,0,10,29V26H30Z" />
                                                    <path d="M17,19H9a1,1,0,0,0,0,2h8a1,1,0,0,0,0-2Z" />
                                                    <path d="M23,19H21a1,1,0,0,0,0,2h2a1,1,0,0,0,0-2Z" />
                                                </g>
                                            </svg>
                                            <span class="flex w-36"> PENAGIHAN </span>
                                            <svg id="penagihanArrow" name="penagihanArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Child Penagihan start -->
                                        <ul id="penagihanChild" name="penagihanChild" class="hidden">
                                            <!-- Invoice Start -->
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-20h7.362c4.156 0 2.638 6 2.638 6s2.313-.635 4.067-.133l1.952-1.976c-2.214-2.807-5.762-5.891-7.83-5.891h-10.189v24h20v-7.98l-2 2.025z" />
                                                    </svg>
                                                    <span class="flex w-40"> Invoice </span></a>
                                            </li>
                                            <!-- Invoice End -->
                                            <!-- Kwitansi Start -->
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-18h4l2.102 2h3.898l2-2h4v1.911l2-2.024v-1.887h-3c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-7.98l-2 2.025zm-8-16.045c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1z" />
                                                    </svg>
                                                    <span class="flex w-40"> Kwitansi </span>
                                                </a>
                                                </a>
                                            </li>
                                            <!-- Kwitansi End -->
                                            <!-- Laporan Penagihan Start -->
                                            <li class="group">
                                                <a class="nav-a ml-5 border-b-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="flex w-40"> Lap. Penagihan </span>
                                                </a>
                                                </a>
                                            </li>
                                            <!-- Laporan Penagihan End -->
                                        </ul>
                                        <!-- Child Penagihan end -->
                                    </li>
                                    <!-- Penagihan End -->
                                    <!-- Faktur PPn start -->
                                    <li id="ppn" name="ppn" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24"fill-rule="evenodd" clip-rule="evenodd">
                                                <path
                                                    d="M4.82 19.407c-2.966-1.857-4.94-5.153-4.94-8.907 0-5.795 4.705-10.5 10.5-10.5 3.605 0 6.789 1.821 8.68 4.593 2.966 1.857 4.94 5.153 4.94 8.907 0 5.795-4.705 10.5-10.5 10.5-3.599 0-6.778-1.815-8.67-4.579l-.01-.014zm8.68-15.407c5.243 0 9.5 4.257 9.5 9.5s-4.257 9.5-9.5 9.5-9.5-4.257-9.5-9.5 4.257-9.5 9.5-9.5zm.5 15h-1.021v-.871c-2.343-.302-2.599-2.179-2.599-2.744h1.091c.025.405.157 1.774 2.182 1.774.599 0 1.088-.141 1.453-.419.361-.276.536-.612.536-1.029 0-.793-.513-1.367-2.07-1.718-2.368-.536-2.923-1.398-2.923-2.533 0-1.509 1.223-2.216 2.33-2.406v-1.054h1.021v1.015c2.491.195 2.695 2.215 2.695 2.771h-1.098c0-1.161-.918-1.766-1.996-1.766-1.077 0-1.854.532-1.854 1.408 0 .781.439 1.165 1.994 1.554 1.879.473 2.999 1.101 2.999 2.681 0 1.744-1.509 2.393-2.74 2.493v.844zm2.85-15.453c-1.696-1.58-3.971-2.547-6.47-2.547-5.243 0-9.5 4.257-9.5 9.5 0 2.633 1.073 5.017 2.806 6.739l-.004-.01c-.44-1.159-.682-2.416-.682-3.729 0-5.795 4.705-10.5 10.5-10.5 1.171 0 2.298.192 3.35.547z" />
                                            </svg>
                                            <span class="flex w-36"> FAKTUR PPN </span>
                                            <svg id="ppnArrow" name="ppnArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Child Faktur PPn start -->
                                        <ul id="ppnChild" name="ppnChild" class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                                    </svg>
                                                    <span class="flex w-40"> Up. Faktur PPn </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12.324 7.021l.154.345c.237-.041.52-.055.847-.025l.133.577c-.257-.032-.53-.062-.771-.012l-.092.023c-.464.123-.316.565.098.672.682.158 1.494.208 1.815.922.258.578-.041.973-.541 1.163l.154.346-.325.068-.147-.329c-.338.061-.725.053-1.08-.041l-.1-.584c.294.046.658.087.938.03l.186-.06c.333-.165.231-.582-.264-.681-.367-.083-1.342-.021-1.705-.831-.205-.458-.053-.936.535-1.154l-.161-.361.326-.068m3.82 1.614c-.706-1.648-2.681-2.751-4.409-2.463-1.728.288-2.557 1.857-1.85 3.506.746 1.739 2.888 2.853 4.651 2.414 1.562-.388 2.28-1.887 1.608-3.457zm4.05-5.635l3.766 8.233c-5.433 4.223-12.654-.038-17.951 4.461l-3.766-8.233c4.944-4.779 11.773-.45 17.951-4.461zm3.806 12.014c-6.857 3.939-12.399-1.424-19.5 5.986l-4.5-9.964 1.402-1.462 3.807 8.401-.002.008c7.445-5.592 11.195-1.175 18.109-4.561.294.647.565 1.33.684 1.592z" />
                                                    </svg>
                                                    <span class="flex w-40"> Pembayaran PPn </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-b-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="flex w-40"> Lap. PPn</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Faktur PPn end -->
                                    </li>
                                    <!-- Faktur PPn end -->
                                    <!-- Faktur PPh start -->
                                    <li id="pph" name="pph" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24" fill-rule="evenodd" clip-rule="evenodd">
                                                <path
                                                    d="M21.19 7h2.81v15h-21v-5h-2.81v-15h21v5zm1.81 1h-19v13h19v-13zm-9.5 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5zm0 1c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm.5 8h-1v-.804c-.767-.16-1.478-.689-1.478-1.704h1.022c0 .591.326.886.978.886.817 0 1.327-.915-.167-1.439-.768-.27-1.68-.676-1.68-1.693 0-.796.573-1.297 1.325-1.448v-.798h1v.806c.704.161 1.313.673 1.313 1.598h-1.018c0-.788-.727-.776-.815-.776-.55 0-.787.291-.787.622 0 .247.134.497.957.768 1.056.344 1.663.845 1.663 1.746 0 .651-.376 1.288-1.313 1.448v.788zm6.19-11v-4h-19v13h1.81v-9h17.19z" />
                                            </svg>
                                            <span class="flex w-36"> FAKTUR PPH </span>
                                            <svg id="pphArrow" name="pphArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Child Faktur PPh start -->
                                        <ul id="pphChild" name="pphChild" class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                                    </svg>
                                                    <span class="flex w-40"> Up. Faktur PPh </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M12.324 7.021l.154.345c.237-.041.52-.055.847-.025l.133.577c-.257-.032-.53-.062-.771-.012l-.092.023c-.464.123-.316.565.098.672.682.158 1.494.208 1.815.922.258.578-.041.973-.541 1.163l.154.346-.325.068-.147-.329c-.338.061-.725.053-1.08-.041l-.1-.584c.294.046.658.087.938.03l.186-.06c.333-.165.231-.582-.264-.681-.367-.083-1.342-.021-1.705-.831-.205-.458-.053-.936.535-1.154l-.161-.361.326-.068m3.82 1.614c-.706-1.648-2.681-2.751-4.409-2.463-1.728.288-2.557 1.857-1.85 3.506.746 1.739 2.888 2.853 4.651 2.414 1.562-.388 2.28-1.887 1.608-3.457zm4.05-5.635l3.766 8.233c-5.433 4.223-12.654-.038-17.951 4.461l-3.766-8.233c4.944-4.779 11.773-.45 17.951-4.461zm3.806 12.014c-6.857 3.939-12.399-1.424-19.5 5.986l-4.5-9.964 1.402-1.462 3.807 8.401-.002.008c7.445-5.592 11.195-1.175 18.109-4.561.294.647.565 1.33.684 1.592z" />
                                                    </svg>
                                                    <span class="flex w-40"> Pembayaran PPh </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-b-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="flex w-40"> Lap. PPh</span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- Child Faktur PPh end -->
                                    </li>
                                    <!-- Faktur PPh end -->
                                </ul>
                                <!-- Accounting Child End -->
                            </li>
                        </div>
                        <!-- Sidebar Accounting End-->

                        <!-- Sidebar Workshop start-->
                        <div class="div-nav-a">
                            <a class="nav-a" href="">
                                <svg role="img" class="nav-svg transition duration-300 ease-in-out"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>PRODUKSI</title>
                                    <path
                                        d="M23.268 10.541C23.268 4.715 18.544 0 12.728 0c-1.614 0-3.191.317-4.663.952a11.952 11.952 0 00-3.817 2.574 11.915 11.915 0 00-3.516 8.478 11.924 11.924 0 003.516 8.48 12.05 12.05 0 003.817 2.573c1.472.626 3.05.943 4.671.943 1.56 0 3.05-.3 4.416-.837l-.908-2.292a9.448 9.448 0 01-3.508.67 9.481 9.481 0 01-6.743-2.794A9.481 9.481 0 013.2 12.004c0-2.547.996-4.944 2.794-6.742a9.496 9.496 0 016.743-2.794 8.072 8.072 0 016.734 12.524l-2.098-5.165c-.308-.758-.679-1.895-2.071-1.895-1.393 0-1.763 1.146-2.063 1.895l-1.93 4.769-2.591-6.54H5.993l3.226 7.95c.326.802.688 1.895 2.09 1.895 1.4 0 1.753-1.093 2.08-1.895l1.912-4.724 1.921 4.724c.388.978.802 1.895 2.08 1.895.908 0 1.481-.582 1.798-.96a10.493 10.493 0 002.168-6.4Z" />
                                </svg>
                            </a>
                            <li id="liWorkshop" name="liWorkshop" class="group hidden" onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/workshop*') ? 'active' : '' }}">
                                    <span class="flex w-40"> DATA PRODUKSI </span>
                                    <svg id="workshopArrow" name="workshopArrow"
                                        class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Arrow</title>
                                        <path
                                            d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                    </svg>
                                </a>
                                <!-- Workshop Child Start -->
                                <ul id="workshopChild" name="workshopChild" class="hidden">
                                    <li id="monitoring" name="monitoring" class="group"
                                        onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-t-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 10h-4.083l1.271-1.396.812.396.676-.862 1.324 1.862zm.88 3h-7.88v-8h9.204c.739 1.612 2.024 1.696 3.796 2.509v4.648c-1.638-.182-3.985-.26-5.12.843zm.12-6h-6v4h6v-4zm9.17-1.833c-.806-1.165-5.031-1.924-6.742-2.167-.169.727.111 1.643.859 2.076.729.422 2.847 1.078 3.473 1.702.812.808 2.026 4.668.028 7.282-2.076-.589-4.24-.527-5.415-.048-1.153.47-1.013 1.908.189 2.045 3.42.39 7.587 1.161 10.322 4.943 0 0 1.821-1.885 4.115-4.426-3.668-3.053-4.198-7.606-6.829-11.407zm-13.92 2.833c-.138 0-.25.112-.25.25s.112.25.25.25c.139 0 .25-.112.25-.25s-.111-.25-.25-.25z" />
                                            </svg>
                                            <span class="flex w-36"> PEMANTAUAN </span>
                                            <svg id="monitoringArrow" name="monitoringArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <ul id="monitoringChild" name="monitoringChild" class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                                    </svg>
                                                    <span class="flex w-40"> Upload Foto </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-b-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="flex w-40"> Lap. Pemantauan</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li id="gambar" name="gambar" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M9 12c0-.552.448-1 1.001-1s.999.448.999 1-.446 1-.999 1-1.001-.448-1.001-1zm6.2 0l-1.7 2.6-1.3-1.6-3.2 4h10l-3.8-5zm5.8-7v-2h-21v15h2v-13h19zm3 2v14h-20v-14h20zm-2 2h-16v10h16v-10z" />
                                            </svg>
                                            <span class="flex w-36"> PEMASANGAN </span>
                                            <svg id="gambarArrow" name="gambarArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <ul id="gambarChild" name="gambarChild" class="hidden">
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                        <path
                                                            d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                                    </svg>
                                                    <span class="flex w-40"> Upload Foto </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-b-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="flex w-40"> Lap. Pemasangan</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- Workshop Child End -->
                            </li>
                        </div>
                        <!-- Sidebar Workshop End-->

                        <!-- Sidebar User start-->
                        <div class="div-nav-a">
                            <a class="nav-a" href="/dashboard/users/users">
                                <svg role="img"
                                    class="nav-svg transition duration-300 ease-in-out {{ Request::is('dashboard/users*') ? 'active' : '' }}"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <title>USER</title>
                                    <path
                                        d="M5.331 3.987H4.012v-1.32h1.32zm7.605 16.001c-1.78-.08-3.15-.532-4.21-1.185.718 3.118 3.405 4.65 3.535 4.723l.792.437c6.063-.405 9.611-4.318 9.611-9.436v-1.109c-1.441 4.7-4.795 6.793-9.728 6.57M4.006 9.605h1.332v2.94h1.336V7.627H8.01v9.612C8.009 21.8 12 24 12 24c-6.705 0-10.664-4.065-10.664-9.473V3.65H2.67v7.274h1.336zM2.67 1.334H1.336V0H2.67zm2.661 6.953h-1.32v-1.32h1.32zm1.334-1.98h-1.32v-1.32h1.32zm1.343-1.66H6.674v-1.32h1.335zM6.674 2.654H5.338v-1.32h1.336zM22.147 13.26l.517-1.688V.015c-6.045 0-6.674 2.317-6.674 4.531V17.24c0 .657-.064 1.354-.197 2.037 3.205-.583 5.296-2.565 6.354-6.016Z" />
                                </svg>
                            </a>
                            <li id="liUser" name="liUser" class="group hidden" onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/users/users*') ? 'active' : '' }}">
                                    <span class="flex w-40"> DATA PENGGUNA </span>
                                    <svg id="userArrow" name="userArrow"
                                        class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <title>Arrow</title>
                                        <path
                                            d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                    </svg>
                                </a>
                                <!-- User Child Start -->
                                <ul id="userChild" name="userChild" class="hidden">
                                    <li class="group">
                                        <a class="nav-a ml-2 border-t-[1px] {{ Request::is('/users*') ? 'active' : '' }}"
                                            href="/users">
                                            <svg class="child-nav-svg" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
                                            </svg>
                                            <span class="flex w-40"> PENGGUNA </span>
                                        </a>
                                    </li>
                                </ul>
                                <!-- User Child End -->
                            </li>
                        </div>
                        <!-- Sidebar User End-->

                        <!-- Sidebar Logout start-->
                        <div class="div-nav-a">
                            <form class="nav-a" action="/logout" method="post">
                                @csrf
                                <button type="submit" class="nav-a">
                                    <svg role="img" class="nav-svg transition duration-300 ease-in-out"
                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <title>LOGOUT</title>
                                        <path
                                            d="M12 0C5.373 0 0 5.37 0 12s5.373 12 12 12c6.63 0 12-5.37 12-12S18.63 0 12 0zm-.84 4.67h1.68v8.36h-1.68V4.67zM12 18.155c-3.24-.002-5.865-2.63-5.864-5.868 0-2.64 1.767-4.956 4.314-5.655v1.71c-1.628.64-2.698 2.21-2.695 3.96 0 2.345 1.903 4.244 4.248 4.243 2.344-.002 4.244-1.903 4.243-4.248 0-1.745-1.07-3.312-2.694-3.95V6.63c2.55.7 4.314 3.018 4.314 5.66 0 3.24-2.626 5.864-5.865 5.864z" />
                                    </svg>
                                </button>
                                <li name="liLogout" id="liLogout" class="group hidden">
                                    <button type="submit" class="nav-a mx-2">
                                        <span class="flex w-40"> LOGOUT </span>
                                    </button>

                                </li>
                            </form>
                        </div>
                        <!-- Sidebar Logout End-->
                </ul>
            </nav>
        </div>
    </div>
@endcanany
