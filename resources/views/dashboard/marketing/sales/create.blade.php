@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Data start -->
    <!-- Form Create Sales Data start -->
    <form class="justify-center" action="/dashboard/marketing/sales" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center">
            <div class="mt-10 w-[950px]">
                <!-- Title Create Sales Data start -->
                <div class="flex border-b">
                    <h1 class="text-xl text-cyan-800 font-bold tracking-wider">INPUT DATA PENJUALAN</h1>
                </div>
                <div class="flex border rounded-lg mt-2 p-2">
                    <select
                        class="flex w-44 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('sale_category_id') is-invalid @enderror"
                        name="sale_category_id" id="sale_category_id">
                        <option value="Pilih Katagori">Pilih Katagori</option>
                        @foreach ($sale_categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <select
                        class="hidden ml-4 w-56 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('quotationDeal') is-invalid @enderror"
                        name="quotationDeal" id="quotationDeal">
                        <option value="Pilih Penawaran">Pilih Penawaran</option>
                        @foreach ($billboard_quotations as $quotation)
                            <?php
                            $deal = false;
                            ?>
                            @foreach ($billboard_quot_statuses as $status)
                                @if ($status->billboard_quotation_id == $quotation->id)
                                    @if ($status->status == 'Deal')
                                        <option value="{{ $quotation->number }}">{{ $quotation->number }}
                                        </option>
                                        <?php
                                        $deal = true;
                                        ?>
                                    @endif
                                @endif
                            @endforeach
                            @if ($deal != true)
                                @foreach ($billboard_quot_revisions as $revision)
                                    <?php
                                    $deal = false;
                                    ?>
                                    @if ($revision->billboard_quotation_id == $quotation->id)
                                        @foreach ($billboard_quot_statuses as $status)
                                            @if ($status->billboard_quot_revision_id == $revision->id)
                                                @if ($status->status == 'Deal')
                                                    <option value="{{ $revision->number }}">
                                                        {{ $revision->number }}
                                                    </option>
                                                    <?php
                                                    $deal = true;
                                                    ?>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                            @endif
                        @endforeach
                    </select>
                </div>
                <!-- Title Create Sales Data end -->
                <div id="salePreviews" class="hidden mt-4">
                    <!-- Billboard Sale Preview start -->
                    <div id="salePreview" class="w-[950px] h-[1345px] border mb-10 mt-1">
                        <!-- Header start -->
                        <div class="h-28">
                            <div class="flex w-full justify-center items-center">
                                <img class="mt-3" src="/img/logo-vm.png" alt="">
                            </div>
                            <div class="flex w-full justify-center items-center mt-2">
                                <img src="/img/line-top.png" alt="">
                            </div>
                        </div>
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <label class="flex text-lg font-bold border-b text-teal-700 mt-4">DATA
                                    PENJUALAN</label>
                            </div>
                            <div class="flex justify-center mt-4">
                                <div class="w-[385px] border rounded-lg mt-2 p-2">
                                    <div class="flex mt-1">
                                        @if (count($sales) != 0)
                                            <?php
                                            $saleNumber = $sales[count($sales) - 1]->number;
                                            ?>
                                        @else
                                            <?php
                                            $saleNumber = 1;
                                            ?>
                                        @endif
                                        <label class="text-sm text-teal-700 w-28">No. Penjualan</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label class="text-sm text-teal-700 ml-2">000{{ $saleNumber }}/PJ/VM/2024 </label>
                                        <input id="number" name="number" type="text" value="{{ $saleNumber }}"
                                            hidden>
                                    </div>
                                    <div class="flex mt-1">
                                        <?php
                                        $saleDate = date('d F Y');
                                        ?>
                                        <label class="text-sm text-teal-700 w-28">Tgl. Penjualan</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label class="text-sm text-teal-700 ml-2">{{ $saleDate }}</label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Dok. Approval</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <button id="btnApproval" name="btnApproval"
                                            class="w-max h-5 ml-2 cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg"
                                            type="button" disabled>
                                            <span class="mx-2 text-sm">Add/View</span>
                                        </button>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Dok. PO/SPK</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <button id="btnPO" name="btnPO"
                                            class="w-max h-5 ml-2 cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg"
                                            type="button" disabled>
                                            <span class="mx-2 text-sm">Add/View</span>
                                        </button>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Dok. Agreement</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <button id="btnAgreement" name="btnAgreement"
                                            class="w-max h-5 ml-2 cursor-pointer bg-teal-500 rounded-lg text-white hover:bg-teal-600 drop-shadow-lg"
                                            type="button" disabled>
                                            <span class="mx-2 text-sm">Add/View</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="w-[385px] border rounded-lg mt-2 p-2 ml-4">
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">No. Penawaran</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="quotationNumber" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Nama Klien</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="client" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Perusahaan</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="clientCompany" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Alamat</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="clientAddress" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Kontak Person</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="clientContact" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Nomor Telp./Hp.</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="contactPhone" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="text-sm text-teal-700 w-28">Email</label>
                                        <label class="text-sm text-teal-700 ml-2">: </label>
                                        <label id="contactEmail" class="text-sm text-teal-700 ml-2">- </label>
                                    </div>
                                </div>
                            </div>
                            <!-- sale table start -->
                            <div id="saleData" class="mt-4">
                                <div class="flex justify-center">
                                    <table id="saleTable" class="table-auto mt-2 w-[790px]">
                                        <thead>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-6" rowspan="2">No</th>
                                                <th class="text-xs text-teal-700 border w-20" rowspan="2">Kode</th>
                                                <th class="text-xs text-teal-700 border w-56" rowspan="2">Lokasi</th>
                                                <th class="text-xs text-teal-700 border" colspan="3">Deskripsi</th>
                                                <th class="text-xs text-teal-700 border">Harga</th>
                                            </tr>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-9">Jenis</th>
                                                <th class="text-xs text-teal-700 border w-9">BL/FL</th>
                                                <th class="text-xs text-teal-700 border w-[88px]">Size - V/H</th>
                                                <th id="thPeriode" class="text-xs text-teal-700 border w-[88px]">
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="locationTBody">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- sale table end -->

                            <!-- sale note start -->
                            <div class="flex justify-center mt-4">
                                <div class="w-[325px] border rounded-lg mt-2 p-2">
                                    <div>
                                        <label class="text-sm font-semibold underline text-teal-700">Termin Pembayaran
                                            : </label>
                                        <label class="flex text-sm text-teal-700">1.
                                            <input class="ml-2 w-8 outline-none" type="number" value="50"> % DP
                                            sebelum materi
                                            iklan
                                            tayang
                                        </label>
                                        <label class="flex text-sm text-teal-700">2.
                                            <input class="ml-2 w-8 outline-none" type="number" value="50"> %
                                            Pelunasan setelah BAPP</label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="text-sm font-semibold underline text-teal-700 w-28">Services
                                            :</label>
                                        <label class="flex text-sm text-teal-700">1. Free biaya cetak 12x
                                        </label>
                                        <label class="flex text-sm text-teal-700">2. Free biaya pemasangan 12x
                                        </label>
                                    </div>
                                </div>
                                <div class="w-[435px] border rounded-lg mt-2 p-2 ml-4">
                                    <div>
                                        <label class="text-sm font-semibold underline text-teal-700">Keterangan :</label>
                                        <label
                                            class="flex text-sm text-teal-700 w-[416px] border-b h-5 border-dotted"></label>
                                        <label
                                            class="flex text-sm text-teal-700 w-[416px] border-b h-5 border-dotted"></label>
                                        <label
                                            class="flex text-sm text-teal-700 w-[416px] border-b h-5 border-dotted"></label>
                                        <label
                                            class="flex text-sm text-teal-700 w-[416px] border-b h-5 border-dotted"></label>
                                        <label
                                            class="flex text-sm text-teal-700 w-[416px] border-b h-5 border-dotted"></label>
                                        <label
                                            class="flex text-sm text-teal-700 w-[416px] border-b h-5 border-dotted"></label>
                                    </div>
                                </div>
                            </div>
                            <!-- sale note end -->

                            <!-- sign area start -->
                            <div class="flex justify-center mt-4">
                                <div class="flex justify-center w-[792px] h-52">
                                    <table class="mt-2 w-full">
                                        <thead>
                                            <tr>
                                                <th class="text-sm text-teal-700 border h-6 underline" colspan="4">
                                                    Mengetahui :
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-xs text-teal-700 border w-[198px] h-5">Sales & Marketing
                                                </th>
                                                <th class="text-xs text-teal-700 border w-[198px] h-5">Invoicing</th>
                                                <th class="text-xs text-teal-700 border w-[198px] h-5">Accounting</th>
                                                <th class="text-xs text-teal-700 border w-[198px] h-5">Director</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td
                                                    class="text-center align-bottom text-sm font-bold text-teal-700 border w-[195px] p-2 underline">
                                                    Nur Cahyono
                                                </td>
                                                <td
                                                    class="text-center align-bottom text-sm font-bold text-teal-700 border w-[195px] p-2 underline">
                                                    Yudhi Pratama</td>
                                                <td
                                                    class="text-center align-bottom text-sm font-bold text-teal-700 border w-[195px] p-2 underline">
                                                    Ayu Putri Lestari</td>
                                                <td
                                                    class="text-center align-bottom text-sm font-bold text-teal-700 border w-[195px] p-2 underline">
                                                    Texun Sandy Kamboy</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- sign area end -->


                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        <div class="flex items-end justify-center">
                            <div>
                                <div class="flex w-full h-max justify-center mt-2">
                                    <img src="/img/line-bottom.png" alt="">
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-sm font-semibold">PT. Vista Media</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali - Indonesia</span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                </div>
                                <div class="flex items-center w-full justify-center">
                                    <span class="text-xs">e-mail : info@vistamedia.co.id | www.vistamedia.co.id</span>
                                </div>
                            </div>
                        </div>
                        <!-- Footer end -->
                    </div>
                    <!-- Billboard Sale Preview start -->
                </div>
            </div>
        </div>

        <!-- Multiple Sale Start -->
        <div class="flex justify-center mt-4">
            <div id="multipleSale" class="h-max">

            </div>
        </div>
        <!-- Multiple Sale End -->

        <!-- Add / view Approval start -->
        <div id="modalApproval" name="modalApproval"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div>
                <div class="flex justify-end">
                    <button id="btnApprovalClose" name="btnApprovalClose" class="flex mr-50 mt-10" title="Close"
                        type="button">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
                <div class="w-[800px] h-max bg-white mt-2 p-4">
                    <div class="flex justify-center">
                        <div>
                            <div class="flex justify-center w-full m-2">
                                <button id="btnChoseApproval" name="btnChoseApproval"
                                    class="flex justify-center items-center w-44 btn-primary" title="Chose Files"
                                    type="button" onclick="document.getElementById('documentApproval').click()">
                                    <svg class="fill-current w-[18px]" xmlns="http://www.w3.org/2000/svg"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Chose Images</span>
                                </button>
                                <input class="hidden" id="documentApproval" name="documentAppronal" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="previewAppovalImage()" multiple>
                            </div>
                            <div class="flex justify-center my-2 border-b-2 border-teal-700">
                                <label id="numberApprovalFile" class="text-sm text-teal-700">No Files Chosen</label>
                            </div>
                            <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                                id="approvalImg">

                            </figure>
                            <div class="relative m-auto w-[750px] h-max">
                                <div id="prevApprovalButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer"
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
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesApprovalPreview" class="mt-2">
                                    {{-- <img class="approval-preview w-full" src="" alt="" hidden> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add / view Approval end -->

        <!-- Add / view PO / SPK start -->
        <div id="modalPO" name="modalPO"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div>
                <div class="flex justify-end">
                    <button id="btnPOClose" name="btnPOClose" class="flex mr-50 mt-10" title="Close" type="button">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
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
                                <input class="hidden" id="documentPO" name="documentPO" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="previewPOImage()" multiple>
                            </div>
                            <div class="flex justify-center my-2 border-b-2 border-teal-700">
                                <label id="numberPOFile" class="text-sm text-teal-700">No Files Chosen</label>
                            </div>
                            <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                                id="poImg">

                            </figure>
                            <div class="relative m-auto w-[750px] h-max">
                                <div id="prevPOButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer"
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
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer">
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

        <!-- Add / view Agreement start -->
        <div id="modalAgreement" name="modalAgreement"
            class="absolute justify-center top-0 w-full h-full bg-black bg-opacity-90 z-50 hidden">
            <div>
                <div class="flex justify-end">
                    <button id="btnAgreementClose" name="btnAgreementClose" class="flex mr-50 mt-10" title="Close"
                        type="button">
                        <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                        </svg>
                    </button>
                </div>
                <div class="w-[800px] h-max bg-white mt-2 p-4">
                    <div class="flex justify-center">
                        <div>
                            <div class="flex justify-center w-full m-2">
                                <button id="btnChoseAgreement" name="btnChosePO"
                                    class="flex justify-center items-center w-44 btn-primary" title="Chose Files"
                                    type="button" onclick="document.getElementById('documentAgreement').click()">
                                    <svg class="fill-current w-[18px]" xmlns="http://www.w3.org/2000/svg"
                                        fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path
                                            d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                    </svg>
                                    <span class="ml-2">Chose Images</span>
                                </button>
                                <input class="hidden" id="documentAgreement" name="documentPO" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="previewAgreementImage()" multiple>
                            </div>
                            <div class="flex justify-center my-2 border-b-2 border-teal-700">
                                <label id="numberAgreementFile" class="text-sm text-teal-700">No Files Chosen</label>
                            </div>
                            <figure class="flex w-[750px] justify-center overflow-x-auto border-b-2 border-teal-700"
                                id="agreementImg">

                            </figure>
                            <div class="relative m-auto w-[750px] h-max">
                                <div id="prevAgreementButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                    <button
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer"
                                        type="button">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextAgreementButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                            fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="slidesAgreementPreview" class="mt-2">
                                    {{-- <img class="approval-preview w-full" src="" alt="" hidden> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Add / view Agreement end -->
    </form>
    <!-- Form Create Sales Data end -->

    <!-- Script start -->
    <script src="/js/inputsaledata.js"></script>
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <!-- Script end -->
@endsection
