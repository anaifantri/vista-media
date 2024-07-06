@extends('dashboard.layouts.main');

@section('container')
    <form class="justify-center" action="/dashboard/marketing/print-install-sales" method="post" enctype="multipart/form-data">
        @csrf
        <!-- Create Print Install Sale start -->
        <div class="flex justify-center bg-black h-max">
            <div class="mt-10">
                <!-- Title Create Print Install Sale start -->
                <div class="flex border-b justify-end">
                    <button class="flex justify-center items-center mx-1 btn-primary mb-2" title="Save" type="submit"
                        onclick="return confirm('Apakah anda yakin data sudah benar?')">
                        <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                        </svg>
                        <span class="ml-2 text-white">Save</span>
                    </button>
                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                        href="/dashboard/marketing/sales/create">
                        <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                    </a>
                </div>
                <!-- Title Create Print Install Sale end -->
                <div>
                    <?php
                    $products = json_decode($print_instal_quotation->products);
                    ?>
                    @foreach ($products->quotationProducts as $product)
                        <div class="w-[950px] h-[1345px] mt-2 bg-white">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1125px]">
                                <div class="flex justify-center">
                                    <label class="sale-label-title">DATA PENJUALAN CETAK & PASANG</label>
                                </div>
                                <div class="body-detail">
                                    <?php
                                    $searchDate = strtotime(request('search'));
                                    $month = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
                                    ?>
                                    <div class="sale-detail">
                                        <div class="div-sale">
                                            <label class="label-sale-01">No. Penjualan</label>
                                            <label class="label-sale-02">:</label>
                                            <label class="label-sale-02"></label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Tgl. Penjualan</label>
                                            <label class="label-sale-02">:</label>
                                            <label class="label-sale-02">{{ date('j') }} {{ $month[(int) date('m')] }}
                                                {{ date('Y') }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Dok. Approval</label>
                                            <label class="label-sale-02">:</label>
                                            <label id="approvalDocuments"
                                                class="label-sale-02 ml-2">{{ count($print_instal_quotation->print_install_approvals) }}
                                                documents</label>
                                            <button class="btn-sale ml-2" id="btnApproval"
                                                onclick="previewAppovalImage('{{ $print_instal_quotation->id }}')"
                                                type="button">
                                                <span class="text-sm mx-2">view</span>
                                            </button>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Dok. PO/SPK</label>
                                            <label class="label-sale-02">:</label>
                                            <label id="orderDocuments" class="label-sale-02 ml-2">No Files Chosen</label>
                                            <button class="btn-sale ml-2" onclick="btnPOEvent()" type="button">
                                                <span class="text-sm mx-2">add/view</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="sale-detail ml-4">
                                        <div class="div-sale">
                                            <label class="label-sale-01">No. Penawaran</label>
                                            <label class="label-sale-02">:</label>
                                            <label class="label-sale-02">{{ $print_instal_quotation->number }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Tgl. Penawaran</label>
                                            <label class="label-sale-02">:</label>
                                            <label
                                                class="label-sale-02">{{ date('j', strtotime($print_instal_quotation->created_at)) }}
                                                {{ $month[(int) date('m', strtotime($print_instal_quotation->created_at))] }}
                                                {{ date('Y', strtotime($print_instal_quotation->created_at)) }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Nama Klien</label>
                                            <label class="label-sale-02">:</label>
                                            <label class="label-sale-02">{{ $print_instal_quotation->client->name }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Perusahaan</label>
                                            <label class="label-sale-02">:</label>
                                            <label
                                                class="label-sale-02">{{ $print_instal_quotation->client->company }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Alamat</label>
                                            <label class="label-sale-02">:</label>
                                            <textarea class="label-sale-02 w-60 outline-none" rows="2" readonly>{{ $print_instal_quotation->client->address }}</textarea>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Kontak Person</label>
                                            <label class="label-sale-02">:</label>
                                            <label
                                                class="label-sale-02">{{ $print_instal_quotation->contact->name }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">No. Hp</label>
                                            <label class="label-sale-02">:</label>
                                            <label
                                                class="label-sale-02">{{ $print_instal_quotation->contact->phone }}</label>
                                        </div>
                                        <div class="div-sale">
                                            <label class="label-sale-01">Email</label>
                                            <label class="label-sale-02">:</label>
                                            <label
                                                class="label-sale-02">{{ $print_instal_quotation->contact->email }}</label>
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
                                                    <?php
                                                    $totalPrint = 0;
                                                    $totalPrint = $product->print_price * $product->wide;
                                                    $totalInstall = 0;
                                                    $totalInstall = $product->install_price * $product->wide;
                                                    $subTotal = 0;
                                                    $subTotal = $totalPrint + $totalInstall;
                                                    $ppn = 0;
                                                    $ppn = ($subTotal * 11) / 100;
                                                    ?>
                                                    <tr>
                                                        <td class="text-xs text-teal-700 border text-center p-1"
                                                            rowspan="2">
                                                            1</td>
                                                        <td class="text-xs text-teal-700 border text-center p-1">Cetak</td>
                                                        <td class="text-xs text-teal-700 border text-center p-1"
                                                            rowspan="2">
                                                            {{ $product->billboard_code }}
                                                        </td>
                                                        <td class="text-xs text-teal-700 border p-1" rowspan="2">
                                                            {{ $product->billboard_address }}</td>
                                                        @if ($product->print == true)
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ $product->printProduct }}</td>
                                                            <td class="text-xs text-teal-700 border text-center p-1"
                                                                rowspan="2">{{ $product->wide }}</td>
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ number_format($product->print_price) }}</td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">
                                                                {{ number_format($totalPrint) }}
                                                            </td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center">Free</td>
                                                            <td class="text-xs text-teal-700 border text-center p-1"
                                                                rowspan="2">{{ $product->wide }}</td>
                                                            <td class="text-xs text-teal-700 border text-center">Free</td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">Free ke
                                                                {{ $product->used_print + 1 }} dari
                                                                {{ $product->free_print }}
                                                            </td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td class="text-xs text-teal-700 border text-center p-1">Pasang
                                                        </td>
                                                        @if ($product->install == true)
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ $product->installProduct }}</td>
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ number_format($product->install_price) }}</td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">
                                                                {{ number_format($totalInstall) }}
                                                            </td>
                                                        @else
                                                            <td class="text-xs text-teal-700 border text-center">
                                                                {{ $product->installProduct }}</td>
                                                            <td class="text-xs text-teal-700 border text-center">Free</td>
                                                            <td class="text-xs text-teal-700 border text-right p-1">Free ke
                                                                {{ $product->used_install + 1 }} dari
                                                                {{ $product->free_install }}</td>
                                                        @endif
                                                    </tr>
                                                    <tr>
                                                        <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                            colspan="7">Sub Total</td>
                                                        <td
                                                            class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                            {{ number_format($subTotal) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                            colspan="7">PPN 11%</td>
                                                        <td
                                                            class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                            {{ number_format($ppn) }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="text-xs text-teal-700 border text-right px-2 font-semibold"
                                                            colspan="7">Grand Total</td>
                                                        <td
                                                            class="text-xs text-teal-700 border text-right p-1 font-semibold">
                                                            {{ number_format($ppn + $subTotal) }}</td>
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
                                        @foreach ($billboards as $billboard)
                                            @if ($billboard->id == $product->billboard_id)
                                                @foreach ($billboard_photos as $photo)
                                                    @if ($photo->billboard_id == $billboard->id)
                                                        <img class="img-location-sale" src="/storage/{{ $photo->photo }}"
                                                            alt="">
                                                    @endif
                                                @endforeach
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
                    @endforeach
                </div>
                <input type="text" name="sales_data" value="{{ json_encode($print_instal_quotation) }}" hidden>
                <div class="mb-10">
                </div>
            </div>
        </div>
        <!-- Create Print Install Sale end -->
        <div id="modalApproval" name="modalApproval"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div>
                <div class="flex mt-10">
                    <div class="flex w-[788px] justify-end">
                        <button id="btnCloseApproval" class="flex" title="Close" type="button">
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
                        <div>
                            <div class="flex justify-center my-2 border-b-2 border-teal-700">
                                <label class="text-xl font-semibold text-teal-700">Document Approval</label>
                            </div>
                            <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                                id="approvalImg">

                            </figure>
                            <div class="relative m-auto w-[750px] h-max">
                                <div id="prevApprovalButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextApprovalButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesApprovalPreview" class="mt-2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add / view PO / SPK start -->
        <div id="modalPO" name="modalPO"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div>
                <div class="flex mt-10">
                    <button id="btnPOSubmit" class="flex justify-center items-center mx-1 btn-primary mb-2"
                        title="Submit" type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="ml-2 text-white">Submit</span>
                    </button>
                    <button id="btnPOClear" class="flex justify-center items-center mx-1 btn-danger mb-2" title="Cancel"
                        type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M13.5 2c-5.621 0-10.211 4.443-10.475 10h-3.025l5 6.625 5-6.625h-2.975c.257-3.351 3.06-6 6.475-6 3.584 0 6.5 2.916 6.5 6.5s-2.916 6.5-6.5 6.5c-1.863 0-3.542-.793-4.728-2.053l-2.427 3.216c1.877 1.754 4.389 2.837 7.155 2.837 5.79 0 10.5-4.71 10.5-10.5s-4.71-10.5-10.5-10.5z" />
                        </svg>
                        <span class="ml-2 text-white">Clear</span>
                    </button>
                    <div class="flex justify-end px-2 w-full">
                        <button id="btnPOClose" class="flex" title="Close" type="button">
                            <svg class="fill-gray-500 w-6 m-auto hover:fill-red-700" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="w-[800px] h-max bg-white mt-2 p-4">
                    <div class="flex justify-center">
                        <div>
                            <div class="flex justify-center w-full m-2">
                                <button id="btnChosePO" name="btnChosePO"
                                    class="flex justify-center items-center w-44 btn-primary" title="Chose Files"
                                    type="button" onclick="document.getElementById('documentPO').click()">
                                    <svg class="fill-current w-[18px]" xmlns="http://www.w3.org/2000/svg"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Chose Images</span>
                                </button>
                                <input class="hidden" id="documentPO" name="document_po[]" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="previewPOImage()" multiple>
                            </div>
                            <div class="my-2 border-b-2 border-teal-700">
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Nomor PO / SPK</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <input class="ml-2" type="radio" name="order_name" id="order_po"
                                        value="po" checked>
                                    <label class="text-sm text-teal-700 ml-2">PO</label>
                                    <input class="ml-2" type="radio" name="order_name" id="order_spk"
                                        value="spk">
                                    <label class="text-sm text-teal-700 ml-2">SPK</label>
                                </div>
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Nomor PO/SPK</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <input
                                        class="px-2 text-sm text-teal-700 ml-2 outline-none border rounded-lg border-teal-700"
                                        type="text" id="order_number" name="order_number"
                                        placeholder="input nomor PO/SPK">
                                </div>
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Tanggal PO/SPK</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <input
                                        class="text-sm text-teal-700 ml-2 outline-none px-2 border rounded-lg border-teal-700"
                                        type="date" id="order_date" name="order_date">
                                </div>
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Jumlah File</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <label id="numberPOFile" class="text-sm text-teal-700 ml-2">No Files Chosen</label>
                                </div>
                            </div>
                            <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                                id="poImg">

                            </figure>
                            <div class="relative m-auto w-[750px] h-max">
                                <div id="prevPOButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                        type="button">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextPOButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesPOPreview" class="mt-2">
                                    {{-- <img class="approval-preview w-full" src="" alt="" hidden> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add / view PO / SPK end -->
    </form>

    <!-- Script start -->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        // Preview Approval Document --> start
        const documentApproval = document.querySelector('#documentApproval');
        const slidesApprovalPreview = document.getElementById("slidesApprovalPreview");
        const prevApprovalButton = document.getElementById("prevApprovalButton");
        const nextApprovalButton = document.getElementById("nextApprovalButton");
        const approvalImg = document.getElementById("approvalImg");
        const btnCloseApproval = document.getElementById("btnCloseApproval");

        let objApproval = {};
        let approvalData = [];
        let approvalUrl = [];
        let approvalImage = [];
        let slideApprovalPreview = [];
        let slideApprovalImage = [];
        let slideApprovalIndex = 0;

        //Get Document Approval --> start
        getApprovalData();

        function getApprovalData() {
            const xhrDocumentApproval = new XMLHttpRequest();
            const methodDocumentApproval = "GET";
            const urlDocumentApproval = "/printInstallApproval";

            xhrDocumentApproval.open(methodDocumentApproval, urlDocumentApproval, true);
            xhrDocumentApproval.send();

            xhrDocumentApproval.onreadystatechange = () => {
                // In local files, status is 0 upon success in Mozilla Firefox
                if (xhrDocumentApproval.readyState === XMLHttpRequest.DONE) {
                    const status = xhrDocumentApproval.status;
                    if (status === 0 || (status >= 200 && status < 400)) {
                        objApproval = JSON.parse(xhrDocumentApproval.responseText);
                        approvalData = objApproval.dataApproval;
                        console.log(approvalData);
                    } else {
                        // Oh no! There has been an error with the request!
                    }
                }
            }
        }
        //Get Document Approval --> end

        function previewAppovalImage(quotID) {
            modalApproval.classList.remove("hidden");
            modalApproval.classList.add("flex");
            window.scrollTo(0, 0);
            slideApprovalIndex = 0;

            while (approvalImg.hasChildNodes()) {
                approvalImg.removeChild(approvalImg.firstChild);
            }

            while (slidesApprovalPreview.hasChildNodes()) {
                slidesApprovalPreview.removeChild(slidesApprovalPreview.firstChild);
            }

            var a = 0;
            approvalUrl = [];
            console.log(quotID);
            for (i = 0; i < approvalData.length; i++) {
                console.log(approvalData[i].print_instal_quotation_id);
                if (approvalData[i].print_instal_quotation_id == quotID) {
                    approvalUrl[a] = approvalData[i].approval_image;
                    a = a + 1;
                }
            }

            if (approvalUrl.length != 0) {
                for (n = 0; n < approvalUrl.length; n++) {
                    approvalImage[n] = document.createElement("img")
                    if (n == 0) {
                        approvalImage[n].classList.add("document-approval-active");
                    } else {
                        approvalImage[n].classList.add("document-approval");
                    }

                    approvalImage[n].src = '/storage/' + approvalUrl[n];
                    approvalImage[n].setAttribute('id', n);
                    approvalImage[n].setAttribute('onclick', 'myApprovalSlide(this)');
                    approvalImg.appendChild(approvalImage[n]);

                    slideApprovalPreview[n] = document.createElement("figure");
                    slideApprovalPreview[n].classList.add("mySlides");
                    slideApprovalPreview[n].classList.add("fade");
                    slideApprovalImage[n] = document.createElement("img");
                    if (n != 0) {
                        slideApprovalImage[n].classList.add("hidden");
                    }
                    slideApprovalImage[n].classList.add("w-full");
                    slideApprovalImage[n].classList.add("mt-2");
                    slideApprovalImage[n].src = '/storage/' + approvalUrl[n];
                    slideApprovalPreview[n].appendChild(slideApprovalImage[n]);
                    slidesApprovalPreview.appendChild(slideApprovalPreview[n]);
                }

                prevApprovalButton.removeAttribute('hidden');
                nextApprovalButton.removeAttribute('hidden');
            }
        }

        prevApprovalButton.addEventListener('click', function() {
            if (slideApprovalIndex != 0) {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
                approvalImage[slideApprovalIndex].classList.add("document-approval");
                slideApprovalIndex = slideApprovalIndex - 1;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            } else {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[0].classList.remove("document-approval-active");
                approvalImage[0].classList.add("document-approval");
                slideApprovalIndex = approvalUrl.length - 1;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            }
        })

        nextApprovalButton.addEventListener('click', function() {
            if (slideApprovalIndex != approvalUrl.length - 1) {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
                approvalImage[slideApprovalIndex].classList.add("document-approval");
                slideApprovalIndex = slideApprovalIndex + 1;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            } else {
                slideApprovalImage[slideApprovalIndex].classList.add("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
                approvalImage[slideApprovalIndex].classList.add("document-approval");
                slideApprovalIndex = 0;
                slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
                approvalImage[slideApprovalIndex].classList.remove("document-approval");
                approvalImage[slideApprovalIndex].classList.add("document-approval-active");
            }
        })

        function myApprovalSlide(img) {
            slideApprovalImage[slideApprovalIndex].classList.add("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval-active");
            approvalImage[slideApprovalIndex].classList.add("document-approval");
            slideApprovalIndex = Number(img.id);
            slideApprovalImage[slideApprovalIndex].classList.remove("hidden");
            approvalImage[slideApprovalIndex].classList.remove("document-approval");
            approvalImage[slideApprovalIndex].classList.add("document-approval-active");
        }

        btnCloseApproval.addEventListener('click', function() {
            modalApproval.classList.add("hidden");
            modalApproval.classList.remove("flex");
        })

        // Preview Approval Document --> end

        //Preview PO/SPK document --> start
        const modalPO = document.getElementById("modalPO");
        const btnPOSubmit = document.getElementById("btnPOSubmit");
        const btnPOClear = document.getElementById("btnPOClear");
        const btnPOClose = document.getElementById("btnPOClose");
        const orderNumber = document.getElementById("order_number");
        const orderDate = document.getElementById("order_date");
        const documentPO = document.getElementById("documentPO");
        const slidesPOPreview = document.getElementById("slidesPOPreview");
        const numberPOFile = document.getElementById("numberPOFile");
        const prevPOButton = document.getElementById("prevPOButton");
        const nextPOButton = document.getElementById("nextPOButton");
        const poImg = document.getElementById("poImg");
        const orderDocuments = document.querySelectorAll("[id='orderDocuments']");

        let poImage = [];
        let slidePOPreview = [];
        let slidePOImage = [];
        let slidePOIndex = 0;

        function previewPOImage() {
            while (poImg.hasChildNodes()) {
                poImg.removeChild(poImg.firstChild);
            }

            while (slidesPOPreview.hasChildNodes()) {
                slidesPOPreview.removeChild(slidesPOPreview.firstChild);
            }

            if (documentPO.files.length != 0) {
                numberPOFile.innerHTML = "";
                numberPOFile.innerHTML = documentPO.files.length + " images selected";

                for (n = 0; n < documentPO.files.length; n++) {
                    const file = documentPO.files[n];
                    const objectUrl = URL.createObjectURL(file);

                    poImage[n] = document.createElement("img")
                    if (n == 0) {
                        poImage[n].classList.add("document-approval-active");
                    } else {
                        poImage[n].classList.add("document-approval");
                    }

                    poImage[n].src = objectUrl;
                    poImage[n].setAttribute('id', n);
                    poImage[n].setAttribute('onclick', 'myPOSlide(this)');
                    poImg.appendChild(poImage[n]);

                    slidePOPreview[n] = document.createElement("figure");
                    slidePOPreview[n].classList.add("mySlides");
                    slidePOPreview[n].classList.add("fade");
                    slidePOImage[n] = document.createElement("img");
                    if (n != 0) {
                        slidePOImage[n].classList.add("hidden");
                    }
                    slidePOImage[n].classList.add("w-full");
                    slidePOImage[n].classList.add("mt-2");
                    slidePOImage[n].src = objectUrl;
                    slidePOPreview[n].appendChild(slidePOImage[n]);
                    slidesPOPreview.appendChild(slidePOPreview[n]);
                }

                prevPOButton.removeAttribute('hidden');
                nextPOButton.removeAttribute('hidden');
            }
        }

        prevPOButton.addEventListener('click', function() {
            if (slidePOIndex != 0) {
                slidePOImage[slidePOIndex].classList.add("hidden");
                poImage[slidePOIndex].classList.remove("document-approval-active");
                poImage[slidePOIndex].classList.add("document-approval");
                slidePOIndex = slidePOIndex - 1;
                slidePOImage[slidePOIndex].classList.remove("hidden");
                poImage[slidePOIndex].classList.remove("document-approval");
                poImage[slidePOIndex].classList.add("document-approval-active");
            } else {
                slidePOImage[slidePOIndex].classList.add("hidden");
                poImage[0].classList.remove("document-approval-active");
                poImage[0].classList.add("document-approval");
                slidePOIndex = documentPO.files.length - 1;
                slidePOImage[slidePOIndex].classList.remove("hidden");
                poImage[slidePOIndex].classList.remove("document-approval");
                poImage[slidePOIndex].classList.add("document-approval-active");
            }
        })

        nextPOButton.addEventListener('click', function() {
            if (slidePOIndex != documentPO.files.length - 1) {
                slidePOImage[slidePOIndex].classList.add("hidden");
                poImage[slidePOIndex].classList.remove("document-approval-active");
                poImage[slidePOIndex].classList.add("document-approval");
                slidePOIndex = slidePOIndex + 1;
                slidePOImage[slidePOIndex].classList.remove("hidden");
                poImage[slidePOIndex].classList.remove("document-approval");
                poImage[slidePOIndex].classList.add("document-approval-active");
            } else {
                slidePOImage[slidePOIndex].classList.add("hidden");
                poImage[slidePOIndex].classList.remove("document-approval-active");
                poImage[slidePOIndex].classList.add("document-approval");
                slidePOIndex = 0;
                slidePOImage[slidePOIndex].classList.remove("hidden");
                poImage[slidePOIndex].classList.remove("document-approval");
                poImage[slidePOIndex].classList.add("document-approval-active");
            }
        })

        function myPOSlide(img) {
            slidePOImage[slidePOIndex].classList.add("hidden");
            poImage[slidePOIndex].classList.remove("document-approval-active");
            poImage[slidePOIndex].classList.add("document-approval");
            slidePOIndex = Number(img.id);
            slidePOImage[slidePOIndex].classList.remove("hidden");
            poImage[slidePOIndex].classList.remove("document-approval");
            poImage[slidePOIndex].classList.add("document-approval-active");
        }

        function btnPOEvent() {
            modalPO.classList.remove("hidden");
            modalPO.classList.add("flex");
            window.scrollTo(0, 0);
        }

        btnPOSubmit.addEventListener('click', function() {
            if (documentPO.files.length == 0) {
                alert("Dokumen po/spk dipilih")
            } else if (orderNumber.value == "") {
                alert("Nomor po/spk belum di input")
            } else if (orderDate.value == "") {
                alert("Tanggal po/spk belum diinput")
            } else {
                modalPO.classList.add("hidden");
                modalPO.classList.remove("flex");
                for (let i = 0; i < orderDocuments.length; i++) {
                    orderDocuments[i].innerHTML = "";
                    orderDocuments[i].innerHTML = numberPOFile.innerHTML;
                }
            }
        })

        btnPOClear.addEventListener('click', function() {
            prevPOButton.setAttribute('hidden', 'hidden');
            nextPOButton.setAttribute('hidden', 'hidden');
            for (let i = 0; i < orderDocuments.length; i++) {
                orderDocuments[i].innerHTML = "";
                orderDocuments[i].innerHTML = "No Files Chosen";
            }
            documentPO.value = null;
            while (poImg.hasChildNodes()) {
                poImg.removeChild(poImg.firstChild);
            }

            while (slidesPOPreview.hasChildNodes()) {
                slidesPOPreview.removeChild(slidesPOPreview.firstChild);
            }

            numberPOFile.innerHTML = "No Files Chosen";
            orderDate.value = null;
            orderNumber.value = null;
        })

        btnPOClose.addEventListener('click', () => {
            modalPO.classList.add("hidden");
            modalPO.classList.remove("flex");
        })
        //Preview PO/SPK document --> end
    </script>
    <!-- Script end -->
@endsection
