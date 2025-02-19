<div class="justify-start items-center px-2 w-full flex">
    <nav class="flex w-full">
        <ul class="flex justify-start group w-max  h-6 transition duration-300 ease-in-out">
            <a class="right-nav text-stone-100 {{ Request::is('dashboard') ? 'active' : '' }}"
                href="/dashboard/{{ $company->id }}">
                <svg class="fill-current w-5 mx-2" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <title>DASHBOARD</title>
                    <path
                        d="M11.9922 1.3945a.7041.7041 0 00-.498.211L.1621 13.0977A.5634.5634 0 000 13.494a.567.567 0 00.5664.5664H2.67v8.0743c0 .2603.2104.4707.4707.4707h7.9473v-3.6836L8.037 15.8672a2.42 2.42 0 01-.9473.1933c-1.3379 0-2.4218-1.0868-2.4218-2.4257 0-1.339 1.084-2.4239 2.4218-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 .3359-.068.6563-.1915.9472l1.7676 1.7676v-5.375C10.2 10.615 9.5723 9.744 9.5723 8.7266c0-1.339 1.0859-2.4258 2.4238-2.4258 1.338 0 2.4219 1.0868 2.4219 2.4258 0 1.0174-.6259 1.8884-1.5137 2.248v5.375l1.7656-1.7676a2.4205 2.4205 0 01-.1914-.9472c0-1.339 1.086-2.4239 2.4238-2.4239 1.338 0 2.422 1.085 2.422 2.4239 0 1.3389-1.084 2.4257-2.422 2.4257a2.42 2.42 0 01-.9472-.1933l-3.0508 3.0547v3.6836h7.9473a.4702.4702 0 00.4707-.4707v-8.0743h2.1113a.5686.5686 0 00.3965-.162c.2233-.2185.2262-.5775.0078-.8008l-2.5156-2.5723V6.4707c0-.2603-.2104-.4727-.4707-.4727h-1.9649c-.2603 0-.4707.2124-.4707.4727v1.1035L12.5 1.6035a.7056.7056 0 00-.5078-.209zm.0039 6.3614c-.5352 0-.9688.4351-.9688.9707 0 .5355.4336.9687.9688.9687a.9683.9683 0 00.9687-.9687c0-.5356-.4335-.9707-.9687-.9707zM7.0898 12.666a.9683.9683 0 00-.9687.9688c0 .5355.4336.9707.9687.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688zm9.8125 0c-.5351 0-.9707.4332-.9707.9688 0 .5355.4356.9707.9707.9707.5352 0 .9688-.4352.9688-.9707a.9683.9683 0 00-.9688-.9688Z" />
                </svg>
                <span class="flex group"> Dashboard </span>
            </a>
        </ul>
        @can('isElectricity')
            <ul id="electricityNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40  p-1 h-6 text-stone-100 {{ Request::is('workshop/electrical-powers*') ? 'active' : '' }}{{ Request::is('workshop/electricity-top-ups*') ? 'active' : '' }}{{ Request::is('workshop/electricity-payments*') ? 'active' : '' }}{{ Request::is('workshop/electricity-reports*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M0 18h21v-12h-21v12zm9.599-6.157v-2.843l6.401 4.686-4.408-1.296v2.61l-6.592-4.488 4.599 1.331zm14.401-1.593v3.5c0 .69-.56 1.25-1.25 1.25h-.75v-6h.75c.69 0 1.25.56 1.25 1.25z" />
                    </svg>
                    <span class="flex"> Data Listrik </span>
                    <svg id="electricityArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="electricityChildNav"
                    class="absolute border rounded-b-lg mt-4 w-max p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Electricity Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/electrical-powers*') ? 'active' : '' }}"
                                href="/workshop/electrical-powers">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Daya Listrik </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/electricity-top-ups*') ? 'active' : '' }}"
                                href="/workshop/electricity-top-ups">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Pengisian Pulsa Listrik </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/electricity-payments*') ? 'active' : '' }}"
                                href="/workshop/electricity-payments">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Pembayaran Listrik </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/electricity-reports*') ? 'active' : '' }}"
                                href="/workshop/electricity-reports">
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
                    <!-- Child Electricity End -->
                </li>
            </ul>
        @endcan
        @can('isComplaint')
            <ul id="complaintNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-max p-1 h-6 text-stone-100 {{ Request::is('workshop/complaints*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M21.169 19.754c.522-.79.831-1.735.831-2.754 0-2.761-2.238-5-5-5s-5 2.239-5 5 2.238 5 5 5c1.019 0 1.964-.309 2.755-.832l2.831 2.832 1.414-1.414-2.831-2.832zm-4.169.246c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm-4.89 2h-7.11l2.599-3h2.696c.345 1.152.976 2.18 1.815 3zm-2.11-5h-10v-17h22v12.11c-.574-.586-1.251-1.068-2-1.425v-8.685h-18v13h8.295c-.19.634-.295 1.305-.295 2zm-2.131-4.372l.945-5.759.965 4.145c.096.425.686.473.847.063l.895-2.328.479.974c.08.169.164.277.438.277h1.208v-.877h-.921l-.836-1.624c-.156-.364-.677-.356-.82.014l-.741 1.895-1.144-5.062c-.052-.232-.242-.346-.43-.346-.2 0-.4.127-.44.373l-.948 5.847-.969-3.6c-.109-.43-.715-.455-.853-.029l-.721 2.545h-.823v.864h1.172c.16 0 .334-.13.38-.284l.406-1.257 1.043 4.206c.117.468.791.437.868-.037z" />
                    </svg>
                    <span class="flex"> Komplain </span>
                    <svg id="complaintArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="complaintChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Complaint Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/complaints*') ? 'active' : '' }}"
                                href="/workshop/Complaints">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Data Komplain </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/complaints*') ? 'active' : '' }}"
                                href="/workshop/Complaints">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Data Respons </span>
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
                    <!-- Child Complaint End -->
                </li>
            </ul>
        @endcan
        @can('isMonitoring')
            <ul id="monitoringNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-max p-1 h-6 text-stone-100 {{ Request::is('workshop/monitorings*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M21.169 19.754c.522-.79.831-1.735.831-2.754 0-2.761-2.238-5-5-5s-5 2.239-5 5 2.238 5 5 5c1.019 0 1.964-.309 2.755-.832l2.831 2.832 1.414-1.414-2.831-2.832zm-4.169.246c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm-4.89 2h-7.11l2.599-3h2.696c.345 1.152.976 2.18 1.815 3zm-2.11-5h-10v-17h22v12.11c-.574-.586-1.251-1.068-2-1.425v-8.685h-18v13h8.295c-.19.634-.295 1.305-.295 2zm-2.131-4.372l.945-5.759.965 4.145c.096.425.686.473.847.063l.895-2.328.479.974c.08.169.164.277.438.277h1.208v-.877h-.921l-.836-1.624c-.156-.364-.677-.356-.82.014l-.741 1.895-1.144-5.062c-.052-.232-.242-.346-.43-.346-.2 0-.4.127-.44.373l-.948 5.847-.969-3.6c-.109-.43-.715-.455-.853-.029l-.721 2.545h-.823v.864h1.172c.16 0 .334-.13.38-.284l.406-1.257 1.043 4.206c.117.468.791.437.868-.037z" />
                    </svg>
                    <span class="flex"> Pemantauan </span>
                    <svg id="monitoringArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="monitoringChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Monitoring Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/monitorings*') ? 'active' : '' }}"
                                href="/workshop/monitorings">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Upload Foto </span>
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
                    <!-- Child Monitoring End -->
                </li>
            </ul>
        @endcan
        @can('isDocumentation')
            <ul id="documentationNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-max p-1 h-6 text-stone-100 {{ Request::is('workshop/documentations*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M9 12c0-.552.448-1 1.001-1s.999.448.999 1-.446 1-.999 1-1.001-.448-1.001-1zm6.2 0l-1.7 2.6-1.3-1.6-3.2 4h10l-3.8-5zm5.8-7v-2h-21v15h2v-13h19zm3 2v14h-20v-14h20zm-2 2h-16v10h16v-10z" />
                    </svg>
                    <span class="flex"> Pemasangan </span>
                    <svg id="documentationArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="documentationChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Documentation Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/documentations*') ? 'active' : '' }}"
                                href="/installation-photos/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Upload Foto </span>
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
                    <!-- Child Documentation End -->
                </li>
            </ul>
        @endcan
        @can('isContent')
            <ul id="contentNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-max p-1 h-6 text-stone-100 {{ Request::is('workshop/contents*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M9 12c0-.552.448-1 1.001-1s.999.448.999 1-.446 1-.999 1-1.001-.448-1.001-1zm6.2 0l-1.7 2.6-1.3-1.6-3.2 4h10l-3.8-5zm5.8-7v-2h-21v15h2v-13h19zm3 2v14h-20v-14h20zm-2 2h-16v10h16v-10z" />
                    </svg>
                    <span class="flex"> Konten LED </span>
                    <svg id="contentArrowNav" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="contentChildNav"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Content Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/contents*') ? 'active' : '' }}"
                                href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Publish Konten </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('workshop/contents*') ? 'active' : '' }}"
                                href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex font-semibold"> Take Out Konten </span>
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
                    <!-- Child Content End -->
                </li>
            </ul>
        @endcan
    </nav>
</div>
