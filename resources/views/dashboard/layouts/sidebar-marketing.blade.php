<div class="div-nav-a" title="Data Pemasaran">
    <a class="nav-a {{ Request::is('marketing*') ? 'active' : '' }}" href="/marketing">
        <svg role="img" class="nav-svg transition duration-300 ease-in-out" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <title>PEMASARAN</title>
            <path
                d="M12 0C5.372 0 0 5.372 0 12s5.372 12 12 12 12-5.372 12-12S18.628 0 12 0zm6.23 16.244a.371.371 0 0 1-.373.372H16.29a.371.371 0 0 1-.372-.372v-4.828c0-.04-.046-.06-.08-.033l-3.32 3.32a.742.742 0 0 1-1.043 0l-3.32-3.32c-.027-.027-.08-.007-.08.033v4.828a.371.371 0 0 1-.372.372H6.136a.371.371 0 0 1-.372-.372V7.757c0-.206.166-.372.372-.372h1.076a.75.75 0 0 1 .525.22l4.13 4.13a.18.18 0 0 0 .26 0l4.13-4.13c.14-.14.325-.22.525-.22h1.075c.206 0 .372.166.372.372z" />
        </svg>
    </a>

    <li class="group hidden" id="liMarketing" name="liMarketing" onclick="showHideDropdown(this)">
        <a href="#" class="nav-a mx-2 {{ Request::is('marketing*') ? 'active' : '' }}">
            <span class="flex w-40"> DATA PEMASARAN </span>
            <svg id="marketingArrow" name="marketingArrow"
                class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>Arrow</title>
                <path
                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
            </svg>
        </a>
        <!-- Child Marketing Start -->
        <ul class="hidden" id="marketingChild">
            <!-- Vendor Start -->
            @can('isVendor')
                <li class="group" title="Data Vendor" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/vendor-categories*') ? 'active' : '' }}{{ Request::is('marketing/vendors*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M5 15.613c0-.788.061-1.243.992-1.458 1.074-.249 2.075-.466 1.591-1.381-1.476-2.785-.392-4.274 1.166-4.274 1.054 0 1.874.681 1.874 1.936 0 2.907-1.605 1.551-1.623 5.564v1h-4v-1.387zm14 1.387h-9v-1c0-1.373-.11-2.129 1.322-2.46 1.433-.331 2.27-.621 1.623-1.841-1.966-3.713-.521-5.699 1.555-5.699 2.117 0 3.527 2.062 1.556 5.699-.666 1.227.218 1.518 1.621 1.841 1.411.326 1.323 1.067 1.323 2.46v1zm-6 4.949v-2.949h-2v2.949c-4.717-.472-8.479-4.232-8.949-8.949h2.949v-2h-2.949c.47-4.718 4.232-8.479 8.949-8.95v2.95h2v-2.95c4.717.471 8.479 4.232 8.949 8.95h-2.949v2h2.949c-.47 4.717-4.232 8.477-8.949 8.949zm-1-21.949c-6.627 0-12 5.372-12 12 0 6.627 5.373 12 12 12s12-5.373 12-12c0-6.628-5.373-12-12-12z" />
                        </svg>
                        <span class="flex w-36"> DATA VENDOR </span>
                        <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Vendor Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/vendor-categories*') ? 'active' : '' }}"
                                href="/marketing/vendor-categories">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> KATAGORI VENDOR </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/vendors*') ? 'active' : '' }}"
                                href="/marketing/vendors">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> DAFTAR VENDOR </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Vendor End -->
                </li>
            @endcan
            <!-- Vendor end -->

            <!-- Clients Start -->
            @can('isClient')
                <li class="group" title="Data Klien" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/client-categories*') ? 'active' : '' }}{{ Request::is('marketing/clients*') ? 'active' : '' }}{{ Request::is('marketing/client-groups*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M7 16.488l1.526-.723c1.792-.81 2.851-.344 4.349.232 1.716.661 2.365.883 3.077 1.164 1.278.506.688 2.177-.592 1.838-.778-.206-2.812-.795-3.38-.931-.64-.154-.93.602-.323.818 1.106.393 2.663.79 3.494 1.007.831.218 1.295-.145 1.881-.611.906-.72 2.968-2.909 2.968-2.909.842-.799 1.991-.135 1.991.72 0 .23-.083.474-.276.707-2.328 2.793-3.06 3.642-4.568 5.226-.623.655-1.342.974-2.204.974-.442 0-.922-.084-1.443-.25-1.825-.581-4.172-1.313-6.5-1.6v-5.662zm-1 6.538h-4v-8h4v8zm1-7.869v-1.714c-.006-1.557.062-2.447 1.854-2.861 1.963-.453 4.315-.859 3.384-2.577-2.761-5.092-.787-7.979 2.177-7.979 2.907 0 4.93 2.78 2.177 7.979-.904 1.708 1.378 2.114 3.384 2.577 1.799.415 1.859 1.311 1.853 2.879 0 .13-.011 1.171 0 1.665-.483-.309-1.442-.552-2.187.106-.535.472-.568.504-1.783 1.629-1.75-.831-4.456-1.883-6.214-2.478-.896-.304-2.04-.308-2.962.075l-1.683.699z" />
                        </svg>
                        <span class="flex w-36"> DATA KLIEN </span>
                        <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Clients Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/client-categories*') ? 'active' : '' }}"
                                href="/marketing/client-categories">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> KATAGORI KLIEN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/clients*') ? 'active' : '' }}"
                                href="/marketing/clients">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> DAFTAR KLIEN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/client-groups*') ? 'active' : '' }}"
                                href="/marketing/client-groups">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> GROUP KLIEN </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Clients End -->
                </li>
            @endcan
            <!-- Clients end -->

            <!-- Penawaran Start -->
            @can('isQuotation')
                <li id="penawaran" title="Penawaran" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/quotations*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 0l-6 22-8.129-7.239 7.802-8.234-10.458 7.227-7.215-1.754 24-12zm-15 16.668v7.332l3.258-4.431-3.258-2.901z" />
                        </svg>
                        <span class="flex w-36"> PENAWARAN </span>
                        <svg id="penawaranArrow" name="penawaranArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Penawaran Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/quotations/home/All*') ? 'active' : '' }}"
                                href="/marketing/quotations/home/All/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Semua Katagori </span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            @if ($category->name == 'Service')
                                <li class="group">
                                    <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/quotations/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex w-40"> Cetak & Pasang </span>
                                    </a>
                                </li>
                            @else
                                <li class="group">
                                    <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/quotations/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/quotations/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex w-40"> {{ $category->name }} </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Child Penawaran End -->
                </li>
            @endcan
            <!-- Penawaran end -->

            <!-- Penjualan start -->
            @can('isSale')
                <li id="penjualan" title="Penjualan" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/sales*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill-rule="evenodd" clip-rule="evenodd">
                            <path
                                d="M12.628 21.412l5.969-5.97 1.458 3.71-12.34 4.848-4.808-12.238 9.721 9.65zm-1.276-21.412h-9.352v9.453l10.625 10.547 9.375-9.375-10.648-10.625zm4.025 9.476c-.415-.415-.865-.617-1.378-.617-.578 0-1.227.241-2.171.804-.682.41-1.118.584-1.456.584-.361 0-1.083-.408-.961-1.218.052-.345.25-.697.572-1.02.652-.651 1.544-.848 2.276-.106l.744-.744c-.476-.476-1.096-.792-1.761-.792-.566 0-1.125.227-1.663.677l-.626-.627-.698.699.653.652c-.569.826-.842 2.021.076 2.938 1.011 1.011 2.188.541 3.413-.232.6-.379 1.083-.563 1.475-.563.589 0 1.18.498 1.078 1.258-.052.386-.26.763-.621 1.122-.451.451-.904.679-1.347.679-.418 0-.747-.192-1.049-.462l-.739.739c.463.458 1.082.753 1.735.753.544 0 1.087-.201 1.612-.597l.54.538.697-.697-.52-.521c.743-.896 1.157-2.209.119-3.247zm-9.678-7.476c.938 0 1.699.761 1.699 1.699 0 .938-.761 1.699-1.699 1.699-.938 0-1.699-.761-1.699-1.699 0-.938.761-1.699 1.699-1.699z" />
                        </svg>
                        <span class="flex w-36"> PENJUALAN </span>
                        <svg id="penjualanArrow" name="penjualanArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <!-- Penjualan Child Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/sales/home/All*') ? 'active' : '' }}"
                                href="/marketing/sales/home/All/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Semua Katagori </span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            @if ($category->name == 'Service')
                                <li class="group">
                                    <a class="nav-a ml-5 border-b-[1px] {{ Request::is('marketing/sales/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex w-40"> Cetak & Pasang </span>
                                    </a>
                                </li>
                            @else
                                <li class="group">
                                    <a class="nav-a ml-5 {{ Request::is('marketing/sales/home/' . $category->name . '*') ? 'active' : '' }}"
                                        href="/marketing/sales/home/{{ $category->name }}/{{ $company->id }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd"
                                            fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex w-40"> {{ $category->name }} </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Penjualan Child End -->
                </li>
            @endcan
            <!-- Penjualan end -->

            <!-- SPK start -->
            @can('isOrder')
                <li id="materi" title="SPK" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/print-orders*') ? 'active' : '' }}{{ Request::is('marketing/install-orders*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m6 18v3c0 .621.52 1 1 1h14c.478 0 1-.379 1-1v-14c0-.478-.379-1-1-1h-3v-3c0-.478-.379-1-1-1h-14c-.62 0-1 .519-1 1v14c0 .621.52 1 1 1zm10.5-12h-9.5c-.62 0-1 .519-1 1v9.5h-2.5v-13h13z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="flex w-36"> SPK </span>
                        <svg id="materiArrow" name="materiArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <!-- Penggantian Materi Child Start -->
                    <ul class="hidden" id="materiChild" name="materiChild">
                        <li class="group">
                            <a class="nav-a ml-5 {{ Request::is('marketing/print-orders*') ? 'active' : '' }}"
                                href="/print-orders/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> SPK Cetak </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 {{ Request::is('marketing/install-orders*') ? 'active' : '' }}"
                                href="/install-orders/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> SPK Pasang </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Penggantian Materi Child End -->
                </li>
            @endcan
            <!-- SPK end -->

            <!-- Quotation Reports start -->
            @can('isQuotationReport')
                <li id="quotReport" title="Lap. Penawaran" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/quotations-report*') ? 'active' : '' }}"
                        href="/marketing/quotations-report/{{ $company->id }}">
                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                        </svg>
                        <span class="flex w-36"> LAP. PENAWARAN </span>
                        <svg id="quotReportArrow" name="quotReportArrow"
                            class="hidden rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                </li>
            @endcan
            <!-- Quotation Reports end -->

            <!-- Sales Reports start -->
            @can('isSaleReport')
                <li id="saleReports" title="Lap. Penjualan" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/sales-report*') ? 'active' : '' }}"
                        href="/marketing/sales-report/{{ $company->id }}">
                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                        </svg>
                        <span class="flex w-36"> LAP. PENJUALAN </span>
                        <svg id="saleReportsArrow" name="saleReportsArrow"
                            class="hidden rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                </li>
            @endcan
            <!-- Sales Reports end -->

            <!-- SPK Reports start -->
            @can('isOrderReport')
                <li id="spkReports" title="Lap. SPK" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('marketing/orders-report*') ? 'active' : '' }}"
                        href="/marketing/orders-report/{{ $company->id }}">
                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22 13v-13h-20v24h8.409c4.857 0 3.335-8 3.335-8 3.009.745 8.256.419 8.256-3zm-4-7h-12v-1h12v1zm0 3h-12v-1h12v1zm0 3h-12v-1h12v1zm-2.091 6.223c2.047.478 4.805-.279 6.091-1.179-1.494 1.998-5.23 5.708-7.432 6.881 1.156-1.168 1.563-4.234 1.341-5.702z" />
                        </svg>
                        <span class="flex w-36"> LAP. SPK </span>
                        <svg id="spkReportsArrow" name="spkReportsArrow"
                            class="hidden rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                </li>
            @endcan
            <!-- SPK Reports end -->

            <!-- Setting Start -->
            @can('isMarketingSetting')
                <li class="group" title="Pengaturan" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 {{ Request::is('marketing/printing-products*') ? 'active' : '' }}{{ Request::is('marketing/printing-prices*') ? 'active' : '' }}{{ Request::is('marketing/installation-prices*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 13.616v-3.232c-1.651-.587-2.693-.752-3.219-2.019v-.001c-.527-1.271.1-2.134.847-3.707l-2.285-2.285c-1.561.742-2.433 1.375-3.707.847h-.001c-1.269-.526-1.435-1.576-2.019-3.219h-3.232c-.582 1.635-.749 2.692-2.019 3.219h-.001c-1.271.528-2.132-.098-3.707-.847l-2.285 2.285c.745 1.568 1.375 2.434.847 3.707-.527 1.271-1.584 1.438-3.219 2.02v3.232c1.632.58 2.692.749 3.219 2.019.53 1.282-.114 2.166-.847 3.707l2.285 2.286c1.562-.743 2.434-1.375 3.707-.847h.001c1.27.526 1.436 1.579 2.019 3.219h3.232c.582-1.636.749-2.69 2.027-3.222h.001c1.262-.524 2.12.101 3.698.851l2.285-2.286c-.743-1.563-1.375-2.433-.848-3.706.527-1.271 1.588-1.44 3.221-2.021zm-12 3.384c-2.762 0-5-2.239-5-5s2.238-5 5-5 5 2.239 5 5-2.238 5-5 5zm3-5c0 1.654-1.346 3-3 3s-3-1.346-3-3 1.346-3 3-3 3 1.346 3 3z" />
                        </svg>
                        <span class="flex w-36"> PENGATURAN </span>
                        <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Setting Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 {{ Request::is('marketing/printing-products*') ? 'active' : '' }}"
                                href="/marketing/printing-products">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> BAHAN CETAK </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 {{ Request::is('marketing/printing-prices*') ? 'active' : '' }}"
                                href="/marketing/printing-prices">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> HARGA VENDOR </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 {{ Request::is('marketing/installation-prices*') ? 'active' : '' }}"
                                href="/marketing/installation-prices">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> HARGA PASANG </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Setting End -->
                </li>
            @endcan
            <!-- Setting end -->
        </ul>
        <!-- Child Marketing End -->
    </li>
</div>
