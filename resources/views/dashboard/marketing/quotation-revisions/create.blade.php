@extends('dashboard.layouts.main');

@section('container')
    <!-- Show Quotatin start -->
    <div class="flex justify-center">
        <div class="mt-10">
            <!-- Title Show Quotatin start -->
            <div class="flex border-b">
                <h1 class="text-xl text-cyan-800 font-bold tracking-wider">DETAIL PENAWAWARAN</h1>
            </div>
            <!-- Title Show Quotatin end -->
            <form id="formCreate" name="formCreate" class="flex justify-center"
                action="/dashboard/marketing/billboard-quot-revisions" method="post" enctype="multipart/form-data">
                @csrf
                <input class="@error('billboard_quotation_id') is-invalid @enderror" id="billboard_quotation_id"
                    name="billboard_quotation_id" type="text" value="{{ $billboard_quotation->id }}" hidden>
                <input class="@error('number') is-invalid @enderror" id="number" name="number" type="text"
                    value="{{ old('number') }}" hidden>
                @if (old('billboards'))
                    <input id="billboards" name="billboards" type="text" value="{{ old('billboards') }}" hidden>
                @else
                    <input id="billboards" name="billboards" type="text" value="{{ $billboard_quotation->billboards }}"
                        hidden>
                @endif
                <input class="@error('attachment') is-invalid @enderror" id="attachment" name="attachment" type="text"
                    value="{{ $billboard_quotation->attachment }}" hidden>
                <input class="@error('subject') is-invalid @enderror" id="subject" name="subject" type="text"
                    value="{{ $billboard_quotation->subject }}" hidden>
                <input class="@error('body_top') is-invalid @enderror" id="body_top" name="body_top" type="text"
                    value="{{ $billboard_quotation->body_top }}" hidden>
                <input class="@error('note') is-invalid @enderror" id="note" name="note" type="text"
                    value="{{ old('note') }}" hidden>
                <input class="@error('body_end') is-invalid @enderror" id="body_end" name="body_end" type="text"
                    value="{{ $billboard_quotation->body_end }}" hidden>
                <input class="@error('priceType') is-invalid @enderror" id="priceType" name="priceType" type="text"
                    value="{{ old('priceType') }}" hidden>
                <div class="flex">
                    <div class="flex justify-center">
                        <div class="flex mx-1">
                            <div class="">
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nomor Penawaran
                                            Utama</label>
                                        <label id="mainNumber"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->number }}</label>
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nomor Penawaran
                                            Revisi</label>
                                        <label id="revisionNumber" name="revisionNumber"
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1"></label>
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Nama Perusahaan</label>
                                        <label
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->client->company }}</label>
                                    </div>
                                </div>
                                <div class="flex mt-1">
                                    <div class="mt-1">
                                        <label class="text-sm xl:text-md 2xl:text-lg text-teal-700">Kontak Person</label>
                                        <label
                                            class="flex w-36 xl:w-48 2xl:w-56  text-sm xl:text-md 2xl:text-lg font-semibold text-teal-900 border rounded-lg p-1">{{ $billboard_quotation->contact->name }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-start mt-5">
                                    <button id="btnPreview" name="btnPreview"
                                        class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-warning cursor-pointer"
                                        type="button">
                                        <svg class="fill-current w-5" xmlns="http://www.w3.org/2000/svg" width="24"
                                            height="24" viewBox="0 0 24 24">
                                            <path
                                                d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                                        </svg>
                                        <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Preview</span>
                                    </button>
                                    <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                                        href="/dashboard/marketing/billboard-quotations">
                                        <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 mx-1"
                                            xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24">
                                            <path
                                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                                        </svg>
                                        <span class="mx-1 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div id="pdfPreview" class="h-[1345px] mb-10">
                            <!-- Header start -->
                            <div class="w-[950px] h-[1345px] mt-2 bg-white border">
                                <div class="h-24 mt-4">
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
                                        <div class="w-[725px] mt-4">
                                            <div class="flex">
                                                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                                <label class="ml-1 text-sm text-black flex">:</label>
                                                <label id="revisionNumberPreview"
                                                    class="ml-1 text-sm text-black flex"></label>
                                            </div>
                                            <div class="flex">
                                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                                <label class="ml-1 text-sm text-black flex">:</label>
                                                <label id="attachmentBillboard"
                                                    class="ml-1 text-sm text-black flex">{{ $billboard_quotation->attachment }}</label>
                                            </div>
                                            <div class="flex">
                                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                                <label class="ml-1 text-sm text-black flex">:</label>
                                                <label id="subjectBillboard"
                                                    class="ml-1 text-sm text-black flex">{{ $billboard_quotation->subject }}</label>
                                            </div>
                                            <div class="flex mt-4">
                                                <div>
                                                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                                    <label id="clientCompany"
                                                        class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_quotation->client->company }}</label>
                                                    <label id="clientContact"
                                                        class="ml-1 text-sm text-black flex font-semibold">UP.
                                                        {{ $billboard_quotation->contact->name }}</label>
                                                    <label class="ml-1 text-sm text-black flex">Di -</label>
                                                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                                                </div>
                                            </div>
                                            <div class="flex mt-4">
                                                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                                <label class="ml-1 text-sm text-black flex">:</label>
                                                <label id="contactEmail"
                                                    class="ml-1 text-sm text-black flex">{{ $billboard_quotation->contact->email }}</label>
                                            </div>
                                            <div class="flex">
                                                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                                <label class="ml-1 text-sm text-black flex">:</label>
                                                <label id="contactPhone"
                                                    class="ml-1 text-sm text-black flex">{{ $billboard_quotation->contact->phone }}</label>
                                            </div>
                                            <div class="flex mt-4">
                                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                            </div>
                                            <div class="flex mt-2">
                                                <label id="bodyTopBillboard"
                                                    class="ml-1 w-[725px] h-max text-sm text-black flex">{{ $billboard_quotation->body_top }}</label>
                                            </div>
                                            <?php
                                            $objLocations = json_decode($billboard_quotation->billboards);
                                            ?>
                                            <div class="flex items-center border-b p-1 w-[725px]">
                                                <label class="text-sm font-semibold text-teal-700 flex w-max p-1">Type
                                                    Harga
                                                    : </label>
                                                <div class="flex justify-start">
                                                    @if ($billboard_quotation->price_type == 'Harga Otomatis' || old('price_type') == 'Harga Otomatis')
                                                        <input class="flex ml-2" type="radio" id="auto"
                                                            name="price_type" value="Harga Otomatis" checked><label
                                                            class="ml-1 text-sm xl:text-md 2xl:text-lg text-teal-700 font-semibold"
                                                            for="html">Otomatis</label>
                                                        <input class="hidden" type="radio" id="manual"
                                                            name="price_type" value="Harga Manual"><label
                                                            class="ml-1 text-sm xl:text-md 2xl:text-lg text-teal-700 font-semibold"
                                                            for="html" hidden>Manual</label>
                                                    @elseif ($billboard_quotation->price_type == 'Harga Manual' || old('price_type') == 'Harga Manual')
                                                        <input class="flex ml-2" type="radio" id="manual"
                                                            name="price_type" value="Harga Manual" checked><label
                                                            class="ml-1 text-sm xl:text-md 2xl:text-lg text-teal-700 font-semibold"
                                                            for="html">Manual</label>
                                                        <input class="hidden" type="radio" id="auto"
                                                            name="price_type" value="Harga Otomatis">
                                                        <label
                                                            class="ml-1 text-sm xl:text-md 2xl:text-lg text-teal-700 font-semibold"
                                                            for="html" hidden>Otomatis</label>
                                                    @endif
                                                </div>
                                            </div>
                                            <div id="priceTypeBillboard">
                                                <div class="flex items-center w-[600px] mt-1">
                                                    @if ($billboard_quotation->price_type == 'Harga Otomatis' || old('price_type') == 'Harga Otomatis')
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="aMonth"
                                                                name="aMonth" value="{{ old('aMonth') }}" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="oneMonth" type="text"
                                                                value="{{ old('oneMonth') }}" readonly>
                                                        @elseif ($objLocations->locations[0]->price->periodeMonth->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="aMonth"
                                                                name="aMonth" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="oneMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeMonth->periode }}"
                                                                readonly>
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="aMonth"
                                                                name="aMonth">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="oneMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeMonth->periode }}"
                                                                readonly>
                                                        @endif
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="quarterYear"
                                                                name="quarterYear" value="{{ old('quarterYear') }}"
                                                                checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="threeMonth" type="text"
                                                                value="{{ old(threeMonth) }}" readonly>
                                                        @elseif ($objLocations->locations[0]->price->periodeQuarter->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="quarterYear"
                                                                name="quarterYear" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="threeMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeQuarter->periode }}"
                                                                readonly>
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="quarterYear"
                                                                name="quarterYear" value="1">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="threeMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeQuarter->periode }}"
                                                                readonly>
                                                        @endif
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="halfYear"
                                                                name="halfYear" value="{{ old('halfYear') }}" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="sixMonth" type="text"
                                                                value="{{ old('sixMonth') }}" readonly>
                                                        @elseif ($objLocations->locations[0]->price->periodeHalf->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="halfYear"
                                                                name="halfYear" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="sixMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeHalf->periode }}"
                                                                readonly>
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="halfYear"
                                                                name="halfYear">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="sixMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeHalf->periode }}"
                                                                readonly>
                                                        @endif
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="aYear"
                                                                name="aYear" value="{{ old('aYear') }}" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="twelveMonth" type="text"
                                                                value="{{ old('twelveMonth') }}" readonly>
                                                        @elseif ($objLocations->locations[0]->price->periodeYear->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="aYear"
                                                                name="aYear" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="twelveMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeYear->periode }}"
                                                                readonly>
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="aYear"
                                                                name="aYear">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="twelveMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeYear->periode }}"
                                                                readonly>
                                                        @endif
                                                    @elseif ($billboard_quotation->price_type == 'Harga Manual' || old('price_type') == 'Harga Manual')
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="aMonth"
                                                                name="aMonth" value="{{ old('aMonth') }}" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="oneMonth" type="text"
                                                                value="{{ old('oneMonth') }}">
                                                        @elseif ($objLocations->locations[0]->price->periodeMonth->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="aMonth"
                                                                name="aMonth" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="oneMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeMonth->periode }}">
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="aMonth"
                                                                name="aMonth">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="oneMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeMonth->periode }}">
                                                        @endif
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="quarterYear"
                                                                name="quarterYear" value="{{ old('quarterYear') }}"
                                                                checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="threeMonth" type="text"
                                                                value="{{ old('threeMonth') }}">
                                                        @elseif ($objLocations->locations[0]->price->periodeQuarter->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="quarterYear"
                                                                name="quarterYear" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="threeMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeQuarter->periode }}">
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="quarterYear"
                                                                name="quarterYear">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="threeMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeQuarter->periode }}">
                                                        @endif
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="halfYear"
                                                                name="halfYear" value="{{ old('halfYear') }}" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="sixMonth" type="text"
                                                                value="{{ old('sixMonth') }}">
                                                        @elseif ($objLocations->locations[0]->price->periodeHalf->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="halfYear"
                                                                name="halfYear" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="sixMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeHalf->periode }}">
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="halfYear"
                                                                name="halfYear">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="sixMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeHalf->periode }}">
                                                        @endif
                                                        @if (old('price_type'))
                                                            <input class="ml-2" type="checkbox" id="aYear"
                                                                name="aYear" value="{{ old('aYear') }}" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="twelveMonth" type="text"
                                                                value="{{ old('twelveMonth') }}">
                                                        @elseif ($objLocations->locations[0]->price->periodeYear->cbPeriode == true)
                                                            <input class="ml-2" type="checkbox" id="aYear"
                                                                name="aYear" checked>
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="twelveMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeYear->periode }}">
                                                        @else
                                                            <input class="ml-2" type="checkbox" id="aYear"
                                                                name="aYear">
                                                            <input
                                                                class="ml-1 text-sm text-teal-700 flex w-20 rounded-md p-1 outline-teal-100"
                                                                id="twelveMonth" type="text"
                                                                value="{{ $objLocations->locations[0]->price->periodeYear->periode }}">
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Billboard Location Table Preview start -->
                                    <div id="" class="ml-2">
                                        <div class="flex justify-center">
                                            <div id="tableWidth" class="w-[725px]">
                                                <table id="billboardTable" class="table-fix mt-2 w-full">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-[0.7rem] text-teal-700 border w-6"
                                                                rowspan="2">No
                                                            </th>
                                                            <th class="text-[0.7rem] text-teal-700 border w-20"
                                                                rowspan="2">
                                                                Kode
                                                            </th>
                                                            <th class="text-[0.7rem] text-teal-700 border" rowspan="2">
                                                                Lokasi
                                                            </th>
                                                            <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                                                                Deskripsi
                                                            </th>
                                                            <th id="thPrice" class="text-[0.7rem] text-teal-700 border">
                                                                Harga (Rp.)
                                                            </th>
                                                            {{-- <th class="text-[0.7rem] text-teal-700 border" rowspan="2">
                                                        </th> --}}
                                                        </tr>
                                                        <tr>
                                                            <th class="text-[0.7rem] text-teal-700 border w-9">Jenis</th>
                                                            <th class="text-[0.7rem] text-teal-700 border w-9">BL/FL</th>
                                                            <th class="text-[0.7rem] text-teal-700 border w-[88px]">Size -
                                                                V/H
                                                            </th>
                                                            @if ($objLocations->locations[0]->price->periodeMonth->cbPeriode == true)
                                                                <th id="thAMonth"
                                                                    class="text-[0.7rem] text-teal-700 border w-[72px]">
                                                                    {{ $objLocations->locations[0]->price->periodeMonth->periode }}
                                                                </th>
                                                            @else
                                                                <th id="thAMonth"
                                                                    class="text-[0.7rem] text-teal-700 border w-[72px]"
                                                                    hidden>
                                                                    {{ $objLocations->locations[0]->price->periodeMonth->periode }}
                                                                </th>
                                                            @endif
                                                            @if ($objLocations->locations[0]->price->periodeQuarter->cbPeriode == true)
                                                                <th id="thQuarterYear"
                                                                    class="text-[0.7rem] text-teal-700 border  w-[72px]">
                                                                    {{ $objLocations->locations[0]->price->periodeQuarter->periode }}
                                                                </th>
                                                            @else
                                                                <th id="thQuarterYear"
                                                                    class="text-[0.7rem] text-teal-700 border  w-[88px]"
                                                                    hidden>
                                                                    {{ $objLocations->locations[0]->price->periodeQuarter->periode }}
                                                                </th>
                                                            @endif
                                                            @if ($objLocations->locations[0]->price->periodeHalf->cbPeriode == true)
                                                                <th id="thHalfYear"
                                                                    class="text-[0.7rem] text-teal-700 border w-[72px]">
                                                                    {{ $objLocations->locations[0]->price->periodeHalf->periode }}
                                                                </th>
                                                            @else
                                                                <th id="thHalfYear"
                                                                    class="text-[0.7rem] text-teal-700 border w-[72px]"
                                                                    hidden>
                                                                    {{ $objLocations->locations[0]->price->periodeHalf->periode }}
                                                                </th>
                                                            @endif
                                                            @if ($objLocations->locations[0]->price->periodeYear->cbPeriode == true)
                                                                <th id="thAYear"
                                                                    class="text-[0.7rem] text-teal-700 border w-[72px]">
                                                                    {{ $objLocations->locations[0]->price->periodeYear->periode }}
                                                                </th>
                                                            @else
                                                                <th id="thAYear"
                                                                    class="text-[0.7rem] text-teal-700 border w-[88px]"
                                                                    hidden>
                                                                    {{ $objLocations->locations[0]->price->periodeYear->periode }}
                                                                </th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody id="billboardTBody">
                                                        @foreach ($objLocations->locations as $location)
                                                            <tr>
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    {{ $location->code }} - {{ $location->city }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-teal-700 border">
                                                                    {{ $location->address }}
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    @if ($location->category == 'Billboard')
                                                                        BB
                                                                    @elseif ($location->category == 'Bando')
                                                                        BD
                                                                    @elseif ($location->category == 'Baliho')
                                                                        BLH
                                                                    @elseif ($location->category == 'Midiboard')
                                                                        MB
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    @if ($location->lighting == 'Frontlight')
                                                                        FL
                                                                    @elseif ($location->lighting == 'Backlight')
                                                                        BL
                                                                    @endif
                                                                </td>
                                                                <td class="text-[0.7rem] text-center text-teal-700 border">
                                                                    {{ $location->size }} -
                                                                    @if ($location->orientation == 'Horizontal')
                                                                        H
                                                                    @elseif ($location->orientation == 'Vertikal')
                                                                        V
                                                                    @endif
                                                                </td>
                                                                @if ($location->price->periodeMonth->cbPeriode == true || old('aMonth') == true)
                                                                    <td
                                                                        class="text-[0.7rem] text-center text-teal-700 border">
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeMonth->priceMonth }}">
                                                                    </td>
                                                                @else
                                                                    <td class="text-[0.7rem] text-center text-teal-700 border"
                                                                        hidden>
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeMonth->priceMonth }}">
                                                                    </td>
                                                                @endif
                                                                @if ($location->price->periodeQuarter->cbPeriode == true || old('quarterYear') == true)
                                                                    <td
                                                                        class="text-[0.7rem] text-center text-teal-700 border">
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeQuarter->priceQuarter }}">
                                                                    </td>
                                                                @else
                                                                    <td class="text-[0.7rem] text-center text-teal-700 border"
                                                                        hidden>
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeQuarter->priceQuarter }}">
                                                                    </td>
                                                                @endif
                                                                @if ($location->price->periodeHalf->cbPeriode == true || old('halfYear') == true)
                                                                    <td
                                                                        class="text-[0.7rem] text-center text-teal-700 border">
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeHalf->priceHalf }}">
                                                                    </td>
                                                                @else
                                                                    <td class="text-[0.7rem] text-center text-teal-700 border"
                                                                        hidden>
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeHalf->priceHalf }}">
                                                                    </td>
                                                                @endif
                                                                @if ($location->price->periodeYear->cbPeriode == true || old('aYear') == true)
                                                                    <td
                                                                        class="text-[0.7rem] text-center text-teal-700 border">
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeYear->priceYear }}">
                                                                    </td>
                                                                @else
                                                                    <td class="text-[0.7rem] text-center text-teal-700 border"
                                                                        hidden>
                                                                        <input
                                                                            class="outline-none border border-teal-50 rounded-md w-[72px]"
                                                                            type="number"
                                                                            value="{{ $location->price->periodeYear->priceYear }}">
                                                                    </td>
                                                                @endif
                                                                <td
                                                                    class="text-[0.7rem] text-teal-700 flex justify-center w-max">
                                                                    {{-- <input type='button' onclick='deleteRow(this);'
                                                                        id='remove'value='Remove'> --}}
                                                                    <button
                                                                        class="index-link text-white w-5 h-4 rounded bg-red-600 hover:bg-red-700 drop-shadow-md mr-1"
                                                                        onclick="deleteRow(this)" type="button">
                                                                        <svg class="fill-current w-4" clip-rule="evenodd"
                                                                            fill-rule="evenodd" stroke-linejoin="round"
                                                                            stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                            xmlns="http://www.w3.org/2000/svg">
                                                                            <path
                                                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                                                                fill-rule="nonzero" />
                                                                        </svg>
                                                                    </button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Billboard Location Table Preview end -->

                                    <!-- billboard note start -->
                                    <?php
                                    $objNotes = json_decode($billboard_quotation->note);
                                    $payment = $objNotes->notes[6];
                                    $objPayment = json_encode($payment);
                                    ?>
                                    <input id="termPayment" type="text" value="{{ $objPayment }}" hidden>
                                    <input id="notesAdd" type="text" value="{{ $billboard_quotation->note }}"
                                        hidden>
                                    <div class="flex justify-center">
                                        <div id="billboardNote" class="w-[725px] mt-2">
                                            <div class="flex">
                                                <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                                <label class="ml-1 text-sm text-black flex">:</label>
                                            </div>
                                            @foreach ($objNotes->notes as $note)
                                                @if ($loop->iteration == 8)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex items-start">
                                                                <input class="ml-1 mt-1"
                                                                    id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <textarea id="inputBBNote-{{ $loop->iteration }}" class="ml-1 w-[721px] outline-none text-sm" rows="4">{{ $note->textNote }}
                                                                    </textarea>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex items-start">
                                                                <input class="ml-1 mt-1"
                                                                    id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <textarea id="inputBBNote-{{ $loop->iteration }}" class="ml-1 w-[721px] outline-none text-sm" rows="5">{{ $note->textNote }}
                                                                    </textarea>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif ($loop->iteration == 7)
                                                    <div id="billboardNote-7">
                                                        <div class="flex">
                                                            <button id="btnAddPayment" type="button"
                                                                class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-8 justify-center items-center text-white p-1">
                                                                <svg class="fill-current w-4" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                                        fill-rule="nonzero" />
                                                                </svg>add payment terms</button>
                                                            <button id="btnDelPayment" type="button"
                                                                class="flex w-max h-5 bg-red-600 text-sm rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                                                <svg class="fill-current w-4" clip-rule="evenodd"
                                                                    fill-rule="evenodd" stroke-linejoin="round"
                                                                    stroke-miterlimit="2" viewBox="0 0 24 24"
                                                                    xmlns="http://www.w3.org/2000/svg">
                                                                    <path
                                                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                                                        fill-rule="nonzero" />
                                                                </svg>remove last payment terms</button>
                                                        </div>
                                                    </div>
                                                @elseif ($loop->iteration == 3)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label class="ml-4 text-sm text-black">• Free
                                                                    pemasangan visual</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    type="number" placeholder="0"
                                                                    class="ml-1 text-sm text-center text-black outline-none w-8"
                                                                    type="text" value="{{ $note->freeInstal }}">
                                                                <label id="labelBBNote-3"
                                                                    class="ml-1 text-sm text-black">x selama
                                                                    kontrak</label>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label class="ml-4 text-sm text-black">• Free
                                                                    pemasangan visual</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    type="number" placeholder="0"
                                                                    class="ml-1 text-sm text-center text-black outline-none w-8"
                                                                    type="text" value="{{ $note->freeInstal }}">
                                                                <label id="labelBBNote-3"
                                                                    class="ml-1 text-sm text-black">x selama
                                                                    kontrak</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif($loop->iteration == 4)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label class="ml-4 text-sm text-black">• Free cetak
                                                                    materi visual</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    type="number" placeholder="0"
                                                                    class="ml-1 text-sm text-center text-black outline-none w-8"
                                                                    type="text" value="{{ $note->freePrint }}">
                                                                <label id="labelBBNote-4"
                                                                    class="ml-1 text-sm text-black">x selama
                                                                    kontrak, di luar Design.</label>

                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label class="ml-4 text-sm text-black">• Free cetak
                                                                    materi visual</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    type="number" placeholder="0"
                                                                    class="ml-1 text-sm text-center text-black outline-none w-8"
                                                                    type="text" value="{{ $note->freePrint }}">
                                                                <label id="labelBBNote-4"
                                                                    class="ml-1 text-sm text-black">x selama
                                                                    kontrak, di luar
                                                                    Design.</label>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif ($loop->iteration == 5)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-4 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-4 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif ($loop->iteration < 9)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                            {{-- @foreach ($objNotes->notes as $note)
                                                @if ($loop->iteration > 10)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach --}}
                                            @foreach ($objNotes->notes as $note)
                                                @if ($loop->iteration == 9)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif ($loop->iteration == 10)
                                                    @if ($note->cbNote == 'true')
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox" checked>
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div>
                                                            <div class="flex">
                                                                <input id="cbBillboardNote-{{ $loop->iteration }}"
                                                                    class="ml-1" type="checkbox">
                                                                <label
                                                                    class="ml-1 text-sm text-black flex">{{ $note->labelNote }}</label>
                                                                <input id="inputBBNote-{{ $loop->iteration }}"
                                                                    class="ml-2 text-sm text-black outline-none w-full"
                                                                    type="text" value="{{ $note->textNote }}">
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            @endforeach
                                            <div class="flex">
                                                <button id="btnAddNotes" type="button"
                                                    class="flex w-max h-5 bg-teal-500 text-sm rounded-md hover:bg-teal-900 cursor-pointer ml-8 justify-center items-center text-white p-1">
                                                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                            fill-rule="nonzero" />
                                                    </svg>add
                                                    notes</button>
                                                <button id="btnDelNotes" type="button"
                                                    class="flex w-max h-5 bg-red-600 text-sm rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                                    <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                        stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                        xmlns="http://www.w3.org/2000/svg">
                                                        <path
                                                            d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                                            fill-rule="nonzero" />
                                                    </svg>remove last notes</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- billboard note end -->

                                    <div class="flex justify-center">
                                        <div class="flex mt-2 w-[725px]">
                                            <label
                                                class="ml-1 w-[650px] h-max text-sm text-black flex">{{ $billboard_quotation->body_end }}</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <?php
                                        $quotationDate = date('d F Y');
                                        ?>
                                        <div class="w-[725px] mt-2">
                                            <label class="ml-1 text-sm text-black flex">Denpasar,
                                                {{ date('d F Y', strtotime($billboard_quotation->created_at)) }}</label>
                                        </div>
                                    </div>
                                    <div class="flex justify-center">
                                        <div class="w-[275px]">
                                            <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista
                                                Media</label>
                                            <label class="ml-1 my-2 text-xs text-slate-300 flex">Ditandatangani secara
                                                elektronik
                                                oleh
                                                :</label>
                                            <label id="salesUser"
                                                class="ml-1 text-sm text-black flex font-semibold">{{ $billboard_quotation->user->name }}</label>
                                            <label id="salesPotition"
                                                class="ml-1 text-sm text-black flex">{{ $billboard_quotation->user->level }}</label>
                                        </div>
                                        <div class="w-[450px]">
                                            <div>
                                                {{ QrCode::size(100)->generate('https://www.vistamedia.co.id/dashboard/marketing/billboard-quotations/' . $billboard_quotation->id) }}
                                            </div>
                                        </div>
                                    </div>
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
                                            <span class="text-xs">Jl. Pulau Kawe No. 40 - Denpasar | Bali -
                                                Indonesia</span>
                                        </div>
                                        <div class="flex items-center w-full justify-center">
                                            <span class="text-xs">Ph. +62 361 230000 | Fax. +62 361 237800 </span>
                                        </div>
                                        <div class="flex items-center w-full justify-center">
                                            <span class="text-xs">e-mail : info@vistamedia.co.id |
                                                www.vistamedia.co.id</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Footer end -->
                        </div>
                    </div>
                </div>
                @include('dashboard.marketing.quotation-revisions.revision-preview')
            </form>
        </div>
    </div>
    <!-- Show Quotatin end -->

    <!-- Script start -->
    <script src="/js/billboardquotrevision.js"></script>
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>
    <!-- Script end -->
@endsection
