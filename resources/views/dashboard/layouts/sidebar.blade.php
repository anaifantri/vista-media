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
                                                    <span class="flex w-40"> Semua Lokasi </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/locations/home/Billboard">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Billboard </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/locations/home/Bando">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Bando Jalan </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/locations/home/Videotron">
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
                                                <a class="nav-a ml-5" href="/locations/home/Baliho">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Baliho </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/locations/home/Midiboard">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Midiboard </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/locations/home/Signage">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Signage </span>
                                                </a>
                                            </li>
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
                                                    d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm10.881-2.501c0-1.492-.739-2.83-1.902-3.748l.741-.752c1.395 1.101 2.28 2.706 2.28 4.5s-.885 3.4-2.28 4.501l-.741-.753c1.163-.917 1.902-2.256 1.902-3.748zm-3.381 2.249l.74.751c.931-.733 1.521-1.804 1.521-3 0-1.195-.59-2.267-1.521-3l-.74.751c.697.551 1.141 1.354 1.141 2.249s-.444 1.699-1.141 2.249zm-16.479 1.499l-.741.753c-1.395-1.101-2.28-2.707-2.28-4.501s.885-3.399 2.28-4.5l.741.752c-1.163.918-1.902 2.256-1.902 3.748s.739 2.831 1.902 3.748zm.338-3.748c0-.896.443-1.698 1.141-2.249l-.74-.751c-.931.733-1.521 1.805-1.521 3 0 1.196.59 2.267 1.521 3l.74-.751c-.697-.55-1.141-1.353-1.141-2.249zm16.641 14.501c0 2.209-3.581 4-8 4s-8-1.791-8-4c0-1.602 1.888-2.98 4.608-3.619l1.154 1.824c-.401.068-.806.135-1.178.242-3.312.949-3.453 2.109-.021 3.102 2.088.603 4.777.605 6.874-.001 3.619-1.047 3.164-2.275-.268-3.167-.296-.077-.621-.118-.936-.171l1.156-1.828c2.723.638 4.611 2.016 4.611 3.618z" />
                                            </svg>
                                            <span class="flex w-36"> AREA </span>
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

                                    <!-- Setting Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm10.881-2.501c0-1.492-.739-2.83-1.902-3.748l.741-.752c1.395 1.101 2.28 2.706 2.28 4.5s-.885 3.4-2.28 4.501l-.741-.753c1.163-.917 1.902-2.256 1.902-3.748zm-3.381 2.249l.74.751c.931-.733 1.521-1.804 1.521-3 0-1.195-.59-2.267-1.521-3l-.74.751c.697.551 1.141 1.354 1.141 2.249s-.444 1.699-1.141 2.249zm-16.479 1.499l-.741.753c-1.395-1.101-2.28-2.707-2.28-4.501s.885-3.399 2.28-4.5l.741.752c-1.163.918-1.902 2.256-1.902 3.748s.739 2.831 1.902 3.748zm.338-3.748c0-.896.443-1.698 1.141-2.249l-.74-.751c-.931.733-1.521 1.805-1.521 3 0 1.196.59 2.267 1.521 3l.74-.751c-.697-.55-1.141-1.353-1.141-2.249zm16.641 14.501c0 2.209-3.581 4-8 4s-8-1.791-8-4c0-1.602 1.888-2.98 4.608-3.619l1.154 1.824c-.401.068-.806.135-1.178.242-3.312.949-3.453 2.109-.021 3.102 2.088.603 4.777.605 6.874-.001 3.619-1.047 3.164-2.275-.268-3.167-.296-.077-.621-.118-.936-.171l1.156-1.828c2.723.638 4.611 2.016 4.611 3.618z" />
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
                                                <a class="nav-a ml-5" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> JENIS LED </span>
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
                                                    <span class="flex w-40"> BAHAN CETAK </span>
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

                                    <!-- Vendor Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm10.881-2.501c0-1.492-.739-2.83-1.902-3.748l.741-.752c1.395 1.101 2.28 2.706 2.28 4.5s-.885 3.4-2.28 4.501l-.741-.753c1.163-.917 1.902-2.256 1.902-3.748zm-3.381 2.249l.74.751c.931-.733 1.521-1.804 1.521-3 0-1.195-.59-2.267-1.521-3l-.74.751c.697.551 1.141 1.354 1.141 2.249s-.444 1.699-1.141 2.249zm-16.479 1.499l-.741.753c-1.395-1.101-2.28-2.707-2.28-4.501s.885-3.399 2.28-4.5l.741.752c-1.163.918-1.902 2.256-1.902 3.748s.739 2.831 1.902 3.748zm.338-3.748c0-.896.443-1.698 1.141-2.249l-.74-.751c-.931.733-1.521 1.805-1.521 3 0 1.196.59 2.267 1.521 3l.74-.751c-.697-.55-1.141-1.353-1.141-2.249zm16.641 14.501c0 2.209-3.581 4-8 4s-8-1.791-8-4c0-1.602 1.888-2.98 4.608-3.619l1.154 1.824c-.401.068-.806.135-1.178.242-3.312.949-3.453 2.109-.021 3.102 2.088.603 4.777.605 6.874-.001 3.619-1.047 3.164-2.275-.268-3.167-.296-.077-.621-.118-.936-.171l1.156-1.828c2.723.638 4.611 2.016 4.611 3.618z" />
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
                                                <a class="nav-a ml-5" href="#">
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
                                                <a class="nav-a ml-5" href="#">
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

                                    <!-- Media Legality Start -->
                                    <li class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm10.881-2.501c0-1.492-.739-2.83-1.902-3.748l.741-.752c1.395 1.101 2.28 2.706 2.28 4.5s-.885 3.4-2.28 4.501l-.741-.753c1.163-.917 1.902-2.256 1.902-3.748zm-3.381 2.249l.74.751c.931-.733 1.521-1.804 1.521-3 0-1.195-.59-2.267-1.521-3l-.74.751c.697.551 1.141 1.354 1.141 2.249s-.444 1.699-1.141 2.249zm-16.479 1.499l-.741.753c-1.395-1.101-2.28-2.707-2.28-4.501s.885-3.399 2.28-4.5l.741.752c-1.163.918-1.902 2.256-1.902 3.748s.739 2.831 1.902 3.748zm.338-3.748c0-.896.443-1.698 1.141-2.249l-.74-.751c-.931.733-1.521 1.805-1.521 3 0 1.196.59 2.267 1.521 3l.74-.751c-.697-.55-1.141-1.353-1.141-2.249zm16.641 14.501c0 2.209-3.581 4-8 4s-8-1.791-8-4c0-1.602 1.888-2.98 4.608-3.619l1.154 1.824c-.401.068-.806.135-1.178.242-3.312.949-3.453 2.109-.021 3.102 2.088.603 4.777.605 6.874-.001 3.619-1.047 3.164-2.275-.268-3.167-.296-.077-.621-.118-.936-.171l1.156-1.828c2.723.638 4.611 2.016 4.611 3.618z" />
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

                                    {{-- <span class="flex nav-a ml-2 border-t-[1px]"> Data OOH </span>
                                    <li class="group">
                                        <a class="nav-a ml-2 border-t-[1px] {{ Request::is('dashboard/media/billboards*') ? 'active' : '' }}"
                                            href="/dashboard/media/billboards">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                                            </svg>
                                            <span class="flex w-40"> Billboard </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 {{ Request::is('dashboard/media/videotrons*') ? 'active' : '' }}"
                                            href="/dashboard/media/videotrons">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M2 0c-1.104 0-2 .896-2 2v15c0 1.104.896 2 2 2h20c1.104 0 2-.896 2-2v-15c0-1.104-.896-2-2-2h-20zm20 14h-20v-12h20v12zm-6.599 7c0 1.6 1.744 2.625 2.599 3h-12c.938-.333 2.599-1.317 2.599-3h6.802z" />
                                            </svg>
                                            <span class="flex w-40"> Videotron </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 {{ Request::is('dashboard/media/signages*') ? 'active' : '' }}"
                                            href="/dashboard/media/signages">
                                            <svg class="child-nav-svg rotate-90" xmlns="http://www.w3.org/2000/svg"
                                                role="img" viewBox="0 0 24 24">
                                                <path
                                                    d="M21.5 6c.276 0 .5.224.5.5v11c0 .276-.224.5-.5.5h-19c-.276 0-.5-.224-.5-.5v-11c0-.276.224-.5.5-.5h19zm2.5 0c0-1.104-.896-2-2-2h-20c-1.105 0-2 .896-2 2v12c0 1.104.895 2 2 2h20c1.104 0 2-.896 2-2v-12zm-14.11 5c.098 0 .174.04.232.116.79 1.085 1.33 2.237 1.616 3.455h-1.991c-.38-1.313-.924-2.429-1.638-3.344l-.029-.085c-.001-.073.058-.142.145-.142h1.665zm2.495 1.594c-.147.594-.33 1.179-.558 1.754-.237-.924-.616-1.808-1.143-2.652.121-.656.183-1.326.196-2.004.63 1.013 1.13 1.978 1.505 2.902zm.442-3.165c1.364 1.877 2.334 4.187 2.54 6.571h-2.013c-.121-1.978-.946-4.17-2.469-6.571h1.942zm3.094 2.571c0 1.263-.152 2.469-.451 3.625-.201-1.665-.732-3.277-1.603-4.835-.076-.897-.232-1.763-.473-2.607-.022-.094.045-.183.139-.183h1.603c.125 0 .241.085.272.205.343 1.219.513 2.482.513 3.795z" />
                                            </svg>
                                            <span class="flex w-40"> Signage </span>
                                        </a>
                                    </li>
                                    <span class="flex nav-a ml-2 border-t-[1px] border-b-[1px]"> Pengaturan </span>
                                    <li class="group">
                                        <a class="nav-a ml-2 {{ Request::is('dashboard/media/companies*') ? 'active' : '' }}"
                                            href="/dashboard/media/companies">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M13.144 8.171c-.035-.066.342-.102.409-.102.074.009-.196.452-.409.102zm-.461 15.795c-.228.013-.453.034-.683.034-6.628 0-12-5.373-12-12s5.372-12 12-12c6.627 0 12 5.373 12 12 0 .23-.021.455-.034.682-.582-.652-1.266-1.209-2.031-1.643-.064-.679-.182-1.293-.306-1.671-.058-.174-.189-.312-.359-.378-.256-.1-1.337.597-1.5.254-.107-.229-.324.146-.572.008-.12-.066-.454-.515-.605-.46-.309.111.474.964.688 1.076.201-.152.852-.465.992-.038.056.166.047.335.009.504-.725-.215-1.489-.334-2.282-.334-2.885 0-5.69 1.602-7.103 4.328-.126.058-.25.121-.381.161-.346.104-.7-.082-1.042-.125-1.407-.178-1.866-1.786-1.499-2.946.037-.19-.114-.542-.048-.689.158-.352.48-.747.762-1.014.158-.15.361-.112.547-.229.287-.181.291-.553.572-.781.4-.325.946-.318 1.468-.388.278-.037 1.336-.266 1.503-.06 0 .038.191.604-.019.572.433.023 1.05.749 1.461.579.211-.088.134-.736.567-.423.262.188 1.436.272 1.68.069.15-.124.234-.93.052-1.021.116.115-.611.124-.679.098-.12-.044-.232.114-.425.025.116.055-.646-.354-.218-.667-.179.131-.346-.037-.539.107-.133.108.062.18-.128.274-.302.153-.53-.525-.644-.602-.116-.076-1.014-.706-.77-.295l.789.785c-.039.025-.207-.286-.207-.059.053-.135.02.579-.104.347-.055-.089.09-.139.006-.268 0-.085-.228-.168-.272-.226-.125-.155-.457-.497-.637-.579-.05-.023-.764.087-.824.11-.07.098-.13.201-.179.311-.148.055-.287.126-.419.214l-.157.353c-.068.061-.765.291-.769.3.029-.075-.487-.171-.453-.321.038-.165.213-.68.168-.868-.048-.197 1.074.284 1.146-.235.029-.225.046-.487-.313-.525.068.008.695-.246.799-.36.146-.168.481-.442.724-.442.284 0 .223-.413.354-.615.131.053-.07.376.087.507-.01-.103.445.057.489.033.105-.055.685-.023.595-.295-.1-.277.051-.195.181-.253-.02.008.245-.454.359-.452-.103-.088-.395.111-.51.102-.305-.024-.176-.52-.061-.665.089-.115-.243-.256-.247-.036-.006.329-.312.627-.241 1.064.108.659-.735-.159-.809-.114-.28.17-.509-.214-.364-.444.148-.235.505-.224.652-.476.104-.178.225-.385.385-.52.535-.449.683-.09 1.216-.041.521.048.176.124.104.324-.069.19.286.258.409.099.07-.092.229-.323.298-.494.089-.222.901-.197.334-.536-.374-.223-2.004-.672-3.096-.672-.236 0-.401.263-.581.412-.356.295-1.268.874-1.775.698-.519-.179-1.63.66-1.808.666-.065.004.004-.634.358-.681-.153.023 1.247-.707 1.209-.859-.046-.18-2.799.822-2.676 1.023.059.092.299.092-.016.294-.18.109-.372.801-.541.801-.505.221-.537-.435-1.099.409l-.894.36c-1.328 1.411-2.247 3.198-2.58 5.183-.013.079.334.226.379.28.112.134.112.712.167.901.138.478.479.744.74 1.179.154.259.41.914.329 1.186.108-.178 1.07.815 1.246 1.022.414.487.733 1.077.061 1.559-.217.156.33 1.129.048 1.368l-.361.093c-.356.219-.195.756.021.982 1.611 1.686 3.809 2.804 6.265 3.037.434.764.989 1.446 1.641 2.027zm3.007-17.337c-.006-.146-.19-.284-.382-.031-.135.174-.111.439-.184.557-.104.175.567.339.567.174.025-.277.732-.063.87-.025.248.069.643-.226.211-.381-.355-.13-.542-.269-.574-.523 0 0 .188-.176.106-.166-.218.027-.614.786-.614.395zm-5.299-1.089c-.084.085.003.14.089.103.125-.055.293-.053.311-.22.015-.148.044-.046.08-.1.035-.053-.067-.138-.11-.146-.064-.014-.108.069-.149.104l-.072.019-.068.087.008.048-.089.105zm.475.344c.096.136.824-.195.708-.176.225-.113.029-.125-.097-.19-.043-.215-.079-.547-.213-.68l.088-.102c-.207-.299-.36.362-.36.362l.108-.031c.064.055-.072.095-.051.136.086.155.021.248.008.332-.014.085-.104.048-.149.093-.053.066.258.075.262.085.011.033-.375.089-.304.171zm13.134 12.116c0 3.313-2.687 6-6 6s-6-2.687-6-6 2.687-6 6-6 6 2.687 6 6zm-3.5-2.5l-6 2.25 3 .75.754 3 2.246-6z" />
                                            </svg>
                                            <span class="flex w-40"> Perusahaan </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 {{ Request::is('dashboard/media/area*') ? 'active' : '' }}"
                                            href="/dashboard/media/area">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M13.144 8.171c-.035-.066.342-.102.409-.102.074.009-.196.452-.409.102zm-.461 15.795c-.228.013-.453.034-.683.034-6.628 0-12-5.373-12-12s5.372-12 12-12c6.627 0 12 5.373 12 12 0 .23-.021.455-.034.682-.582-.652-1.266-1.209-2.031-1.643-.064-.679-.182-1.293-.306-1.671-.058-.174-.189-.312-.359-.378-.256-.1-1.337.597-1.5.254-.107-.229-.324.146-.572.008-.12-.066-.454-.515-.605-.46-.309.111.474.964.688 1.076.201-.152.852-.465.992-.038.056.166.047.335.009.504-.725-.215-1.489-.334-2.282-.334-2.885 0-5.69 1.602-7.103 4.328-.126.058-.25.121-.381.161-.346.104-.7-.082-1.042-.125-1.407-.178-1.866-1.786-1.499-2.946.037-.19-.114-.542-.048-.689.158-.352.48-.747.762-1.014.158-.15.361-.112.547-.229.287-.181.291-.553.572-.781.4-.325.946-.318 1.468-.388.278-.037 1.336-.266 1.503-.06 0 .038.191.604-.019.572.433.023 1.05.749 1.461.579.211-.088.134-.736.567-.423.262.188 1.436.272 1.68.069.15-.124.234-.93.052-1.021.116.115-.611.124-.679.098-.12-.044-.232.114-.425.025.116.055-.646-.354-.218-.667-.179.131-.346-.037-.539.107-.133.108.062.18-.128.274-.302.153-.53-.525-.644-.602-.116-.076-1.014-.706-.77-.295l.789.785c-.039.025-.207-.286-.207-.059.053-.135.02.579-.104.347-.055-.089.09-.139.006-.268 0-.085-.228-.168-.272-.226-.125-.155-.457-.497-.637-.579-.05-.023-.764.087-.824.11-.07.098-.13.201-.179.311-.148.055-.287.126-.419.214l-.157.353c-.068.061-.765.291-.769.3.029-.075-.487-.171-.453-.321.038-.165.213-.68.168-.868-.048-.197 1.074.284 1.146-.235.029-.225.046-.487-.313-.525.068.008.695-.246.799-.36.146-.168.481-.442.724-.442.284 0 .223-.413.354-.615.131.053-.07.376.087.507-.01-.103.445.057.489.033.105-.055.685-.023.595-.295-.1-.277.051-.195.181-.253-.02.008.245-.454.359-.452-.103-.088-.395.111-.51.102-.305-.024-.176-.52-.061-.665.089-.115-.243-.256-.247-.036-.006.329-.312.627-.241 1.064.108.659-.735-.159-.809-.114-.28.17-.509-.214-.364-.444.148-.235.505-.224.652-.476.104-.178.225-.385.385-.52.535-.449.683-.09 1.216-.041.521.048.176.124.104.324-.069.19.286.258.409.099.07-.092.229-.323.298-.494.089-.222.901-.197.334-.536-.374-.223-2.004-.672-3.096-.672-.236 0-.401.263-.581.412-.356.295-1.268.874-1.775.698-.519-.179-1.63.66-1.808.666-.065.004.004-.634.358-.681-.153.023 1.247-.707 1.209-.859-.046-.18-2.799.822-2.676 1.023.059.092.299.092-.016.294-.18.109-.372.801-.541.801-.505.221-.537-.435-1.099.409l-.894.36c-1.328 1.411-2.247 3.198-2.58 5.183-.013.079.334.226.379.28.112.134.112.712.167.901.138.478.479.744.74 1.179.154.259.41.914.329 1.186.108-.178 1.07.815 1.246 1.022.414.487.733 1.077.061 1.559-.217.156.33 1.129.048 1.368l-.361.093c-.356.219-.195.756.021.982 1.611 1.686 3.809 2.804 6.265 3.037.434.764.989 1.446 1.641 2.027zm3.007-17.337c-.006-.146-.19-.284-.382-.031-.135.174-.111.439-.184.557-.104.175.567.339.567.174.025-.277.732-.063.87-.025.248.069.643-.226.211-.381-.355-.13-.542-.269-.574-.523 0 0 .188-.176.106-.166-.218.027-.614.786-.614.395zm-5.299-1.089c-.084.085.003.14.089.103.125-.055.293-.053.311-.22.015-.148.044-.046.08-.1.035-.053-.067-.138-.11-.146-.064-.014-.108.069-.149.104l-.072.019-.068.087.008.048-.089.105zm.475.344c.096.136.824-.195.708-.176.225-.113.029-.125-.097-.19-.043-.215-.079-.547-.213-.68l.088-.102c-.207-.299-.36.362-.36.362l.108-.031c.064.055-.072.095-.051.136.086.155.021.248.008.332-.014.085-.104.048-.149.093-.053.066.258.075.262.085.011.033-.375.089-.304.171zm13.134 12.116c0 3.313-2.687 6-6 6s-6-2.687-6-6 2.687-6 6-6 6 2.687 6 6zm-3.5-2.5l-6 2.25 3 .75.754 3 2.246-6z" />
                                            </svg>
                                            <span class="flex w-40"> Area </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 {{ Request::is('dashboard/media/cities*') ? 'active' : '' }}"
                                            href="/dashboard/media/cities">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-3.148 0-6 2.553-6 5.702 0 4.682 4.783 5.177 6 12.298 1.217-7.121 6-7.616 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm12 16l-6.707-2.427-5.293 2.427-5.581-2.427-6.419 2.427 4-9 3.96-1.584c.38.516.741 1.08 1.061 1.729l-3.523 1.41-1.725 3.88 2.672-1.01 1.506-2.687-.635 3.044 4.189 1.789.495-2.021.465 2.024 4.15-1.89-.618-3.033 1.572 2.896 2.732.989-1.739-3.978-3.581-1.415c.319-.65.681-1.215 1.062-1.731l4.021 1.588 3.936 9z" />
                                            </svg>
                                            <span class="flex w-40"> Kota </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/billboard-categories">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m20.998 8.498h-17.996c-.569 0-1.001.464-1.001.999 0 .118-.105-.582 1.694 10.659.077.486.496.842.988.842h14.635c.492 0 .911-.356.988-.842 1.801-11.25 1.693-10.54 1.693-10.66 0-.558-.456-.998-1.001-.998zm-.964-3.017h-16.03c-.524 0-1.001.422-1.001 1.007 0 .081-.01.016.14 1.01h17.752c.152-1.012.139-.931.139-1.009 0-.58-.469-1.008-1-1.008zm-15.973-1h15.916c.058-.436.055-.426.055-.482 0-.671-.575-1.001-1.001-1.001h-14.024c-.536 0-1.001.433-1.001 1 0 .056-.004.043.055.483z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="flex w-40"> Katagori Billboard </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/signage-categories">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m20.998 8.498h-17.996c-.569 0-1.001.464-1.001.999 0 .118-.105-.582 1.694 10.659.077.486.496.842.988.842h14.635c.492 0 .911-.356.988-.842 1.801-11.25 1.693-10.54 1.693-10.66 0-.558-.456-.998-1.001-.998zm-.964-3.017h-16.03c-.524 0-1.001.422-1.001 1.007 0 .081-.01.016.14 1.01h17.752c.152-1.012.139-.931.139-1.009 0-.58-.469-1.008-1-1.008zm-15.973-1h15.916c.058-.436.055-.426.055-.482 0-.671-.575-1.001-1.001-1.001h-14.024c-.536 0-1.001.433-1.001 1 0 .056-.004.043.055.483z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="flex w-40"> Katagori Signage </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/marketing/sale-categories">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m20.998 8.498h-17.996c-.569 0-1.001.464-1.001.999 0 .118-.105-.582 1.694 10.659.077.486.496.842.988.842h14.635c.492 0 .911-.356.988-.842 1.801-11.25 1.693-10.54 1.693-10.66 0-.558-.456-.998-1.001-.998zm-.964-3.017h-16.03c-.524 0-1.001.422-1.001 1.007 0 .081-.01.016.14 1.01h17.752c.152-1.012.139-.931.139-1.009 0-.58-.469-1.008-1-1.008zm-15.973-1h15.916c.058-.436.055-.426.055-.482 0-.671-.575-1.001-1.001-1.001h-14.024c-.536 0-1.001.433-1.001 1 0 .056-.004.043.055.483z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="flex w-40"> Katagori Penjualan </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/sizes">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m22 5c0-.478-.379-1-1-1h-18c-.62 0-1 .519-1 1v14c0 .621.52 1 1 1h18c.478 0 1-.379 1-1zm-7.565 3.522h-1.218c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h3.033c.414 0 .75.336.75.75v3.05c0 .414-.336.75-.75.75s-.75-.336-.75-.75v-1.244l-5.918 5.922h1.219c.414 0 .75.336.75.75s-.336.75-.75.75c-.715 0-2.319 0-3.033 0-.415 0-.75-.336-.75-.75 0-.715 0-2.335 0-3.05 0-.414.335-.75.75-.75.414 0 .75.336.75.75v1.243z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="flex w-40"> Ukuran </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/leds">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.95 5.636l1.414 1.414-2.195 2.195c-.372-.562-.853-1.042-1.414-1.414l2.195-2.195zm-5.95-1.636h2v3.101c-.323-.066-.657-.101-1-.101s-.677.035-1 .101v-3.101zm-3.95 1.636l2.195 2.195c-.561.372-1.042.853-1.414 1.415l-2.195-2.196 1.414-1.414zm-3.05 5.364h3.101c-.066.323-.101.657-.101 1s.035.677.101 1h-3.101v-2zm3.05 7.364l-1.414-1.414 2.195-2.195c.372.562.853 1.042 1.414 1.414l-2.195 2.195zm5.95 1.636h-2v-3.101c.323.066.657.101 1 .101s.677-.035 1-.101v3.101zm-1-5c-1.657 0-3-1.343-3-3s1.343-3 3-3 3 1.343 3 3-1.343 3-3 3zm4.95 3.364l-2.195-2.195c.562-.372 1.042-.853 1.414-1.414l2.195 2.195-1.414 1.414zm3.05-5.364h-3.101c.066-.323.101-.657.101-1s-.035-.677-.101-1h3.101v2z" />
                                            </svg>
                                            <span class="flex w-40"> Jenis LED </span>
                                        </a>
                                    </li>
                                    <span class="flex nav-a ml-2 border-t-[1px] border-b-[1px]"> Data Vendor </span>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/vendors">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M21.062 13.875l-1.625-5.979 3.367-1.092c-1.939-4.022-6.04-6.804-10.804-6.804-4.779 0-8.894 2.801-10.824 6.845l3.386 1.051-1.625 5.979-2.937-.767c.56 6.108 5.747 10.892 12 10.892s11.439-4.784 12-10.892l-2.938.767zm-14.826 1.845c-.314-.231-.382-.673-.151-.987l.806-1.088c.23-.313.67-.383.986-.151.316.231.383.672.152.987l-.807 1.087c-.217.298-.687.37-.986.152zm1.424 1.04c-.313-.232-.387-.664-.156-.978l.812-1.096c.229-.313.67-.381.984-.151.315.23.385.673.152.986l-.812 1.097c-.212.292-.672.366-.98.142zm1.426 1.04c-.313-.231-.383-.673-.151-.988l.805-1.086c.233-.315.674-.382.987-.152.314.231.383.673.151.987l-.805 1.088c-.218.296-.686.372-.987.151zm3.217-.201l-.807 1.092c-.215.294-.682.374-.986.151-.314-.231-.383-.672-.152-.986l.809-1.092c.229-.311.67-.382.986-.149.314.228.382.671.15.984zm.743 1.401c-.142 0-.296-.033-.451-.113.235-.318.579-.742.707-1.044l.159.159c.487.487.127.998-.415.998zm4.922-2.979c-.275.276-.723.276-.998 0l-2.025-2.025c-.065-.067-.174-.069-.243-.005-.075.067-.078.184-.006.255l1.875 1.876c.276.276.276.722 0 .998-.275.276-.723.276-.998 0l-1.523-1.524c-.068-.068-.178-.069-.247-.002-.072.069-.072.183-.003.252l1.264 1.265c.276.276.276.722 0 .999-.274.275-.722.276-.997 0l-.654-.654c.17-1.042-.595-1.891-1.53-1.972-.248-.591-.803-.985-1.422-1.039-.238-.571-.784-.984-1.424-1.04-.506-1.208-2.158-1.432-2.95-.351l-.44.595c-.449-.169-.934-.31-1.489-.441l1.273-4.685c1.899-.017 3.396-1.817 5.149-.709-.574.71-1.045 1.277-1.755 1.691-.567.332-.833.981-.66 1.616.216.797 1.024 1.354 1.968 1.354 1.248 0 2.54-1.025 3.521-1.761.578.577 3.831 3.775 4.315 4.31.274.274.274.72-.001.997zm.495-1.954s-3.125-3.084-4.053-4.013c-.496-.494-.838-.562-1.41-.101-.728.586-1.619 1.182-2.277 1.413-1.291.452-1.996-.647-1.396-.999 1.22-.711 1.814-1.737 2.839-2.898.284-.322.623-.441.969-.441.376 0 .761.14 1.095.312 1.517.784 2.897 1.319 4.351 1.212l1.296 4.768c-.464.208-.931.45-1.414.747z" />
                                            </svg>
                                            <span class="flex w-40"> Vendor </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/vendor-categories">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M21.062 13.875l-1.625-5.979 3.367-1.092c-1.939-4.022-6.04-6.804-10.804-6.804-4.779 0-8.894 2.801-10.824 6.845l3.386 1.051-1.625 5.979-2.937-.767c.56 6.108 5.747 10.892 12 10.892s11.439-4.784 12-10.892l-2.938.767zm-14.826 1.845c-.314-.231-.382-.673-.151-.987l.806-1.088c.23-.313.67-.383.986-.151.316.231.383.672.152.987l-.807 1.087c-.217.298-.687.37-.986.152zm1.424 1.04c-.313-.232-.387-.664-.156-.978l.812-1.096c.229-.313.67-.381.984-.151.315.23.385.673.152.986l-.812 1.097c-.212.292-.672.366-.98.142zm1.426 1.04c-.313-.231-.383-.673-.151-.988l.805-1.086c.233-.315.674-.382.987-.152.314.231.383.673.151.987l-.805 1.088c-.218.296-.686.372-.987.151zm3.217-.201l-.807 1.092c-.215.294-.682.374-.986.151-.314-.231-.383-.672-.152-.986l.809-1.092c.229-.311.67-.382.986-.149.314.228.382.671.15.984zm.743 1.401c-.142 0-.296-.033-.451-.113.235-.318.579-.742.707-1.044l.159.159c.487.487.127.998-.415.998zm4.922-2.979c-.275.276-.723.276-.998 0l-2.025-2.025c-.065-.067-.174-.069-.243-.005-.075.067-.078.184-.006.255l1.875 1.876c.276.276.276.722 0 .998-.275.276-.723.276-.998 0l-1.523-1.524c-.068-.068-.178-.069-.247-.002-.072.069-.072.183-.003.252l1.264 1.265c.276.276.276.722 0 .999-.274.275-.722.276-.997 0l-.654-.654c.17-1.042-.595-1.891-1.53-1.972-.248-.591-.803-.985-1.422-1.039-.238-.571-.784-.984-1.424-1.04-.506-1.208-2.158-1.432-2.95-.351l-.44.595c-.449-.169-.934-.31-1.489-.441l1.273-4.685c1.899-.017 3.396-1.817 5.149-.709-.574.71-1.045 1.277-1.755 1.691-.567.332-.833.981-.66 1.616.216.797 1.024 1.354 1.968 1.354 1.248 0 2.54-1.025 3.521-1.761.578.577 3.831 3.775 4.315 4.31.274.274.274.72-.001.997zm.495-1.954s-3.125-3.084-4.053-4.013c-.496-.494-.838-.562-1.41-.101-.728.586-1.619 1.182-2.277 1.413-1.291.452-1.996-.647-1.396-.999 1.22-.711 1.814-1.737 2.839-2.898.284-.322.623-.441.969-.441.376 0 .761.14 1.095.312 1.517.784 2.897 1.319 4.351 1.212l1.296 4.768c-.464.208-.931.45-1.414.747z" />
                                            </svg>
                                            <span class="flex w-40"> Katagori Vendor </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/printing-products">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M11.5 23l-8.5-4.535v-3.953l5.4 3.122 3.1-3.406v8.772zm1-.001v-8.806l3.162 3.343 5.338-2.958v3.887l-8.5 4.534zm-10.339-10.125l-2.161-1.244 3-3.302-3-2.823 8.718-4.505 3.215 2.385 3.325-2.385 8.742 4.561-2.995 2.771 2.995 3.443-2.242 1.241v-.001l-5.903 3.27-3.348-3.541 7.416-3.962-7.922-4.372-7.923 4.372 7.422 3.937v.024l-3.297 3.622-5.203-3.008-.16-.092-.679-.393v.002z" />
                                            </svg>
                                            <span class="flex w-40"> Bahan Cetak </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/printing-prices">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 16.462l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm15-11.497l-6.5 3.468v-7.215l6.5-3.345v7.092zm-7.5-3.771v7.216l-6.458-3.445v-7.133l6.458 3.362zm-3.408-5.589l6.526 3.398-2.596 1.336-6.451-3.359 2.521-1.375zm10.381 1.415l-2.766 1.423-6.558-3.415 2.872-1.566 6.452 3.558z" />
                                            </svg>
                                            <span class="flex w-40"> Harga Cetak </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="/dashboard/media/installation-prices">
                                            <svg class="child-nav-svg" xmlns="http://www.w3.org/2000/svg" role="img"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 16.462l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm15-11.497l-6.5 3.468v-7.215l6.5-3.345v7.092zm-7.5-3.771v7.216l-6.458-3.445v-7.133l6.458 3.362zm-3.408-5.589l6.526 3.398-2.596 1.336-6.451-3.359 2.521-1.375zm10.381 1.415l-2.766 1.423-6.558-3.415 2.872-1.566 6.452 3.558z" />
                                            </svg>
                                            <span class="flex w-40"> Harga Pasang </span>
                                        </a>
                                    </li>
                                    <span class="flex nav-a ml-2 border-t-[1px] border-b-[1px]"> Legalitas OOH </span>
                                    <li class="group">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M11.329 19.6c-.185.252-.47.385-.759.385-.194 0-.389-.06-.558-.183-.419-.309-.509-.896-.202-1.315l1.077-1.456c.308-.417.896-.508 1.315-.199.421.306.511.895.201 1.313l-1.074 1.455zm-.825-2.839c.308-.418.217-1.007-.201-1.316-.421-.308-1.008-.216-1.317.203l-1.073 1.449c-.309.419-.217 1.009.202 1.317.417.307 1.007.218 1.315-.202l1.074-1.451zm-1.9-1.388c.309-.417.217-1.007-.203-1.315-.418-.307-1.007-.216-1.314.202l-1.083 1.461c-.308.419-.209.995.209 1.304.421.308 1 .229 1.308-.19l1.083-1.462zm-1.898-1.386c.308-.419.219-1.007-.203-1.315-.419-.309-1.007-.218-1.315.201l-1.075 1.451c-.308.418-.217 1.008.202 1.315.419.307 1.008.218 1.315-.202l1.076-1.45zm17.294-8.438s-1.555.301-2.667.479c-2.146.344-4.144-.416-6.361-1.562-.445-.229-.957-.466-1.458-.466-.461 0-.913.209-1.292.639-1.366 1.547-2.16 2.915-3.785 3.864-.801.468.14 1.934 1.86 1.331.878-.308 1.736-.895 2.706-1.677.762-.615 1.22-.524 1.879.135 1.238 1.238 5.404 5.351 5.404 5.351 1.317-.812 2.422-1.312 3.713-1.792v-6.302zm-10.524 12.662c-.158.459-.618 1.001-.953 1.455.297.235.608.334.882.334.717 0 1.188-.671.542-1.318l-.471-.471zm6.506-3.463c-1.07-1.055-4.732-4.667-5.803-5.713-.165-.161-.421-.18-.608-.044-.639.464-2.082 1.485-2.944 1.788-1.685.59-3.115-.222-3.422-1.359-.192-.712.093-1.411.727-1.781 1.008-.589 1.657-1.375 2.456-2.363-.695-.539-1.35-.732-1.991-.732-1.706 0-3.317 1.366-5.336 1.231-1.373-.09-3.061-.403-3.061-.403v6.333c1.476.321 2.455.464 3.92 1.199l.462-.624c.364-.496.949-.792 1.564-.792.87 0 1.622.578 1.861 1.388.951 0 1.667.602 1.898 1.387.826-.031 1.641.519 1.897 1.385 1.171 0 2.017.92 1.981 2.007l1.168 1.168c.367.368.963.367 1.331 0 .368-.368.368-.964 0-1.332l-1.686-1.687c-.22-.22.113-.553.333-.333l2.032 2.033c.368.368.963.368 1.331 0s.368-.963 0-1.331l-2.501-2.502c-.221-.218.113-.553.333-.333l2.7 2.701c.368.368.963.368 1.331 0 .358-.356.361-.922.027-1.291z" />
                                            </svg>
                                            <span class="flex w-40"> Sewa Lahan</span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M18.625 19.46c-.264 1.696-.97 3.247-2.1 4.54-.065-.461-.254-.908-.433-1.266-.409.216-.899.33-1.328.33l-.265-.016c1.199-1.25 1.791-2.544 1.965-4.27.281.079.623.12 1.053.12.415.284.578.46 1.108.562zm4.875 3.589c-1.197-1.248-1.782-2.549-1.957-4.271-.283.079-.625.122-1.061.122-.414.285-.587.461-1.106.561.264 1.697.97 3.247 2.099 4.54.065-.461.254-.908.433-1.266.51.269 1.131.372 1.592.314zm-4.992-4.829c-.704-.494-.552-.447-1.423-.444h-.002c-.362 0-.685-.225-.794-.557-.267-.797-.176-.673-.879-1.163-.302-.208-.418-.577-.307-.9.273-.793.273-.641 0-1.438-.109-.32.002-.691.307-.9.703-.488.611-.365.879-1.163.109-.333.432-.557.794-.557h.002c.87.002.718.052 1.423-.444.146-.102.318-.154.492-.154s.346.052.492.154c.704.495.552.447 1.423.444h.001c.363 0 .686.224.797.557.266.796.172.673.877 1.163.223.153.348.397.348.65l-.042.25c-.272.793-.272.641 0 1.438.111.317 0 .69-.306.9-.705.489-.611.366-.877 1.163-.205.614-.656.555-1.18.555-.463 0-.465.042-1.041.446-.293.207-.691.207-.984 0zm.492-1.814c1.088 0 1.969-.882 1.969-1.969 0-1.087-.881-1.969-1.969-1.969s-1.969.881-1.969 1.969c0 1.087.881 1.969 1.969 1.969zm-4.674 1.333c-1.675 1.058-3.561 2.247-3.952 2.493-.043-.772-.329-1.492-.828-2.084-.058-.074-5.813-7.4-7.222-9.204-1.109-1.42-.06-2.934 1.23-2.934 1.694 0 2.369 2.207.894 3.163l1.163 1.486 8.053-4.551c1.396-1.032 1.79-2.938.914-4.434-.605-1.032-1.726-1.674-2.924-1.674-.475 0-.936.098-1.373.292l-8.264 4.227c-1.301.624-2.017 1.846-2.017 3.147 0 .816.282 1.663.877 2.412 1.444 1.815 7.261 9.253 7.319 9.328.862 1.147.017 2.753-1.376 2.753-.989 0-1.516-.705-1.667-1.308-.176-.705.069-1.407.773-1.858l-1.141-1.458c-.855.602-1.4 1.515-1.507 2.536-.228 2.174 1.504 3.929 3.557 3.929.63 0 1.255-.174 1.807-.502l5.485-3.458c.264-.415.529-1.431.199-2.301zm-3.319-15.755c.203-.095.431-.145.659-.145.577 0 1.082.305 1.349.816.338.645.244 1.59-.594 2.071l-5.307 3.006c0-1.191-.581-2.284-1.57-2.952l5.463-2.796zm1.987 6.267l1.725 2.117c.348-.525.858-.921 1.46-1.121l-1.562-1.916-1.623.92zm-2.886 8.043l2.871-1.628-.633-.825-2.863 1.661.625.792zm1.842-6.987l-5.012 2.943.624.792 5.026-2.951-.638-.784zm1.286 1.597l-5.035 2.965.624.792 5.049-2.974-.638-.783z" />
                                            </svg>
                                            <span class="flex w-40"> Perizinan </span>
                                        </a>
                                    </li> --}}
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
                                    <title>MARKETING</title>
                                    <path
                                        d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm6.23 16.244a.371.371 0 0 1-.373.372H16.29a.371.371 0 0 1-.372-.372v-4.828c0-.04-.046-.06-.08-.033l-3.32 3.32a.742.742 0 0 1-1.043 0l-3.32-3.32c-.027-.027-.08-.007-.08.033v4.828a.371.371 0 0 1-.372.372H6.136a.371.371 0 0 1-.372-.372V7.757c0-.206.166-.372.372-.372h1.076a.75.75 0 0 1 .525.22l4.13 4.13a.18.18 0 0 0 .26 0l4.13-4.13c.14-.14.325-.22.525-.22h1.075c.206 0 .372.166.372.372z" />
                                </svg>
                            </a>

                            <li class="group hidden" id="liMarketing" name="liMarketing"
                                onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/marketing*') ? 'active' : '' }}">
                                    <span class="flex w-40"> Marketing </span>
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
                                    <!-- Client Start -->
                                    <li class="group">
                                        <a class="nav-a ml-2 border-t-[1px] {{ Request::is('/dashboard/marketing/clients*') ? 'active' : '' }}"
                                            href="/dashboard/marketing/clients">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M7 16.488l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm1-7.869v-1.714c-.006-1.557.062-2.447 1.854-2.861 1.963-.453 4.315-.859 3.384-2.577-2.761-5.092-.787-7.979 2.177-7.979 2.907 0 4.93 2.78 2.177 7.979-.904 1.708 1.378 2.114 3.384 2.577 1.799.415 1.859 1.311 1.853 2.879 0 .13-.011 1.171 0 1.665-.483-.309-1.442-.552-2.187.106-.535.472-.568.504-1.783 1.629-1.75-.831-4.456-1.883-6.214-2.478-.896-.304-2.04-.308-2.962.075l-1.683.699z" />
                                            </svg>
                                            <span class="flex w-36"> Klien </span>
                                        </a>
                                    </li>
                                    <!-- Client End -->

                                    <!-- Penawaran Start -->
                                    <li id="penawaran" name="penawaran" class="group" onclick="childMenu(event,this)">
                                        <a class="nav-a ml-2" href="#">
                                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z" />
                                            </svg>
                                            <span class="flex w-36"> Penawaran </span>
                                            <svg id="penawaranArrow" name="penawaranArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>

                                        <!-- Child Penawaran Start -->
                                        <ul class="hidden" id="penawaranChild" name="penawaranChild">
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/dashboard/marketing/billboard-quotations">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Billboard </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/dashboard/marketing/videotron-quotations">
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
                                                <a class="nav-a ml-5" href="/dashboard/marketing/signage-quotations">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Signage </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5" href="/dashboard/marketing/print-instal-quotations">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Cetak & Pasang </span>
                                                </a>
                                            </li>
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
                                            <span class="flex w-36"> Penjualan </span>
                                            <svg id="penjualanArrow" name="penjualanArrow"
                                                class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                                                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <title>Arrow</title>
                                                <path
                                                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                                            </svg>
                                        </a>
                                        <!-- Penjualan Child Start -->
                                        <ul class="hidden" id="penjualanChild" name="penjualanChild">
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="/dashboard/marketing/sales">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill-rule="evenodd" clip-rule="evenodd">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Billboard </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill-rule="evenodd" clip-rule="evenodd">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Videotron </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill-rule="evenodd" clip-rule="evenodd">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Signage </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-t-[1px]"
                                                    href="/dashboard/marketing/print-install-sales">
                                                    <svg class="child-nav-svg" role="img"
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                                                        fill-rule="evenodd" clip-rule="evenodd">
                                                        <path
                                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                                    </svg>
                                                    <span class="flex w-40"> Cetak & Pasang </span>
                                                </a>
                                            </li>
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
                                            <span class="flex w-36"> Lap. Penawaran </span>
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
                                            <span class="flex w-36"> Lap. Penjualan </span>
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
                                            <span class="flex w-36"> Lap. SPK </span>
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
                                                    <span class="flex w-40"> Cetak </span>
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
                                                    <span class="flex w-40"> Pasang </span>
                                                </a>
                                            </li>
                                        </ul>
                                        <!-- SPK Reports Child End -->
                                    </li>
                                    <!-- SPK Reports end -->
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
                                    <title>ACCOUNTING</title>
                                    <path
                                        d="M6.898.437S7.87.534 8.26 1.505c0 0 1.069 2.526 2.04 4.955 1.42 3.33 3.22 7.615 4.67 11.078H1.167c-.778 0-1.166-.486-1.166-.486.777 1.36 3.012 5.636 3.012 5.636.388.486.777.776 1.36.776 1.264 0 3.208-1.262 3.208-1.262l7.409-4.619c1.412 3.372 2.5 5.98 2.5 5.98H24c.097-.097-9.327-22.446-9.424-22.544-.097-.097-.292-.582-.972-.582zm-.29.875c-.583 0-.778.485-.875.582L.39 14.526c-.291.874-.097 1.943 1.458 1.943h4.177l3.693-8.841A453.32 453.32 0 0 0 7.58 2.38c-.097-.291-.389-1.068-.972-1.068z" />
                                </svg>
                            </a>
                            <li id="liAccounting" name="liAccounting" class="group hidden"
                                onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/accounting*') ? 'active' : '' }}">
                                    <span class="flex w-40"> Accounting </span>
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
                                            <span class="flex w-36"> Penagihan </span>
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
                                            <span class="flex w-36"> Faktur PPn </span>
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
                                            <span class="flex w-36"> Faktur PPh </span>
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
                                    <title>WORKSHOP</title>
                                    <path
                                        d="M23.268 10.541C23.268 4.715 18.544 0 12.728 0c-1.614 0-3.191.317-4.663.952a11.952 11.952 0 00-3.817 2.574 11.915 11.915 0 00-3.516 8.478 11.924 11.924 0 003.516 8.48 12.05 12.05 0 003.817 2.573c1.472.626 3.05.943 4.671.943 1.56 0 3.05-.3 4.416-.837l-.908-2.292a9.448 9.448 0 01-3.508.67 9.481 9.481 0 01-6.743-2.794A9.481 9.481 0 013.2 12.004c0-2.547.996-4.944 2.794-6.742a9.496 9.496 0 016.743-2.794 8.072 8.072 0 016.734 12.524l-2.098-5.165c-.308-.758-.679-1.895-2.071-1.895-1.393 0-1.763 1.146-2.063 1.895l-1.93 4.769-2.591-6.54H5.993l3.226 7.95c.326.802.688 1.895 2.09 1.895 1.4 0 1.753-1.093 2.08-1.895l1.912-4.724 1.921 4.724c.388.978.802 1.895 2.08 1.895.908 0 1.481-.582 1.798-.96a10.493 10.493 0 002.168-6.4Z" />
                                </svg>
                            </a>
                            <li id="liWorkshop" name="liWorkshop" class="group hidden" onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/workshop*') ? 'active' : '' }}">
                                    <span class="flex w-40"> Workshop </span>
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
                                            <span class="flex w-36"> Monitoring </span>
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
                                                    <span class="flex w-40"> Up. Monitoring </span>
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
                                                    <span class="flex w-40"> Lap. Monitoring</span>
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
                                            <span class="flex w-36"> Pasang Gambar </span>
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
                                                    <span class="flex w-40"> Up. Dok. Pasang </span>
                                                </a>
                                            </li>
                                            <li class="group">
                                                <a class="nav-a ml-5 border-b-[1px]" href="#">
                                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
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
                                    <title>User</title>
                                    <path
                                        d="M5.331 3.987H4.012v-1.32h1.32zm7.605 16.001c-1.78-.08-3.15-.532-4.21-1.185.718 3.118 3.405 4.65 3.535 4.723l.792.437c6.063-.405 9.611-4.318 9.611-9.436v-1.109c-1.441 4.7-4.795 6.793-9.728 6.57M4.006 9.605h1.332v2.94h1.336V7.627H8.01v9.612C8.009 21.8 12 24 12 24c-6.705 0-10.664-4.065-10.664-9.473V3.65H2.67v7.274h1.336zM2.67 1.334H1.336V0H2.67zm2.661 6.953h-1.32v-1.32h1.32zm1.334-1.98h-1.32v-1.32h1.32zm1.343-1.66H6.674v-1.32h1.335zM6.674 2.654H5.338v-1.32h1.336zM22.147 13.26l.517-1.688V.015c-6.045 0-6.674 2.317-6.674 4.531V17.24c0 .657-.064 1.354-.197 2.037 3.205-.583 5.296-2.565 6.354-6.016Z" />
                                </svg>
                            </a>
                            <li id="liUser" name="liUser" class="group hidden" onclick="showHideDropdown(this)">
                                <a href="#"
                                    class="nav-a mx-2 {{ Request::is('dashboard/users/users*') ? 'active' : '' }}">
                                    <span class="flex w-40"> User </span>
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
                                        <a class="nav-a ml-2 border-t-[1px] {{ Request::is('/dashboard/users/users*') ? 'active' : '' }}"
                                            href="/dashboard/users/users">
                                            <svg class="child-nav-svg" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path
                                                    d="M19 7.001c0 3.865-3.134 7-7 7s-7-3.135-7-7c0-3.867 3.134-7.001 7-7.001s7 3.134 7 7.001zm-1.598 7.18c-1.506 1.137-3.374 1.82-5.402 1.82-2.03 0-3.899-.685-5.407-1.822-4.072 1.793-6.593 7.376-6.593 9.821h24c0-2.423-2.6-8.006-6.598-9.819z" />
                                            </svg>
                                            <span class="flex w-40"> User </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 {{ Request::is('/dashboard/users/notifications*') ? 'active' : '' }}"
                                            href="/dashboard/users/notifications">
                                            <svg class="child-nav-svg" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                <path fill="none" d="M0 0h24v24H0V0z" />
                                                <path
                                                    d="M18 16v-5c0-3.07-1.64-5.64-4.5-6.32V4c0-.83-.68-1.5-1.51-1.5S10.5 3.17 10.5 4v.68C7.63 5.36 6 7.92 6 11v5l-1.3 1.29c-.63.63-.19 1.71.7 1.71h13.17c.89 0 1.34-1.08.71-1.71L18 16zm-6.01 6c1.1 0 2-.9 2-2h-4c0 1.1.89 2 2 2zM6.77 4.73c.42-.38.43-1.03.03-1.43-.38-.38-1-.39-1.39-.02C3.7 4.84 2.52 6.96 2.14 9.34c-.09.61.38 1.16 1 1.16.48 0 .9-.35.98-.83.3-1.94 1.26-3.67 2.65-4.94zM18.6 3.28c-.4-.37-1.02-.36-1.4.02-.4.4-.38 1.04.03 1.42 1.38 1.27 2.35 3 2.65 4.94.07.48.49.83.98.83.61 0 1.09-.55.99-1.16-.38-2.37-1.55-4.48-3.25-6.05z" />
                                            </svg>
                                            <span class="flex w-40"> Notifikasi </span>
                                        </a>
                                    </li>
                                    <li class="group">
                                        <a class="nav-a ml-2 border-b-[1px]" href="#">
                                            <svg class="child-nav-svg" role="img"
                                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
                                                <circle cx="16" cy="31.58" r="1" />
                                                <path
                                                    d="M45.75,19H10.32A5.3,5.3,0,0,0,5,24.26V38.74c0,2.37,2.75,4.17,4,4.87v7.06a1,1,0,0,0,1,1,1,1,0,0,0,.71-.3L18.07,44H45.75A5.26,5.26,0,0,0,51,38.74V24.46A5.28,5.28,0,0,0,45.75,19ZM13,31.58a3,3,0,1,1,3,3A3,3,0,0,1,13,31.58Zm8,0a3,3,0,1,1,3,3A3,3,0,0,1,21,31.58Zm8,0a3,3,0,1,1,3,3A3,3,0,0,1,29,31.58Zm11,3a3,3,0,1,1,3-3A3,3,0,0,1,40,34.58Z" />
                                                <circle cx="40" cy="31.58" r="1" />
                                                <circle cx="32" cy="31.58" r="1" />
                                                <circle cx="24" cy="31.58" r="1" />
                                                <path
                                                    d="M53.74,13h-34a5.1,5.1,0,0,0-5,4h31A7.27,7.27,0,0,1,53,24.25V38h.75A5.25,5.25,0,0,0,59,32.75V18.26A5.25,5.25,0,0,0,53.74,13Z" />
                                            </svg>
                                            <span class="flex w-40"> Pesan </span>
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
                                        <span class="flex w-40"> Logout </span>
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
