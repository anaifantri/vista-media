@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Report start -->
    @php
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
            <div class="flex justify-center m-2 w-[1280px]">
                <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">LAPORAN SPK CETAK</h1>
            </div>
            @include('orders-report.print-header')
            <div id="chartReport" class="flex justify-center z-0">
                <?php
                if (fmod(count($print_orders), 30) == 0) {
                    $pageQty = count($print_orders) / 30;
                } else {
                    $pageQty = (count($print_orders) - fmod(count($print_orders), 30)) / 30 + 1;
                }
                ?>
                <div id="pdfPreview">
                    @if (count($print_orders) == 0)
                        <div class="w-[1280px] h-[900px] px-10 mt-2 p-4 bg-white z-0">
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
                                            <label class="text-5xl text-center">SC</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center">LAPORAN SPK CETAK</label>
                                        </div>
                                        <div class="flex justify-center w-56">
                                            <label class="text-sm text-center"></label>
                                        </div>
                                        <div class="flex justify-center w-56 border rounded-md">
                                            @if (request('search'))
                                                <?php
                                                $searchDate = strtotime(request('search'));
                                                ?>
                                                <label id="labelPeriode"
                                                    class="month-report text-xl font-semibold text-center">
                                                    {{ $bulan[(int) date('m', $searchDate)] }}
                                                    {{ date('Y', $searchDate) }}
                                                </label>
                                            @else
                                                <label id="labelPeriode"
                                                    class="month-report text-xl font-semibold text-center">SEMUA
                                                    DATA</label>
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
                            <div class="flex justify-center h-[625px] mt-2">
                                <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak ada data SPK
                                    Cetak pada
                                    bulan
                                    {{ $bulan[(int) date('m', strtotime(request('search')))] }}
                                    {{ date('Y', strtotime(request('search'))) }} ~~
                                </label>
                            </div>
                        </div>
                    @else
                        @for ($i = 0; $i < $pageQty; $i++)
                            <div class="w-[1280px] h-[900px] px-10 mt-2 p-4 bg-white z-0">
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
                                            <span class="text-xs">{{ $company->address }}, Desa/Kel.
                                                {{ $company->village }},
                                                Kec.
                                                {{ $company->district }}</span>
                                        </div>
                                        <div>
                                            <span class="text-xs">
                                                {{ $company->city }} - {{ $company->province }} {{ $company->post_code }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-xs">
                                                Ph. {{ $company->phone }} | Mobile. {{ $company->m_phone }}
                                            </span>
                                        </div>
                                        <div>
                                            <span class="text-xs">
                                                e-mail : {{ $company->email }} | website : {{ $company->website }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="flex w-full justify-end">
                                        <div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-5xl text-center">SC</label>
                                            </div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-sm text-center">LAPORAN SPK CETAK</label>
                                            </div>
                                            <div class="flex justify-center w-56">
                                                <label class="text-sm text-center"></label>
                                            </div>
                                            <div class="flex justify-center w-56 border rounded-md">
                                                @if (request('search'))
                                                    <?php
                                                    $searchDate = strtotime(request('search'));
                                                    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                                    ?>
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">{{ $bulan[(int) date('m', $searchDate)] }}
                                                        {{ date('Y', $searchDate) }}</label>
                                                @else
                                                    <label id="labelPeriode"
                                                        class="month-report text-xl font-semibold text-center">SEMUA
                                                        DATA</label>
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
                                <div class="h-[622px] mt-2">
                                    <table class="table-auto w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-6"
                                                    rowspan="2">
                                                    No.
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] text-center w-24"
                                                    rowspan="2">
                                                    <button
                                                        class="flex justify-center items-center w-full">@sortablelink('number', 'Nomor SPK')
                                                        <svg class="fill-current w-3 ml-1"
                                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                                        </svg>
                                                    </button>
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-16"
                                                    rowspan="2">
                                                    Tanggal
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem] w-20"
                                                    rowspan="2">
                                                    Vendor
                                                </th>
                                                <th class="text-black sticky top-0 border text-[0.65rem]" colspan="11">
                                                    Deskripsi
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-black border text-[0.65rem] w-16">Kode</th>
                                                <th class="text-black border text-[0.65rem]">Lokasi</th>
                                                <th class="text-black border text-[0.65rem] w-24">Klien</th>
                                                <th class="text-black border text-[0.65rem] w-28">Tema</th>
                                                <th class="text-black border text-[0.65rem] w-24">Status</th>
                                                <th class="text-black border text-[0.65rem] w-8">Jenis</th>
                                                <th class="text-black border text-[0.65rem] w-20">Bahan</th>
                                                <th class="text-black border text-[0.65rem] w-14">Size</th>
                                                <th class="text-black border text-[0.65rem] w-8">Qty</th>
                                                <th class="text-black border text-[0.65rem] w-14">Harga</th>
                                                <th class="text-black border text-[0.65rem] w-20">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($print_orders as $order)
                                                @php
                                                    $client = null;
                                                    $product = json_decode($order->product);
                                                    if ($product->main_sale_id) {
                                                        $sale = $sales->where('id', $product->main_sale_id)->last();
                                                        $client = json_decode($sale->quotation->clients);
                                                    } elseif ($product->sale_id) {
                                                        $sale = $sales->where('id', $product->sale_id)->last();
                                                        $client = json_decode($sale->quotation->clients);
                                                    }
                                                @endphp
                                                @if ($i == 0)
                                                    @if ($loop->iteration <= 30)
                                                        <tr>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ substr($order->number, 0, 15) }}..
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ date('d-m-Y', strtotime($order->created_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $order->vendor->name }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->location_code }}-{{ $product->city_code }}
                                                            </td>
                                                            <td class="text-black border text-[0.65rem] align-top px-1">
                                                                @if (strlen($product->location_address) > 45)
                                                                    {{ substr($product->location_address, 0, 45) }}..
                                                                @else
                                                                    {{ $product->location_address }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top text-center px-1">
                                                                @if ($client)
                                                                    {{ $client->name }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $order->theme }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $product->status }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if ($product->product_type == 'Frontlight')
                                                                    FL
                                                                @elseif ($product->product_type == 'Backlight')
                                                                    BL
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->product_name }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->location_size }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->qty }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-2 text-right">
                                                                {{ number_format($product->product_price) }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-2 text-right">
                                                                {{ number_format($product->product_price * $product->qty * $product->location_width * $product->location_height) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @else
                                                    @if ($loop->iteration > $i * 30 && $loop->iteration < ($i + 1) * 30 + 1)
                                                        <tr>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $loop->iteration }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ substr($order->number, 0, 15) }}..
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ date('d-m-Y', strtotime($order->created_at)) }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $order->vendor->name }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->location_code }}-{{ $product->city_code }}
                                                            </td>
                                                            <td class="text-black border text-[0.65rem] align-top px-1">
                                                                @if (strlen($product->location_address) > 45)
                                                                    {{ substr($product->location_address, 0, 45) }}..
                                                                @else
                                                                    {{ $product->location_address }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top text-center px-1">
                                                                @if ($client)
                                                                    {{ $client->name }}
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $order->theme }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                {{ $product->status }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] text-center align-top">
                                                                @if ($product->product_type == 'Frontlight')
                                                                    FL
                                                                @elseif ($product->product_type == 'Backlight')
                                                                    BL
                                                                @endif
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->product_name }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->location_size }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-1 text-center">
                                                                {{ $product->qty }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-2 text-right">
                                                                {{ number_format($product->product_price) }}
                                                            </td>
                                                            <td
                                                                class="text-black border text-[0.65rem] align-top px-2 text-right">
                                                                {{ number_format($product->product_price * $product->qty * $product->location_width * $product->location_height) }}
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                            <tr>
                                                <td class="text-stone-900 px-2 border text-[0.7rem] font-semibold text-right"
                                                    colspan="14">Total</td>
                                                <td
                                                    class="text-stone-900 px-2 border text-[0.7rem] font-semibold text-right">
                                                    {{ number_format($amount) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="flex justify-end mt-1 text-teal-900">
                                    <label for="">Halaman {{ $i + 1 }} dari {{ $pageQty }}</label>
                                </div>
                            </div>
                        @endfor
                    @endif
                </div>
            </div>
        </div>
        <input id="saveName" type="text" value="Laporan SPK Cetak - {{ date('d-m-Y') }}" hidden>
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
                        dpi: 192,
                        scale: 2,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [1300, 920],
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
