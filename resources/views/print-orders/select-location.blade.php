@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Signage start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex w-[1200px] border-b">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi Cetak Gambar
                </h1>
                <div class="flex justify-end w-full">
                    <button class="flex justify-center items-center btn-primary w-44" type="button" onclick="orderCreate()">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1">Buat SPK</span>
                    </button>
                    <a id="btnCreate" hidden></a>
                    <a class="flex justify-center items-center ml-1 btn-danger"
                        href="/print-orders/index/{{ $company->id }}">
                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-1">Cancel</span>
                    </a>
                </div>
            </div>
            <form action="/print-orders/select-locations/{{ $company->id }}">
                @if (request('orderType'))
                    <input id="orderType" type="text" value="{{ request('orderType') }}" hidden>
                @else
                    <input id="orderType" type="text" value="sales" hidden>
                @endif
                <div class="flex mt-1 ml-2">
                    @if (request('orderType'))
                        @if (request('orderType') == 'sales')
                            <input class="outline-none" name="orderType" type="radio" onclick="submit()" value="sales"
                                checked>
                            <label class="text-sm text-stone-100 ml-2" for="sales">Cetak Berbayar</label>
                        @else
                            <input class="outline-none" name="orderType" type="radio" onclick="submit()" value="sales">
                            <label class="text-sm text-stone-100 ml-2" for="sales">Cetak Berbayar</label>
                        @endif
                        @if (request('orderType') == 'free')
                            <input class="outline-none ml-4" name="orderType" type="radio" onclick="submit()"
                                value="free" checked>
                            <label class="text-sm text-stone-100 ml-2" for="free">Free Cetak Klien</label>
                        @else
                            <input class="outline-none ml-4" name="orderType" type="radio" onclick="submit()"
                                value="free">
                            <label class="text-sm text-stone-100 ml-2" for="free">Free Cetak Klien</label>
                        @endif
                        @if (request('orderType') == 'locations')
                            <input class="outline-none  ml-4" name="orderType" type="radio" onclick="submit()"
                                value="locations" checked>
                            <label class="text-sm text-stone-100 ml-2" for="locations">Free Cetak Lain-Lain</label>
                        @else
                            <input class="outline-none  ml-4" name="orderType" type="radio" onclick="submit()"
                                value="locations">
                            <label class="text-sm text-stone-100 ml-2" for="locations">Free Cetak Lain-Lain</label>
                        @endif
                    @else
                        <input class="outline-none" name="orderType" type="radio" onclick="submit()" value="sales"
                            checked>
                        <label class="text-sm text-stone-100 ml-2" for="sales">Cetak Berbayar</label>
                        <input class="outline-none ml-4" name="orderType" type="radio" onclick="submit()" value="free">
                        <label class="text-sm text-stone-100 ml-2" for="free">Free Cetak Klien</label>
                        <input class="outline-none ml-4" name="orderType" type="radio" onclick="submit()"
                            value="locations">
                        <label class="text-sm text-stone-100 ml-2" for="locations">Free Cetak Lain-Lain</label>
                    @endif
                </div>
                <div class="flex mt-1 ml-2">
                    <div class="w-36">
                        <span class="text-sm text-stone-100">Area</span>
                        @if (request('area'))
                            <select class="w-full border rounded-lg text-sm text-stone-900 outline-none" name="area"
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
                        @else
                            <select class="w-full border rounded-lg text-sm text-stone-900 outline-none" name="area"
                                id="area" onchange="submit()" value="{{ request('area') }}">
                                <option value="All">All</option>
                                @foreach ($areas as $area)
                                    @if (request('area') == $area->id)
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @else
                                        <option value="{{ $area->id }}">{{ $area->area }}</option>
                                    @endif
                                @endforeach
                            </select>
                        @endif
                    </div>
                    <div class="w-36 ml-2">
                        <span class="text-sm text-stone-100">Kota</span>
                        @if (request('area'))
                            @if (request('area') != 'All')
                                <select id="city"
                                    class="w-full border rounded-lg text-sm text-stone-900 outline-none" name="city"
                                    onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city') == $city->id)
                                                <option value="{{ $city->id }}" selected>{{ $city->city }}
                                                </option>
                                            @else
                                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select id="city"
                                    class="w-full border rounded-lg text-sm text-stone-900 outline-none" name="city"
                                    onchange="submit()" disabled>
                                    <option value="All">All</option>
                                </select>
                            @endif
                        @else
                            <select id="city" class="w-full border rounded-lg text-sm text-stone-900 outline-none"
                                name="city" onchange="submit()" disabled>
                                <option value="All">All</option>
                            </select>
                        @endif
                    </div>
                    <div class="ml-2 w-36">
                        <span class="text-sm text-stone-100">Katagori</span>
                        <select class="w-full border rounded-lg text-sm text-stone-900 outline-none"
                            name="media_category_id" id="media_category_id" onchange="submit()"
                            value="{{ request('media_category_id') }}">
                            <option value="All">All</option>
                            @foreach ($categories as $category)
                                @if ($category->name != 'Service' && $category->name != 'Videotron')
                                    @if (request('media_category_id') == $category->id)
                                        <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                    @else
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="flex mt-2">
                    <div class="flex">
                        <input id="search" name="search"
                            class="flex border rounded-l-lg ml-2 p-1 outline-none text-sm text-teal-900" type="text"
                            placeholder="Search" value="{{ request('search') }}" onkeyup="submit()" autofocus
                            onfocus="this.setSelectionRange(this.value.length,this.value.length);">
                        <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                            type="submit">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                            </svg>
                        </button>
                    </div>
                </div>
            </form>
            <div class="w-[1200px] mt-4">
                @if (request('orderType'))
                    @if (request('orderType') == 'locations')
                        @include('print-orders.locations-table')
                    @elseif (request('orderType') == 'free')
                        @include('print-orders.free-table')
                    @elseif(request('orderType') == 'sales')
                        @include('print-orders.order-table')
                    @endif
                @else
                    @include('print-orders.order-table')
                @endif
            </div>
            @if (request('orderType') == 'locations')
                <div class="flex justify-center text-stone-100 mt-2">
                    {!! $locations->appends(Request::query())->render('dashboard.layouts.pagination') !!}
                </div>
            @endif
        </div>
    </div>

    <script src="/js/selectprintlocation.js"></script>
@endsection
