<div class="div-nav-a" title="Data Media">
    <a class="nav-a" href="/media">
        <svg class="nav-svg transition duration-300 ease-in-out {{ Request::is('media*') ? 'active' : '' }}"
            role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <title>DATA MEDIA</title>
            <path
                d="M8.051 5.238c-1.328 1.566-2.186 3.883-2.246 6.48v.564c.061 2.598.918 4.912 2.246 6.479 1.721 2.236 4.279 3.654 7.139 3.654 1.756 0 3.4-.537 4.807-1.471C17.879 22.846 15.074 24 12 24c-.192 0-.383-.004-.57-.014C5.064 23.689 0 18.436 0 12 0 5.371 5.373 0 12 0h.045c3.055.012 5.84 1.166 7.953 3.055-1.408-.93-3.051-1.471-4.81-1.471-2.858 0-5.417 1.42-7.14 3.654h.003zM24 12c0 3.556-1.545 6.748-4.002 8.945-3.078 1.5-5.946.451-6.896-.205 3.023-.664 5.307-4.32 5.307-8.74 0-4.422-2.283-8.075-5.307-8.74.949-.654 3.818-1.703 6.896-.205C22.455 5.25 24 8.445 24 12z" />
        </svg>
    </a>

    <li class="group hidden" id="liMedia" name="liMedia" onclick="showHideDropdown(this)">
        <a href="#" class="nav-a mx-2 {{ Request::is('media*') ? 'active' : '' }}">
            <span class="flex w-40"> DATA MEDIA </span>
            <svg id="mediaArrow" name="mediaArrow" class="svg-arrow rotate-180 transition duration-300 ease-in-out"
                role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <title>Arrow</title>
                <path
                    d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
            </svg>
        </a>

        <!-- Child Media OOH start-->
        <ul class="hidden" id="mediaChild">
            <!-- Data Lokasi Start -->
            @can('isLocation')
                <li class="group" title="Data Lokasi" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('media/locations*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-3.148 0-6 2.553-6 5.702 0 3.148 2.602 6.907 6 12.298 3.398-5.391 6-9.15 6-12.298 0-3.149-2.851-5.702-6-5.702zm0 8c-1.105 0-2-.895-2-2s.895-2 2-2 2 .895 2 2-.895 2-2 2zm10.881-2.501c0-1.492-.739-2.83-1.902-3.748l.741-.752c1.395 1.101 2.28 2.706 2.28 4.5s-.885 3.4-2.28 4.501l-.741-.753c1.163-.917 1.902-2.256 1.902-3.748zm-3.381 2.249l.74.751c.931-.733 1.521-1.804 1.521-3 0-1.195-.59-2.267-1.521-3l-.74.751c.697.551 1.141 1.354 1.141 2.249s-.444 1.699-1.141 2.249zm-16.479 1.499l-.741.753c-1.395-1.101-2.28-2.707-2.28-4.501s.885-3.399 2.28-4.5l.741.752c-1.163.918-1.902 2.256-1.902 3.748s.739 2.831 1.902 3.748zm.338-3.748c0-.896.443-1.698 1.141-2.249l-.74-.751c-.931.733-1.521 1.805-1.521 3 0 1.196.59 2.267 1.521 3l.74-.751c-.697-.55-1.141-1.353-1.141-2.249zm16.641 14.501c0 2.209-3.581 4-8 4s-8-1.791-8-4c0-1.602 1.888-2.98 4.608-3.619l1.154 1.824c-.401.068-.806.135-1.178.242-3.312.949-3.453 2.109-.021 3.102 2.088.603 4.777.605 6.874-.001 3.619-1.047 3.164-2.275-.268-3.167-.296-.077-.621-.118-.936-.171l1.156-1.828c2.723.638 4.611 2.016 4.611 3.618z" />
                        </svg>
                        <span class="flex w-36"> DATA LOKASI </span>
                        <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Data Lokasi Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px]" href="/media/locations/home/All">
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
                            @if ($category->name != 'Service')
                                <li class="group">
                                    <a class="nav-a ml-5 border-b-[1px]" href="/media/locations/home/{{ $category->name }}">
                                        <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                        </svg>
                                        <span class="flex w-40"> {{ $category->name }} </span>
                                    </a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <!-- Child Data Lokasi End -->
                </li>
            @endcan
            <!-- Data Lokasi end -->

            <!-- Area Start -->
            @can('isArea')
                <li class="group" title="Data Area" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('media/area*') ? 'active' : '' }}{{ Request::is('media/cities*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M18.305 20.418c-.992.615-2.16.97-3.411.97-3.588 0-6.5-2.919-6.5-6.514s2.912-6.513 6.5-6.513c3.587 0 6.5 2.918 6.5 6.513 0 1.254-.354 2.425-.967 3.419l3.573 3.58-2.121 2.126-3.574-3.581zm-8.904-.436c-3.216-.19-6.025-1.903-7.716-4.427l4.349-2.511c.38.493.849.914 1.383 1.237-.015.197-.023.396-.023.596 0 1.972.762 3.766 2.007 5.105zm5.493-9.592c2.484 0 4.5 2.02 4.5 4.509 0 2.489-2.016 4.509-4.5 4.509s-4.5-2.02-4.5-4.509c0-2.489 2.016-4.509 4.5-4.509zm-1.5 6.989h-1v-2.004h1v2.004zm2 0h-1v-3.006h1v3.006zm2 0h-1v-4.96h1v4.96zm-7.894-17.367v5.013c-2.525.251-4.5 2.384-4.5 4.975 0 .787.182 1.531.507 2.194l-4.336 2.503c-.747-1.401-1.171-3-1.171-4.697 0-5.351 4.213-9.727 9.5-9.988zm4.772 7.391c-.796-1.306-2.174-2.219-3.772-2.378v-5.013c5.077.251 9.164 4.296 9.48 9.356-1.337-1.236-3.124-1.991-5.086-1.991-.209 0-.417.009-.622.026z" />
                        </svg>
                        <span class="flex w-36"> DATA AREA </span>
                        <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Area Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/area*') ? 'active' : '' }}"
                                href="/media/area">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Area </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/cities*') ? 'active' : '' }}"
                                href="/media/cities">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> Kota </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Area End -->
                </li>
            @endcan
            <!-- Area end -->

            <!-- Media Legality Start -->
            @can('isLegal')
                <li class="group" title="Data Legalitas" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('media/licensing-categories*') ? 'active' : '' }}{{ Request::is('media/licenses*') ? 'active' : '' }}{{ Request::is('media/land-agreements*') ? 'active' : '' }}"
                        href="#">
                        <svg class="child-nav-svg" role="img" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M7 22v-16h14v7.543c0 4.107-6 2.457-6 2.457s1.518 6-2.638 6h-5.362zm16-7.614v-10.386h-18v20h8.189c3.163 0 9.811-7.223 9.811-9.614zm-10 1.614h-4v-1h4v1zm6-4h-10v1h10v-1zm0-3h-10v1h10v-1zm1-7h-17v19h-2v-21h19v2z" />
                        </svg>
                        <span class="flex w-36"> DATA LEGALITAS </span>
                        <svg class="svg-arrow rotate-180 transition duration-300 ease-in-out" role="img"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <title>Arrow</title>
                            <path
                                d="M12.468.186a.7.7 0 0 0-.95 0L1.924 9.193a1.705 1.705 0 0 0-.475 1.095v3.59c0 .358.214.452.475.207l9.601-9.01a.705.705 0 0 1 .95 0l9.603 9.01c.262.245.475.151.475-.207v-3.59a1.71 1.71 0 0 0-.475-1.095zm0 9.783a.705.705 0 0 0-.95 0l-9.595 9.002a1.705 1.705 0 0 0-.475 1.094v3.59c0 .358.214.453.475.208l9.601-9.007a.701.701 0 0 1 .95 0l9.603 9.008c.262.244.475.15.475-.208v-3.59a1.71 1.71 0 0 0-.475-1.094Z" />
                        </svg>
                    </a>

                    <!-- Child Media Legality Start -->
                    <ul class="hidden">
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/licensing-categories*') ? 'active' : '' }}"
                                href="/media/licensing-categories">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> KATAGORI IZIN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/licenses*') ? 'active' : '' }}"
                                href="/media/licenses">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> DAFTAR IZIN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/land-agreements*') ? 'active' : '' }}"
                                href="/media/land-agreements">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> SEWA LAHAN </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Media Legality End -->
                </li>
            @endcan
            <!-- Media Legality end -->

            <!-- Setting Start -->
            @can('isMediaSetting')
                <li class="group" title="Pengaturan" onclick="childMenu(event,this)">
                    <a class="nav-a ml-2 border-b-[1px] {{ Request::is('media/companies*') ? 'active' : '' }}{{ Request::is('media/media-categories*') ? 'active' : '' }}{{ Request::is('media/media-sizes*') ? 'active' : '' }}{{ Request::is('media/leds*') ? 'active' : '' }}"
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
                        @can('isAdmin')
                            <li class="group">
                                <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/companies*') ? 'active' : '' }}"
                                    href="/media/companies">
                                    <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                    </svg>
                                    <span class="flex w-40"> PERUSAHAAN </span>
                                </a>
                            </li>
                        @endcan
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/media-categories*') ? 'active' : '' }}"
                                href="/media/media-categories">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> KATAGORI MEDIA </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/media-sizes*') ? 'active' : '' }}"
                                href="/media/media-sizes">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> UKURAN </span>
                            </a>
                        </li>
                        <li class="group">
                            <a class="nav-a ml-5 border-b-[1px] {{ Request::is('media/leds*') ? 'active' : '' }}"
                                href="/media/leds">
                                <svg class="child-nav-svg" role="img" clip-rule="evenodd" fill-rule="evenodd"
                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m10.211 7.155c-.141-.108-.3-.157-.456-.157-.389 0-.755.306-.755.749v8.501c0 .445.367.75.755.75.157 0 .316-.05.457-.159 1.554-1.203 4.199-3.252 5.498-4.258.184-.142.29-.36.29-.592 0-.23-.107-.449-.291-.591-1.299-1.002-3.945-3.044-5.498-4.243z" />
                                </svg>
                                <span class="flex w-40"> JENIS LED </span>
                            </a>
                        </li>
                    </ul>
                    <!-- Child Setting End -->
                </li>
            @endcan
            <!-- Setting end -->
        </ul>
        <!-- Child Media OOH end-->
    </li>
</div>
