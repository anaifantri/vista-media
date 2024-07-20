@extends('dashboard.layouts.main');

@section('container')
    <!-- Preview Print Install Sale start -->
    <div class="flex justify-center bg-black h-max">
        <div class="mt-10">
            <!-- Title Preview Print Install Sale start -->
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Save"
                    type="button">
                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                    </svg>
                    <span class="ml-2 text-white">Save PDF</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/dashboard/marketing/print-install-sales">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                </a>
                @if (session()->has('success'))
                    <div
                        class="ml-2 flex text-white text-sm items-center rounded-lg border border-white bg-green-700 drop-shadow-xl shadow-inner w-max h-8 p-2">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                        </svg>
                        <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                    </div>
                @endif
            </div>
            <!-- Title Preview Print Install Sale end -->
            <div>
                @foreach ($print_install_sales as $sale)
                    <?php
                    $searchDate = strtotime(request('search'));
                    $month = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                    $products = json_decode($sale->products);
                    $totalPrint = $products->wide * $products->print_price;
                    $totalInstall = $products->wide * $products->install_price;
                    $subTotal = $totalPrint + $totalInstall;
                    $ppn = ($subTotal * 11) / 100;
                    $grandTotal = $subTotal + $ppn;
                    ?>
                    <div id="pdfPreview" class="w-[950px] h-[1345px] mt-2 bg-white">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <label class="sale-label-title">DATA PENJUALAN CETAK & PASANG</label>
                            </div>
                            <div class="body-detail">
                                <div class="sale-detail">
                                    <div class="div-sale">
                                        <label class="label-sale-01">No. Penjualan</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->number }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Tgl. Penjualan</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ date('j', strtotime($sale->created_at)) }}
                                            {{ $month[(int) date('m', strtotime($sale->created_at))] }}
                                            {{ date('Y', strtotime($sale->created_at)) }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Dok. Approval</label>
                                        <label class="label-sale-02">:</label>
                                        <label id="approvalDocuments"
                                            class="label-sale-02 ml-2">{{ count($print_install_approvals) }}
                                            documents</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Dok. PO/SPK</label>
                                        <label class="label-sale-02">:</label>
                                        <label id="orderDocuments"
                                            class="label-sale-02 ml-2">{{ count($print_install_orders) }} documents</label>
                                    </div>
                                </div>
                                <div class="sale-detail ml-4">
                                    <div class="div-sale">
                                        <label class="label-sale-01">No. Penawaran</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->print_instal_quotation->number }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Tgl. Penawaran</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">
                                            {{ date('j', strtotime($sale->print_instal_quotation->created_at)) }}
                                            {{ $month[(int) date('m', strtotime($sale->print_instal_quotation->created_at))] }}
                                            {{ date('Y', strtotime($sale->print_instal_quotation->created_at)) }}
                                        </label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Nama Klien</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->client->name }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Perusahaan</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->client->company }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Alamat</label>
                                        <label class="label-sale-02">:</label>
                                        <textarea class="label-sale-02 w-60 outline-none" rows="2" readonly>{{ $sale->client->address }}</textarea>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Kontak Person</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->contact->name }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">No. Hp</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->contact->phone }}</label>
                                    </div>
                                    <div class="div-sale">
                                        <label class="label-sale-01">Email</label>
                                        <label class="label-sale-02">:</label>
                                        <label class="label-sale-02">{{ $sale->contact->email }}</label>
                                    </div>
                                </div>
                            </div>
                            <!-- sale data table start -->
                            <div>
                                <div class="flex justify-center mt-4">
                                    <div class="w-[785px]">
                                        <table id="billboardTable" class="table-fix mt-2 w-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                                    <th class="text-xs text-teal-700 border w-16" rowspan="2">Jenis
                                                    </th>
                                                    <th class="text-xs text-teal-700 border" colspan="2">Lokasi</th>
                                                    <th class="text-xs text-teal-700 border w-[300px]" colspan="4">
                                                        Deskripsi
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-xs text-teal-700 border w-20">Kode</th>
                                                    <th class="text-xs text-teal-700 border">Alamat</th>
                                                    <th class="text-xs text-teal-700 border w-28">Bahan</th>
                                                    <th class="text-xs text-teal-700 border w-8">Luas</th>
                                                    <th class="text-xs text-teal-700 border w-14">Harga</th>
                                                    <th class="text-xs text-teal-700 border w-[100px]">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody id="billboardsPreviewTBody">
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-center p-1"
                                                        rowspan="2">
                                                        1</td>
                                                    <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                                    <td class="text-xs text-teal-700 border text-center p-1"
                                                        rowspan="2">{{ $products->billboard_code }}</td>
                                                    <td class="text-xs text-teal-700 border p-1" rowspan="2">
                                                        {{ $products->billboard_address }}</td>
                                                    @if ($products->print == true)
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ $products->printProduct }}</td>
                                                        <td class="text-xs text-teal-700 border text-center"
                                                            rowspan="2">{{ $products->wide }}</td>
                                                        <td class="text-xs text-teal-700 border text-right px-2">
                                                            {{ number_format($products->print_price) }}
                                                        </td>
                                                        <td class="text-xs text-teal-700 border text-right px-2">
                                                            {{ number_format($totalPrint) }}
                                                        </td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center">Free</td>
                                                        <td class="text-xs text-teal-700 border text-center"
                                                            rowspan="2">{{ $products->wide }}</td>
                                                        <td class="text-xs text-teal-700 border text-center">Free</td>
                                                        <td class="text-xs text-teal-700 border text-center">Free ke
                                                            {{ $products->used_print + 1 }} dari
                                                            {{ $products->free_print }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-center p-1">Pasang</td>
                                                    @if ($products->install == true)
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ $products->installProduct }}</td>
                                                        <td class="text-xs text-teal-700 border text-right px-2">
                                                            {{ number_format($products->print_price) }}</td>
                                                        <td class="text-xs text-teal-700 border text-right px-2">
                                                            {{ number_format($totalInstall) }}</td>
                                                    @else
                                                        <td class="text-xs text-teal-700 border text-center">
                                                            {{ $products->installProduct }}</td>
                                                        <td class="text-xs text-teal-700 border text-center">Free</td>
                                                        <td class="text-xs text-teal-700 border text-center">Free ke
                                                            {{ $products->used_install + 1 }} dari
                                                            {{ $products->free_install }}</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                        colspan="7">Sub Total</td>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold">
                                                        {{ number_format($subTotal) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                        colspan="7">PPN 11%</td>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold">
                                                        {{ number_format($ppn) }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                        colspan="7">Grand Total</td>
                                                    <td class="text-xs text-teal-700 border text-right px-2 font-semibold">
                                                        {{ number_format($grandTotal) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- sale data table end -->

                            <!-- sale note start -->
                            <div class="sale-note">
                                <div class="div-sale-notes w-[325px]">
                                    <div>
                                        <label class="sale-note-title">Termin Pembayaran :</label>
                                    </div>
                                    <div>
                                        <label class="label-sale-02">1.</label>
                                        <label class="label-sale-02">100%</label>
                                        <label class="label-sale-02">setelah cetak dan pemasangan</label>
                                    </div>
                                </div>
                                <div class="div-sale-notes w-[435px] ml-4">
                                    <div>
                                        <label class="sale-note-title">Keterangan Tambahan :</label>
                                        <label class="line-label"></label>
                                        <label class="line-label"></label>
                                        <label class="line-label"></label>
                                        <label class="line-label"></label>
                                        <label class="line-label"></label>
                                        <label class="line-label"></label>
                                    </div>

                                </div>
                            </div>
                            <!-- sale note end -->

                            <!-- sign table start -->
                            @include('dashboard.layouts.sale-sign-area')
                            <!-- sign table end -->

                            <!-- Location photo start -->
                            <div class="body-bottom-sale mt-2">
                                <div class="sale-detail">
                                    @foreach ($billboard_photos as $photo)
                                        @if ($photo->billboard_id == $sale->billboard->id)
                                            <img class="img-location-sale" src="/storage/{{ $photo->photo }}"
                                                alt="">
                                        @endif
                                    @endforeach
                                </div>
                                <div class="qr-code-sale ml-4">

                                </div>
                            </div>
                            <!-- Location photo end -->
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                    <input type="text" id="saveNumber"
                        value="{{ Str::substr($sale->number, 0, 4) . '_PJ Cetak & Pasang_' . $sale->client->name . '_' . $products->billboard_code }}"
                        hidden>
                @endforeach
            </div>
            <div class="mb-10">
            </div>
        </div>
    </div>
    <!-- Preview Print Install Sale end -->

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        var saveName = document.querySelectorAll("[id='saveNumber']");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.querySelectorAll("[id='pdfPreview']");
            for (let i = 0; i < element.length; i++) {
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
                        scale: 4,
                        letterRendering: true,
                        useCORS: true
                    },
                    jsPDF: {
                        unit: 'px',
                        format: [950, 1365],
                        orientation: 'portrait',
                        putTotalPages: true
                    }
                };
                // html2pdf(element, opt);
                html2pdf().set(opt).from(element[i]).save();
            }
        };
    </script>

    <!-- Script end -->
@endsection
