@extends('dashboard.layouts.main');

@section('container')
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
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex justify-center w-full">
                <div class="w-[1200px]">
                    <div class="flex  border-b">
                        @if (request('media_category_id'))
                            @if (request('media_category_id') == 'All')
                                <h1 class="index-h1"> DAFTAR PENJUALAN</h1>
                            @else
                                @if ($data_category->name == 'Service')
                                    <h1 class="index-h1">DAFTAR PENJUALAN CETAK / PASANG</h1>
                                @else
                                    <h1 class="index-h1">DAFTAR PENJUALAN {{ strtoupper($data_category->name) }}</h1>
                                @endif
                            @endif
                        @else
                            @if ($category == 'All')
                                <h1 class="index-h1"> DAFTAR PENJUALAN</h1>
                            @elseif ($category == 'Service')
                                <h1 class="index-h1">DAFTAR PENJUALAN CETAK / PASANG</h1>
                            @else
                                <h1 class="index-h1">DAFTAR PENJUALAN {{ strtoupper($category) }}</h1>
                            @endif
                        @endif
                        @if ($category == 'All')
                            @if (request('media_category_id') != '' && request('media_category_id') != 'All')
                                @canany(['isAdmin', 'isMarketing'])
                                    @can('isQuotation')
                                        @can('isMarketingCreate')
                                            <div>
                                                <a href="/marketing/sales/select-quotation/{{ $data_category->name }}/{{ $company->id }}"
                                                    class="index-link btn-primary">
                                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                    <span class="mx-1 flex">Tambah Data Penjualan</span>
                                                </a>
                                            </div>
                                        @endcan
                                    @endcan
                                @endcanany
                            @endif
                        @else
                            @canany(['isAdmin', 'isMarketing'])
                                @can('isQuotation')
                                    @can('isMarketingCreate')
                                        <div>
                                            <a href="/marketing/sales/select-quotation/{{ $category }}/{{ $company->id }}"
                                                class="index-link btn-primary">
                                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                    stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                        fill-rule="nonzero" />
                                                </svg>
                                                <span class="mx-1 flex">Tambah Data Penjualan</span>
                                            </a>
                                        </div>
                                    @endcan
                                @endcan
                            @endcanany
                        @endif
                    </div>
                    <form action="/marketing/sales/home/{{ $category }}/{{ $company->id }}">
                        @if (request('weekday'))
                            <input type="text" name="weekday" value="{{ request('weekday') }}" hidden>
                        @endif
                        @if (request('monthly'))
                            <input type="text" name="monthly" value="{{ request('monthly') }}" hidden>
                        @endif
                        @if (request('annual'))
                            <input type="text" name="annual" value="{{ request('annual') }}" hidden>
                        @endif
                        <div class="flex items-center mt-1">
                            @if ($category == 'All')
                                <div class="w-32">
                                    <span class="text-base text-stone-100">Katagori</span>
                                    <select class="w-full border rounded-lg text-sm p-1 text-teal-900 outline-none"
                                        name="media_category_id" id="media_category_id" onchange="submit()"
                                        value="{{ request('media_category_id') }}">
                                        <option value="All">All</option>
                                        @foreach ($categories as $dataCategory)
                                            @if (request('media_category_id') == $dataCategory->id)
                                                <option value="{{ $dataCategory->id }}" selected>
                                                    @if ($dataCategory->name == 'Service')
                                                        Cetak/Pasang
                                                    @else
                                                        {{ $dataCategory->name }}
                                                    @endif
                                                </option>
                                            @else
                                                <option value="{{ $dataCategory->id }}">
                                                    @if ($dataCategory->name == 'Service')
                                                        Cetak/Pasang
                                                    @else
                                                        {{ $dataCategory->name }}
                                                    @endif
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="ml-2 w-24">
                                <span class="text-base text-stone-100">Bulan</span>
                                <select name="month"
                                    class="p-1 outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                    onchange="submit()">
                                    <option value="All">All</option>
                                    @if (request('month'))
                                        @for ($i = 1; $i < 13; $i++)
                                            @if ($i == request('month'))
                                                <option value="{{ $i }}" selected>{{ $bulan[$i] }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $bulan[$i] }}</option>
                                            @endif
                                        @endfor
                                    @else
                                        @for ($i = 1; $i < 13; $i++)
                                            <option value="{{ $i }}">{{ $bulan[$i] }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                            <div class="ml-2 w-20">
                                <span class="text-base text-stone-100">Tahun</span>
                                <select name="year"
                                    class="p-1 text-center outline-none border w-full text-sm text-stone-900 rounded-md bg-stone-100"
                                    onchange="submit()">
                                    @if (request('year'))
                                        @for ($i = date('Y'); $i > date('Y') - 5; $i--)
                                            @if ($i == request('year'))
                                                <option value="{{ $i }}" selected>{{ $i }}</option>
                                            @else
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endif
                                        @endfor
                                    @else
                                        @for ($i = date('Y'); $i > date('Y') - 5; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    @endif
                                </select>
                            </div>
                            <div class="ml-2">
                                <span class="text-base text-stone-100">Pencarian</span>
                                <div class="flex">
                                    <input id="search" name="search"
                                        class="border text-sm rounded-l-lg p-1 outline-none text-teal-900" type="text"
                                        placeholder="Search" value="{{ request('search') }}" onkeyup="submit()"
                                        onfocus="this.setSelectionRange(this.value.length, this.value.length);" autofocus>
                                    <button
                                        class="flex border text-sm rounded-r-lg text-stone-900 items-center justify-center w-10 bg-stone-100"
                                        type="submit">
                                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                        @if (session()->has('success'))
                            <div class="mt-2 flex alert-success">
                                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                </svg>
                                <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                            </div>
                        @elseif (session()->has('order_success'))
                            <div class="ml-2 flex alert-success">
                                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                </svg>
                                <span class="font-semibold mx-1">Success!</span> {{ session('order_success') }}
                            </div>
                        @elseif (session()->has('agreement_success'))
                            <div class="ml-2 flex alert-success">
                                <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                    <path
                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                                </svg>
                                <span class="font-semibold mx-1">Success!</span> {{ session('agreement_success') }}
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="flex justify-center">
                <div class="w-[1200px] overflow-x-scroll overflow-y-auto bg-stone-300">
                    <table class="table-auto w-max mb-6">
                        <thead class="sticky top-0 z-10">
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-6"
                                    rowspan="2">No.</th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-44 text-center"
                                    rowspan="2">
                                    <button class="flex justify-center items-center w-44">@sortablelink('number', 'Data Penjualan')
                                        <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                            viewBox="0 0 24 24">
                                            <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                        </svg>
                                    </button>
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-60"
                                    rowspan="2">Data
                                    Reklame
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-64"
                                    rowspan="2">Klien</th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-36"
                                    rowspan="2">Deskripsi
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-48"
                                    rowspan="2">Penawaran
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-36"
                                    rowspan="2">Harga
                                    (Rp.)
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem]"
                                    colspan="5">
                                    Termin
                                    Pembayaran</th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem]"
                                    colspan="3">Penagihan
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem]"
                                    colspan="2">Pembayaran
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-16"
                                    rowspan="2">Dokumen
                                    Approval</th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-16"
                                    rowspan="2">Dokumen
                                    PO/SPK
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-16"
                                    rowspan="2">Dokumen
                                    Agreement
                                </th>
                                <th class="text-stone-900 sticky border-stone-900 top-0 border text-[0.65rem] w-16"
                                    rowspan="2">Action
                                </th>
                            </tr>
                            <tr class="bg-stone-400">
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-10">Termin</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-[72px]">Nominal</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-16">PPN</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-14">PPh</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-20">Total</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-20">No. Invoice</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-20">Tgl. Invoice</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-[72px]">Nominal</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-12">Status</th>
                                <th class="text-stone-900 border border-stone-900 text-[0.65rem] w-20">Tgl. Bayar</th>
                            </tr>
                        </thead>
                        <tbody class="bg-stone-300">
                            @php
                                $index = 1 + ($sales->currentPage() - 1) * $sales->perPage();
                            @endphp
                            @foreach ($sales as $sale)
                                @php
                                    $quotId = null;
                                    $quotRevisionId = null;
                                    $created_by = json_decode($sale->created_by);
                                    $revisions = $sale->quotation->quotation_revisions;

                                    if (count($revisions) != 0) {
                                        $revision =
                                            $sale->quotation->quotation_revisions[
                                                count($sale->quotation->quotation_revisions) - 1
                                            ];
                                        $number = $revision->number;
                                        $quotRevisionId = $revision->id;
                                        $notes = json_decode($revision->notes);
                                        $created_at = $revision->created_at;
                                        $payment_terms = json_decode($revision->payment_terms);
                                        $price = json_decode($revision->price);
                                        $dataApprovals = $sale->quotation->quotation_approvals;
                                        $dataAgreements = $sale->quotation_agreements;
                                        $dataOrders = $sale->quotation_orders;
                                    } else {
                                        $number = $sale->quotation->number;
                                        $quotId = $sale->quotation->id;
                                        $notes = json_decode($sale->quotation->notes);
                                        $created_at = $sale->quotation->created_at;
                                        $payment_terms = json_decode($sale->quotation->payment_terms);
                                        $price = json_decode($sale->quotation->price);
                                        $dataApprovals = $sale->quotation->quotation_approvals;
                                        $dataAgreements = $sale->quotation_agreements;
                                        $dataOrders = $sale->quotation_orders;
                                    }
                                    $clients = json_decode($sale->quotation->clients);
                                    $product = json_decode($sale->product);
                                    $description = json_decode($product->description);
                                    $saleBillings = $sale->billings;
                                @endphp
                                <tr>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        {{ $index++ }}
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-6">No.</label>
                                                <label>:</label>
                                                <label class="ml-1">{{ $sale->number }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-6">Tgl.</label>
                                                <label>:</label>
                                                <label class="ml-1">
                                                    {{ date('d', strtotime($sale->created_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                                                    {{ date('Y', strtotime($sale->created_at)) }}
                                                </label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-6">Oleh</label>
                                                <label>:</label>
                                                <label class="ml-1">{{ $created_by->name }}</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-8">Kode</label>
                                                <label>:</label>
                                                <a class="mx-1 w-48"
                                                    href="/media/locations/{{ $product->id }}">{{ $product->code }}-{{ $product->city_code }}</a>
                                                {{-- <label class="mx-1 w-48">{{ $product->code }}</label> --}}
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-8">Lokasi</label>
                                                <label>:</label>
                                                <label class="mx-1 w-48">{{ $product->address }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-8">Size</label>
                                                <label>:</label>
                                                <label class="mx-1 w-48">{{ $product->size }}</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-14">Klien</label>
                                                <label>:</label>
                                                <a class="ml-1 w-40"
                                                    href="/marketing/clients/{{ $clients->id }}">{{ $clients->name }}</a>
                                            </div>
                                            @if ($clients->type == 'Perusahaan')
                                                <div class="flex ml-1">
                                                    <label class="w-14">Perusahaan</label>
                                                    <label>:</label>
                                                    <label class="ml-1 w-40">{{ $clients->company }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-14">Kontak</label>
                                                    <label>:</label>
                                                    <label class="ml-1 w-40">{{ $clients->contact_name }}</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-14">No. Hp</label>
                                                    <label>:</label>
                                                    <label class="ml-1 w-40">{{ $clients->contact_phone }}</label>
                                                </div>
                                            @else
                                                <div class="flex ml-1">
                                                    <label class="w-14">No. Hp</label>
                                                    <label>:</label>
                                                    <label class="ml-1 w-40">{{ $clients->phone }}</label>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-start align-top">
                                        <div>
                                            @if ($sale->media_category->name == 'Service')
                                                @if ($price->objServiceType->print == true)
                                                    <div class="flex ml-1">
                                                        <label class="w-10">Jenis</label>
                                                        <label>:</label>
                                                        <label class="ml-1">Cetak</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-10">Bahan</label>
                                                        <label>:</label>
                                                        <label class="ml-1">
                                                            @foreach ($price->objPrints as $objPrint)
                                                                @if ($objPrint->code == $product->code)
                                                                    {{ $objPrint->printProduct }}
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                @endif
                                                @if ($price->objServiceType->install == true)
                                                    <div class="flex ml-1 mt-2">
                                                        <label class="w-10">Jenis</label>
                                                        <label>:</label>
                                                        <label class="ml-1">Pasang</label>
                                                    </div>
                                                    <div class="flex ml-1">
                                                        <label class="w-10">Bahan</label>
                                                        <label>:</label>
                                                        <label class="ml-1">
                                                            @foreach ($price->objInstalls as $objInstall)
                                                                @if ($objInstall->code == $product->code)
                                                                    {{ $objInstall->type }}
                                                                @endif
                                                            @endforeach
                                                        </label>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="flex ml-1">
                                                    <label class="w-10">Jenis</label>
                                                    <label>:</label>
                                                    <label class="ml-1">{{ $product->category }}</label>
                                                </div>
                                                @if ($product->category == 'Signage')
                                                    <div class="flex ml-1">
                                                        <label class="w-10">Bentuk</label>
                                                        <label>:</label>
                                                        <label class="ml-1">{{ $description->type }}</label>
                                                    </div>
                                                @endif
                                                <div class="flex ml-1">
                                                    <label class="w-10">Periode</label>
                                                    <label>:</label>
                                                    <label class="ml-1">{{ $sale->duration }}</label>
                                                </div>
                                                <form class="flex items-center"
                                                    action="/marketing/sales/{{ $sale->id }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <input type="text" name="company_id" value="{{ $company->id }}"
                                                        hidden>
                                                    <div>
                                                        <div class="flex ml-1">
                                                            <label class="w-10">Awal</label>
                                                            <label>:</label>
                                                            @if ($sale->start_at)
                                                                <label
                                                                    class="ml-1">{{ date('d-M-Y', strtotime($sale->start_at)) }}</label>
                                                            @else
                                                                @if (session()->has('failed') && session()->has('id'))
                                                                    @if (session('id') == $sale->id)
                                                                        <input
                                                                            class="text-[0.65rem] text-stone-900 ml-1 outline-none border rounded-md w-20"
                                                                            type="date" name="start_at" autofocus>
                                                                    @endif
                                                                @else
                                                                    <input
                                                                        class="text-[0.65rem] text-stone-900 ml-1 outline-none border rounded-md w-20"
                                                                        type="date" name="start_at">
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <div class="flex ml-1">
                                                            <label class="w-10">Akhir</label>
                                                            <label>:</label>
                                                            @if ($sale->end_at)
                                                                <label
                                                                    class="ml-1">{{ date('d-M-Y', strtotime($sale->end_at)) }}</label>
                                                            @else
                                                                <input
                                                                    class="text-[0.65rem] text-stone-900 ml-1 outline-none border rounded-md w-20"
                                                                    type="date" name="end_at">
                                                            @endif
                                                        </div>
                                                        <input type="text" name="category"
                                                            value="{{ $category }}" hidden>
                                                        <input type="text" name="sales_id"
                                                            value="{{ $sale->id }}" hidden>
                                                    </div>
                                                    @if ($sale->start_at == null || $sale->end_at == null)
                                                        <div class="ml-2">
                                                            <button
                                                                class="index-link text-white w-8 h-5 rounded bg-green-700 hover:bg-green-900 drop-shadow-md mr-1"
                                                                onclick="return confirm('Apakah anda yakin ingin update data penjualan {{ $sale->number }} ?')"
                                                                title="Update" type="submit">
                                                                <svg class="fill-current w-4" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 20l-1.359-2.038c-1.061.653-2.305 1.038-3.641 1.038-3.859 0-7-3.14-7-7h2c0 2.757 2.243 5 5 5 .927 0 1.786-.264 2.527-.708l-1.527-2.292h5.719l-1.719 6zm0-8c0-2.757-2.243-5-5-5-.927 0-1.786.264-2.527.708l1.527 2.292h-5.719l1.719-6 1.359 2.038c1.061-.653 2.305-1.038 3.641-1.038 3.859 0 7 3.14 7 7h-2z" />
                                                                </svg>
                                                            </button>
                                                        </div>
                                                    @endif
                                                </form>
                                            @endif
                                            @if (session()->has('failed') && session()->has('id'))
                                                @if (session('id') == $sale->id)
                                                    <div class="invalid-feedback">
                                                        {{ session('failed') }}
                                                    </div>
                                                @endif
                                            @endif
                                            @if (session()->has('success') && session()->has('id'))
                                                @if (session('id') == $sale->id)
                                                    <div class="success-feedback">
                                                        {{ session('success') }}
                                                    </div>
                                                @endif
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-5">No.</label>
                                                <label>:</label>
                                                @if ($quotId != 0)
                                                    <a class="ml-1"
                                                        href="/marketing/quotations/{{ $quotId }}">{{ $number }}</a>
                                                @elseif ($quotRevisionId != 0)
                                                    <a class="ml-1"
                                                        href="/marketing/quotation-revisions/{{ $quotRevisionId }}">{{ $number }}</a>
                                                @endif
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-5">Tgl.</label>
                                                <label>:</label>
                                                <label class="ml-1">{{ date('d-M-Y', strtotime($created_at)) }}</label>
                                            </div>
                                            @if (
                                                ($sale->media_category->name != 'Videotron' && $sale->media_category->name != 'Service') ||
                                                    ($sale->media_category->name == 'Signage' && $description->type != 'Videotron'))
                                                <div class="flex ml-1">
                                                    <label class="w-14">Free Cetak</label>
                                                    <label>:</label>
                                                    <label class="ml-1">{{ $notes->freePrint }} x</label>
                                                </div>
                                                <div class="flex ml-1">
                                                    <label class="w-14">Free Pasang</label>
                                                    <label>:</label>
                                                    <label class="ml-1">{{ $notes->freeInstall }} x</label>
                                                </div>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="text-stone-900 border border-stone-900 text-[0.65rem] text-start align-top">
                                        <div>
                                            <div class="flex ml-1">
                                                <label class="w-12">Harga</label>
                                                <label>:</label>
                                                <label
                                                    class="w-[72px] text-right">{{ number_format($sale->price) }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-12">DPP</label>
                                                <label>:</label>
                                                <label class="w-[72px] text-right">{{ number_format($sale->dpp) }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-12">PPN {{ $sale->ppn }}%</label>
                                                <label>:</label>
                                                <label
                                                    class="w-[72px] text-right">{{ number_format($sale->dpp * ($sale->ppn / 100)) }}</label>
                                            </div>
                                            <div class="flex ml-1">
                                                <label class="w-12">PPh {{ $sale->pph }}%</label>
                                                <label>:</label>
                                                <label
                                                    class="w-[72px] text-right">{{ number_format($sale->dpp * ($sale->pph / 100)) }}</label>
                                            </div>
                                            <div class="flex ml-1 border-t border-stone-900">
                                                <label class="w-12 font-semibold">Total</label>
                                                <label>:</label>
                                                <label
                                                    class="w-[72px] text-right font-semibold">{{ number_format($sale->price + $sale->dpp * ($sale->ppn / 100) - $sale->dpp * ($sale->pph / 100)) }}</label>
                                            </div>
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($payment_terms->dataPayments as $payment)
                                                <div class="flex ml-1 justify-center">
                                                    <label>{{ $payment->term }} %</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($payment_terms->dataPayments as $payment)
                                                <div class="flex mx-1 justify-end">
                                                    <label>{{ number_format($sale->price * ($payment->term / 100)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($payment_terms->dataPayments as $payment)
                                                <div class="flex mx-1 justify-end">
                                                    <label>{{ number_format($sale->dpp * ($payment->term / 100) * ($sale->ppn / 100)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($payment_terms->dataPayments as $payment)
                                                <div class="flex mx-1 justify-end">
                                                    <label>{{ number_format($sale->dpp * ($payment->term / 100) * ($sale->pph / 100)) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($payment_terms->dataPayments as $payment)
                                                <div class="flex mx-1 justify-end">
                                                    @if ($sale->dpp)
                                                        @php
                                                            $subTotal = $sale->price * ($payment->term / 100);
                                                            $ppnTerm =
                                                                $sale->dpp *
                                                                ($payment->term / 100) *
                                                                ($sale->ppn / 100);
                                                            $pphTerm =
                                                                $sale->dpp *
                                                                ($payment->term / 100) *
                                                                ($sale->pph / 100);
                                                        @endphp
                                                        <label>{{ number_format($subTotal + $ppnTerm - $pphTerm) }}</label>
                                                    @else
                                                        <label>{{ number_format($sale->price * ($payment->term / 100)) }}</label>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($sale->billings as $itemBilling)
                                                <a
                                                    href="/accounting/billings/{{ $itemBilling->id }}">{{ substr($itemBilling->invoice_number, 0, 3) }}/...-{{ substr($itemBilling->invoice_number, -4) }}</a>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($sale->billings as $itemBilling)
                                                <span>{{ date('d', strtotime($itemBilling->created_at)) }}-{{ $sMonth[(int) date('m', strtotime($itemBilling->created_at))] }}-{{ date('Y', strtotime($itemBilling->created_at)) }}</span>
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @if ($sale->media_category->name == 'Service')
                                                @foreach ($saleBillings as $itemBilling)
                                                    @foreach (json_decode($itemBilling->invoice_content)->description as $itemDescription)
                                                        @if ($itemDescription->sale_id == $sale->id)
                                                            {{ number_format($itemDescription->nominal + ($sale->ppn / 100) * $itemDescription->nominal) }}
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @else
                                                @foreach ($saleBillings as $itemBilling)
                                                    @foreach (json_decode($itemBilling->invoice_content)->data_sales as $itemSales)
                                                        @if ($itemSales->id == $sale->id)
                                                            {{ number_format($itemSales->nominal + ($sale->ppn / 100) * $itemSales->nominal) }}
                                                        @endif
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                        <div>
                                            @foreach ($saleBillings as $itemBilling)
                                                Unpaid
                                            @endforeach
                                        </div>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-top">
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-center">
                                        {{ count($dataApprovals) }} dokumen
                                        <a href="/marketing/quotation-approvals/show-approvals/{{ $category }}/{{ $sale->quotation->id }}"
                                            title="Lihat Dokumen"
                                            class="flex items-center px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md">
                                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="text-sm ml-1">Lihat</span>
                                        </a>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-center">
                                        {{ count($dataOrders) }} dokumen
                                        <a href="/marketing/quotation-orders/show-orders/{{ $category }}/{{ $sale->id }}"
                                            title="Lihat Dokumen"
                                            class="flex items-center px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md">
                                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="text-sm ml-1">Lihat</span>
                                        </a>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-center">
                                        {{ count($dataAgreements) }} dokumen
                                        <a href="/marketing/quotation-agreements/show-agreements/{{ $category }}/{{ $sale->id }}"
                                            title="Lihat Dokumen"
                                            class="flex items-center px-1 w-20 h-5 bg-teal-500 rounded-md text-white hover:bg-teal-600 drop-shadow-md">
                                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm.002 3c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c1.38 0 2.5 1.12 2.5 2.5s-1.12 2.5-2.5 2.5-2.5-1.12-2.5-2.5 1.12-2.5 2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                            <span class="text-sm ml-1">Lihat</span>
                                        </a>
                                    </td>
                                    <td
                                        class="text-stone-900 border border-stone-900 text-[0.65rem] text-center align-center">
                                        <div class="flex justify-center items-center">
                                            <div>
                                                <a href="/marketing/sales/{{ $sale->id }}"
                                                    class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mt-1"
                                                    title="Menampilkan">
                                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                            fill-rule="nonzero" />
                                                    </svg>
                                                </a>
                                                @canany(['isAdmin', 'isMarketing'])
                                                    @can('isQuotation')
                                                        @can('isMarketingEdit')
                                                            @if (
                                                                $sale->void_sale ||
                                                                    $sale->change_sale ||
                                                                    ($sale->media_category->name != 'Service' && $sale->end_at < date('Y-m-d')))
                                                                <a href="#" title="Merubah"
                                                                    class="index-link w-8 h-5 rounded bg-slate-500 text-slate-300 drop-shadow-md mt-1">
                                                                    <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                            fill-rule="nonzero" />
                                                                    </svg>
                                                                </a>
                                                            @else
                                                                <a href="/change-sales/create/{{ $sale->id }}" title="Merubah"
                                                                    class="index-link text-white w-8 h-5 rounded bg-amber-400 hover:bg-amber-500 drop-shadow-md mt-1">
                                                                    <svg class="fill-current w-[18px]" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                                                            fill-rule="nonzero" />
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                        @endcan
                                                    @endcan
                                                @endcanany
                                                @canany(['isAdmin', 'isMarketing'])
                                                    @can('isQuotation')
                                                        @can('isMarketingDelete')
                                                            @if (
                                                                $sale->void_sale ||
                                                                    $sale->change_sale ||
                                                                    ($sale->media_category->name != 'Service' && $sale->end_at < date('Y-m-d')))
                                                                <a href="#"
                                                                    class="index-link w-8 h-5 rounded bg-slate-500 text-slate-300 drop-shadow-md mt-1"
                                                                    title="Membatalkan">
                                                                    <svg class="fill-current w-5" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                            fill-rule="nonzero" />
                                                                    </svg>
                                                                </a>
                                                            @else
                                                                <a href="/void-sales/create/{{ $sale->id }}"
                                                                    class="index-link text-white w-8 h-5 rounded bg-red-600 hover:bg-red-700 drop-shadow-md mt-1"
                                                                    title="Membatalkan">
                                                                    <svg class="fill-current w-5" clip-rule="evenodd"
                                                                        fill-rule="evenodd" stroke-linejoin="round"
                                                                        stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                        xmlns="http://www.w3.org/2000/svg">
                                                                        <path
                                                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                            fill-rule="nonzero" />
                                                                    </svg>
                                                                </a>
                                                            @endif
                                                        @endcan
                                                    @endcan
                                                @endcanany
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @if (count($sales) == 0)
                <div class="flex justify-center items-center h-16 text-amber-500">
                    ~~ Tidak ada data penjualan ~~
                </div>
            @endif
            <div class="flex justify-center text-stone-100 mt-2">
                {!! $sales->appends(Request::query())->render('dashboard.layouts.pagination') !!}
            </div>
        </div>
    </div>

    <!-- Script start -->
    <!-- Script end -->
@endsection
