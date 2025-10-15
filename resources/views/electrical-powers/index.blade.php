@extends('dashboard.layouts.main');

@section('container')
    <?php
    $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agst', 'Sept', 'Okt', 'Nov', 'Des'];
    $types = ['Prabayar', 'Pascabayar'];
    $periods = ['Januari - Juni', 'Juli - Desember'];
    if (request('year')) {
        $getYear = request('year');
    } else {
        $getYear = date('Y');
    }
    
    if (request('area')) {
        $getArea = $areas->where('id', request('area'))->last();
    } else {
        $getArea = '';
    }
    
    if (request('city')) {
        $getCity = $cities->where('id', request('city'))->last();
    } else {
        $getCity = '';
    }
    ?>
    <!-- Container start -->
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex p-1 w-full border-b">
                <!-- Title start -->
                @if (request('type') && request('type') != 'All')
                    <h1 class="index-h1">DAFTAR DAYA LISTRIK {{ strtoupper(request('type')) }}</h1>
                @else
                    <h1 class="index-h1">DAFTAR DAYA LISTRIK</h1>
                @endif
                <div class="flex">
                    @canany(['isAdmin', 'isWorkshop', 'isMedia', 'isAccounting', 'isMarketing'])
                        @can('isElectricity')
                            @can('isWorkshopCreate')
                                <a href="/workshop/electrical-powers/create" title="Tambah Data Daya Listrik"
                                    class="index-link btn-primary mx-1">
                                    <svg class="fill-current w-[18px]" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1">Tambah Data</span>
                                </a>
                            @endcan
                        @endcan
                    @endcanany
                    @canany(['isAdmin', 'isWorkshop', 'isAccounting', 'isMarketing', 'isMedia'])
                        @can('isElectricity')
                            @can('isWorkshopRead')
                                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-warning mb-2"
                                    title="Create PDF" type="button">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1 text-white">Save PDF</span>
                                </button>
                                <button id="btnExportExcel" class="flex justify-center items-center mx-1 btn-success mb-2"
                                    title="Create PDF" type="button">
                                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                                    </svg>
                                    <span class="mx-1 text-white">Export to EXCEL</span>
                                </button>
                            @endcan
                        @endcan
                    @endcanany
                </div>
                <!-- Title end -->
            </div>
            <div>
                <!-- Form search start -->
                <form action="/workshop/electrical-powers/">
                    <div class="flex mt-1 ml-2">
                        <div class="w-36">
                            <span class="text-base text-stone-100">Area</span>
                            <select class="w-36 border rounded-lg text-base text-stone-900 outline-none" name="area"
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
                                    class="flex text-base text-stone-900 w-36 border rounded-lg px-1 outline-none"
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
                        <div class="w-36 ml-2">
                            <span class="text-base text-stone-100">Jenis Daya</span>
                            <select id="type" name="type"
                                class="w-36 text-base text-stone-900 border rounded-lg outline-none" type="text"
                                onchange="submit()">
                                <option value="All">- All -</option>
                                @if (request('type') && request('type') != 'All')
                                    @foreach ($types as $type)
                                        @if (request('type') == $type)
                                            <option value="{{ $type }}" selected>
                                                {{ $type }}
                                            </option>
                                        @else
                                            <option value="{{ $type }}">
                                                {{ $type }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($types as $type)
                                        <option value="{{ $type }}">
                                            {{ $type }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="w-36 ml-2">
                            <span class="text-base text-stone-100">Periode</span>
                            <select id="type" name="period"
                                class="w-36 text-base text-stone-900 border rounded-lg outline-none" type="text"
                                onchange="submit()">
                                @if (request('period') && request('period') != 'All')
                                    @foreach ($periods as $period)
                                        @if (request('period') == $period)
                                            <option value="{{ $period }}" selected>
                                                {{ $period }}
                                            </option>
                                        @else
                                            <option value="{{ $period }}">
                                                {{ $period }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    @foreach ($periods as $period)
                                        <option value="{{ $period }}">
                                            {{ $period }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="ml-2 w-32">
                            <span class="text-base text-stone-100">Tahun</span>
                            <div class="flex items-center">
                                <select name="year"
                                    class="text-center outline-none border w-20 text-base text-stone-900 rounded-md bg-stone-100"
                                    onchange="submit()">
                                    @php
                                        $oldYear = 2020;
                                    @endphp
                                    @if (request('year'))
                                        @for ($i = date('Y'); $i > $oldYear; $i--)
                                            @if ($i == request('year'))
                                                <option value="{{ $i }}" selected>
                                                    {{ $i }}
                                                </option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}
                                                </option>
                                            @endif
                                        @endfor
                                    @else
                                        @for ($i = date('Y'); $i > $oldYear; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="ml-2 w-full">
                            <span class="text-base text-stone-100">Pencarian</span>
                            <div class="flex w-full">
                                <input id="search" name="search"
                                    class="flex border rounded-l-lg px-1 outline-none text-base text-stone-900"
                                    type="text" placeholder="Search" value="{{ request('search') }}"
                                    onkeyup="submit()"
                                    onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                <button
                                    class="flex border px-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                                    type="submit">
                                    <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                        <path
                                            d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                    </svg>
                                </button>
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
            @include('electrical-powers.electrical-view')
            @include('electrical-powers.pdf-format')
            @include('electrical-powers.excel-format')
            {{-- @if (request('rbView'))
                @if (request('rbView') == 'electricalView')
                    @include('electrical-powers.electrical-view')
                @else
                    @include('electrical-powers.location-view')
                @endif
            @else
                @include('electrical-powers.electrical-view')
            @endif --}}
            <!-- View end -->
        </div>
    </div>

    @if (request('period') && request('period') == 'Juli - Desember')
        <input id="saveName" type="text" value="LIST DAYA LISTRIK - JUL-DES {{ $getYear }}" hidden>
    @else
        <input id="saveName" type="text" value="LIST DAYA LISTRIK - JAN-JUN {{ $getYear }}" hidden>
    @endif
    <!-- Container end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/jquery.min.js"></script>
    <script src="/js/jquery.table2excel.min.js"></script>

    <script>
        const saveName = document.querySelectorAll("[id=saveName]");
        const pdfPreview = document.querySelectorAll("[id=pdfPreview]");
        document.getElementById("btnCreatePdf").onclick = function() {
            for (let i = 0; i < pdfPreview.length; i++) {
                var element = document.getElementById('pdfPreview');
                var opt = {
                    margin: 0,
                    filename: saveName[i].value,
                    image: {
                        type: 'jpeg',
                        quality: 1
                    },
                    pagebreak: {
                        mode: ['avoid-all', 'css', 'legacy']
                    },
                    html2canvas: {
                        dpi: 300,
                        scale: 2.5,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1550, 1000],
                        orientation: 'landscape',
                        putTotalPages: true
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        };

        $(document).ready(function() {
            $('#btnExportExcel').on('click', function() {
                $('#exportExcelTable').table2excel({
                    filename: "List Data Daya Listrik.xls"
                });
            });
        });

        changeArea = () => {
            const cityId = document.getElementById("city");
            const formFilter = document.getElementById("formFilter");

            cityId.value = "All"

            formFilter.submit();
        }
    </script>
    <!-- Script end -->
@endsection
