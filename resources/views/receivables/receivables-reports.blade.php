@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Receivable Report start -->
    @if (request('fromData') && request('fromData') == 'PENJUALAN')
        <!-- Create G Report start -->
        @php
            $ppnTotal = 0;
            $pphTotal = 0;
            $priceTotal = 0;
            $dataClients = [];
            foreach ($sales as $getReceivable) {
                $getClient = json_decode($getReceivable->quotation->clients);
                if ($getClient->type == 'Perusahaan') {
                    if (!in_array($getClient->company, $dataClients)) {
                        array_push($dataClients, $getClient->company);
                    }
                } else {
                    if (!in_array($getClient->name, $dataClients)) {
                        array_push($dataClients, $getClient->name);
                    }
                }
            }
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
                    <h1 class="text-xl text-stone-100 font-bold tracking-wider w-[1580px] border-b">DATA PENJUALAN</h1>
                </div>
                @include('receivables.receivables-header')
                <div id="chartReport" class="flex justify-center z-0">
                    <?php
                    if (fmod(count($sales), 30) == 0) {
                        $pageQty = count($sales) / 30;
                    } else {
                        $pageQty = (count($sales) - fmod(count($sales), 30)) / 30 + 1;
                    }
                    ?>
                    <div id="pdfPreview">
                        @if (count($sales) == 0)
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
                                            <span class="text-xs">{{ $company->address }}, Desa/Kel.
                                                {{ $company->village }},
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
                                                <label class="text-5xl text-center">G1</label>
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
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak
                                                ada
                                                data
                                                penjualan pada
                                                bulan
                                                {{ $bulan[request('month')] }}
                                                {{ request('year') }} ~~
                                            </label>
                                        @else
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak
                                                ada
                                                data
                                                penjualan pada tahun {{ request('year') }} ~~
                                            </label>
                                        @endif
                                    @else
                                        @if (request('year'))
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak
                                                ada
                                                data
                                                penjualan pada tahun {{ request('year') }} ~~
                                            </label>
                                        @else
                                            <label class="flex text-base text-red-600 font-serif tracking-wider">~~ Tidak
                                                ada
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
                                    @include('receivables.g-last-page')
                                @else
                                    @include('receivables.g-page')
                                @endif
                            @endfor
                        @endif
                    </div>
                </div>
            </div>
            <input id="saveName" type="text" value="Laporan C1 - {{ date('d-m-Y') }}" hidden>
        </div>

        <table id="exportExcelTable" class="table-auto w-full" hidden>
            <thead>
                <tr class="bg-teal-100 h-10">
                    <th class="sticky top-0 border border-black text-sm w-8" rowspan="2">
                        No.
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center w-24">
                        No. Penjualan
                    </th>
                    <th class="sticky top-0 border border-black text-sm">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-72">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-20">
                        Deskripsi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Harga
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Penagihan
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Pembayaran
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Pot. PPh
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[104px]">
                        Piutang
                    </th>
                </tr>
            </thead>
            <tbody class="bg-stone-300">
                @foreach ($sales as $sale)
                    @php
                        $pphTotal = $pphTotal + $sale->dpp * (2 / 100);
                        $ppnTotal = $ppnTotal + $sale->dpp * ($sale->ppn / 100);
                        $priceTotal = $priceTotal + $sale->price;

                        $quotId = null;
                        $quotRevisionId = null;
                        $created_by = json_decode($sale->created_by);
                        $revisions = $sale->quotation->quotation_revisions;

                        if (count($revisions) != 0) {
                            $revision =
                                $sale->quotation->quotation_revisions[count($sale->quotation->quotation_revisions) - 1];
                            $number = $revision->number;
                            $quotRevisionId = $revision->id;
                            $notes = json_decode($revision->notes);
                            $created_at = $revision->created_at;
                            $payment_terms = json_decode($revision->payment_terms);
                            $price = json_decode($revision->price);
                            $dataApprovals = $sale->quotation->quotation_approvals;
                            $dataAgreements = $sale->quotation->quotation_agreements;
                            $dataOrders = $sale->quotation->quotation_orders;
                        } else {
                            $number = $sale->quotation->number;
                            $quotId = $sale->quotation->id;
                            $notes = json_decode($sale->quotation->notes);
                            $created_at = $sale->quotation->created_at;
                            $payment_terms = json_decode($sale->quotation->payment_terms);
                            $price = json_decode($sale->quotation->price);
                            $dataApprovals = $sale->quotation->quotation_approvals;
                            $dataAgreements = $sale->quotation->quotation_agreements;
                            $dataOrders = $sale->quotation->quotation_orders;
                        }
                        $clients = json_decode($sale->quotation->clients);
                        $product = json_decode($sale->product);
                        $description = json_decode($product->description);
                        $saleBillings = $sale->billings;
                    @endphp
                    <tr>
                        <td class="border border-black text-sm text-center">
                            {{ $loop->iteration }}</td>
                        <td class="border border-black text-sm text-center">
                            <a href="/marketing/sales/{{ $sale->id }}">
                                {{ substr($sale->number, 0, 5) }}..{{ substr($sale->number, -5) }}
                            </a>
                        </td>
                        <td class="border border-black text-sm text-start px-1">
                            <a href="/media/locations/preview/{{ $product->category }}/{{ $product->id }}"
                                class="ml-1">{{ $product->code }} -
                                {{ $product->city_code }} | {{ $product->address }}</a>
                        </td>
                        <td class="border border-black text-sm text-start px-1">
                            <div>
                                @if ($clients->type == 'Perusahaan')
                                    {{ $clients->company }}
                                    {{-- @if (strlen($clients->company) > 20)
                                                {{ substr($clients->company, 0, 20) }}..
                                            @else
                                                {{ $clients->company }}
                                            @endif --}}
                                @else
                                    {{ $clients->name }}
                                @endif
                            </div>
                        </td>
                        <td class="border border-black text-sm text-center px-1">
                            @if ($sale->media_category->name == 'Service')
                                Revisual
                            @else
                                {{ $sale->media_category->name }}
                            @endif
                        </td>
                        <td class="border border-black text-sm text-right px-1">
                            {{ number_format($sale->price + ($sale->dpp * $sale->ppn) / 100) }}
                        </td>
                        <td class="border border-black text-sm text-right px-1">
                            @php
                                $billingNominal = 0;
                                if ($sale->media_category->name == 'Service') {
                                    foreach ($saleBillings as $itemBilling) {
                                        foreach (
                                            json_decode($itemBilling->invoice_content)->description
                                            as $itemDescription
                                        ) {
                                            if ($itemDescription->sale_id == $sale->id) {
                                                $billingNominal =
                                                    $billingNominal +
                                                    ($itemDescription->nominal +
                                                        ($sale->ppn / 100) * $itemDescription->nominal);
                                            }
                                        }
                                    }
                                } else {
                                    foreach ($saleBillings as $itemBilling) {
                                        if (isset(json_decode($itemBilling->invoice_content)->manual_detail)) {
                                            $billingNominal =
                                                $billingNominal + ($itemBilling->nominal + $itemBilling->ppn);
                                        } elseif (isset(json_decode($itemBilling->invoice_content)->data_sales)) {
                                            foreach (
                                                json_decode($itemBilling->invoice_content)->data_sales
                                                as $itemSales
                                            ) {
                                                if ($itemSales->id == $sale->id) {
                                                    $billingNominal =
                                                        $billingNominal +
                                                        ($itemSales->nominal +
                                                            ($sale->ppn / 100) * $itemSales->nominal);
                                                }
                                            }
                                        } else {
                                            foreach (
                                                json_decode($itemBilling->invoice_content)->description
                                                as $itemDesc
                                            ) {
                                                if ($itemDesc->sale_id == $sale->id) {
                                                    $billingNominal =
                                                        $billingNominal +
                                                        ($itemDesc->nominal + ($sale->ppn / 100) * $itemDesc->nominal);
                                                }
                                            }
                                        }
                                    }
                                }
                            @endphp
                            {{ number_format($billingNominal) }}
                        </td>
                        <td class="border border-black text-sm text-right px-1">
                            @php
                                $paymentNominal = 0;
                                foreach ($saleBillings as $itemBilling) {
                                    if (count($itemBilling->bill_payments) > 0) {
                                        $paymentNominal = $paymentNominal + $itemBilling->bill_payments->sum('nominal');
                                    }
                                }
                            @endphp
                            {{ number_format($paymentNominal) }}
                        </td>
                        <td class="border border-black text-sm text-right px-1">
                            {{-- <div>
                                        @foreach ($saleBillings as $itemBilling)
                                            @if (count($itemBilling->bill_payments) > 0)
                                                <span>{{ number_format($itemBilling->bill_payments->sum('nominal')) }}</span>
                                            @endif
                                        @endforeach
                                    </div> --}}
                        </td>
                        <td class="border border-black text-sm text-right px-1">
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border border-black text-sm text-right font-semibold px-2" colspan="5">
                        Total</td>
                    <td class="border border-black text-sm text-right font-semibold px-2">
                        {{ number_format($priceTotal) }}
                    </td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                    <td class="text-black border border-black text-sm text-right font-semibold"></td>
                </tr>
            </tbody>
        </table>
        <!-- Create G Report start -->
    @else
        @php
            $ppnTotal = 0;
            $pphTotal = 0;
            $priceTotal = 0;
            $dataClients = [];
            $qty = 0;
            foreach ($receivables as $getReceivable) {
                $descriptions = json_decode($getReceivable->invoice_content)->description;
                $getClient = json_decode($getReceivable->client);
                if (isset($getClient->company)) {
                    if (!in_array($getClient->company, $dataClients)) {
                        array_push($dataClients, $getClient->company);
                    }
                } else {
                    if (!in_array($getClient->name, $dataClients)) {
                        array_push($dataClients, $getClient->name);
                    }
                }
                foreach ($descriptions as $description) {
                    $qty++;
                }
            }
            if (fmod($qty, 30) == 0) {
                $pageQty = $qty / 30;
            } else {
                $pageQty = ($qty - fmod($qty, 30)) / 30 + 1;
            }
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
                    <div id="pdfPreview">
                        @if ($qty == 0)
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
                                            <span class="text-xs">{{ $company->address }}, Desa/Kel.
                                                {{ $company->village }},
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

        <table id="exportExcelTable" class="table-auto w-full" hidden>
            <thead>
                <tr class="bg-teal-100 h-10">
                    <th class="sticky top-0 border border-black text-sm w-8">
                        No.
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-72">
                        Klien
                    </th>
                    <th class="sticky top-0 border border-black text-sm text-center">
                        Lokasi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-[72px]">
                        Deskripsi
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-56">
                        No. Invoice
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-24">
                        Tgl. Invoice
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Nominal
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Pembayaran
                    </th>
                    <th class="sticky top-0 border border-black text-sm w-32">
                        Piutang
                    </th>
                </tr>
            </thead>
            <tbody class="bg-stone-300">
                @foreach ($receivables as $receivable)
                    @php
                        $client = json_decode($receivable->client);
                        $descriptions = json_decode($receivable->invoice_content)->description;
                    @endphp
                    <tr>
                        <td class="border border-black text-sm text-center align-center px-1">
                            {{ $loop->iteration }}
                        </td>
                        <td class="border border-black text-sm text-start align-center px-1">
                            @if (isset($client->company))
                                {{ $client->company }}
                            @else
                                {{ $client->name }}
                            @endif
                        </td>
                        <td class="border border-black text-sm text-start align-center px-1">
                            @foreach ($descriptions as $description)
                                @if ($description == end($descriptions))
                                    {{ substr($description->location, 0, 8) }}
                                @else
                                    {{ substr($description->location, 0, 8) }} |
                                @endif
                            @endforeach
                        </td>
                        <td class="border border-black text-sm text-center align-center px-1">
                            @if ($receivable->category == 'Media')
                                Media
                            @else
                                Revisual
                            @endif
                        </td>
                        <td class="border border-black text-sm text-center align-center px-1">
                            {{ $receivable->invoice_number }}
                        </td>
                        <td class="border border-black text-sm text-center align-center px-1">
                            {{ date('d-m-Y', strtotime($receivable->created_at)) }}
                        </td>
                        <td class="border border-black text-sm text-right align-center px-1">
                            @php
                                $billingNominal =
                                    $receivable->nominal + $receivable->ppn - ($receivable->dpp / 11) * 12 * (2 / 100);
                            @endphp
                            {{ number_format($billingNominal) }}
                        </td>
                        <td class="border border-black text-sm text-right align-center px-1">
                            {{ number_format($data_payments[$loop->iteration - 1]) }}
                        </td>
                        <td class="border border-black text-sm text-right align-center px-1">
                            {{ number_format($billingNominal - $data_payments[$loop->iteration - 1]) }}
                        </td>
                    </tr>
                @endforeach
                <tr>
                    <td class="border border-black text-md text-right align-center font-semibold px-2" colspan="6">
                        TOTAL
                    </td>
                    <td class="border border-black text-md text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($billing_nominals)) }}
                    </td>
                    <td class="border border-black text-md text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($data_payments)) }}
                    </td>
                    <td class="border border-black text-md text-right align-center font-semibold px-2">
                        {{ number_format(array_sum($billing_nominals) - array_sum($data_payments)) }}
                    </td>
                </tr>
            </tbody>
        </table>
    @endif
    <!-- Create Receivable Report end -->


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

        $(document).ready(function() {
            $('#btnExportExcel').on('click', function() {
                $('#exportExcelTable').table2excel({
                    filename: "List Piutang.xls"
                });
            });
        });
    </script>
    <!-- Script end -->
@endsection
