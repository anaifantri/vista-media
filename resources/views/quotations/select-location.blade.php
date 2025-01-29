@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Signage start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div>
                <div class="flex w-[1200px] border-b">
                    @if ($category == 'Service')
                        <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi Cetak /
                            Pasang</h1>
                    @else
                        @if ($category == 'All')
                            <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi</h1>
                        @else
                            <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[600px] py-1">Pilih Lokasi
                                {{ $category }}</h1>
                        @endif
                    @endif

                    <div class="flex justify-end w-full">
                        <button class="flex justify-center items-center btn-primary w-44" type="button"
                            onclick="quotationCreate()">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Buat Penawaran</span>
                        </button>
                        <a id="btnCreate" hidden></a>
                        <input type="text" name="dataId" id="location_id" value="test" hidden>
                        @if ($category == 'All')
                            <input type="text" name="category" id="category" value="Billboard" hidden>
                        @else
                            <input type="text" name="category" id="category" value="{{ $category }}" hidden>
                        @endif

                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/marketing/quotations/home/{{ $category }}/{{ $company->id }}">
                            <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <form action="/marketing/quotations/select-location/{{ $category }}/{{ $company->id }}">
                    <input id="requestService" type="text" value="{{ request('serviceType') }}" hidden>
                    <input id="requestType" type="text" value="{{ request('quotationType') }}" hidden>
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-stone-100">Area</span>
                            @if (request('area'))
                                <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                    name="area" id="area" onchange="submit()" value="{{ request('area') }}">
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
                                <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                    name="area" id="area" onchange="submit()" value="{{ request('area') }}">
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
                            <span class="text-base text-stone-100">Kota</span>
                            @if (request('area'))
                                <select id="city"
                                    class="w-full border rounded-lg text-base text-stone-900 outline-none" name="city"
                                    onchange="submit()">
                                    <option value="All">All</option>
                                    @foreach ($cities as $city)
                                        @if (request('area') == $city->area_id)
                                            @if (request('city') == $city->id)
                                                <option value="{{ $city->id }}" selected>{{ $city->city }}</option>
                                            @else
                                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <select id="city"
                                    class="w-full border rounded-lg text-base text-stone-900 outline-none" name="city"
                                    onchange="submit()" disabled>
                                    <option value="All">All</option>
                                </select>
                            @endif
                        </div>

                        @if ($category == 'Signage')
                            <div class="w-36 ml-2">
                                @php
                                    $dataType = ['Neon Box', 'Videotron', 'Papan'];
                                @endphp
                                <span class="text-base text-stone-100">Bentuk</span>
                                @if (request('type'))
                                    <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                        name="type" id="type" onchange="submit()" value="{{ request('type') }}">
                                        <option value="All">All</option>
                                        @foreach ($dataType as $type)
                                            @if (request('type') == $type)
                                                <option value="{{ $type }}" selected>{{ $type }}</option>
                                            @else
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @else
                                    <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                        name="type" id="type" onchange="submit()" value="{{ request('type') }}">
                                        <option value="All">All</option>
                                        @foreach ($dataType as $type)
                                            @if (request('type') == $type)
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @else
                                                <option value="{{ $type }}">{{ $type }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        @endif
                        @if ($category == 'Service')
                            <div class="w-36 ml-4">
                                <span class="text-base text-stone-100">Katagori</span>
                                <select class="w-full border rounded-lg text-base text-stone-900 outline-none"
                                    name="media_category_id" id="media_category_id" onchange="submit()"
                                    value="{{ request('media_category_id') }}">
                                    <option value="All">All</option>
                                    @foreach ($categories as $dataCategory)
                                        @if ($dataCategory->name != 'Videotron' && $dataCategory->name != 'Service')
                                            @if (request('media_category_id') == $dataCategory->id)
                                                <option value="{{ $dataCategory->id }}" selected>
                                                    {{ $dataCategory->name }}
                                                </option>
                                            @else
                                                <option value="{{ $dataCategory->id }}">{{ $dataCategory->name }}
                                                </option>
                                            @endif
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="ml-4" hidden>
                                <span class="text-base text-stone-100">Jenis Penawaran</span>
                                <div class="flex items-center">
                                    <input id="existingRadioService" class="outline-none" type="radio"
                                        name="serviceType" value="existing" onclick="typeServiceCheck(this), submit()"
                                        checked>
                                    <label class="text-sm text-stone-100 ml-2" for="existing">Dari Data Penjualan</label>
                                    <input id="newRadioService" class="outline-none  ml-4" type="radio"
                                        name="serviceType" value="new" onclick="typeServiceCheck(this), submit()">
                                    <label class="text-sm text-stone-100 ml-2" for="new">Penawaran Baru</label>
                                </div>
                            </div>
                        @else
                            <div class="ml-4">
                                <span class="text-base text-stone-100">Jenis Penawaran</span>
                                <div class="flex items-center">
                                    <input id="newType" class="outline-none" type="radio" name="quotationType"
                                        value="new" checked onclick="typeCheck(this), submit()">
                                    <label class="text-sm text-stone-100 ml-2" for="new">Penawaran Baru</label>
                                    <input id="extendType" class="outline-none ml-4" type="radio" name="quotationType"
                                        value="extend" onclick="typeCheck(this), submit()">
                                    <label class="text-sm text-stone-100 ml-2" for="extend">Penawaran
                                        Perpanjangan</label>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="flex mt-2">
                        <div class="flex">
                            <input
                                id="search"class="flex border rounded-lg ml-2 p-1 outline-none text-base text-stone-900"
                                type="text" placeholder="Search"onkeyup="searchTable()" autofocus>
                            {{-- <input id="search" name="search"
                                class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-stone-900"
                                type="text" placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                autofocus onfocus="this.setSelectionRange(this.value.length,this.value.length);"> --}}
                            {{-- <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                type="submit">
                                <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                </svg>
                            </button> --}}
                        </div>
                    </div>
                </form>
            </div>
            <div class="w-[1200px] h-[500px] overflow-y-auto mt-4">
                @if ($category == 'Service')
                    @if (request('serviceType'))
                        @if (request('serviceType') == 'new')
                            @include('quotations.new-quotation')
                        @else
                            @include('quotations.existing-quotation')
                        @endif
                    @else
                        @include('quotations.existing-quotation')
                    @endif
                @else
                    @if (request('quotationType'))
                        @if (request('quotationType') == 'new')
                            @include('quotations.new-quotation')
                        @elseif(request('quotationType') == 'extend')
                            @include('quotations.extend-quotation')
                        @endif
                    @else
                        @include('quotations.new-quotation')
                    @endif
                @endif
            </div>
            {{-- <div class="flex justify-center text-stone-100 mt-2">
                @if ($category != 'Service' || ($category == 'Service' && request('serviceType') == 'new'))
                    {!! $locations->appends(Request::query())->render('dashboard.layouts.pagination') !!}
                @endif
            </div> --}}
        </div>
    </div>

    <script src="/js/selectlocation.js"></script>
@endsection
