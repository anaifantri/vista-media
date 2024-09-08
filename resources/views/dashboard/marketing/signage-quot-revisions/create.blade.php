@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation signage start -->
    <?php
    $products = json_decode($signage_quotation->products);
    $payment_terms = json_decode($signage_quotation->payment_terms);
    $created_by = json_decode($signage_quotation->created_by);
    $notes = json_decode($signage_quotation->notes);
    $price = json_decode($signage_quotation->price);
    $checkbox = 0;
    $width = 0;
    foreach ($price->dataHeader as $header) {
        if ($header->checkbox == true) {
            $checkbox = $checkbox + 1;
        }
    }
    $modified_by = new stdClass();
    $modified_by->id = auth()->user()->id;
    $modified_by->name = auth()->user()->name;
    $modified_by->position = auth()->user()->position;
    ?>
    <input type="text" name="oldProducts" id="oldProducts" value="{{ json_encode($products) }}" hidden>
    <div class="mt-10 z-0">
        <div class="flex w-full justify-center">
            <div class="flex w-[950px] justify-end">
                <button id="btnPreview" class="flex justify-center items-center mx-1 btn-primary" title="Preview"
                    type="button">
                    <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg" width="24"
                        height="24" viewBox="0 0 24 24">
                        <path
                            d="M15 12c0 1.657-1.343 3-3 3s-3-1.343-3-3c0-.199.02-.393.057-.581 1.474.541 2.927-.882 2.405-2.371.174-.03.354-.048.538-.048 1.657 0 3 1.344 3 3zm-2.985-7c-7.569 0-12.015 6.551-12.015 6.551s4.835 7.449 12.015 7.449c7.733 0 11.985-7.449 11.985-7.449s-4.291-6.551-11.985-6.551zm-.015 12c-2.761 0-5-2.238-5-5 0-2.761 2.239-5 5-5 2.762 0 5 2.239 5 5 0 2.762-2.238 5-5 5z" />
                    </svg>
                    <span class="ml-2 text-white">Preview</span>
                </button>
                <a class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                    href="/dashboard/marketing/signage-quotations/{{ $signage_quotation->id }}">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                </a>
            </div>
        </div>
        <div id="pdfPreview">
            <div class="flex justify-center w-full">
                <div class="w-[950px] h-[1345px] border mb-10 mt-1 bg-white">
                    <!-- Header start -->
                    @include('dashboard.layouts.letter-header')
                    <!-- Header end -->
                    <!-- Body start -->
                    <div class="h-[1125px]">
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-slate-500">Auto Numbering</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-black">{{ $signage_quotation->attachment }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-black">{{ $signage_quotation->subject }}</label>
                                </div>
                                <div class="mt-4">
                                    <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                    <label
                                        class="flex ml-1 text-sm text-black font-semibold">{{ $signage_quotation->client->company }}</label>
                                    <label
                                        class="flex ml-1 text-sm text-black font-semibold">{{ $signage_quotation->client_contact }}</label>
                                    <label class="flex ml-1 text-sm text-black">Di -</label>
                                    <label class="flex ml-6 text-sm text-black">Tempat</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black w-20">Email</label>
                                    <label class="ml-1 text-sm text-black ">:</label>
                                    <label class="ml-1 text-sm text-black ">{{ $signage_quotation->contact_email }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                    <label class="ml-1 text-sm text-black ">:</label>
                                    <label class="ml-1 text-sm text-black ">{{ $signage_quotation->contact_phone }}</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                </div>
                                <div class="flex mt-2">
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $signage_quotation->body_top }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- signage table start -->
                        <div class="ml-2">
                            <div class="flex justify-center">
                                <div class="w-[850px]">
                                    <table class="table-auto mt-2 w-full">
                                        <thead id="signageTHead">
                                            <tr>
                                                <th class="text-[0.7rem] text-teal-700 border w-10" rowspan="2">No
                                                </th>
                                                <th class="text-[0.7rem] text-teal-700 border w-[72px]" rowspan="2">Kode
                                                </th>
                                                <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi</th>
                                                <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                                                    Deskripsi
                                                </th>
                                                <th class="text-[0.7rem] text-teal-700 border w-60" colspan="5">Harga
                                                    (Rp.)
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="text-[0.7rem] text-teal-700 border w-16">Jenis</th>
                                                <th class="text-[0.7rem] text-teal-700 border w-28">Size - Side - V/H
                                                </th>
                                                <th class="text-[0.7rem] text-teal-700 border w-10">Qty</th>
                                                <?php
                                                $cbId = ['cbMonth', 'cbQuarter', 'cbHalf', 'cbYear'];
                                                $titleId = ['titleMonth', 'titleQuarter', 'titleHalf', 'titleYear'];
                                                $priceId = ['priceMonth', 'priceQuarter', 'priceHalf', 'priceYear'];
                                                ?>
                                                @foreach ($price->dataHeader as $header)
                                                    @if ($header->checkbox == true)
                                                        <th class="text-[0.7rem] text-teal-700 border w-[80px]">
                                                            <input id="{{ $cbId[$loop->iteration - 1] }}" type="checkbox"
                                                                onclick="cbTitleAction(this)" checked>
                                                            <input id="{{ $titleId[$loop->iteration - 1] }}"
                                                                class="input-td-enable w-14" type="text"
                                                                value="{{ $header->title }}">
                                                        </th>
                                                    @else
                                                        <th class="text-[0.7rem] text-teal-700 border w-[80px]">
                                                            <input id="{{ $cbId[$loop->iteration - 1] }}" type="checkbox"
                                                                onclick="cbTitleAction(this)">
                                                            <input id="{{ $titleId[$loop->iteration - 1] }}"
                                                                class="input-td-disabled w-14" type="text"
                                                                value="{{ $header->title }}" disabled>
                                                        </th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody id="signageTBody">
                                            @foreach ($signages as $signage)
                                                <?php
                                                $row = $loop->iteration - 1;
                                                ?>
                                                <tr>
                                                    <td class="td-enable text-center">
                                                        <input id="{{ $row }}" type="checkbox"
                                                            onclick="cbRow(this)" checked>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td class="td-enable text-center">
                                                        {{ $signage->code }}-{{ $signage->city->code }}
                                                    </td>
                                                    <td class="td-enable">
                                                        {{ $signage->address }}
                                                    </td>
                                                    <td class="td-enable text-center">
                                                        {{ $signage->signage_category->name }}</td>
                                                    <td class="td-enable text-center">
                                                        {{ $signage->size->size }} x {{ $signage->side }} sisi -
                                                        @if ($signage->orientation == 'Vertikal')
                                                            V
                                                        @elseif ($signage->orientation == 'Horizontal')
                                                            H
                                                        @endif
                                                    </td>
                                                    <td class="td-enable text-center">
                                                        {{ $signage->qty }}</td>
                                                    @foreach ($price->dataPrice as $priceValue)
                                                        @if ($price->dataHeader[$loop->iteration - 1]->checkbox == true)
                                                            <td class="td-enable text-center">
                                                                <input id="{{ $priceId[$loop->iteration - 1] }}"
                                                                    class="input-td-enable w-[72px] in-out-spin-none"
                                                                    type="number" min="0"
                                                                    value="{{ $priceValue[$row]->price }}">
                                                            </td>
                                                        @else
                                                            <td class="td-enable text-center">
                                                                <input id="{{ $priceId[$loop->iteration - 1] }}"
                                                                    class="input-td-disabled w-[72px] in-out-spin-none"
                                                                    type="number" min="0"
                                                                    value="{{ $priceValue[$row]->price }}" disabled>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- signage table end -->

                        <!-- quotation note start -->
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                    <label class="ml-1 text-sm text-black flex">:</label>
                                </div>
                                <div id="notesQty">
                                    @foreach ($notes->dataNotes as $note)
                                        @if ($loop->iteration == 2)
                                            <input class="ml-1 text-xs text-black outline-none w-full"
                                                value="{{ $note }}" readonly></input>
                                        @else
                                            <input class="ml-1 text-xs text-black outline-none w-full"
                                                value="{{ $note }}"></input>
                                        @endif
                                    @endforeach
                                </div>
                                <div class="flex">
                                    <button id="btnAddNote" type="button"
                                        class="flex w-max h-5 bg-teal-500 text-xs rounded-md hover:bg-teal-900 cursor-pointer ml-4 justify-center items-center text-white p-1">
                                        <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                fill-rule="nonzero" />
                                        </svg>add
                                        note</button>
                                    <button id="btnDelNote" type="button"
                                        class="flex w-max h-5 bg-red-600 text-xs rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                        <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                            stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                                fill-rule="nonzero" />
                                        </svg>remove last note</button>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                </div>
                                <div id="paymentTerms">
                                    @foreach ($payment_terms->dataPayments as $term)
                                        <div class="flex">
                                            <label class="ml-1 text-xs">-</label>
                                            <input class="text-xs ml-2 outline-none border rounded-md px-1 w-12"
                                                type="number" min="0" max="100"
                                                value="{{ $term->term }}">
                                            <textarea class="text-area-notes" rows="1">{{ $term->note }}</textarea>
                                        </div>
                                    @endforeach
                                </div>
                                <div>
                                    <div class="flex mt-2">
                                        <button id="btnAddPayment" type="button"
                                            class="flex w-max h-5 bg-teal-500 text-xs rounded-md hover:bg-teal-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2c5.518 0 9.998 4.48 9.998 9.998 0 5.517-4.48 9.997-9.998 9.997-5.517 0-9.997-4.48-9.997-9.997 0-5.518 4.48-9.998 9.997-9.998zm-.747 9.25h-3.5c-.414 0-.75.336-.75.75s.336.75.75.75h3.5v3.5c0 .414.336.75.75.75s.75-.336.75-.75v-3.5h3.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-3.5v-3.5c0-.414-.336-.75-.75-.75s-.75.336-.75.75z"
                                                    fill-rule="nonzero" />
                                            </svg>add payment terms</button>
                                        <button id="btnDelPayment" type="button"
                                            class="flex w-max h-5 bg-red-600 text-xs rounded-md hover:bg-red-900 cursor-pointer ml-2 justify-center items-center text-white p-1">
                                            <svg class="fill-current w-4" clip-rule="evenodd" fill-rule="evenodd"
                                                stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm4.253 9.25h-8.5c-.414 0-.75.336-.75.75s.336.75.75.75h8.5c.414 0 .75-.336.75-.75s-.336-.75-.75-.75z"
                                                    fill-rule="nonzero" />
                                            </svg>remove last payment terms</button>
                                    </div>
                                </div>
                            </div>
                            @error('note')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <!-- quotation note end -->

                        <div>
                            <div class="flex justify-center">
                                <div class="flex mt-4">
                                    <label class="ml-1 w-[721px] text-sm">{{ $signage_quotation->body_end }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <?php
                                $quotationDate = date('d F Y', strtotime($signage_quotation->created_at));
                                ?>
                                <div class="w-[725px] mt-4">
                                    <label class="ml-1 text-sm text-black flex">Denpasar, {{ $quotationDate }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px]">
                                    <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-10">
                                    <input
                                        class="ml-1 text-sm text-black flex font-semibold"value="{{ $created_by->name }}"
                                        type="text">
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <div class="w-[725px]">
                                    <input class="ml-1 text-sm text-black flex" value="{{ $created_by->position }}"
                                        type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Body end -->
                    <!-- Footer start -->
                    @include('dashboard.layouts.letter-footer')
                    <!-- Footer end -->
                </div>
            </div>
            <!-- View Location start -->
            @foreach ($signages as $signage)
                <div id="location{{ $loop->iteration - 1 }}">
                    @include('dashboard.layouts.sn-location')
                </div>
            @endforeach
            <!-- View Location end -->
        </div>
    </div>

    <!-- Modal Preview start -->
    <form class="flex justify-center" action="/dashboard/marketing/signage-quot-revisions" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="text" name="signage_quotation_id" id="signage_quotation_id"
            value="{{ $signage_quotation->id }}" hidden>
        <input type="text" name="notes" id="notes" hidden>
        <input type="text" name="products" id="products" hidden>
        <input type="text" name="payment_terms" id="payment_terms" hidden>
        <input type="text" name="price" id="price" hidden>
        <input type="text" name="quotation_number" id="number"
            value="{{ substr($signage_quotation->number, 0, 4) }}" hidden>
        <input type="text" id="modified_by" name="modified_by" value="{{ json_encode($modified_by) }}" hidden>
        <div id="modalPreview" name="modalPreview"
            class="absolute justify-center top-0 w-full h-[full] bg-black bg-opacity-90 z-20 hidden">
            <div class="mt-10">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px] justify-end">
                        <button class="flex justify-center items-center mx-1 btn-primary" title="Save" type="submit">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="ml-2 text-white">Save</span>
                        </button>
                        <button id="btnClose" class="flex justify-center items-center ml-1 xl:mx-2 2xl:h-10 btn-danger"
                            type="button" title="Close">
                            <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm4.151 17.943l-4.143-4.102-4.117 4.159-1.833-1.833 4.104-4.157-4.162-4.119 1.833-1.833 4.155 4.102 4.106-4.16 1.849 1.849-4.1 4.141 4.157 4.104-1.849 1.849z" />
                            </svg>
                            <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Close</span>
                        </button>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] border mb-10 mt-1 bg-white">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-slate-500">Auto Numbering</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label
                                            class="ml-1 text-sm text-black">{{ $signage_quotation->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $signage_quotation->subject }}</label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $signage_quotation->client->company }}</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $signage_quotation->client_contact }}</label>
                                        <label class="flex ml-1 text-sm text-black">Di -</label>
                                        <label class="flex ml-6 text-sm text-black">Tempat</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black w-20">Email</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $signage_quotation->contact_email }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $signage_quotation->contact_phone }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $signage_quotation->body_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- signage table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    <div id="divTable" class="">
                                        <table class="table-auto mt-2 w-full">
                                            <thead id="previewTHead">
                                                <tr>
                                                    <th class="text-[0.7rem] text-teal-700 border w-6" rowspan="2">No
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[72px]"
                                                        rowspan="2">
                                                        Kode
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" rowspan="2">Lokasi
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" colspan="3">
                                                        Deskripsi
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border" colspan="5">Harga
                                                        (Rp.)
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th class="text-[0.7rem] text-teal-700 border w-14">Jenis</th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-28">Size - Side - V/H
                                                    </th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-10">Qty</th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[90px]"></th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[90px]"></th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[90px]"></th>
                                                    <th class="text-[0.7rem] text-teal-700 border w-[90px]"></th>
                                                </tr>
                                            </thead>
                                            <tbody id="previewTBody">
                                                @foreach ($signages as $signage)
                                                    <?php
                                                    $row = $loop->iteration - 1;
                                                    ?>
                                                    <tr>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $loop->iteration }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->code }}-{{ $signage->city->code }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border">
                                                            {{ $signage->address }}
                                                        </td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->signage_category->name }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->size->size }} x {{ $signage->side }} sisi -
                                                            @if ($signage->orientation == 'Vertikal')
                                                                V
                                                            @elseif ($signage->orientation == 'Horizontal')
                                                                H
                                                            @endif
                                                        </td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center">
                                                            {{ $signage->qty }}</td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center"></td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center"></td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center"></td>
                                                        <td class="text-[0.7rem] text-teal-700 border text-center"></td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- signage table end -->

                            <!-- quotation note start -->
                            <div class="flex justify-center">
                                <div class="w-[725px] mt-2">
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Catatan</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                    </div>
                                    <div id="previewNotesQty"></div>
                                    <div class="flex mt-2">
                                        <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                    </div>
                                    <div id="previewPaymentTerms"></div>
                                </div>
                            </div>
                            <!-- quotation note end -->

                            <div>
                                <div class="flex justify-center">
                                    <div class="flex mt-4">
                                        <textarea id="body_end" name="body_end" class="ml-1 w-[721px] outline-none text-sm" rows="1" readonly>Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <?php
                                    $quotationDate = date('d F Y');
                                    ?>
                                    <div class="w-[725px] mt-4">
                                        <label class="ml-1 text-sm text-black flex">Denpasar, {{ $quotationDate }}</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <label class="ml-1 text-sm text-black flex font-semibold">PT. Vista Media</label>
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px] mt-10">
                                        <input class="ml-1 text-sm text-black flex font-semibold"
                                            value="{{ auth()->user()->name }}" type="text">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <input class="ml-1 text-sm text-black flex"
                                            value="{{ auth()->user()->position }}" type="text">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Body end -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                </div>
                <!-- View Location start -->
                @foreach ($signages as $signage)
                    <div id="previewLocation{{ $loop->iteration - 1 }}">
                        @include('dashboard.layouts.sn-location')
                    </div>
                @endforeach
                <!-- View Location end -->
            </div>
        </div>
    </form>
    <!-- Modal Preview end -->

    <!-- Quotation signage end -->
    <script>
        //const notes
        const btnAddNote = document.getElementById("btnAddNote");
        const btnDelNote = document.getElementById("btnDelNote");
        const notesQty = document.getElementById("notesQty");
        const btnAddPayment = document.getElementById("btnAddPayment");
        const btnDelPayment = document.getElementById("btnDelPayment");
        const paymentTerms = document.getElementById("paymentTerms");

        //const preview check
        const btnPreview = document.getElementById("btnPreview");
        const createNumber = document.getElementById("createNumber");
        const modalPreview = document.getElementById("modalPreview");
        const btnClose = document.getElementById("btnClose");

        // Button Preview Action --> start
        btnPreview.addEventListener("click", function() {
            if (paymentCheck() == true && getPrice() == true && getProducts() == true) {
                modalPreview.classList.remove("hidden");
                fillData();
                getNotes();
                getPayments();
            }
        })
        // Button Preview Action --> end

        // Button Close Action --> start
        btnClose.addEventListener("click", function() {
            modalPreview.classList.add("hidden");
        })
        // Button Close Action --> end

        // Button Get Products --> start
        getProducts = () => {
            const oldProducts = document.getElementById("oldProducts");
            const products = document.getElementById("products");
            const signageTBody = document.getElementById("signageTBody");
            var tableRow = signageTBody.getElementsByTagName('tr');
            var productsCheck = false;

            let dataProducts = {};

            for (let i = 0; i < tableRow.length; i++) {
                if (Boolean(tableRow[i].cells[0].children[0].checked) == true) {
                    productsCheck = true;
                }
            }

            if (productsCheck == true) {
                dataProducts = JSON.parse(oldProducts.value);
                for (let i = 0; i < tableRow.length; i++) {
                    if (Boolean(tableRow[i].cells[0].children[0].checked) == false) {
                        dataProducts.splice(i, 1);
                    }
                }
                products.value = JSON.stringify(dataProducts);
                return true;
            } else {
                alert("Silahkan pilih minimal 1 lokasi")
            }

        }
        // Button Get Products --> end

        // Function Payment Check --> start
        paymentCheck = () => {
            var payment = 0;
            for (let i = 0; i < paymentTerms.children.length; i++) {
                if (paymentTerms.children[i].children[1].value == 0) {
                    payment = 0;
                    alert("Silahkan input termin pembayaran yang masih kosong");
                    paymentTerms.children[i].children[1].focus();
                    return false;
                } else {
                    payment = payment + Number(paymentTerms.children[i].children[1].value);
                }
            }
            if (payment != 100) {
                alert("Total termin pembayaran tidak sama dengan 100%, silahkan sesuaikan lagi termin pembayaran");
                payment = 0;
                paymentTerms.children[0].children[1].focus();
            } else {
                return true;
            }
        }
        // Function Payment Check --> end

        // Function Fill Data --> start
        fillData = () => {
            const divTable = document.getElementById("divTable");
            const signageTBody = document.getElementById("signageTBody");
            var signageTableRow = signageTBody.getElementsByTagName('tr');
            const previewTHead = document.getElementById("previewTHead");
            const previewTBody = document.getElementById("previewTBody");
            var tableRow = previewTBody.getElementsByTagName('tr');
            var tableHead = previewTHead.getElementsByTagName('tr');

            let objPrice = JSON.parse(price.value);
            let dataPrice = objPrice.dataPrice;
            let dataHeader = objPrice.dataHeader;

            var priceActive = 0;
            var resetNumber = 0;

            for (let i = 0; i < dataHeader.length; i++) {
                if (dataHeader[i].checkbox == true) {
                    priceActive = priceActive + 1;
                    tableHead[1].cells[i + 3].innerHTML = dataHeader[i].title;
                    tableHead[1].cells[i + 3].removeAttribute('hidden');
                    for (let n = 0; n < tableRow.length; n++) {
                        tableRow[n].cells[i + 6].removeAttribute('hidden');
                    }
                } else {
                    tableHead[1].cells[i + 3].innerHTML = dataHeader[i].title;
                    tableHead[1].cells[i + 3].setAttribute('hidden', 'hidden');
                    for (let n = 0; n < tableRow.length; n++) {
                        tableRow[n].cells[i + 6].setAttribute('hidden', 'hidden');
                    }
                }
            }
            for (let i = 0; i < tableRow.length; i++) {
                if (signageTableRow[i].cells[0].children[0].checked == false) {
                    tableRow[i].setAttribute('hidden', 'hidden');
                } else {
                    resetNumber = resetNumber + 1;
                    tableRow[i].removeAttribute('hidden');
                    tableRow[i].cells[0].innerHTML = "";
                    tableRow[i].cells[0].innerHTML = resetNumber;
                    tableRow[i].cells[6].innerHTML = "Rp. " + dataPrice[0][i].price.toLocaleString() + ",-";
                    tableRow[i].cells[7].innerHTML = "Rp. " + dataPrice[1][i].price.toLocaleString() + ",-";
                    tableRow[i].cells[8].innerHTML = "Rp. " + dataPrice[2][i].price.toLocaleString() + ",-";
                    tableRow[i].cells[9].innerHTML = "Rp. " + dataPrice[3][i].price.toLocaleString() + ",-";
                }
            }
            if (priceActive > 2) {
                divTable.classList.add("w-[850px]");
            } else {
                divTable.classList.add("w-[725px]");
            }
        }
        // Function Fill Data --> 

        // Function Get Note --> start
        getNotes = () => {
            const notes = document.getElementById("notes");
            const previewNotesQty = document.getElementById("previewNotesQty");
            let objNotes = {};
            let dataNotes = [];

            while (previewNotesQty.hasChildNodes()) {
                previewNotesQty.removeChild(previewNotesQty.firstChild);
            }

            for (let i = 0; i < notesQty.children.length; i++) {
                if (notesQty.children[i].value != "") {
                    dataNotes[i] = notesQty.children[i].value;

                    const divNotes = document.createElement("div");
                    const labelNotes = document.createElement("label");

                    divNotes.classList.add("flex");
                    labelNotes.classList.add("flex");
                    labelNotes.classList.add("text-xs");
                    labelNotes.classList.add("text-black");

                    if (i == 2 || i == 3) {
                        labelNotes.classList.add("ml-4");
                    } else {
                        labelNotes.classList.add("ml-1");
                    }

                    labelNotes.innerHTML = notesQty.children[i].value;

                    divNotes.appendChild(labelNotes);
                    previewNotesQty.appendChild(divNotes);
                }
            }

            objNotes = {
                dataNotes
            };
            notes.value = JSON.stringify(objNotes);
        }
        // Function Get Note --> end

        // Function Get Payment Terms --> start
        getPayments = () => {
            const terms = document.getElementById("payment_terms");
            const previewPaymentTerms = document.getElementById("previewPaymentTerms");
            let objPayments = {};
            let dataPayments = [];

            while (previewPaymentTerms.hasChildNodes()) {
                previewPaymentTerms.removeChild(previewPaymentTerms.firstChild);
            }

            for (let i = 0; i < paymentTerms.children.length; i++) {
                dataPayments[i] = {
                    term: paymentTerms.children[i].children[1].value,
                    note: paymentTerms.children[i].children[2].value,
                }

                const divTerms = document.createElement("div");
                const labelTerms = document.createElement("label");

                divTerms.classList.add("flex");
                labelTerms.classList.add("flex");
                labelTerms.classList.add("text-xs");
                labelTerms.classList.add("ml-1");
                labelTerms.classList.add("text-black");

                labelTerms.innerHTML = '- ' + paymentTerms.children[i].children[1].value + ' ' + paymentTerms.children[
                    i].children[2].value;

                divTerms.appendChild(labelTerms);
                previewPaymentTerms.appendChild(divTerms);
            }

            objPayments = {
                dataPayments
            };
            terms.value = JSON.stringify(objPayments);
        }
        // Function Get Payment Terms --> end

        // Function Get Price --> start
        getPrice = () => {
            const cbMonth = document.getElementById("cbMonth");
            const cbQuarter = document.getElementById("cbQuarter");
            const cbHalf = document.getElementById("cbHalf");
            const cbYear = document.getElementById("cbYear");
            const signageTHead = document.getElementById("signageTHead");
            const signageTBody = document.getElementById("signageTBody");
            var tableRow = signageTBody.getElementsByTagName('tr');
            var tableHead = signageTHead.getElementsByTagName('tr');

            let objPrice = {};
            let dataPrice = [];
            let dataHeader = [];
            let dataPriceMonth = [];
            let dataPriceQuarter = [];
            let dataPriceHalf = [];
            let dataPriceYear = [];

            for (let i = 0; i < tableRow.length; i++) {
                console.log(tableRow[i].cells[0].children[0].checked);
                if (tableRow[i].cells[0].children[0].checked == true) {
                    dataPriceMonth[i] = {
                        signage_code: tableRow[i].cells[1].innerText.substring(0, 4),
                        city_code: tableRow[i].cells[1].innerText.substring(5),
                        price: Number(tableRow[i].cells[6].children[0].value)
                    }
                    dataPriceQuarter[i] = {
                        signage_code: tableRow[i].cells[1].innerText.substring(0, 4),
                        city_code: tableRow[i].cells[1].innerText.substring(5),
                        price: Number(tableRow[i].cells[7].children[0].value)
                    }
                    dataPriceHalf[i] = {
                        signage_code: tableRow[i].cells[1].innerText.substring(0, 4),
                        city_code: tableRow[i].cells[1].innerText.substring(5),
                        price: Number(tableRow[i].cells[8].children[0].value)
                    }
                    dataPriceYear[i] = {
                        signage_code: tableRow[i].cells[1].innerText.substring(0, 4),
                        city_code: tableRow[i].cells[1].innerText.substring(5),
                        price: Number(tableRow[i].cells[9].children[0].value)
                    }
                }
            }
            dataPrice[0] = dataPriceMonth;
            dataPrice[1] = dataPriceQuarter;
            dataPrice[2] = dataPriceHalf;
            dataPrice[3] = dataPriceYear;

            for (let i = 0; i < 4; i++) {
                dataHeader[i] = {
                    checkbox: tableHead[1].cells[i + 3].children[0].checked,
                    title: tableHead[1].cells[i + 3].children[1].value
                }
            }

            objPrice = {
                dataHeader,
                dataPrice
            };

            if (cbMonth.checked == false && cbQuarter.checked == false && cbHalf.checked == false && cbYear.checked ==
                false) {
                alert("Pilihan harga tidak boleh kosong");
                return false;
            } else {
                price.value = JSON.stringify(objPrice);
                return true;
            }
        }
        // Function Get Price --> end

        // Button Add Note Action --> start
        btnAddNote.addEventListener("click", function() {
            if (notesQty.children.length < 9) {
                const inputNotes = document.createElement("input");
                inputNotes.classList.add("text-area-notes");
                inputNotes.value = "- ";

                notesQty.insertBefore(inputNotes, notesQty.children[notesQty.children.length - 1]);
                inputNotes.focus();
            } else {
                alert("Maksimal tambahan 3 catatan");
            }
        });
        // Button Add Note Action --> end

        // Button Remove Last Note Action --> start
        btnDelNote.addEventListener("click", function() {
            if (notesQty.children.length > 6) {
                notesQty.removeChild(notesQty.children[notesQty.children.length - 2]);
            } else {
                alert("Tidak ada tambahan catatan yang bisa dihapus");
            }
        });
        // Button Remove Last Note Action --> end

        // Button Add Payment Action --> start
        btnAddPayment.addEventListener("click", function() {
            if (paymentTerms.children.length < 4) {
                const divPayment = document.createElement("div");
                const labelPayment = document.createElement("label");
                const termOfPayment = document.createElement("input");
                const paymentDescription = document.createElement("textarea");
                divPayment.classList.add("flex");

                labelPayment.classList.add("ml-1");
                labelPayment.classList.add("text-xs");
                labelPayment.innerHTML = "-";

                termOfPayment.setAttribute('min', 0);
                termOfPayment.setAttribute('max', 100);
                termOfPayment.setAttribute('type', 'number');
                termOfPayment.setAttribute('value', 0);
                termOfPayment.setAttribute('required', 'required');
                termOfPayment.classList.add('term-of-payment');

                paymentDescription.classList.add("text-area-notes");
                paymentDescription.value = "%";
                paymentDescription.setAttribute("rows", "1");

                divPayment.appendChild(labelPayment);
                divPayment.appendChild(termOfPayment);
                divPayment.appendChild(paymentDescription);

                paymentTerms.appendChild(divPayment);
                termOfPayment.focus();
            } else {
                alert("Maksimal 4 termin pembayaran");
            }
        });
        // Button Add Payment Action --> end

        // Button Remove Last Payment Action --> start
        btnDelPayment.addEventListener("click", function() {
            if (paymentTerms.children.length > 1) {
                paymentTerms.removeChild(paymentTerms.lastChild);
            } else {
                alert("Minimal 1 termin pembayaran");
            }
        });
        // Button Remove Last Payment Action --> end

        // Function Checkbox Year --> start
        cbTitleAction = (sel) => {
            if (sel.id == "cbMonth") {
                cbMonth(sel);
            } else if (sel.id == "cbQuarter") {
                cbQuarter(sel);
            } else if (sel.id == "cbHalf") {
                cbHalf(sel);
            } else if (sel.id == "cbYear") {
                cbYear(sel);
            }
        }
        // Function Checkbox Year --> end

        // Function Checkbox Month --> start
        cbMonth = (sel) => {
            const previewTBody = document.getElementById("signageTBody");
            var tableRow = previewTBody.getElementsByTagName('tr');
            const titleMonth = document.getElementById("titleMonth");
            const priceMonths = document.querySelectorAll('[id=priceMonth]');
            for (let i = 0; i < priceMonths.length; i++) {
                if (sel.checked == true && tableRow[i].cells[0].children[0].checked == true) {
                    titleMonth.classList.add('input-td-enable');
                    titleMonth.classList.remove('input-td-disabled');
                    priceMonths[i].classList.add('input-td-enable');
                    priceMonths[i].classList.remove('input-td-disabled');
                    priceMonths[i].removeAttribute('disabled');
                    titleMonth.removeAttribute('disabled');
                } else {
                    titleMonth.classList.remove('input-td-enable');
                    titleMonth.classList.add('input-td-disabled');
                    priceMonths[i].classList.remove('input-td-enable');
                    priceMonths[i].classList.add('input-td-disabled');
                    priceMonths[i].setAttribute('disabled', 'disabled');
                    titleMonth.setAttribute('disabled', 'disabled');
                }
            }
        }
        // Function Checkbox Month --> end

        // Function Checkbox Quarter --> start
        cbQuarter = (sel) => {
            const previewTBody = document.getElementById("signageTBody");
            var tableRow = previewTBody.getElementsByTagName('tr');
            const titleQuarter = document.getElementById("titleQuarter");
            const priceQuarters = document.querySelectorAll('[id=priceQuarter]');
            for (let i = 0; i < priceQuarters.length; i++) {
                if (sel.checked == true && tableRow[i].cells[0].children[0].checked == true) {
                    titleQuarter.classList.add('input-td-enable');
                    titleQuarter.classList.remove('input-td-disabled');
                    priceQuarters[i].classList.add('input-td-enable');
                    priceQuarters[i].classList.remove('input-td-disabled');
                    priceQuarters[i].removeAttribute('disabled');
                    titleQuarter.removeAttribute('disabled');
                } else {
                    titleQuarter.classList.remove('input-td-enable');
                    titleQuarter.classList.add('input-td-disabled');
                    priceQuarters[i].classList.remove('input-td-enable');
                    priceQuarters[i].classList.add('input-td-disabled');
                    priceQuarters[i].setAttribute('disabled', 'disabled');
                    titleQuarter.setAttribute('disabled', 'disabled');
                }
            }
        }
        // Function Checkbox Quarter --> end

        // Function Checkbox Half --> start
        cbHalf = (sel) => {
            const previewTBody = document.getElementById("signageTBody");
            var tableRow = previewTBody.getElementsByTagName('tr');
            const titleHalf = document.getElementById("titleHalf");
            const priceHalfs = document.querySelectorAll('[id=priceHalf]');
            for (let i = 0; i < priceHalfs.length; i++) {
                if (sel.checked == true && tableRow[i].cells[0].children[0].checked == true) {
                    titleHalf.classList.add('input-td-enable');
                    titleHalf.classList.remove('input-td-disabled');
                    priceHalfs[i].classList.add('input-td-enable');
                    priceHalfs[i].classList.remove('input-td-disabled');
                    priceHalfs[i].removeAttribute('disabled');
                    titleHalf.removeAttribute('disabled');
                } else {
                    titleHalf.classList.remove('input-td-enable');
                    titleHalf.classList.add('input-td-disabled');
                    priceHalfs[i].classList.remove('input-td-enable');
                    priceHalfs[i].classList.add('input-td-disabled');
                    priceHalfs[i].setAttribute('disabled', 'disabled');
                    titleHalf.setAttribute('disabled', 'disabled');
                }
            }
        }
        // Function Checkbox Half --> end

        // Function Checkbox Year --> start
        cbYear = (sel) => {
            const previewTBody = document.getElementById("signageTBody");
            var tableRow = previewTBody.getElementsByTagName('tr');
            const titleYear = document.getElementById("titleYear");
            const priceYears = document.querySelectorAll('[id=priceYear]');
            for (let i = 0; i < priceYears.length; i++) {
                if (sel.checked == true && tableRow[i].cells[0].children[0].checked == true) {
                    titleYear.classList.add('input-td-enable');
                    titleYear.classList.remove('input-td-disabled');
                    priceYears[i].classList.add('input-td-enable');
                    priceYears[i].classList.remove('input-td-disabled');
                    priceYears[i].removeAttribute('disabled');
                    titleYear.removeAttribute('disabled');
                } else {
                    titleYear.classList.remove('input-td-enable');
                    titleYear.classList.add('input-td-disabled');
                    priceYears[i].classList.remove('input-td-enable');
                    priceYears[i].classList.add('input-td-disabled');
                    priceYears[i].setAttribute('disabled', 'disabled');
                    titleYear.setAttribute('disabled', 'disabled');
                }
            }
        }
        // Function Checkbox Year --> end

        // Function Checkbox Row --> start
        cbRow = (sel) => {
            const signageTHead = document.getElementById("signageTHead");
            const signageTBody = document.getElementById("signageTBody");
            var tableRow = signageTBody.getElementsByTagName('tr');
            var tableHead = signageTHead.getElementsByTagName('tr');

            if (Boolean(sel.checked == true)) {
                for (let i = 0; i < 10; i++) {
                    tableRow[Number(sel.id)].cells[i].classList.remove('td-disabled');
                    tableRow[Number(sel.id)].cells[i].classList.add('td-enable');
                    if (i > 5) {
                        if (tableHead[1].cells[i - 3].children[0].checked == true) {
                            tableRow[Number(sel.id)].cells[i].children[0].classList.remove('input-td-disabled');
                            tableRow[Number(sel.id)].cells[i].children[0].classList.add('input-td-enable');
                            tableRow[Number(sel.id)].cells[i].children[0].removeAttribute('disabled');
                        }
                    }
                }
                document.getElementById("location" + Number(sel.id)).removeAttribute('hidden');
                document.getElementById("previewLocation" + Number(sel.id)).removeAttribute('hidden');
            } else {
                for (let i = 0; i < 10; i++) {
                    tableRow[Number(sel.id)].cells[i].classList.add('td-disabled');
                    tableRow[Number(sel.id)].cells[i].classList.remove('td-enable');
                    if (i > 5) {
                        if (tableHead[1].cells[i - 3].children[0].checked == true) {
                            tableRow[Number(sel.id)].cells[i].children[0].classList.add('input-td-disabled');
                            tableRow[Number(sel.id)].cells[i].children[0].classList.remove('input-td-enable');
                            tableRow[Number(sel.id)].cells[i].children[0].setAttribute('disabled', 'disabled');
                        }
                    }
                }
                document.getElementById("location" + Number(sel.id)).setAttribute('hidden', 'hidden');
                document.getElementById("previewLocation" + Number(sel.id)).setAttribute('hidden', 'hidden');
            }
        }
        // Function Checkbox Row --> end
    </script>
@endsection
