<div class="div-nav-a">
    <a class="nav-a" href="">
        <svg role="img" class="nav-svg transition duration-300 ease-in-out" viewBox="0 0 24 24"
            xmlns="http://www.w3.org/2000/svg">
            <title>PRODUKSI</title>
            <path
                d="M23.268 10.541C23.268 4.715 18.544 0 12.728 0c-1.614 0-3.191.317-4.663.952a11.952 11.952 0 00-3.817 2.574 11.915 11.915 0 00-3.516 8.478 11.924 11.924 0 003.516 8.48 12.05 12.05 0 003.817 2.573c1.472.626 3.05.943 4.671.943 1.56 0 3.05-.3 4.416-.837l-.908-2.292a9.448 9.448 0 01-3.508.67 9.481 9.481 0 01-6.743-2.794A9.481 9.481 0 013.2 12.004c0-2.547.996-4.944 2.794-6.742a9.496 9.496 0 016.743-2.794 8.072 8.072 0 016.734 12.524l-2.098-5.165c-.308-.758-.679-1.895-2.071-1.895-1.393 0-1.763 1.146-2.063 1.895l-1.93 4.769-2.591-6.54H5.993l3.226 7.95c.326.802.688 1.895 2.09 1.895 1.4 0 1.753-1.093 2.08-1.895l1.912-4.724 1.921 4.724c.388.978.802 1.895 2.08 1.895.908 0 1.481-.582 1.798-.96a10.493 10.493 0 002.168-6.4Z" />
        </svg>
    </a>
    <li id="liWorkshop" name="liWorkshop" class="group hidden" onclick="showHideDropdown(this)">
        <a href="#" class="nav-a mx-2 {{ Request::is('dashboard/workshop*') ? 'active' : '' }}">
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
        <ul id="workshopChild" name="workshopChild" class="hidden">
            <li id="monitoring" name="monitoring" class="group" onclick="childMenu(event,this)">
                <a class="nav-a ml-2 border-b-[1px]" href="#">
                    <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M7 10h-4.083l1.271-1.396.812.396.676-.862 1.324 1.862zm.88 3h-7.88v-8h9.204c.739 1.612 2.024 1.696 3.796 2.509v4.648c-1.638-.182-3.985-.26-5.12.843zm.12-6h-6v4h6v-4zm9.17-1.833c-.806-1.165-5.031-1.924-6.742-2.167-.169.727.111 1.643.859 2.076.729.422 2.847 1.078 3.473 1.702.812.808 2.026 4.668.028 7.282-2.076-.589-4.24-.527-5.415-.048-1.153.47-1.013 1.908.189 2.045 3.42.39 7.587 1.161 10.322 4.943 0 0 1.821-1.885 4.115-4.426-3.668-3.053-4.198-7.606-6.829-11.407zm-13.92 2.833c-.138 0-.25.112-.25.25s.112.25.25.25c.139 0 .25-.112.25-.25s-.111-.25-.25-.25z" />
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
                        <a class="nav-a ml-5 border-b-[1px]" href="#">
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
                            <span class="flex w-40"> Lap. Pemantauan</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li id="gambar" name="gambar" class="group" onclick="childMenu(event,this)">
                <a class="nav-a ml-2 border-b-[1px]" href="#">
                    <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
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
                        <a class="nav-a ml-5 border-b-[1px]" href="#">
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
                            <span class="flex w-40"> Lap. Pemasangan</span>
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Workshop Child End -->
    </li>
</div>
