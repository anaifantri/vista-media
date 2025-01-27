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
        @can('isQuotation')
            <ul id="quotationNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40  p-1 h-6 text-stone-200 {{ Request::is('marketing/quotations*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> Penawaran </span>
                    <svg id="quotationArrow" class="ml-1 fill-current transition duration-300 ease-in-out w-5"
                        role="img" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="quotationChild"
                    class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Penawaran Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('marketing/quotations/home/All*') ? 'active' : '' }}"
                                href="/marketing/quotations/home/All/{{ $company->id }}">
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
                            @if ($category->name == 'Service')
                                <li class="group">
                                    <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('marketing/quotations/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex font-semibold"> Cetak & Pasang </span>
                                    </a>
                                </li>
                            @else
                                <li class="group">
                                    <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('marketing/quotations/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}">
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
                    <!-- Child Penawaran End -->
                </li>
            </ul>
        @endcan
        @can('isSale')
            <ul id="saleNav" class="relative group transition duration-300 ease-in-out"
                onclick="headerDropdown(event, this)">
                <a class="right-nav w-40 p-1 h-6 text-stone-200 {{ Request::is('marketing/sales/*') ? 'active' : '' }}"
                    href="#">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M19 2c-1.229 0-2.18-1.084-3-2h-8c-.82.916-1.771 2-3 2h-3v22h20v-22h-3zm-7 0c.552 0 1 .448 1 1s-.448 1-1 1-1-.448-1-1 .448-1 1-1zm8 20h-3.824c1.377-1.103 2.751-2.51 3.824-3.865v3.865zm0-8.457c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-7.362v-18h4l2.102 2h3.898l2-2h4v9.543z" />
                    </svg>
                    <span class="flex"> Penjualan </span>
                    <svg id="saleArrow" class="ml-1 fill-current transition duration-300 ease-in-out w-5" role="img"
                        clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="m16.843 10.211c.108-.141.157-.3.157-.456 0-.389-.306-.755-.749-.755h-8.501c-.445 0-.75.367-.75.755 0 .157.05.316.159.457 1.203 1.554 3.252 4.199 4.258 5.498.142.184.36.29.592.29.23 0 .449-.107.591-.291 1.002-1.299 3.044-3.945 4.243-5.498z" />
                    </svg>
                </a>
                <li id="saleChild" class="absolute border rounded-b-lg mt-4 w-40 p-1 bg-stone-700 drop-shadow-md hidden">
                    <!-- Child Penawaran Start -->
                    <ul>
                        <li class="group">
                            <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('marketing/sales/home/All*') ? 'active' : '' }}"
                                href="/marketing/sales/home/All/{{ $company->id }}">
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
                            @if ($category->name == 'Service')
                                <li class="group">
                                    <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('marketing/sales/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex font-semibold"> Cetak & Pasang </span>
                                    </a>
                                </li>
                            @else
                                <li class="group">
                                    <a class="nav-a hover:bg-teal-50 p-1 rounded-md border-b-[1px] {{ Request::is('marketing/sales/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex font-semibold"> {{ $category->name }} </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Child Penawaran End -->
                </li>
            </ul>
        @endcan
        @can('isSaleReport')
            <ul class="flex group w-max  p-1 h-6 transition duration-300 ease-in-out">
                <a class="right-nav text-stone-200 {{ Request::is('marketing/sales-report*') ? 'active' : '' }}"
                    href="/marketing/sales-report/{{ $company->id }}">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                    </svg>
                    <span class="flex"> Lap. Penjualan </span>
                </a>
            </ul>
        @endcan
        @can('isClient')
            <ul class="flex group w-max  p-1 h-6 transition duration-300 ease-in-out">
                <a class="right-nav text-stone-200 {{ Request::is('marketing/clients*') ? 'active' : '' }}"
                    href="/marketing/clients">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M7 16.488l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm1-7.869v-1.714c-.006-1.557.062-2.447 1.854-2.861 1.963-.453 4.315-.859 3.384-2.577-2.761-5.092-.787-7.979 2.177-7.979 2.907 0 4.93 2.78 2.177 7.979-.904 1.708 1.378 2.114 3.384 2.577 1.799.415 1.859 1.311 1.853 2.879 0 .13-.011 1.171 0 1.665-.483-.309-1.442-.552-2.187.106-.535.472-.568.504-1.783 1.629-1.75-.831-4.456-1.883-6.214-2.478-.896-.304-2.04-.308-2.962.075l-1.683.699z" />
                    </svg>
                    <span class="lg:flex hidden"> Klien </span>
                </a>
            </ul>
        @endcan
        @can('isOrder')
            <ul class="flex group w-max  ml-4 h-6 transition duration-300 ease-in-out">
                <a class="right-nav text-stone-200 {{ Request::is('print-orders/index/*') ? 'active' : '' }}"
                    href="/print-orders/index/{{ $company->id }}">
                    <svg class="fill-current w-5 mx-2" xmlns="http://www.w3.org/2000/svg" role="img"
                        viewBox="0 0 24 24">
                        <path
                            d="M18 17l3 6h-18l3-6h2.203l-1.967 4h11.527l-1.956-4h2.193zm6-12v14h-2.764l-2-4h-14.472l-2 4h-2.764v-14h4v-4h16v4h4zm-6-2h-12v2h12v-2zm4 4.5c0-.276-.224-.5-.5-.5s-.5.224-.5.5.224.5.5.5.5-.224.5-.5z" />
                    </svg>
                    <span class="flex"> SPK Cetak </span>
                </a>
            </ul>
        @endcan
        @can('isOrder')
            <ul class="flex group w-max transition duration-300 ease-in-out">
                <a class="right-nav w-max p-2 h-6 text-stone-200 {{ Request::is('install-orders/index/*') ? 'active' : '' }}"
                    href="/install-orders/index/{{ $company->id }}">
                    <svg class="fill-current w-5 mx-2 rotate-180" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M9 3h6v2h-6v-2zm3 15l7-8h-4v-4h-6v4h-4l7 8zm3-16v-2h-6v2h6zm3.213-.246l-1.213 1.599c2.984 1.732 5 4.955 5 8.647 0 5.514-4.486 10-10 10s-10-4.486-10-10c0-3.692 2.016-6.915 5-8.647l-1.213-1.599c-3.465 2.103-5.787 5.897-5.787 10.246 0 6.627 5.373 12 12 12s12-5.373 12-12c0-4.349-2.322-8.143-5.787-10.246z" />
                    </svg>
                    <Span class="flex">SPK Pasang</Span>
                </a>
            </ul>
        @endcan
        @can('isOrder')
            <ul class="flex group w-max transition duration-300 ease-in-out">
                <a class="right-nav w-max p-2 h-6 text-stone-200 {{ Request::is('takedown-orders/index/*') ? 'active' : '' }}"
                    href="/takedown-orders/index/{{ $company->id }}">
                    <svg class="fill-current w-5 mx-2 rot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M9 3h6v2h-6v-2zm3 15l7-8h-4v-4h-6v4h-4l7 8zm3-16v-2h-6v2h6zm3.213-.246l-1.213 1.599c2.984 1.732 5 4.955 5 8.647 0 5.514-4.486 10-10 10s-10-4.486-10-10c0-3.692 2.016-6.915 5-8.647l-1.213-1.599c-3.465 2.103-5.787 5.897-5.787 10.246 0 6.627 5.373 12 12 12s12-5.373 12-12c0-4.349-2.322-8.143-5.787-10.246z" />
                    </svg>
                    <Span class="flex">SPK Penurunan</Span>
                </a>
            </ul>
        @endcan
    </nav>
</div>
