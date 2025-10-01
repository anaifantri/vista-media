<div class="justify-start items-center px-2 w-full hidden sm:flex">
    <nav class="sm:flex w-full hidden">
        <ul class="flex justify-start group w-max  h-6 transition duration-300 ease-in-out">
            <a class="right-nav text-white {{ Request::is('dashboard') ? 'active' : '' }}"
                href="/dashboard/{{ encrypt($company->id) }}">
                <svg class="fill-current w-5 mx-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <title>DASHBOARD</title>
                    <path
                        d="M11.9922 1.3945a.7041.7041 0 00-.498.211L.1621 13.0977A.5634.5634 0 000 13.494a.567.567 0 00.5664.5664H2.67v8.0743c0 .2603.2104.4707.4707.4707h7.9473v-3.6836L8.037 15.8672a2.42 2.42 0 01-.9473.1933c-1.3379 0-2.4218-1.0868-2.4218-2.4257 0-1.339 1.084-2.4239 2.4218-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 .3359-.068.6563-.1915.9472l1.7676 1.7676v-5.375C10.2 10.615 9.5723 9.744 9.5723 8.7266c0-1.339 1.0859-2.4258 2.4238-2.4258 1.338 0 2.4219 1.0868 2.4219 2.4258 0 1.0174-.6259 1.8884-1.5137 2.248v5.375l1.7656-1.7676a2.4205 2.4205 0 01-.1914-.9472c0-1.339 1.086-2.4239 2.4238-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 1.3389-1.084 2.4257-2.422 2.4257a2.42 2.42 0 01-.9472-.1933l-3.0508 3.0547v3.6836h7.9473a.4702.4702 0 00.4707-.4707v-8.0743h2.1113a.5686.5686 0 00.3965-.162c.2233-.2185.2262-.5775.0078-.8008l-2.5156-2.5723V6.4707c0-.2603-.2104-.4727-.4707-.4727h-1.9649c-.2603 0-.4707.2124-.4707.4727v1.1035L12.5 1.6035a.7056.7056 0 00-.5078-.209zm.0039 6.3614c-.5352 0-.9688.4351-.9688.9707 0 .5355.4336.9687.9688.9687a.9683.9683 0 00.9687-.9687c0-.5356-.4335-.9707-.9687-.9707zM7.0898 12.666a.9683.9683 0 00-.9687.9688c0 .5355.4336.9707.9687.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688zm9.8125 0c-.5351 0-.9707.4332-.9707.9688 0 .5355.4356.9707.9707.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688Z" />
                </svg>
                <span class="flex group"> Dashboard </span>
            </a>
        </ul>
        @can('isLocation')
            <ul id="mediaNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40  p-1 h-6 text-white {{ Request::is('media/locations*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 0c-3.148 0-6 2.553-6 5.702 0 4.682 4.783 5.177 6 12.298 1.217-7.121 6-7.616 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm12 16l-6.707-2.427-5.293 2.427-5.581-2.427-6.419 2.427 4-9 3.96-1.584c.38.516.741 1.08 1.061 1.729l-3.523 1.41-1.725 3.88 2.672-1.01 1.506-2.687-.635 3.044 4.189 1.789.495-2.021.465 2.024 4.15-1.89-.618-3.033 1.572 2.896 2.732.989-1.739-3.978-3.581-1.415c.319-.65.681-1.215 1.062-1.731l4.021 1.588 3.936 9z" />
                    </svg>
                    <span class="flex"> Data Lokasi </span>
                    <svg id="mediaArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5" role="img"
                        clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="mediaChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md bg-opacity-90 hidden">
                    <!-- Child Media Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]"
                                href="/media/locations/home/All">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Semua Katagori </span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            @if ($category->name != 'Service')
                                <li class="group">
                                    <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]"
                                        href="/media/locations/home/{{ $category->name }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex font-semibold"> {{ $category->name }} </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Child Media End -->
                </li>
            </ul>
        @endcan
        @can('isLegal')
            <ul id="legalNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40 p-1 h-6 text-white {{ Request::is('media/licenses*') ? 'active' : '' }}{{ Request::is('media/land_agreements*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> Data Legalitas </span>
                    <svg id="legalArrow" class="ml-1 fill-current transition duration-300 ease-in-out w-5" role="img"
                        clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="legalChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md bg-opacity-90 hidden">
                    <!-- Child Legalitas Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('media/licenses*') ? 'active' : '' }}"
                                href="/media/licenses">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Data Izin </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('media/land_agreements*') ? 'active' : '' }}"
                                href="/media/land-agreements">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Sewa Lahan </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Legalitas End -->
                </li>
            </ul>
        @endcan
        @can('isArea')
            <ul class="flex group w-max  p-1 h-6 transition duration-300 ease-in-out">
                <a class="right-nav text-white {{ Request::is('media/area*') ? 'active' : '' }}" href="/media/area">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M12.02 0c6.614.011 11.98 5.383 11.98 12 0 6.623-5.376 12-12 12-6.623 0-12-5.377-12-12 0-6.617 5.367-11.989 11.981-12h.039zm3.694 16h-7.427c.639 4.266 2.242 7 3.713 7 1.472 0 3.075-2.734 3.714-7m6.535 0h-5.523c-.426 2.985-1.321 5.402-2.485 6.771 3.669-.76 6.671-3.35 8.008-6.771m-14.974 0h-5.524c1.338 3.421 4.34 6.011 8.009 6.771-1.164-1.369-2.059-3.786-2.485-6.771m-.123-7h-5.736c-.331 1.166-.741 3.389 0 6h5.736c-.188-1.814-.215-3.925 0-6m8.691 0h-7.685c-.195 1.8-.225 3.927 0 6h7.685c.196-1.811.224-3.93 0-6m6.742 0h-5.736c.062.592.308 3.019 0 6h5.736c.741-2.612.331-4.835 0-6m-12.825-7.771c-3.669.76-6.671 3.35-8.009 6.771h5.524c.426-2.985 1.321-5.403 2.485-6.771m5.954 6.771c-.639-4.266-2.242-7-3.714-7-1.471 0-3.074 2.734-3.713 7h7.427zm-1.473-6.771c1.164 1.368 2.059 3.786 2.485 6.771h5.523c-1.337-3.421-4.339-6.011-8.008-6.771" />
                    </svg>
                    <span class="flex"> Area </span>
                </a>
            </ul>
            <ul class="flex group w-max  ml-4 h-6 transition duration-300 ease-in-out">
                <a class="right-nav text-white {{ Request::is('media/cities*') ? 'active' : '' }}" href="/media/cities">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M1 22h2v-22h18v22h2v2h-22v-2zm7-3v4h3v-4h-3zm5 0v4h3v-4h-3zm-6-5h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2zm-12-4h-2v2h2v-2zm8 0h-2v2h2v-2zm-4 0h-2v2h2v-2zm8 0h-2v2h2v-2z" />
                    </svg>
                    <span class="flex"> Kota </span>
                </a>
            </ul>
        @endcan
    </nav>
</div>
