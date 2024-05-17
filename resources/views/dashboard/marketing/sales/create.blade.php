@extends('dashboard.layouts.main');

@section('container')
    <!-- Create Sales Data start -->
    <!-- Form Create Sales Data start -->
    <form class="justify-center" action="/dashboard/marketing/sales" method="post" enctype="multipart/form-data">
        @csrf
        <div class="flex justify-center">
            <input type="text" name="sales_value" id="sales_value" hidden>
            <div class="mt-10 w-[950px]">
                <!-- Title Create Sales Data start -->
                <div class="flex border-b">
                    <h1 class="text-xl text-cyan-800 font-bold tracking-wider">INPUT DATA PENJUALAN</h1>
                </div>
                <div class="flex border rounded-lg mt-2 p-2">
                    <div class="flex">
                        <select
                            class="flex w-44 text-sm font-semibold text-teal-900 border rounded-lg p-1 outline-none @error('sale_category_id') is-invalid @enderror"
                            name="sale_category_id" id="sale_category_id" onchange="getSaleCategory(this)">
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
                                $sold = false;
                                ?>
                                @foreach ($billboard_quot_statuses as $status)
                                    @if ($status->billboard_quotation_id == $quotation->id)
                                        <?php
                                        $sold = false;
                                        ?>
                                        @foreach ($sales as $sale)
                                            @if ($sale->billboard_quotation_id == $quotation->id)
                                                <?php
                                                $sold = true;
                                                ?>
                                            @endif
                                        @endforeach
                                        @if ($status->status == 'Deal' && $sold != true)
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
                                                    <?php
                                                    $sold = false;
                                                    ?>
                                                    @foreach ($sales as $sale)
                                                        @if ($sale->billboard_quot_revision_id == $revision->id)
                                                            <?php
                                                            $sold = true;
                                                            ?>
                                                        @endif
                                                    @endforeach
                                                    @if ($status->status == 'Deal' && $sold != true)
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
                    <div id="divButton" class="hidden w-[780px] justify-end">
                        <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                            type="button">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                            </svg>
                            <span class="ml-2 text-white">Preview</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                            href="/dashboard/marketing/sales">
                            <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Multiple Sale Start -->
        <div class="flex justify-center mt-4">
            @if (count($sales) != 0)
                <?php
                $endObject = $sales[count($sales) - 1];
                // var_dump($endObject->number);
                // $endNumber = $endObject->number;
                $endNumber = substr($endObject->number, 0, 4);
                // var_dump($endNumber);
                $saleNumber = ((int) $endNumber) + 1;
                ?>
            @else
                <?php
                $saleNumber = 1;
                ?>
            @endif
            <input id="number" name="number" type="text" value="{{ $saleNumber }}" hidden>
            <div id="multipleSale" class="h-max">

            </div>
        </div>
        <!-- Multiple Sale End -->

        <!-- Add / view Approval start -->
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
                <div class="w-[800px] h-max bg-white mt-2 p-4">
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
                                        class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer"
                                        type="button">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
                                            <path
                                                d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                        </svg>
                                    </button>
                                </div>
                                <div id="nextApprovalButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                    <button type="button"
                                        class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-black bg-opacity-0 hover:bg-opacity-50 transition duration-500 ease-in-out cursor-pointer">
                                        <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                            clip-rule="evenodd" viewBox="0 0 24 24">
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
                <div class="flex mt-10">
                    <button id="btnPOSubmit" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Submit"
                        type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="ml-2 text-white">Submit</span>
                    </button>
                    <button id="btnPOCancel" class="flex justify-center items-center mx-1 btn-danger mb-2" title="Cancel"
                        type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-2 text-white">Cancel</span>
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
                <div class="flex mt-10">
                    <button id="btnAgreementSubmit" class="flex justify-center items-center mx-1 btn-primary mb-2"
                        title="Submit" type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="m20 20h-15.25c-.414 0-.75.336-.75.75s.336.75.75.75h15.75c.53 0 1-.47 1-1v-15.75c0-.414-.336-.75-.75-.75s-.75.336-.75.75zm-1-17c0-.478-.379-1-1-1h-15c-.62 0-1 .519-1 1v15c0 .621.52 1 1 1h15c.478 0 1-.379 1-1zm-12.751 8.306c-.165-.147-.249-.351-.249-.556 0-.411.333-.746.748-.746.178 0 .355.062.499.19l2.371 2.011 4.453-4.962c.149-.161.35-.243.554-.243.417 0 .748.336.748.746 0 .179-.065.359-.196.503l-4.953 5.508c-.148.161-.35.243-.553.243-.177 0-.356-.063-.498-.19z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="ml-2 text-white">Submit</span>
                    </button>
                    <button id="btnAgreementCancel" class="flex justify-center items-center mx-1 btn-danger mb-2"
                        title="Cancel" type="button">
                        <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="ml-2 text-white">Cancel</span>
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
                                <input class="hidden" id="documentAgreement" name="document_agreement[]" type="file"
                                    accept="image/png, image/jpg, image/jpeg" onchange="previewAgreementImage()" multiple>
                            </div>
                            <div class="my-2 border-b-2 border-teal-700">
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Nomor Agreement</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <input
                                        class="text-sm px-2 text-teal-700 ml-2 outline-none border rounded-lg border-teal-700"
                                        type="text" id="agreement_number" name="agreement_number"
                                        placeholder="input nomor perjanjian">
                                </div>
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Tanggal Agreement</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <input
                                        class="text-sm text-teal-700 ml-2 px-2 outline-none border rounded-lg border-teal-700"
                                        type="date" id="agreement_date" name="agreement_date">
                                </div>
                                <div class="flex items-center mt-1">
                                    <label class="text-sm text-teal-700 w-32">Jumlah File</label>
                                    <label class="text-sm text-teal-700 ml-2">:</label>
                                    <label id="numberAgreementFile" class="text-sm text-teal-700 ml-2">No Files
                                        Chosen</label>
                                </div>
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
        <!-- Sales Preview start -->
        <div id="modalPreview" class="absolute justify-center top-0 w-full h-max bg-black bg-opacity-90 z-50 hidden">
            <div>
                <div class="flex mt-10">
                    <div class="flex w-48">
                        <button id="btnSave" class="flex justify-center items-center mx-1 btn-success" title="Save"
                            type="submit">
                            <svg class="fill-current w-4 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-2 text-white">Save</span>
                        </button>
                    </div>
                    <div class="flex w-[738px] justify-end">
                        <button id="btnClosePreview" class="flex" title="Close" type="button">
                            <svg class="fill-white w-6 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                                viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div id="salesPreview" class="h-max mb-24 mt-2">
                </div>
            </div>
        </div>
        <!-- Sales Preview end -->
    </form>
    <!-- Form Create Sales Data end -->

    <!-- Script start -->
    <script src="/js/inputsaledata.js"></script>
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <!-- Script end -->
@endsection
