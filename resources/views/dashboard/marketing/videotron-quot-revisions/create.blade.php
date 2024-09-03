@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Videotron start -->
    <?php
    $products = json_decode($videotron_quotation->products);
    $payment_terms = json_decode($videotron_quotation->payment_terms);
    $created_by = json_decode($videotron_quotation->created_by);
    $notes = json_decode($videotron_quotation->notes);
    $price = json_decode($videotron_quotation->price);
    $share_price = $price->sharePrice;
    $ex_price = $price->exPrice;
    
    $modified_by = new stdClass();
    $modified_by->id = auth()->user()->id;
    $modified_by->name = auth()->user()->name;
    $modified_by->position = auth()->user()->position;
    ?>
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
                    href="/dashboard/marketing/videotron-quotations/{{ $videotron_quotation->id }}">
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
                                    <label class="ml-1 text-sm text-black">{{ $videotron_quotation->attachment }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                    <label class="ml-1 text-sm text-black">:</label>
                                    <label class="ml-1 text-sm text-black">{{ $videotron_quotation->subject }}</label>
                                </div>
                                <div class="mt-4">
                                    <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                    <label
                                        class="flex ml-1 text-sm text-black font-semibold">{{ $videotron_quotation->client->company }}</label>
                                    <label
                                        class="flex ml-1 text-sm text-black font-semibold">{{ $videotron_quotation->client_contact }}</label>
                                    <label class="flex ml-1 text-sm text-black">Di -</label>
                                    <label class="flex ml-6 text-sm text-black">Tempat</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black w-20">Email</label>
                                    <label class="ml-1 text-sm text-black ">:</label>
                                    <label
                                        class="ml-1 text-sm text-black ">{{ $videotron_quotation->contact_email }}</label>
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                    <label class="ml-1 text-sm text-black ">:</label>
                                    <label
                                        class="ml-1 text-sm text-black ">{{ $videotron_quotation->contact_phone }}</label>
                                </div>
                                <div class="flex mt-4">
                                    <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                </div>
                                <div class="flex mt-2">
                                    <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $videotron_quotation->body_top }}</textarea>
                                </div>
                            </div>
                        </div>
                        <!-- videotron table start -->
                        <div class="ml-2">
                            <div class="flex justify-center">
                                <table class="table-auto mt-2">
                                    <thead>
                                        <tr>
                                            <th class="text-sm text-black border w-60">Deskripsi
                                            </th>
                                            <th class="text-sm text-black border w-[480px]" colspan="4">
                                                Spesifikasi
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody id="videotronTBody">
                                        <tr>
                                            <td class="px-4 text-sm text-black border">Lokasi</td>
                                            <td class="px-4 text-sm text-black border" colspan="4">
                                                {{ $products->address }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi
                                            </td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->size }}
                                                ({{ $products->screen_w }} pixel x
                                                {{ $products->screen_h }} pixel)
                                                -
                                                {{ $products->orientation }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Ukuran - Konfigurasi Pixel</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->pixel_pitch }}
                                                -
                                                {{ $products->pixel_configuration }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->pixel_density }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->view_distancing }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->view_angle_h }}(W)
                                                {{ $products->view_angle_v }}(H)</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Refresh Rate</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->refresh_rate }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            $start = explode(':', date('H:i', strtotime($products->start_at)));
                                            $end = explode(':', date('H:i', strtotime($products->end_at)));
                                            $duration_hours = (int) $end[0] - (int) $start[0];
                                            $duration_second = $duration_hours * 60 * 60;
                                            ?>
                                            <td class="px-4 text-xs text-black border">Waktu Tayang</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ date('H:i', strtotime($products->start_at)) }} s.d
                                                {{ date('H:i', strtotime($products->end_at)) }}
                                                ({{ $duration_hours }} jam per hari)</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Durasi Video</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->duration }}
                                                detik /
                                                slot</td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $products->slots }} slot
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                                            <td class="px-4 text-xs text-black border" colspan="4">
                                                {{ $duration_second / $products->duration / $products->slots }}
                                                spot
                                                /
                                                slot /
                                                hari
                                            </td>
                                        </tr>
                                        @if ($price->priceType[0] == true)
                                            <tr>
                                                <td class="px-4 text-xs text-black border" rowspan="2">
                                                    <div class="flex items-center">
                                                        @if ($price->priceType[1] == true)
                                                            <input type="checkbox" onclick="sharingPrice(this)" checked>
                                                            <span class="flex ml-2">Harga Sharing Per Slot</span>
                                                        @else
                                                            <input type="checkbox" onclick="sharingPrice(this)" checked
                                                                disabled>
                                                            <span class="flex ml-2">Harga Sharing Per Slot</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                @foreach ($share_price as $share)
                                                    @if ($share->checkbox == true)
                                                        <td class="border text-center text-xs text-black bg-slate-200">
                                                            <div class="flex w-28 justify-center items-center">
                                                                <input type="checkbox" checked>
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $share->title }}">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black bg-slate-200"
                                                            hidden>
                                                            <div class="flex w-28 justify-center items-center">
                                                                <input type="checkbox" checked>
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $share->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @foreach ($share_price as $share)
                                                    @if ($share->checkbox == true)
                                                        <td class="border text-center text-xs text-black font-semibold">
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $share->price }}">
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black font-semibold"
                                                            hidden>
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $share->price }}">
                                                        </td>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @else
                                            <tr hidden>
                                                <td class="px-4 text-xs text-black border" rowspan="2">
                                                    <div class="flex items-center">
                                                        <input type="checkbox" onclick="sharingPrice(this)">
                                                        <span class="flex ml-2">Harga Sharing Per Slot</span>
                                                    </div>
                                                </td>
                                                @foreach ($share_price as $share)
                                                    @if ($share->checkbox == true)
                                                        <td class="border text-center text-xs text-black bg-slate-200">
                                                            <div class="flex justify-center items-center">
                                                                <input type="checkbox" checked>
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $share->title }}">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black bg-slate-200"
                                                            hidden>
                                                            <div class="flex justify-center items-center">
                                                                <input type="checkbox">
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $share->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr hidden>
                                                @foreach ($share_price as $share)
                                                    @if ($share->checkbox == true)
                                                        <td class="border text-center text-xs text-black font-semibold">
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $share->price }}">
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black font-semibold"
                                                            hidden>
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $share->price }}">
                                                        </td>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endif
                                        @if ($price->priceType[1] == true)
                                            <tr>
                                                <td class="px-4 text-xs text-black border" rowspan="2">
                                                    <div class="flex items-center">
                                                        @if ($price->priceType[0] == true)
                                                            <input type="checkbox" onclick="exclusivePrice(this)" checked>
                                                            <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                                                        @else
                                                            <input type="checkbox" onclick="exclusivePrice(this)" checked
                                                                disabled>
                                                            <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                                                        @endif
                                                    </div>
                                                </td>
                                                @foreach ($ex_price as $exclusive)
                                                    @if ($exclusive->checkbox == true)
                                                        <td class="border text-center text-xs text-black bg-slate-200">
                                                            <div class="flex justify-center items-center">
                                                                <input type="checkbox" checked>
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $exclusive->title }}">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black bg-slate-200"
                                                            hidden>
                                                            <div class="flex justify-center items-center">
                                                                <input type="checkbox">
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $exclusive->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr>
                                                @foreach ($ex_price as $exclusive)
                                                    @if ($exclusive->checkbox == true)
                                                        <td class="border text-center text-xs text-black font-semibold">
                                                            <input
                                                                class="text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $exclusive->price }}">
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black font-semibold"
                                                            hidden>
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $exclusive->price }}">
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @else
                                            <tr hidden>
                                                <td class="px-4 text-xs text-black border" rowspan="2">
                                                    <div class="flex items-center">
                                                        <input type="checkbox" onclick="exclusivePrice(this)">
                                                        <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                                                    </div>
                                                </td>
                                                @foreach ($ex_price as $exclusive)
                                                    @if ($exclusive->checkbox == true)
                                                        <td class="border text-center text-xs text-black bg-slate-200">
                                                            <div class="flex w-28 justify-center items-center">
                                                                <input type="checkbox" checked>
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $exclusive->title }}">
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black bg-slate-200"
                                                            hidden>
                                                            <div class="flex w-28 justify-center items-center">
                                                                <input type="checkbox" checked>
                                                                <input
                                                                    class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                                    type="text" id="exmonth-title"
                                                                    value="{{ $exclusive->title }}">
                                                            </div>
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                            <tr hidden>
                                                @foreach ($ex_price as $exclusive)
                                                    @if ($exclusive->checkbox == true)
                                                        <td class="border text-center text-xs text-black font-semibold">
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $exclusive->price }}">
                                                        </td>
                                                    @else
                                                        <td class="border text-center text-xs text-black font-semibold"
                                                            hidden>
                                                            <input
                                                                class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                                type="number" min="0"
                                                                value="{{ $exclusive->price }}">
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- videotron table end -->

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

                        <div class="h-[1125px]">
                            <div class="flex justify-center">
                                <div class="flex mt-4">
                                    <label class="ml-1 w-[721px] text-sm">{{ $videotron_quotation->body_end }}</label>
                                </div>
                            </div>
                            <div class="flex justify-center">
                                <?php
                                $quotationDate = date('d F Y', strtotime($videotron_quotation->created_at));
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
            @include('dashboard.layouts.vt-location')
            <!-- View Location end -->
        </div>
    </div>

    <!-- Modal Preview start -->
    <form class="flex justify-center" action="/dashboard/marketing/videotron-quot-revisions" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="text" name="videotron_quotation_id" id="videotron_quotation_id"
            value="{{ $videotron_quotation->id }}" hidden>
        <input type="text" name="notes" id="notes" hidden>
        <input type="text" name="payment_terms" id="payment_terms" hidden>
        <input type="text" name="price" id="price" hidden>
        <input type="text" name="quotation_number" id="number"
            value="{{ substr($videotron_quotation->number, 0, 4) }}" hidden>
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
                                            class="ml-1 text-sm text-black">{{ $videotron_quotation->attachment }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-black">{{ $videotron_quotation->subject }}</label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $videotron_quotation->client->company }}</label>
                                        <label
                                            class="flex ml-1 text-sm text-black font-semibold">{{ $videotron_quotation->client_contact }}</label>
                                        <label class="flex ml-1 text-sm text-black">Di -</label>
                                        <label class="flex ml-6 text-sm text-black">Tempat</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black w-20">Email</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $videotron_quotation->contact_email }}</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label
                                            class="ml-1 text-sm text-black ">{{ $videotron_quotation->contact_phone }}</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea class="ml-1 w-[721px] outline-none text-sm" readonly>{{ $videotron_quotation->body_top }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- videotron table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    <table class="table-auto mt-2">
                                        <thead>
                                            <tr>
                                                <th class="text-sm text-black border w-60">Deskripsi
                                                </th>
                                                <th class="text-sm text-black border w-[480px]" colspan="4">
                                                    Spesifikasi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody id="previewTBody">
                                            <tr>
                                                <td class="px-4 text-sm text-black border">Lokasi</td>
                                                <td class="px-4 text-sm text-black border" colspan="4">
                                                    {{ $videotron->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi
                                                </td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->size->size }} ({{ $videotron->screen_w }} pixel x
                                                    {{ $videotron->screen_h }} pixel)
                                                    -
                                                    {{ $videotron->orientation }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Ukuran - Konfigurasi Pixel</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->led->pixel_pitch }}
                                                    -
                                                    {{ $videotron->led->pixel_config }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->led->pixel_density }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->led->view_distancing }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->led->view_angle_h }}(W)
                                                    {{ $videotron->led->view_angle_v }}(H)</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Refresh Rate</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->led->refresh_rate }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <?php
                                                $start = explode(':', date('H:i', strtotime($videotron->start_at)));
                                                $end = explode(':', date('H:i', strtotime($videotron->end_at)));
                                                $duration_hours = (int) $end[0] - (int) $start[0];
                                                $duration_second = $duration_hours * 60 * 60;
                                                ?>
                                                <td class="px-4 text-xs text-black border">Waktu Tayang</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ date('H:i', strtotime($videotron->start_at)) }} s.d
                                                    {{ date('H:i', strtotime($videotron->end_at)) }}
                                                    ({{ $duration_hours }} jam per hari)</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Durasi Video</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->duration }}
                                                    detik /
                                                    slot</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $videotron->slots }} slot
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                                                <td class="px-4 text-xs text-black border" colspan="4">
                                                    {{ $duration_second / $videotron->duration / $videotron->slots }} spot
                                                    /
                                                    slot /
                                                    hari
                                                </td>
                                            </tr>
                                            @if ($price->priceType[0] == true)
                                                <tr>
                                                    <td class="px-4 text-xs text-black border" rowspan="2">Harga
                                                        Sharing
                                                        (per slot)</td>
                                                    @foreach ($share_price as $share)
                                                        @if ($share->checkbox == true)
                                                            <td class="border bg-slate-100 text-center text-xs text-black">
                                                            </td>
                                                        @else
                                                            <td class="border bg-slate-100 text-center text-xs text-black"
                                                                hidden>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($share_price as $share)
                                                        @if ($share->checkbox == true)
                                                            <td class="border text-center text-xs text-black">
                                                            </td>
                                                        @else
                                                            <td class="border text-center text-xs text-black" hidden>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @else
                                                <tr hidden>
                                                    <td class="px-4 text-xs text-black border" rowspan="2">Harga
                                                        Sharing
                                                        (per slot)</td>
                                                    <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                    <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                    <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                    <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                </tr>
                                                <tr hidden>
                                                    <td
                                                        class="border text-center text-xs text-black outline-none font-semibold">
                                                    </td>
                                                    <td
                                                        class="border text-center text-xs text-black outline-none font-semibold">
                                                    </td>
                                                    <td
                                                        class="border text-center text-xs text-black outline-none font-semibold">
                                                    </td>
                                                    <td
                                                        class="border text-center text-xs text-black outline-none font-semibold">
                                                    </td>
                                                </tr>
                                            @endif
                                            @if ($price->priceType[1] == true)
                                                <tr>
                                                    <td class="px-4 text-xs text-black border" rowspan="2">Harga
                                                        eksklusif
                                                        (4 slot)</td>
                                                    @foreach ($ex_price as $exclusive)
                                                        @if ($exclusive->checkbox == true)
                                                            <td class="border bg-slate-100 text-center text-xs text-black">
                                                            </td>
                                                        @else
                                                            <td class="border bg-slate-100 text-center text-xs text-black"
                                                                hidden>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                                <tr>
                                                    @foreach ($ex_price as $exclusive)
                                                        @if ($exclusive->checkbox == true)
                                                            <td class="border text-center text-xs text-black">
                                                            </td>
                                                        @else
                                                            <td class="border text-center text-xs text-black" hidden>
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @else
                                                <tr hidden>
                                                    <td class="px-4 text-xs text-black border" rowspan="2">Harga
                                                        eksklusif
                                                        (4 slot)</td>
                                                    <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                    <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                    <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                    <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                </tr>
                                                <tr hidden>
                                                    <td class="border text-center text-xs text-black font-semibold"></td>
                                                    <td class="border text-center text-xs text-black font-semibold"></td>
                                                    <td class="border text-center text-xs text-black font-semibold"></td>
                                                    <td class="border text-center text-xs text-black font-semibold"></td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- videotron table end -->

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
                @include('dashboard.layouts.vt-location')
                <!-- View Location end -->
            </div>
        </div>
    </form>
    <!-- Modal Preview end -->

    <!-- Quotation Videotron end -->
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
            if (paymentCheck() == true && getPrice() == true) {
                modalPreview.classList.remove("hidden");
                // fillData();
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
            // number.value = createNumber.value;
            // previewNumber.innerHTML = createNumber.value;
            attachment.value = createAttachment.innerText;
            previewAttachment.innerHTML = createAttachment.innerText;
            subject.value = createSubject.innerText;
            previewSubject.innerHTML = createSubject.innerText;
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
            const price = document.getElementById("price");
            var checkPrice = false;
            const videotronTBody = document.getElementById("videotronTBody");
            const previewTBody = document.getElementById("previewTBody");
            var tableRow = videotronTBody.getElementsByTagName('tr');
            var previewTableRow = previewTBody.getElementsByTagName('tr');

            let objPrice = {};
            let sharePrice = [];
            let exPrice = [];
            let priceType = [];

            for (let i = 0; i < 4; i++) {
                if (tableRow[11].cells[i + 1].children[0].children[0].checked == true) {
                    previewTableRow[11].cells[i + 1].innerHTML = tableRow[11].cells[i + 1].children[0].children[1]
                        .value;
                    previewTableRow[12].cells[i].innerHTML = 'Rp. ' + Number(tableRow[12].cells[i].children[0].value)
                        .toLocaleString() + ',-';
                    previewTableRow[11].cells[i + 1].removeAttribute('hidden');
                    previewTableRow[12].cells[i].removeAttribute('hidden');
                } else {
                    previewTableRow[11].cells[i + 1].setAttribute('hidden', 'hidden');
                    previewTableRow[12].cells[i].setAttribute('hidden', 'hidden');
                }

                sharePrice[i] = {
                    checkbox: tableRow[11].cells[i + 1].children[0].children[0].checked,
                    title: tableRow[11].cells[i + 1].children[0].children[1].value,
                    price: Number(tableRow[12].cells[i].children[0].value)
                }
            }

            for (let i = 0; i < 4; i++) {
                exPrice[i] = {
                    checkbox: tableRow[13].cells[i + 1].children[0].children[0].checked,
                    title: tableRow[13].cells[i + 1].children[0].children[1].value,
                    price: Number(tableRow[14].cells[i].children[0].value)
                }

                if (tableRow[13].cells[i + 1].children[0].children[0].checked == true) {
                    previewTableRow[13].cells[i + 1].innerHTML = tableRow[13].cells[i + 1].children[0].children[1]
                        .value;
                    previewTableRow[14].cells[i].innerHTML = 'Rp. ' + Number(tableRow[14].cells[i].children[0].value)
                        .toLocaleString() + ',-';
                    previewTableRow[13].cells[i + 1].removeAttribute('hidden');
                    previewTableRow[14].cells[i].removeAttribute('hidden');
                } else {
                    previewTableRow[13].cells[i + 1].setAttribute('hidden', 'hidden');
                    previewTableRow[14].cells[i].setAttribute('hidden', 'hidden');
                }
            }

            if (tableRow[11].cells[0].children[0].children[0].checked == true) {
                priceType[0] = true;
            } else {
                priceType[0] = false;
            }

            if (tableRow[13].cells[0].children[0].children[0].checked == true) {
                priceType[1] = true;
            } else {
                priceType[1] = false;
            }

            objPrice = {
                priceType,
                sharePrice,
                exPrice
            };
            if (priceType[0] == true) {
                for (let i = 0; i < sharePrice.length; i++) {
                    if (sharePrice[i].checkbox == true) {
                        checkPrice = true;
                    }
                }
            }
            if (priceType[1] == true) {
                for (let i = 0; i < exPrice.length; i++) {
                    if (exPrice[i].checkbox == true) {
                        checkPrice = true;
                    }
                }
            }

            if (checkPrice == false) {
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

        // Function Sharing Price Action --> start
        sharingPrice = (sel) => {
            const videotronTBody = document.getElementById("videotronTBody");
            var tableRow = videotronTBody.getElementsByTagName('tr');
            let objPrice = {};
            const previewTBody = document.getElementById("previewTBody");
            var previewTableRow = previewTBody.getElementsByTagName('tr');
            if (sel.checked == true) {
                for (let i = 0; i < 4; i++) {
                    tableRow[11].cells[i + 1].children[0].children[0].checked = true;
                    tableRow[11].cells[i + 1].children[0].children[0].removeAttribute('disabled');
                    tableRow[11].cells[i + 1].children[0].children[1].removeAttribute('disabled');
                    tableRow[12].cells[i].children[0].removeAttribute('disabled');
                }
                previewTableRow[11].removeAttribute('hidden');
                previewTableRow[12].removeAttribute('hidden');
            } else {
                for (let i = 0; i < 4; i++) {
                    tableRow[11].cells[i + 1].children[0].children[0].checked = false;
                    tableRow[11].cells[i + 1].children[0].children[0].setAttribute('disabled', 'disabled');
                    tableRow[11].cells[i + 1].children[0].children[1].setAttribute('disabled', 'disabled');
                    tableRow[12].cells[i].children[0].setAttribute('disabled', 'disabled');
                }
                previewTableRow[11].setAttribute('hidden', 'hidden');
                previewTableRow[12].setAttribute('hidden', 'hidden');
            }
        }
        // Function Sharing Price Action --> end

        // Function Exclusive Price Action --> start
        exclusivePrice = (sel) => {
            const videotronTBody = document.getElementById("videotronTBody");
            var tableRow = videotronTBody.getElementsByTagName('tr');
            let objPrice = {};
            const previewTBody = document.getElementById("previewTBody");
            var previewTableRow = previewTBody.getElementsByTagName('tr');
            if (sel.checked == true) {
                for (let i = 0; i < 4; i++) {
                    tableRow[13].cells[i + 1].children[0].children[0].checked = true;
                    tableRow[13].cells[i + 1].children[0].children[0].removeAttribute('disabled');
                    tableRow[13].cells[i + 1].children[0].children[1].removeAttribute('disabled');
                    tableRow[14].cells[i].children[0].removeAttribute('disabled');
                }
                previewTableRow[13].removeAttribute('hidden');
                previewTableRow[14].removeAttribute('hidden');
            } else {
                for (let i = 0; i < 4; i++) {
                    tableRow[13].cells[i + 1].children[0].children[0].checked = false;
                    tableRow[13].cells[i + 1].children[0].children[0].setAttribute('disabled', 'disabled');
                    tableRow[13].cells[i + 1].children[0].children[1].setAttribute('disabled', 'disabled');
                    tableRow[14].cells[i].children[0].setAttribute('disabled', 'disabled');
                }
                previewTableRow[13].setAttribute('hidden', 'hidden');
                previewTableRow[14].setAttribute('hidden', 'hidden');
            }
        }
        // Function Exclusive Price Action --> end
    </script>
@endsection
