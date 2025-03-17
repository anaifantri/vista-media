<div class="justify-start items-center px-2 w-full hidden sm:flex">
    <nav class="sm:flex w-full hidden">
        <ul class="flex justify-start group w-max  h-6 transition duration-300 ease-in-out">
            <a class="right-nav text-stone-200 {{ Request::is('dashboard') ? 'active' : '' }}"
                href="/dashboard/{{ $company->id }}">
                <svg class="fill-current w-5 mx-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <title>DASHBOARD</title>
                    <path
                        d="M11.9922 1.3945a.7041.7041 0 00-.498.211L.1621 13.0977A.5634.5634 0 000 13.494a.567.567 0 00.5664.5664H2.67v8.0743c0 .2603.2104.4707.4707.4707h7.9473v-3.6836L8.037 15.8672a2.42 2.42 0 01-.9473.1933c-1.3379 0-2.4218-1.0868-2.4218-2.4257 0-1.339 1.084-2.4239 2.4218-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 .3359-.068.6563-.1915.9472l1.7676 1.7676v-5.375C10.2 10.615 9.5723 9.744 9.5723 8.7266c0-1.339 1.0859-2.4258 2.4238-2.4258 1.338 0 2.4219 1.0868 2.4219 2.4258 0 1.0174-.6259 1.8884-1.5137 2.248v5.375l1.7656-1.7676a2.4205 2.4205 0 01-.1914-.9472c0-1.339 1.086-2.4239 2.4238-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 1.3389-1.084 2.4257-2.422 2.4257a2.42 2.42 0 01-.9472-.1933l-3.0508 3.0547v3.6836h7.9473a.4702.4702 0 00.4707-.4707v-8.0743h2.1113a.5686.5686 0 00.3965-.162c.2233-.2185.2262-.5775.0078-.8008l-2.5156-2.5723V6.4707c0-.2603-.2104-.4727-.4707-.4727h-1.9649c-.2603 0-.4707.2124-.4707.4727v1.1035L12.5 1.6035a.7056.7056 0 00-.5078-.209zm.0039 6.3614c-.5352 0-.9688.4351-.9688.9707 0 .5355.4336.9687.9688.9687a.9683.9683 0 00.9687-.9687c0-.5356-.4335-.9707-.9687-.9707zM7.0898 12.666a.9683.9683 0 00-.9687.9688c0 .5355.4336.9707.9687.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688zm9.8125 0c-.5351 0-.9707.4332-.9707.9688 0 .5355.4356.9707.9707.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688Z" />
                </svg>
                <span class="flex group"> Dashboard </span>
            </a>
        </ul>
        @can('isCollect')
            <ul id="collectNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40  p-1 h-6 text-stone-200" href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> Penagihan </span>
                    <svg id="collectArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="collectChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md bg-opacity-90 hidden">
                    <!-- Child Penagihan Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]"
                                href="/work-reports/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> BAST </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]"
                                href="/billings/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Invoice </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]"
                                href="/bill-cover-letters/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Surat Pengantar </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Laporan </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Penagihan End -->
                </li>
            </ul>
        @endcan
        @can('isPayment')
            <ul id="paymentNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40 p-1 h-6 text-stone-200" href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> Pembayaran </span>
                    <svg id="paymentArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="paymentChildNav"
                    class="absolute border rounded-b-lg mt-4 p-1 bg-stone-700 drop-shadow-md bg-opacity-90 hidden">
                    <!-- Child Pembayaran Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Data Pembayaran </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Laporan </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Pembayaran End -->
                </li>
            </ul>
        @endcan
        @can('isPPN')
            <ul id="ppnNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40 p-1 h-6 text-stone-200" href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> PPN </span>
                    <svg id="ppnArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="ppnChildNav"
                    class="absolute border rounded-b-lg mt-4 p-1 bg-stone-700 drop-shadow-md bg-opacity-90 hidden">
                    <!-- Child PPN Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]"
                                href="/vat-tax-invoices/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Data PPN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Pembayaran PPN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Laporan </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child PPN End -->
                </li>
            </ul>
        @endcan
        @can('isPPh')
            <ul id="pphNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40 p-1 h-6 text-stone-200" href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> PPh </span>
                    <svg id="pphArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="pphChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md bg-opacity-90 hidden">
                    <!-- Child PPN Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Data PPh </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Laporan </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child PPN End -->
                </li>
            </ul>
        @endcan
    </nav>
</div>
