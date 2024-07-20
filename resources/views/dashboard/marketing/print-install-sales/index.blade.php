@extends('dashboard.layouts.main');

@section('container')
    <?php
    $month = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    ?>
    <div id="test"></div>
    <div class="mt-10 min-h-[1600px] z-0">
        <div class="flex justify-center w-full">
            <div class="w-[1200px] p-2">
                <div class="flex">
                    <h1 class="index-h1"> Daftar Penjualan Cetak dan Pasang</h1>
                    <div class="flex border-b">
                        <button id="btnAdd" class="index-link btn-primary">
                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm0 1.5c-4.69 0-8.497 3.808-8.497 8.498s3.807 8.497 8.497 8.497 8.498-3.807 8.498-8.497-3.808-8.498-8.498-8.498zm-.747 7.75h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                    fill-rule="nonzero" />
                            </svg>
                            <span class="mx-1">Tambah Penjualan</span>
                        </button>
                    </div>
                </div>
                <form class="flex mt-2" action="/dashboard/marketing/sales/">
                    <div class="flex">
                        <input id="search" name="search"
                            class="flex border rounded-l-lg ml-2 p-1 outline-none text-base text-teal-900" type="text"
                            placeholder="Search" value="{{ request('search') }}">
                        <button class="flex border p-1 rounded-r-lg text-slate-700 justify-center w-10 bg-slate-50"
                            type="submit">
                            <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path
                                    d="M23.809 21.646l-6.205-6.205c1.167-1.605 1.857-3.579 1.857-5.711 0-5.365-4.365-9.73-9.731-9.73-5.365 0-9.73 4.365-9.73 9.73 0 5.366 4.365 9.73 9.73 9.73 2.034 0 3.923-.627 5.487-1.698l6.238 6.238 2.354-2.354zm-20.955-11.916c0-3.792 3.085-6.877 6.877-6.877s6.877 3.085 6.877 6.877-3.085 6.877-6.877 6.877c-3.793 0-6.877-3.085-6.877-6.877z" />
                            </svg>
                        </button>
                    </div>
                    @if (session()->has('success'))
                        <div class="ml-2 flex alert-success">
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
                    @endif
                </form>
            </div>
        </div>
        <div class="flex justify-center px-2 pb-8 w-full z-0">
            <div class="w-[1200px] overflow-x-scroll h-[450px] overflow-y-auto">
                <table class="table-auto w-max mb-6">
                    <thead class="sticky top-0 z-10">
                        <tr class="bg-teal-100">
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-6" rowspan="2">No.</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-52 text-center" rowspan="2">
                                <button class="flex justify-center items-center w-52">@sortablelink('number', 'Data Penjualan')
                                    <svg class="fill-current w-3 ml-1" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 24 24">
                                        <path d="M12 0l8 10h-16l8-10zm8 14h-16l8 10 8-10z" />
                                    </svg>
                                </button>
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-44" rowspan="2">Data Reklame
                            </th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-52" rowspan="2">Klien</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-48" rowspan="2">Penawaran</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-[360px]" colspan="5">Termin
                                Pembayaran</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" colspan="2">Penagihan</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-40" colspan="2">Pembayaran</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">Approval</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">PO/SPK</th>
                            <th class="text-teal-700 sticky top-0 border text-[0.65rem] w-16" rowspan="2">Action</th>
                        </tr>
                        <tr class="bg-teal-100">
                            <th class="text-teal-700 border text-[0.65rem] w-10">Termin</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Nominal (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">PPN (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">PPh (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Total (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">No. Invoice</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Tgl. Invoice</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Nominal (Rp.)</th>
                            <th class="text-teal-700 border text-[0.65rem] w-20">Tgl. Bayar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($print_install_sales as $sale)
                            <?php
                            $products = json_decode($sale->products);
                            $totalPrint = $products->print_price * $products->wide;
                            $totalInstall = $products->install_price * $products->wide;
                            $subTotal = $totalPrint + $totalInstall;
                            $ppn = ($subTotal * 11) / 100;
                            $pph = ($subTotal * 2) / 100;
                            $grandTotal = $subTotal + $ppn - $pph;
                            ?>
                            <tr>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">{{ $loop->iteration }}
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-6">No.</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->number }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-6">Tgl.</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ date('j', strtotime($sale->created_at)) }}
                                                {{ $month[(int) date('m', strtotime($sale->created_at))] }}
                                                {{ date('Y', strtotime($sale->created_at)) }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-6">Oleh</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->user->name }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Kode</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-32">{{ $products->billboard_code }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Lokasi</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-32">{{ $sale->billboard->address }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-8">Size</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-32">{{ $sale->billboard->size->size }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-14">Klien</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-36">{{ $sale->client->name }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-14">Perusahaan</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-36">{{ $sale->client->company }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-14">Kontak</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2 w-36">{{ $sale->contact->name }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-start align-top">
                                    <div>
                                        <div class="flex ml-1">
                                            <label class="w-5">No.</label>
                                            <label class="ml-1">:</label>
                                            <label class="ml-2">{{ $sale->print_instal_quotation->number }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-5">Tgl.</label>
                                            <label class="ml-1">:</label>
                                            <label
                                                class="ml-2">{{ date('j', strtotime($sale->print_instal_quotation->created_at)) }}
                                                {{ $month[(int) date('m', strtotime($sale->print_instal_quotation->created_at))] }}
                                                {{ date('Y', strtotime($sale->print_instal_quotation->created_at)) }}</label>
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-16">Harga Cetak</label>
                                            <label class="ml-1">:</label>
                                            @if ($products->print == true)
                                                <label class="ml-2">{{ number_format($totalPrint) }}</label>
                                            @else
                                                <label class="ml-2">Free ke {{ $products->used_print + 1 }} dari
                                                    {{ $products->free_print }}</label>
                                            @endif
                                        </div>
                                        <div class="flex ml-1">
                                            <label class="w-16">Harga Pasang</label>
                                            <label class="ml-1">:</label>
                                            @if ($products->install == true)
                                                <label class="ml-2">{{ number_format($totalInstall) }}</label>
                                            @else
                                                <label class="ml-2">Free ke {{ $products->used_install + 1 }} dari
                                                    {{ $products->free_install }}</label>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                    <div>
                                        @for ($i = 0; $i < count($products->paymentTerms); $i++)
                                            <div class="flex ml-1 justify-center">
                                                <label>{{ $products->paymentTerms[$i] }} %</label>
                                            </div>
                                        @endfor
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                    <div>
                                        <div class="flex mr-1 justify-end">
                                            <label>{{ number_format($subTotal) }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                    <div>
                                        <div class="flex mr-1 justify-end">
                                            <label>{{ number_format($ppn) }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                    <div>
                                        <div class="flex mr-1 justify-end">
                                            <label>{{ number_format($pph) }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top">
                                    <div>
                                        <div class="flex mr-1 justify-end">
                                            <label>{{ number_format($grandTotal) }}</label>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-top"></td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                    <div class="flex items-center justify-center">
                                        <button class="btn-sale" id="btnApproval" type="button"
                                            onclick="previewAppovalImage('{{ $sale->print_instal_quotation_id }}')">
                                            <span class="text-sm mx-2">view</span>
                                        </button>
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem]">
                                    <div class="flex items-center justify-center">
                                        @if (count($sale->print_instal_quotation->print_install_orders) == 0)
                                            <button class="btn-sale flex justify-center" id="btnPO" type="button"
                                                onclick="btnPOEvent()">
                                                <span id="spanBtnPO" class="text-sm mx-2">add</span>
                                            </button>
                                        @else
                                            <button class="btn-sale flex justify-center" id="btnViewPO" type="button"
                                                onclick="previewOrderImage('{{ $sale->print_instal_quotation_id }}')">
                                                <span id="spanBtnViewPO" class="text-sm mx-2">view</span>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-teal-700 border text-[0.65rem] text-center align-center">
                                    <div class="flex justify-center">
                                        <a href="/dashboard/marketing/print-install-sales/{{ $sale->id }}"
                                            class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mr-1"
                                            title="Show">
                                            <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m11.998 5c-4.078 0-7.742 3.093-9.853 6.483-.096.159-.145.338-.145.517s.048.358.144.517c2.112 3.39 5.776 6.483 9.854 6.483 4.143 0 7.796-3.09 9.864-6.493.092-.156.138-.332.138-.507s-.046-.351-.138-.507c-2.068-3.403-5.721-6.493-9.864-6.493zm8.413 7c-1.837 2.878-4.897 5.5-8.413 5.5-3.465 0-6.532-2.632-8.404-5.5 1.871-2.868 4.939-5.5 8.404-5.5 3.518 0 6.579 2.624 8.413 5.5zm-8.411-4c2.208 0 4 1.792 4 4s-1.792 4-4 4-4-1.792-4-4 1.792-4 4-4zm0 1.5c-1.38 0-2.5 1.12-2.5 2.5s1.12 2.5 2.5 2.5 2.5-1.12 2.5-2.5-1.12-2.5-2.5-2.5z"
                                                    fill-rule="nonzero" />
                                            </svg>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="flex justify-center text-teal-900">
            {{ $print_install_sales->links() }}
        </div>
    </div>

    @include('dashboard.layouts.print-install-approvals')

    @include('dashboard.layouts.add-print-install-orders')

    @include('dashboard.layouts.view-print-install-orders')

    <div id="modal" name="modal"
        class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
        <div>
            <div class="flex mt-10">
                <div class="flex w-[788px] justify-end">
                    <button id="btnClose" class="flex" title="Close" type="button">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="w-[800px] h-max bg-white mt-2 p-4 mb-96">
                <div class="flex justify-center">
                    <label class="text-teal-700 text-lg border-b font-semibold flex">DAFTAR PENAWARAN YANG TELAH
                        DISETUJUI</label>
                </div>
                <div class="flex justify-center mt-4">
                    <table class="table-auto w-max">
                        <thead>
                            <tr class="bg-teal-100">
                                <th class="text-teal-700 border text-sm w-8">No.</th>
                                <th class="text-teal-700 border text-sm w-60">No. Penawaran</th>
                                <th class="text-teal-700 border text-sm w-24">Tgl. Dibuat</th>
                                <th class="text-teal-700 border text-sm w-20">Status</th>
                                <th class="text-teal-700 border text-sm w-24">Tgl. Disetujui</th>
                                <th class="text-teal-700 border text-sm w-20">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $quotNumber = 0;
                            ?>
                            @foreach ($print_install_quotations as $quotation)
                                @foreach ($print_install_statuses as $status)
                                    @if ($quotation->id == $status->print_instal_quotation_id && $status->status == 'Deal')
                                        <?php
                                        $inputed = false;
                                        $dealAt = $status->created_at;
                                        ?>
                                        @foreach ($print_install_sales as $sale)
                                            @if ($sale->print_instal_quotation_id == $quotation->id)
                                                <?php
                                                $inputed = true;
                                                ?>
                                            @endif
                                        @endforeach
                                        @if ($inputed == false)
                                            <?php
                                            $quotNumber++;
                                            ?>
                                            <tr>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $quotNumber }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $quotation->number }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ date('j', strtotime($quotation->created_at)) }}
                                                    {{ $month[(int) date('m', strtotime($quotation->created_at))] }}
                                                    {{ date('Y', strtotime($quotation->created_at)) }}</td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ $status->status }}
                                                </td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    {{ date('j', strtotime($dealAt)) }}
                                                    {{ $month[(int) date('m', strtotime($dealAt))] }}
                                                    {{ date('Y', strtotime($dealAt)) }}</td>
                                                <td class="text-teal-700 border text-sm text-center">
                                                    <div class="flex justify-center">
                                                        <a href="/dashboard/marketing/print-install-sales/create-sales/{{ $quotation->id }}"
                                                            class="index-link text-white w-8 h-5 rounded bg-teal-500 hover:bg-teal-600 drop-shadow-md mr-1"
                                                            title="Choose">
                                                            <svg class="fill-current w-4" clip-rule="evenodd"
                                                                fill-rule="evenodd" stroke-linejoin="round"
                                                                stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                xmlns="http://www.w3.org/2000/svg">
                                                                <path
                                                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 17.292l-4.5-4.364 1.857-1.858 2.643 2.506 5.643-5.784 1.857 1.857-7.5 7.643z" />
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Script start -->
    <script src="/js/printinstallapprovals.js"></script>
    <script src="/js/addprintinstallorders.js"></script>
    <script src="/js/viewprintinstallorders.js"></script>

    <script>
        const modal = document.getElementById("modal");
        const btnClose = document.getElementById("btnClose");
        const btnAdd = document.getElementById("btnAdd");

        btnClose.addEventListener('click', function() {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        })

        btnAdd.addEventListener('click', () => {
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        })
    </script>
    <!-- Script end -->
@endsection
