<div class="div-nav-a" title="Data Produksi">
    <a class="nav-a" href="">
        <svg role="img" class="nav-svg transition duration-300 ease-in-out" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <title>PRODUKSI</title>
            <path
                d="M23.268 10.541C23.268 4.715 18.544 0 12.728 0c-1.614 0-3.191.317-4.663.952a11.952 11.952 0 00-3.817 2.574 11.915 11.915 0 00-3.516 8.478 11.924 11.924 0 003.516 8.48 12.05 12.05 0 003.817 2.573c1.472.626 3.05.943 4.671.943 1.56 0 3.05-.3 4.416-.837l-.908-2.292a9.448 9.448 0 01-3.508.67 9.481 9.481 0 01-6.743-2.794A9.481 9.481 0 013.2 12.004c0-2.547.996-4.944 2.794-6.742a9.496 9.496 0 016.743-2.794 8.072 8.072 0 016.734 12.524l-2.098-5.165c-.308-.758-.679-1.895-2.071-1.895-1.393 0-1.763 1.146-2.063 1.895l-1.93 4.769-2.591-6.54H5.993l3.226 7.95c.326.802.688 1.895 2.09 1.895 1.4 0 1.753-1.093 2.08-1.895l1.912-4.724 1.921 4.724c.388.978.802 1.895 2.08 1.895.908 0 1.481-.582 1.798-.96a10.493 10.493 0 002.168-6.4Z" />
        </svg>
    </a>
    <li id="liWorkshop" name="liWorkshop" class="group hidden" onclick="showHideDropdown(this)">
        <a href="#" class="nav-a mx-2 {{ Request::is('workshop*') ? 'active' : '' }}">
            <span class="flex w-40"> DATA PRODUKSI </span>
            <svg id="workshopArrow" name="workshopArrow"
                class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg">
                <title>Arrow</title>
                <path
                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
            </svg>
        </a>
        <!-- Workshop Child Start -->
        <ul id="workshopChild" class="hidden">
            @can('isElectricity')
                <li id="electricity" title="Data Listrik" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('workshop/electrical-powers*') ? 'active' : '' }}{{ Request::is('workshop/electricity-top-ups*') ? 'active' : '' }}{{ Request::is('workshop/electricity-payments*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M0 18h21v-12h-21v12zm9.599-6.157v-2.843l6.401 4.686-4.408-1.296v2.61l-6.592-4.488 4.599 1.331zm14.401-1.593v3.5c0 .69-.56 1.25-1.25 1.25h-.75v-6h.75c.69 0 1.25.56 1.25 1.25z" />
                        </svg>
                        <span class="flex w-36"> DATA LISTRIK </span>
                        <svg id="electricityArrow" name="electricityArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <ul id="electricityChild" name="electricityChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/electrical-powers*') ? 'active' : '' }}"
                                href="/workshop/electrical-powers">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Daya Listrik </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/electricity-top-ups*') ? 'active' : '' }}"
                                href="/workshop/electricity-top-ups">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Pengisian Pulsa </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/electricity-payments*') ? 'active' : '' }}"
                                href="/workshop/electricity-payments">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Pembayaran Listrik </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/electricity-reports*') ? 'active' : '' }}"
                                href="/workshop/electricity-reports">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Laporan</span>
                            </a>
                        </li>
                    </ul>
                </li>
            @endcan
            @can('isComplaint')
                <li id="complaint" title="Komplain" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('workshop/monitorings*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M21.169 19.754c.522-.79.831-1.735.831-2.754 0-2.761-2.238-5-5-5s-5 2.239-5 5 2.238 5 5 5c1.019 0 1.964-.309 2.755-.832l2.831 2.832 1.414-1.414-2.831-2.832zm-4.169.246c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm-4.89 2h-7.11l2.599-3h2.696c.345 1.152.976 2.18 1.815 3zm-2.11-5h-10v-17h22v12.11c-.574-.586-1.251-1.068-2-1.425v-8.685h-18v13h8.295c-.19.634-.295 1.305-.295 2zm-2.131-4.372l.945-5.759.965 4.145c.096.425.686.473.847.063l.895-2.328.479.974c.08.169.164.277.438.277h1.208v-.877h-.921l-.836-1.624c-.156-.364-.677-.356-.82.014l-.741 1.895-1.144-5.062c-.052-.232-.242-.346-.43-.346-.2 0-.4.127-.44.373l-.948 5.847-.969-3.6c-.109-.43-.715-.455-.853-.029l-.721 2.545h-.823v.864h1.172c.16 0 .334-.13.38-.284l.406-1.257 1.043 4.206c.117.468.791.437.868-.037z" />
                        </svg>
                        <span class="flex w-36"> KOMPLAIN </span>
                        <svg id="complaintArrow" name="complaintArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <ul id="complaintChild" name="complaintChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/complaints*') ? 'active' : '' }}"
                                href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m2.179 10.201c.055-.298.393-.734.934-.59.377.102.612.476.543.86-.077.529-.141.853-.141 1.529 0 4.47 3.601 8.495 8.502 8.495 2.173 0 4.241-.84 5.792-2.284l-1.251-.341c-.399-.107-.636-.519-.53-.919.108-.4.52-.637.919-.53l3.225.864c.399.108.637.519.53.919l-.875 3.241c-.107.399-.519.636-.919.53-.399-.107-.638-.518-.53-.918l.477-1.77c-1.829 1.711-4.27 2.708-6.838 2.708-5.849 0-9.968-4.8-10.002-9.93-.003-.473.027-1.119.164-1.864zm9.839 6.293c-.552 0-1-.449-1-1 0-.552.448-1 1-1s1 .448 1 1c0 .551-.448 1-1 1zm9.833-2.693c-.054.298-.392.734-.933.59-.378-.102-.614-.476-.543-.86.068-.48.139-.848.139-1.53 0-4.479-3.609-8.495-8.5-8.495-2.173 0-4.241.841-5.794 2.285l1.251.341c.4.107.638.518.531.918-.108.4-.519.637-.919.53l-3.225-.864c-.4-.107-.637-.518-.53-.918l.875-3.241c.107-.4.518-.638.918-.531.4.108.638.518.531.919l-.478 1.769c1.83-1.711 4.272-2.708 6.839-2.708 5.865 0 10.002 4.83 10.002 9.995 0 .724-.081 1.356-.164 1.8zm-9.836-.307c.414 0 .75-.337.75-.75v-4.992c0-.414-.336-.75-.75-.75s-.75.336-.75.75v4.992c0 .413.336.75.75.75z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="flex w-40"> Data Komplain </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/complaints*') ? 'active' : '' }}"
                                href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m2.164 10.201c.055-.298.393-.734.934-.59.377.102.612.476.543.86-.077.529-.141.853-.141 1.529 0 4.47 3.601 8.495 8.502 8.495 2.173 0 4.241-.84 5.792-2.284l-1.251-.341c-.399-.107-.636-.519-.53-.919.108-.4.52-.637.919-.53l3.225.864c.399.108.637.519.53.919l-.875 3.241c-.107.399-.519.636-.919.53-.399-.107-.638-.518-.53-.918l.477-1.77c-1.829 1.711-4.27 2.708-6.838 2.708-5.849 0-9.968-4.8-10.002-9.93-.003-.473.027-1.119.164-1.864zm5.396 2.857 2.924 2.503c.142.128.321.19.499.19.202 0 .405-.081.552-.242l4.953-5.509c.131-.143.196-.323.196-.502 0-.41-.331-.747-.748-.747-.204 0-.405.082-.554.243l-4.453 4.962-2.371-2.011c-.144-.127-.321-.19-.499-.19-.415 0-.748.335-.748.746 0 .205.084.409.249.557zm14.276.743c-.054.298-.392.734-.933.59-.378-.102-.614-.476-.543-.86.068-.48.139-.848.139-1.53 0-4.479-3.609-8.495-8.5-8.495-2.173 0-4.241.841-5.794 2.285l1.251.341c.4.107.638.518.531.918-.108.4-.519.637-.919.53l-3.225-.864c-.4-.107-.637-.518-.53-.918l.875-3.241c.107-.4.518-.638.918-.531.4.108.638.518.531.919l-.478 1.769c1.83-1.711 4.272-2.708 6.839-2.708 5.865 0 10.002 4.83 10.002 9.995 0 .724-.081 1.356-.164 1.8z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="flex w-40"> Data Respons </span>
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
                </li>
            @endcan
            @can('isMonitoring')
                <li id="monitoring" title="Pemantauan" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('workshop/monitorings*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M21.169 19.754c.522-.79.831-1.735.831-2.754 0-2.761-2.238-5-5-5s-5 2.239-5 5 2.238 5 5 5c1.019 0 1.964-.309 2.755-.832l2.831 2.832 1.414-1.414-2.831-2.832zm-4.169.246c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3-1.346 3-3 3zm-4.89 2h-7.11l2.599-3h2.696c.345 1.152.976 2.18 1.815 3zm-2.11-5h-10v-17h22v12.11c-.574-.586-1.251-1.068-2-1.425v-8.685h-18v13h8.295c-.19.634-.295 1.305-.295 2zm-2.131-4.372l.945-5.759.965 4.145c.096.425.686.473.847.063l.895-2.328.479.974c.08.169.164.277.438.277h1.208v-.877h-.921l-.836-1.624c-.156-.364-.677-.356-.82.014l-.741 1.895-1.144-5.062c-.052-.232-.242-.346-.43-.346-.2 0-.4.127-.44.373l-.948 5.847-.969-3.6c-.109-.43-.715-.455-.853-.029l-.721 2.545h-.823v.864h1.172c.16 0 .334-.13.38-.284l.406-1.257 1.043 4.206c.117.468.791.437.868-.037z" />
                        </svg>
                        <span class="flex w-36"> PEMANTAUAN </span>
                        <svg id="monitoringArrow" name="monitoringArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <ul id="monitoringChild" name="monitoringChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('workshop/monitorings*') ? 'active' : '' }}"
                                href="/workshop/monitorings">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                </svg>
                                <span class="flex w-40"> Upload Foto </span>
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
                </li>
            @endcan
            @can('isDocumentation')
                <li id="gambar" title="Pemasangan" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px]" href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M9 12c0-.552.448-1 1.001-1s.999.448.999 1-.446 1-.999 1-1.001-.448-1.001-1zm6.2 0l-1.7 2.6-1.3-1.6-3.2 4h10l-3.8-5zm5.8-7v-2h-21v15h2v-13h19zm3 2v14h-20v-14h20zm-2 2h-16v10h16v-10z" />
                        </svg>
                        <span class="flex w-36"> PEMASANGAN </span>
                        <svg id="gambarArrow" name="gambarArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <ul id="gambarChild" name="gambarChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/installation-photos/index/{{ $company->id }}">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                </svg>
                                <span class="flex w-40"> Upload Foto </span>
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
                </li>
            @endcan
            @can('isContent')
                <li id="content" title="Konten" class="group" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px]" href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M9 12c0-.552.448-1 1.001-1s.999.448.999 1-.446 1-.999 1-1.001-.448-1.001-1zm6.2 0l-1.7 2.6-1.3-1.6-3.2 4h10l-3.8-5zm5.8-7v-2h-21v15h2v-13h19zm3 2v14h-20v-14h20zm-2 2h-16v10h16v-10z" />
                        </svg>
                        <span class="flex w-36"> KONTEN LED </span>
                        <svg id="contentArrow" name="contentArrow"
                            class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>
                    <ul id="contentChild" name="contentChild" class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                                </svg>
                                <span class="flex w-40"> Publish Content </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="#">
                                <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z" />
                                </svg>
                                <span class="flex w-40"> Take Out Content </span>
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
                </li>
            @endcan
        </ul>
        <!-- Workshop Child End -->
    </li>
</div>
