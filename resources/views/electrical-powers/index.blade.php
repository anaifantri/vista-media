@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des'];
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                <h1 class="index-h1">DAFTAR DAYA LISTRIK</h1>
                <!-- Title end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/electrical-powers/">
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-stone-100">Area</span>
                            <select class="w-full border rounded-lg text-base text-stone-900 outline-none" name="area"
                                id="area" onchange="submit()" value="{{ request('area') }}">
                                <option value="All">All</option>
                                @foreach ($areas as $area)
                                    @if (request('area') == $area->id)
                                        <option value="{{ $area->id }}" selected>{{ $area->area }}</option>
                                    @else
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        @if (request('area') && request('area') != 'All')
                            <div class="w-36 ml-2">
                                <span class="text-base text-stone-100">Kota</span>
                                <select id="city" name="city"
                                    class="flex text-base text-stone-900 w-full border rounded-lg px-1 outline-none"
                                    type="text" value="{{ request('city') }}" onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city'))
                                                @if (request('city') == $city->id)
                                                    <option value="{{ $city->id }}" selected>
                                                        {{ $city->city }}
                                                    </option>
                                                @else
                                                    <option value="{{ $city->id }}">
                                                        {{ $city->city }}
                                                    </option>
                                                @endif
                                            @else
                                                <option value="{{ $city->id }}">
                                                    {{ $city->city }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if (request('rbView') == 'locationView')
                            <div class="ml-2 w-36">
                                <span class="text-base text-stone-100">Katagori</span>
                                <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                    name="media_category_id" id="media_category_id" onchange="submit()"
                                    value="{{ request('media_category_id') }}">
                                    <option value="All">All</option>
                                    @foreach ($categories as $category)
                                        @if ($category->name != 'Service')
                                            @if (request('media_category_id') == $category->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->name }}
                                                </option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        <div class="ml-2 w-full">
                            <span class="text-base text-stone-100">Pencarian</span>
                            <div class="flex w-full">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg px-1 outline-none text-base text-stone-900"
                                    type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                    onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                <button class="flex border px-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
                                <div class="ml-2 flex w-full justify-end px-2">
                                    <span class="text-base text-stone-100">Pilih Tampilan</span>
                                    <span class="ml-2 text-base text-stone-100">:</span>
                                    @if (request('rbView'))
                                        @if (request('rbView') == 'electricalView')
                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                value="electricalView" onclick="submit()" checked>
                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                value="locationView" onclick="submit()">
                                            <span class="ml-2 text-base text-stone-100">Lokasi & Daya</span>
                                        @else
                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                value="electricalView" onclick="submit()">
                                            <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                            <input type="radio" name="rbView" class="ml-6 outline-none"
                                                value="locationView" onclick="submit()" checked>
                                            <span class="ml-2 text-base text-stone-100">Lokasi & Daya</span>
                                        @endif
                                    @else
                                        <input type="radio" name="rbView" class="ml-6 outline-none"
                                            value="electricalView" onclick="submit()" checked>
                                        <span class="ml-2 text-base text-stone-100">Daya Listrik</span>
                                        <input type="radio" name="rbView" class="ml-6 outline-none" value="locationView"
                                            onclick="submit()">
                                        <span class="ml-2 text-base text-stone-100">Lokasi & Daya</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex mt-2">
                    </div>
                </form>
                <!-- Form search end -->
                <!-- Alert start -->
                @if (session()->has('success'))
                    <div class="ml-2 flex alert-success">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
                <!-- Alert end -->
            </div>
            <!-- View start -->
            @if (request('rbView'))
                @if (request('rbView') == 'electricalView')
                    @include('electrical-powers.electrical-view')
                @else
                    @include('electrical-powers.location-view')
                @endif
            @else
                @include('electrical-powers.electrical-view')
            @endif
            <!-- View end -->
        </div>
    </div>
    <!-- Container end -->
@endsection
