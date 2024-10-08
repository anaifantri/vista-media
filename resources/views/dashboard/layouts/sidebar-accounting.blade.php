<div class="div-nav-a">
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
                        <a class="nav-a ml-5 border-t-[1px]" href="#">
                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M9 19h-4v-2h4v2zm2.946-4.036l3.107 3.105-4.112.931 1.005-4.036zm12.054-5.839l-7.898 7.996-3.202-3.202 7.898-7.995 3.202 3.201zm-6 8.92v3.955h-16v-20h7.362c4.156 0 2.638 6 2.638 6s2.313-.635 4.067-.133l1.952-1.976c-2.214-2.807-5.762-5.891-7.83-5.891h-10.189v24h20v-7.98l-2 2.025z" />
                            </svg>
                            <span class="flex w-40"> Invoice </span></a>
                    </li>
                    <!-- Invoice End -->
                    <!-- Kwitansi Start -->
                    <li class="group">
                        <a class="nav-a ml-5" href="#">
                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
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
                            <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
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
                    <svg id="ppnArrow" name="ppnArrow" class="svg-arrow rotate-180 transition duration-300 ease-in-out"
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
                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                            </svg>
                            <span class="flex w-40"> Up. Faktur PPn </span>
                        </a>
                    </li>
                    <li class="group">
                        <a class="nav-a ml-5" href="#">
                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12.324 7.021l.154.345c.237-.041.52-.055.847-.025l.133.577c-.257-.032-.53-.062-.771-.012l-.092.023c-.464.123-.316.565.098.672.682.158 1.494.208 1.815.922.258.578-.041.973-.541 1.163l.154.346-.325.068-.147-.329c-.338.061-.725.053-1.08-.041l-.1-.584c.294.046.658.087.938.03l.186-.06c.333-.165.231-.582-.264-.681-.367-.083-1.342-.021-1.705-.831-.205-.458-.053-.936.535-1.154l-.161-.361.326-.068m3.82 1.614c-.706-1.648-2.681-2.751-4.409-2.463-1.728.288-2.557 1.857-1.85 3.506.746 1.739 2.888 2.853 4.651 2.414 1.562-.388 2.28-1.887 1.608-3.457zm4.05-5.635l3.766 8.233c-5.433 4.223-12.654-.038-17.951 4.461l-3.766-8.233c4.944-4.779 11.773-.45 17.951-4.461zm3.806 12.014c-6.857 3.939-12.399-1.424-19.5 5.986l-4.5-9.964 1.402-1.462 3.807 8.401-.002.008c7.445-5.592 11.195-1.175 18.109-4.561.294.647.565 1.33.684 1.592z" />
                            </svg>
                            <span class="flex w-40"> Pembayaran PPn </span>
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
                    <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
                        fill-rule="evenodd" clip-rule="evenodd">
                        <path
                            d="M21.19 7h2.81v15h-21v-5h-2.81v-15h21v5zm1.81 1h-19v13h19v-13zm-9.5 1c3.036 0 5.5 2.464 5.5 5.5s-2.464 5.5-5.5 5.5-5.5-2.464-5.5-5.5 2.464-5.5 5.5-5.5zm0 1c2.484 0 4.5 2.016 4.5 4.5s-2.016 4.5-4.5 4.5-4.5-2.016-4.5-4.5 2.016-4.5 4.5-4.5zm.5 8h-1v-.804c-.767-.16-1.478-.689-1.478-1.704h1.022c0 .591.326.886.978.886.817 0 1.327-.915-.167-1.439-.768-.27-1.68-.676-1.68-1.693 0-.796.573-1.297 1.325-1.448v-.798h1v.806c.704.161 1.313.673 1.313 1.598h-1.018c0-.788-.727-.776-.815-.776-.55 0-.787.291-.787.622 0 .247.134.497.957.768 1.056.344 1.663.845 1.663 1.746 0 .651-.376 1.288-1.313 1.448v.788zm6.19-11v-4h-19v13h1.81v-9h17.19z" />
                    </svg>
                    <span class="flex w-36"> FAKTUR PPH </span>
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
                        <a class="nav-a ml-5 border-t-[1px]" href="#">
                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path d="M10 9h-6l8-9 8 9h-6v11h-4v-11zm11 11v2h-18v-2h-2v4h22v-4h-2z" />
                            </svg>
                            <span class="flex w-40"> Up. Faktur PPh </span>
                        </a>
                    </li>
                    <li class="group">
                        <a class="nav-a ml-5" href="#">
                            <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12.324 7.021l.154.345c.237-.041.52-.055.847-.025l.133.577c-.257-.032-.53-.062-.771-.012l-.092.023c-.464.123-.316.565.098.672.682.158 1.494.208 1.815.922.258.578-.041.973-.541 1.163l.154.346-.325.068-.147-.329c-.338.061-.725.053-1.08-.041l-.1-.584c.294.046.658.087.938.03l.186-.06c.333-.165.231-.582-.264-.681-.367-.083-1.342-.021-1.705-.831-.205-.458-.053-.936.535-1.154l-.161-.361.326-.068m3.82 1.614c-.706-1.648-2.681-2.751-4.409-2.463-1.728.288-2.557 1.857-1.85 3.506.746 1.739 2.888 2.853 4.651 2.414 1.562-.388 2.28-1.887 1.608-3.457zm4.05-5.635l3.766 8.233c-5.433 4.223-12.654-.038-17.951 4.461l-3.766-8.233c4.944-4.779 11.773-.45 17.951-4.461zm3.806 12.014c-6.857 3.939-12.399-1.424-19.5 5.986l-4.5-9.964 1.402-1.462 3.807 8.401-.002.008c7.445-5.592 11.195-1.175 18.109-4.561.294.647.565 1.33.684 1.592z" />
                            </svg>
                            <span class="flex w-40"> Pembayaran PPh </span>
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
