<div class="div-nav-a" title="Data Keuangan">
    <a class="nav-a" href="">
        <svg role="img" class="nav-svg transition duration-300 ease-in-out" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <title>KEUANGAN</title>
            <path
                d="M6.898.437S7.87.534 8.26 1.505c0 0 1.069 2.526 2.04 4.955 1.42 3.33 3.22 7.615 4.67 11.078H1.167c-.778 0-1.166-.486-1.166-.486.777 1.36 3.012 5.636 3.012 5.636.388.486.777.776 1.36.776 1.264 0 3.208-1.262 3.208-1.262l7.409-4.619c1.412 3.372 2.5 5.98 2.5 5.98H24c.097-.097-9.327-22.446-9.424-22.544-.097-.097-.292-.582-.972-.582zm-.29.875c-.583 0-.778.485-.875.582L.39 14.526c-.291.874-.097 1.943 1.458 1.943h4.177l3.693-8.841A453.32 453.32 0 0 0 7.58 2.38c-.097-.291-.389-1.068-.972-1.068z" />
        </svg>
    </a>
    <li id="liAccounting" name="liAccounting" class="group hidden" onclick="showHideDropdown(this)">
        <a href="#" class="nav-a mx-2 {{ Request::is('dashboard/accounting*') ? 'active' : '' }}">
            <span class="flex w-40"> DATA KEUANGAN </span>
            <svg id="accountingArrow" name="accountingArrow"
                class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>Arrow</title>
                <path
                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
            </svg>
        </a>
        <!-- Accounting Child Start -->
        <ul id="accountingChild" class="hidden">
            <!-- Penagihan Start -->
            @can('isCollect')
                <li id="penagihan" title="Penagihan" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px]" href="#">
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
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <!-- Child Penagihan start -->
                    <ul id="penagihanChild" name="penagihanChild" class="hidden">
                        <!-- Invoice Start -->
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-20h7.362c4.156 0 2.638 6 2.638 6s2.313-.635 4.067-.133l1.952-1.976c-2.214-2.807-5.762-5.891-7.83-5.891h-10.189v24h20v-7.98l-2 2.025z" />
                                </svg>
                                <span class="flex w-40"> BAST </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-20h7.362c4.156 0 2.638 6 2.638 6s2.313-.635 4.067-.133l1.952-1.976c-2.214-2.807-5.762-5.891-7.83-5.891h-10.189v24h20v-7.98l-2 2.025z" />
                                </svg>
                                <span class="flex w-40"> Invoice </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-20h7.362c4.156 0 2.638 6 2.638 6s2.313-.635 4.067-.133l1.952-1.976c-2.214-2.807-5.762-5.891-7.83-5.891h-10.189v24h20v-7.98l-2 2.025z" />
                                </svg>
                                <span class="flex w-40"> Surat Pengantar </span>
                            </a>
                        </li>
                        <!-- Invoice End -->
                        <!-- Laporan Penagihan Start -->
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/billings/report/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="flex w-40"> Laporan </span>
                            </a>
                            </a>
                        </li>
                        <!-- Laporan Penagihan End -->
                    </ul>
                    <!-- Child Penagihan end -->
                </li>
            @endcan
            <!-- Penagihan End -->
            <!-- Payment Start -->
            @can('isPayment')
                <li id="pembayaran" title="Pembayaran" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px]" href="#">
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
                        <span class="flex w-36"> PEMBAYARAN </span>
                        <svg id="penagihanArrow" name="penagihanArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <!-- Child Payment start -->
                    <ul id="paymentChild" name="paymentChild" class="hidden">
                        <!-- Invoice Start -->
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/payments/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-20h7.362c4.156 0 2.638 6 2.638 6s2.313-.635 4.067-.133l1.952-1.976c-2.214-2.807-5.762-5.891-7.83-5.891h-10.189v24h20v-7.98l-2 2.025z" />
                                </svg>
                                <span class="flex w-40"> Data Pembayaran </span></a>
                        </li>
                        <!-- Invoice End -->
                        <!-- Laporan Payment Start -->
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/payments/report/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="flex w-40"> Laporan </span>
                            </a>
                            </a>
                        </li>
                        <!-- Laporan Payment End -->
                    </ul>
                    <!-- Child Payment end -->
                </li>
            @endcan
            <!-- Payment End -->
            <!-- Faktur PPn start -->
            @can('isPPN')
                <li id="ppn" title="Faktur PPN" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px]" href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24"fill-rule="evenodd" clip-rule="evenodd">
                            <path
                                d="M4.82 19.407c-2.966-1.857-4.94-5.153-4.94-8.907 0-5.795 4.705-10.5 10.5-10.5 3.605 0 6.789 1.821 8.68 4.593 2.966 1.857 4.94 5.153 4.94 8.907 0 5.795-4.705 10.5-10.5 10.5-3.599 0-6.778-1.815-8.67-4.579l-.01-.014zm8.68-15.407c5.243 0 9.5 4.257 9.5 9.5s-4.257 9.5-9.5 9.5-9.5-4.257-9.5-9.5 4.257-9.5 9.5-9.5zm.5 15h-1.021v-.871c-2.343-.302-2.599-2.179-2.599-2.744h1.091c.025.405.157 1.774 2.182 1.774.599 0 1.088-.141 1.453-.419.361-.276.536-.612.536-1.029 0-.793-.513-1.367-2.07-1.718-2.368-.536-2.923-1.398-2.923-2.533 0-1.509 1.223-2.216 2.33-2.406v-1.054h1.021v1.015c2.491.195 2.695 2.215 2.695 2.771h-1.098c0-1.161-.918-1.766-1.996-1.766-1.077 0-1.854.532-1.854 1.408 0 .781.439 1.165 1.994 1.554 1.879.473 2.999 1.101 2.999 2.681 0 1.744-1.509 2.393-2.74 2.493v.844zm2.85-15.453c-1.696-1.58-3.971-2.547-6.47-2.547-5.243 0-9.5 4.257-9.5 9.5 0 2.633 1.073 5.017 2.806 6.739l-.004-.01c-.44-1.159-.682-2.416-.682-3.729 0-5.795 4.705-10.5 10.5-10.5 1.171 0 2.298.192 3.35.547z" />
                        </svg>
                        <span class="flex w-36"> PPN </span>
                        <svg id="ppnArrow" name="ppnArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <!-- Child Faktur PPn start -->
                    <ul id="ppnChild" name="ppnChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/vat-tax-invoices/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                </svg>
                                <span class="flex w-40"> Data PPN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="flex w-40"> Laporan</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Faktur PPn end -->
                </li>
            @endcan
            <!-- Faktur PPn end -->
            <!-- Faktur PPh start -->
            @can('isPPh')
                <li id="pph" title="Faktur PPh" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px]" href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                            fill-rule="evenodd" clip-rule="evenodd">
                            <path
                                d="M21.19 7h2.81v15h-21v-5h-2.81v-15h21v5zm1.81 1h-19v13h19v-13zm-9.5 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5zm0 1c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm.5 8h-1v-.804c-.767-.16-1.478-.689-1.478-1.704h1.022c0 .591.326.886.978.886.817 0 1.327-.915-.167-1.439-.768-.27-1.68-.676-1.68-1.693 0-.796.573-1.297 1.325-1.448v-.798h1v.806c.704.161 1.313.673 1.313 1.598h-1.018c0-.788-.727-.776-.815-.776-.55 0-.787.291-.787.622 0 .247.134.497.957.768 1.056.344 1.663.845 1.663 1.746 0 .651-.376 1.288-1.313 1.448v.788zm6.19-11v-4h-19v13h1.81v-9h17.19z" />
                        </svg>
                        <span class="flex w-36"> PPH </span>
                        <svg id="pphArrow" name="pphArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <!-- Child Faktur PPh start -->
                    <ul id="pphChild" name="pphChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/income-taxes/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                </svg>
                                <span class="flex w-40"> Data PPh </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="flex w-40"> Laporan</span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Faktur PPh end -->
                </li>
            @endcan
            <!-- Faktur PPh end -->
        </ul>
        <!-- Accounting Child End -->
    </li>
</div>
