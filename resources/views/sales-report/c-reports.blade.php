@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    @php
        $ppnTotal = 0;
        $pphTotal = 0;
        $priceTotal = 0;
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">DATA PENJUALAN</h1>
            </div>
            @include('sales-report.c-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($sales), 8) == 0) {
                    $pageQty = count($sales) / 8;
                } else {
                    $pageQty = (count($sales) - fmod(count($sales), 8)) / 8 + 1;
                }
                ?>
                <div id="pdfPreview">
                    @if (count($sales) == 0)
                        <div class="w-[1580px] h-[1120px] px-10 py-4 mt-2 bg-white z-0">
                            <div class="flex items-center border rounded-lg p-4 mt-8">
                                <div class="w-44">
                                    <img class="ml-2 w-[125px]" src="{{ asset('storage/' . $company->logo) }}"
                                        alt="">
                                </div>
                                <div class="w-[750px] ml-6">
                                    <div>
                                        <span class="text-sm font-semibold">{{ $company->name }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">{{ $company->address }}, Desa/Kel. {{ $company->village }},
                                            Kec.
                                            {{ $company->district }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">{{ $company->city }} - {{ $company->province }}
                                            {{ $company->post_code }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">Ph. {{ $company->phone }} | Mobile.
                                            {{ $company->m_phone }}</span>
                                    </div>
                                    <div>
                                        <span class="text-xs">e-mail : {{ $company->email }} | website :
                                            {{ $company->website }}</span>
                                    </div>
                                </div>
                                <div class="flex w-full justify-end">
                                    <div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-5xl text-center">C1</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center">LAPORAN PENJUALAN</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('month'))
                                                @if (request('month') != 'All')
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">
                                                        {{ $bulan[request('month')] }}
                                                        {{ request('year') }}
                                                    </label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN - DES
                                                        {{ request('year') }}</label>
                                                @endif
                                            @else
                                                @if (request('year'))
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN - DES
                                                        {{ request('year') }}</label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">JAN - DES
                                                        {{ date('Y') }}</label>
                                                @endif
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md mt-2">
                                            <label class="text-sm">
                                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center h-[875px] mt-2">
                                @if (request('month'))
                                    @if (request('month') != 'All')
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada
                                            bulan
                                            {{ $bulan[request('month')] }}
                                            {{ request('year') }} ~~
                                        </label>
                                    @else
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada tahun {{ request('year') }} ~~
                                        </label>
                                    @endif
                                @else
                                    @if (request('year'))
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada tahun {{ request('year') }} ~~
                                        </label>
                                    @else
                                        <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                            data
                                            penjualan pada tahun {{ date('Y', strtotime(date('Y-m-d'))) }} ~~
                                        </label>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            @if ($i == $pageQty - 1)
                                @include('sales-report.c-last-page')
                            @else
                                @include('sales-report.c-page')
                            @endif
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <input id="saveName" type="text" value="Laporan C1 - {{ date('d-m-Y') }}" hidden>
    </div>


    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

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
                        scale: 1.5,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1590, 1130],
                        orientation: 'landscape',
                        putTotalPages: true
                    }
                };
                html2pdf().set(opt).from(element).save();
            }
        };
    </script>
    <!-- Script end -->
@endsection
