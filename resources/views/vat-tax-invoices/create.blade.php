@extends('dashboard.layouts.main');

@section('container')
    <!-- Container start -->
    @php
        $client = json_decode($billing->client);
    @endphp
    <form action="/accounting/vat-tax-invoices" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" value="{{ $company->id }}" hidden>
        <input type="text" name="billing_id" value="{{ $billing->id }}" hidden>
        <input type="text" name="nominal" value="{{ $billing->ppn }}" hidden>
        <div class="flex justify-center pl-14 py-10 bg-stone-800">
            <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
                <!-- Title start -->
                <div class="flex w-[1200px] items-center border-b p-1">
                    <label class="flex text-xl text-stone-100 font-bold w-[850px]">
                        UPLOAD FAKTUR PAJAK
                    </label>
                    <div class="flex items-center w-full justify-end">
                        <a href="/vat-tax-invoices/select-billing/{{ $company->id }}"
                            class="flex justify-center items-center mx-1 btn-primary" title="Back">
                            <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                            </svg>
                            <span class="mx-1 text-white">Back</span>
                        </a>
                        <button id="btnSave" name="btnSave" class="flex justify-center items-center ml-1 btn-primary"
                            type="submit">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Save</span>
                        </button>
                        <a class="flex justify-center items-center ml-1 btn-danger"
                            href="/vat-tax-invoices/index/{{ $company->id }}">
                            <svg class="fill-current w-4 ml-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="ml-1 w-10 text-xs">Cancel</span>
                        </a>
                    </div>
                </div>
                <!-- Title end -->

                <!-- New License Document start -->
                <div class="flex justify-center border rounded-lg w-[1200px] p-4">
                    <div class="w-[950px]">
                        <div class="grid grid-cols-2 gap-2 w-[950px]">
                            <div class="p-2 mt-2 border rounded-lg">
                                <div class="flex">
                                    <label class="text-sm text-stone-100 w-24">Nomor Invoice</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <label class="text-sm text-stone-100 ml-2">{{ $billing->invoice_number }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-100 w-24">Total Tagihan</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <label class="text-sm text-stone-100 ml-2">Rp.
                                        {{ number_format($billing->nominal) }},-</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-100 w-24">Total Ppn</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <label class="text-sm text-stone-100 ml-2">Rp.
                                        {{ number_format($billing->ppn) }},-</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-100 w-24">No. Faktur</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <input name="number" type="text" placeholder="Input Nomor Faktur PPN"
                                        value="{{ old('number') }}"
                                        class="text-sm outline-none rounded-md px-1 ml-2 w-[330px]">
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-100 w-24">Tgl. Faktur</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <input name="tax_date" type="date" class="text-sm outline-none rounded-md px-1 ml-2"
                                        value="{{ old('tax_date') }}">
                                </div>
                            </div>
                            <div class="p-2 mt-2 border rounded-lg">
                                <div class="flex">
                                    <label class="text-sm text-stone-100 w-24">Perusahaan</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <label class="text-sm text-stone-100 ml-2">{{ $client->company }}</label>
                                </div>
                                <div class="flex mt-1">
                                    <label class="text-sm text-stone-100 w-24">Alamat</label>
                                    <label class="text-sm text-stone-100 ml-2">:</label>
                                    <label class="text-sm text-stone-100 w-[340px] ml-2">{{ $client->address }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="flex w-full justify-center mt-4">
                            <input id="documentTax" name="documents[]" type="file"
                                accept="image/png, image/jpg, image/jpeg" onchange="imagePreview(this)" multiple hidden>
                            <button id="btnChooseImages" class="flex justify-center items-center w-44 btn-primary-small"
                                title="Chose Files" type="button" onclick="document.getElementById('documentTax').click()">
                                <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                    clip-rule="evenodd" viewBox="0 0 24 24">
                                    <path d="M23 0v20h-8v-2h6v-16h-18v16h6v2h-8v-20h22zm-12 13h-4l5-6 5 6h-4v11h-2v-11z" />
                                </svg>
                                <span class="ml-2">Pilih Dokumen</span>
                            </button>
                        </div>
                        <div class="flex items-center mt-2 w-full justify-center border rounded-lg">
                            <label class="text-sm text-stone-100 w-20">Jumlah File</label>
                            <label class="text-sm text-stone-100 ml-2">:</label>
                            <label id="numberImagesFile" class="text-sm text-stone-100 ml-2"> 0 file yang
                                dipilih</label>
                        </div>
                        @error('documents.*')
                            <div class="invalid-feedback">
                                Ukuran file max 1024 kb, tipe file jpeg/jpg/png
                            </div>
                        @enderror
                        @error('documents')
                            <div class="text-red-600 flex mx-2">
                                {{ $message }}
                            </div>
                        @enderror
                        <figure class="flex w-[950px] justify-center overflow-x-auto border-b-2 border mt-2"
                            id="figureImages">

                        </figure>
                        <div class="relative m-auto w-[950px] h-max mt-2">
                            <div id="prevButton" class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                <button
                                    class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    type="button" onclick="prevButtonAction()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="nextButton" class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                <button type="button"
                                    class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-teal-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                    onclick="nextButtonAction()">
                                    <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd"
                                        clip-rule="evenodd" viewBox="0 0 24 24">
                                        <path d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                    </svg>
                                </button>
                            </div>
                            <div id="slidesPreview" class="mt-2">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- New License Document end -->
            </div>
        </div>
    </form>
    <!-- Container end -->
    <!-- Script start -->
    <script src="/js/addlegaldocuments.js"></script>
    <!-- Script end -->
@endsection
