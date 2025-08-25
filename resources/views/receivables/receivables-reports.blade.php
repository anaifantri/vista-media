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
        $sMonth = [
            1 => 'Jan',
            'Feb',
            'Mar',
            'Apr',
            'Mei',
            'Jun',
            'Jul',
            'Agu',
            'Sep',
            'Okt',
            'Nov',
            'Des',
        ];
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center m-2">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">DATA PIUTANG</h1>
            </div>
            @include('receivables.receivables-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($receivables), 8) == 0) {
                    $pageQty = count($receivables) / 8;
                } else {
                    $pageQty = (count($receivables) - fmod(count($receivables), 8)) / 8 + 1;
                }
                ?>
                <div id="pdfPreview">
                    @if (count($receivables) == 0)
                        <div class="w-[1580px] h-[1000px] px-10 py-4 mt-2 bg-white z-0">
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
                                        <div class="flex justify-center w-72">
                                            <label class="text-sm text-center">LIST PIUTANG</label>
                                        </div>
                                        <div class="flex justify-center w-72">
                                            <label class="text-3xl text-center">INVOICE</label>
                                        </div>
                                        <div class="flex mt-4 justify-center w-72 border rounded-md">
                                            @if (request('fromDate'))
                                                <label id="labelPeriode"
                                                    class="month-report text-sm font-semibold text-center">
                                                    {{ date('d', strtotime(request('fromDate'))) }}
                                                    {{ $bulan[(int) date('m', strtotime(request('fromDate')))] }}
                                                    {{ date('Y', strtotime(request('fromDate'))) }}
                                                    s.d.
                                                    {{ date('d', strtotime(request('toDate'))) }}
                                                    {{ $bulan[(int) date('m', strtotime(request('toDate')))] }}
                                                    {{ date('Y', strtotime(request('toDate'))) }}
                                                </label>
                                            @else
                                                <label id="labelPeriode"
                                                    class="month-report text-sm font-semibold text-center">-</label>
                                            @endif
                                        </div>
                                        <div class="flex justify-center w-72 border rounded-md mt-2">
                                            <label class="text-sm">
                                                <span class="text-sm font-semibold text-red-600">Tgl. Cetak : </span>
                                                {{ date('d') }} {{ $bulan[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-center h-[875px] mt-2">
                                @if (request('fromDate'))
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada
                                        data
                                        penjualan untuk periode
                                        {{ date('d', strtotime(request('fromDate'))) }}
                                        {{ $bulan[(int) date('m', strtotime(request('fromDate')))] }}
                                        {{ date('Y', strtotime(request('fromDate'))) }}
                                        s.d.
                                        {{ date('d', strtotime(request('toDate'))) }}
                                        {{ $bulan[(int) date('m', strtotime(request('toDate')))] }}
                                        {{ date('Y', strtotime(request('toDate'))) }}
                                    </label>
                                @else
                                    <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Silahkan
                                        tentukan periode awal dan akhir terlebih dahulu..!! ~~
                                    </label>
                                @endif
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            @if ($i == $pageQty - 1)
                                @include('receivables.receivables-last-page')
                            @else
                                @include('receivables.receivables-page')
                            @endif
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <input id="saveName" type="text" value="Laporan Mingguan - {{ date('d-m-Y') }}" hidden>
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
                        dpi: 96,
                        scale: 1.3,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1590, 1020],
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
