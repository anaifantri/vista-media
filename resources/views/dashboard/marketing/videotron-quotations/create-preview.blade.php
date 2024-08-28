@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Videotron start -->
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
                    href="/dashboard/marketing/videotron-quotations/create">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-xs xl:text-sm 2xl:text-md">Cancel</span>
                </a>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <div class="w-[950px] h-[1345px] border mb-10 mt-1">
                <!-- Header start -->
                @include('dashboard.layouts.letter-header')
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1125px]">
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <input class="ml-1 text-sm text-black flex outline-none border rounded-lg w-56 px-2"
                                    id="createNumber" name="createNumber" type="text" autofocus>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="createAttachment" class="ml-1 text-sm text-black flex">Foto dan Denah
                                    Lokasi</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="createSubject" class="ml-1 text-sm text-black flex">Penawaran Penggunaan Media
                                    Reklame
                                    Videotron</label>
                            </div>
                            <div class="flex mt-4">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-teal-700 flex w-12">Klien</label>
                                    <label class="ml-1 text-sm text-teal-700 flex">:</label>
                                    <div>
                                        <div id="selectClient" class="flex" onclick="selectClientAction(event)">
                                            <input
                                                class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-tl-lg w-40 px-2"
                                                type="text" id="client" name="client" placeholder="Pilih Klien"
                                                readonly>
                                            <svg class="flex items-center justify-center w-5 p-1 border rounded-tr-lg"
                                                xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24">
                                                <path d="M12 21l-12-18h24z" />
                                            </svg>
                                        </div>
                                        <div id="clientList"
                                            class="absolute bg-white w-[180px] border rounded-b-lg ml-1 p-2 hidden"
                                            onclick="event.stopPropagation()">
                                            <table id="clientListTable" class="table-auto">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            <input id="search" name="search"
                                                                class="text-sm text-teal-700 flex font-semibold outline-none border rounded-lg w-40 px-2"
                                                                type="text" placeholder="Search" onkeyup="searchTable()">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($clients as $client)
                                                        <tr>
                                                            <td class="w-full text-sm text-teal-700 px-2 hover:bg-slate-200"
                                                                id="{{ $client->id }}" onclick="getSelect(this)"
                                                                title="{{ $client->company }}">
                                                                {{ $client->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div id="divContact" class="hidden">
                                    <label class="ml-8 text-sm text-teal-700 flex w-12">Kontak</label>
                                    <label class="ml-1 text-sm text-teal-700 flex">:</label>
                                    <select
                                        class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-lg w-40"
                                        name="contact_id" id="contact_id" onchange="getContact(this)" disabled>
                                        <option value="pilih">Pilih Kontak</option>
                                    </select>
                                </div>
                            </div>
                            <div class="flex mt-4">
                                <div>
                                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                    <label id="clientCompany" class="ml-1 text-sm text-black font-semibold flex">-</label>
                                    <label id="createClientContact"
                                        class="ml-1 text-sm text-black font-semibold flex">-</label>
                                    <label class="ml-1 text-sm text-black flex">Di -</label>
                                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                                </div>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="createContactEmail" class="ml-1 text-sm text-black font-semibold flex">-</label>
                            </div>
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                <label class="ml-1 text-sm text-black flex">:</label>
                                <label id="createContactPhone"
                                    class="ml-1 text-sm text-black font-semibold flex">-</label>
                            </div>
                            <div class="flex mt-4">
                                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                            </div>
                            <div class="flex mt-2">
                                <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame Videotron area {{ $videotron->area->area }} kota {{ $videotron->city->city }} dengan spesifikasi sebagai berikut :</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- videotron table start -->
                    <div class="ml-2">
                        <div class="flex justify-center">
                            <table class="table-auto mt-2">
                                <thead>
                                    <tr>
                                        <th class="text-sm text-black border w-60" rowspan="2">Deskripsi
                                        </th>
                                        <th class="text-sm text-black border w-[480px]" rowspan="2">
                                            Spesifikasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="px-4 text-sm text-black border">Lokasi</td>
                                        <td class="px-4 text-sm text-black border">{{ $videotron->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                                        <td class="px-4 text-xs text-black border">
                                            {{ $videotron->size->size }} ({{ $videotron->screen_w }} pixel x
                                            {{ $videotron->screen_h }} pixel)
                                            -
                                            {{ $videotron->orientation }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Ukuran - Konfigurasi Pixel</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->led->pixel_pitch }} -
                                            {{ $videotron->led->pixel_config }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->led->pixel_density }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->led->view_distancing }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->led->view_angle_h }}(W)
                                            {{ $videotron->led->view_angle_v }}(H)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Refresh Rate</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->led->refresh_rate }}
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
                                        <td class="px-4 text-xs text-black border">
                                            {{ date('H:i', strtotime($videotron->start_at)) }} s.d
                                            {{ date('H:i', strtotime($videotron->end_at)) }}
                                            ({{ $duration_hours }} jam per hari)</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Durasi Video</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->duration }} detik /
                                            slot</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                                        <td class="px-4 text-xs text-black border">{{ $videotron->slots }} slot</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                                        <td class="px-4 text-xs text-black border">
                                            {{ $duration_second / $videotron->duration / $videotron->slots }} spot / slot /
                                            hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Harga Sharing</td>
                                        <td class="px-4 text-xs text-black border">Rp.
                                            {{ number_format($videotron->price * (27.5 / 100)) }},- / slot / tahun</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Harga eksklusif</td>
                                        <td class="px-4 text-xs text-black border">Rp.
                                            {{ number_format($videotron->price) }},- / tahun</td>
                                    </tr>
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
                                <div class="flex">
                                    <label class="ml-1 text-xs">-</label>
                                    <input class="ml-2 text-xs text-black outline-none w-full"
                                        value="Biaya di atas belum termasuk PPN dan tidak termasuk desain materi iklan">
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-xs text-black flex">-</label>
                                    <label class="ml-2 text-xs text-black outline-none w-full">Harga tersebut termasuk
                                        :</label>
                                </div>
                                <div class="flex">
                                    <input class="ml-4 text-xs text-black outline-none w-full"
                                        value="• Penggantian (upload / take out) materi iklan.">
                                </div>
                                <div class="flex">
                                    <input class="ml-4 text-xs text-black outline-none w-full"
                                        value="• Sewa Lokasi, konsumsi listrik selama kontrak, maintenance selama kontrak.">
                                </div>
                                <div class="flex">
                                    <label class="ml-1 text-xs">-</label>
                                    <input class="ml-2 text-xs text-black outline-none w-full"
                                        value="Harga & lokasi tidak mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis">
                                </div>
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
                                <div class="flex">
                                    <label class="ml-1 text-xs">-</label>
                                    <input class="text-xs ml-2 outline-none border rounded-md px-1 w-12" type="number"
                                        min="0" max="100" value="100">
                                    <textarea class="text-area-notes" rows="1">% sebelum materi iklan tayang</textarea>
                                </div>
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
                            <div>
                                <div class="flex">
                                    <label class="ml-1 text-xs">-</label>
                                    <label class="ml-2 text-xs text-black font-semibold outline-none w-full">OOH Premium
                                        milik kami
                                        tersebar di Area Lombok, Bali, Jawa Timur dan Kalimantan</label>
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
                            <div class="flex mt-2">
                                <textarea id="createBodyEnd" class="ml-1 w-[721px] outline-none text-sm" rows="1">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <?php
                            $quotationDate = date('d F Y');
                            ?>
                            <div class="w-[725px] mt-2">
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
                                <label id="salesUser"
                                    class="ml-1 text-sm text-black flex font-semibold">{{ auth()->user()->name }}</label>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px]">
                                <label id="salesPotition"
                                    class="ml-1 text-sm text-black flex">{{ auth()->user()->level }}</label>
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

    <!-- Modal Preview start -->

    <!-- Modal Preview end -->
    <form class="flex justify-center" action="/dashboard/marketing/videotron-quotations" method="post"
        enctype="multipart/form-data">
        @csrf
        <input type="text" name="company_id" id="company_id" value="1" hidden>
        <input type="text" name="client_id" id="client_id" hidden>
        <input type="text" name="client_contact" id="client_contact" hidden>
        <div id="modalPreview" name="modalPreview"
            class="absolute justify-center top-0 w-full h-[full] bg-black bg-opacity-90 z-20 hidden">
            <div class="mt-10">
                <div class="flex w-full justify-center">
                    <div class="flex w-[950px] justify-end">
                        <button id="btnSave" class="flex justify-center items-center mx-1 btn-primary" title="Save"
                            type="submit">
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
                                        <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <input class="ml-1 text-sm text-black flex" type="text" id="number"
                                            name="number" readonly>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <input class="ml-1 text-sm text-black flex w-full" type="text" id="attachment"
                                            name="attachment" readonly>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <input class="ml-1 text-sm text-black flex w-full" type="text" id="subject"
                                            name="subject" readonly>
                                    </div>
                                    <div class="flex mt-4">
                                        <div>
                                            <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                                            <label class="ml-1 text-sm text-black font-semibold flex"
                                                id="previewClientCompany"></label>
                                            <label class="ml-1 text-sm text-black font-semibold flex"
                                                id="previewClientContact"></label>
                                            <label class="ml-1 text-sm text-black flex">Di -</label>
                                            <label class="ml-6 text-sm text-black flex">Tempat</label>
                                        </div>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex w-20">Email</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <input class="ml-1 text-sm text-black font-semibold flex" type="text"
                                            id="contact_email" name="contact_email" readonly>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black flex">:</label>
                                        <input class="ml-1 text-sm text-black font-semibold flex" type="text"
                                            id="contact_phone" name="contact_phone" readonly>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea id="body_top" name="body_top" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame Videotron area {{ $videotron->area->area }} kota {{ $videotron->city->city }} dengan spesifikasi sebagai berikut :</textarea>
                                    </div>
                                </div>
                            </div>
                            <!-- videotron table start -->
                            <div class="ml-2">
                                <div class="flex justify-center">
                                    <table class="table-auto mt-2">
                                        <thead>
                                            <tr>
                                                <th class="text-sm text-black border w-60" rowspan="2">Deskripsi
                                                </th>
                                                <th class="text-sm text-black border w-[480px]" rowspan="2">
                                                    Spesifikasi
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="px-4 text-sm text-black border">Lokasi</td>
                                                <td class="px-4 text-sm text-black border">{{ $videotron->address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi
                                                </td>
                                                <td class="px-4 text-xs text-black border">
                                                    {{ $videotron->size->size }} ({{ $videotron->screen_w }} pixel x
                                                    {{ $videotron->screen_h }} pixel)
                                                    -
                                                    {{ $videotron->orientation }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Ukuran - Konfigurasi Pixel</td>
                                                <td class="px-4 text-xs text-black border">
                                                    {{ $videotron->led->pixel_pitch }}
                                                    -
                                                    {{ $videotron->led->pixel_config }}</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Kerapatan Pixel</td>
                                                <td class="px-4 text-xs text-black border">
                                                    {{ $videotron->led->pixel_density }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jarak Pandang Terbaik</td>
                                                <td class="px-4 text-xs text-black border">
                                                    {{ $videotron->led->view_distancing }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Sudut Pandang Terbaik</td>
                                                <td class="px-4 text-xs text-black border">
                                                    {{ $videotron->led->view_angle_h }}(W)
                                                    {{ $videotron->led->view_angle_v }}(H)</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Refresh Rate</td>
                                                <td class="px-4 text-xs text-black border">
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
                                                <td class="px-4 text-xs text-black border">
                                                    {{ date('H:i', strtotime($videotron->start_at)) }} s.d
                                                    {{ date('H:i', strtotime($videotron->end_at)) }}
                                                    ({{ $duration_hours }} jam per hari)</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Durasi Video</td>
                                                <td class="px-4 text-xs text-black border">{{ $videotron->duration }}
                                                    detik /
                                                    slot</td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                                                <td class="px-4 text-xs text-black border">{{ $videotron->slots }} slot
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                                                <td class="px-4 text-xs text-black border">
                                                    {{ $duration_second / $videotron->duration / $videotron->slots }} spot
                                                    /
                                                    slot /
                                                    hari
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Harga Sharing</td>
                                                <td class="px-4 text-xs text-black border">Rp.
                                                    {{ number_format($videotron->price * (27.5 / 100)) }},- / slot / tahun
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="px-4 text-xs text-black border">Harga eksklusif</td>
                                                <td class="px-4 text-xs text-black border">Rp.
                                                    {{ number_format($videotron->price) }},- / tahun</td>
                                            </tr>
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
                                        <div class="flex">
                                            <label class="ml-1 text-xs">-</label>
                                            <input class="ml-2 text-xs text-black outline-none w-full"
                                                value="Biaya di atas belum termasuk PPN dan tidak termasuk desain materi iklan">
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-xs text-black flex">-</label>
                                            <label class="ml-2 text-xs text-black outline-none w-full">Harga tersebut
                                                termasuk
                                                :</label>
                                        </div>
                                        <div class="flex">
                                            <input class="ml-4 text-xs text-black outline-none w-full"
                                                value="• Penggantian (upload / take out) materi iklan.">
                                        </div>
                                        <div class="flex">
                                            <input class="ml-4 text-xs text-black outline-none w-full"
                                                value="• Sewa Lokasi, konsumsi listrik selama kontrak, maintenance selama kontrak.">
                                        </div>
                                        <div class="flex">
                                            <label class="ml-1 text-xs">-</label>
                                            <input class="ml-2 text-xs text-black outline-none w-full"
                                                value="Harga & lokasi tidak mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis">
                                        </div>
                                    </div>
                                    <div class="flex mt-2">
                                        <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                    </div>
                                    <div id="paymentTerms">
                                        <div class="flex">
                                            <label class="ml-1 text-xs">-</label>
                                            <input class="text-xs ml-2 outline-none border rounded-md px-1 w-12"
                                                type="number" min="0" max="100" value="100">
                                            <textarea class="text-area-notes" rows="1">% sebelum materi iklan tayang</textarea>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="flex">
                                            <label class="ml-1 text-xs">-</label>
                                            <label class="ml-2 text-xs text-black font-semibold outline-none w-full">OOH
                                                Premium milik kami tersebar di Area Lombok, Bali, Jawa Timur dan
                                                Kalimantan</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- quotation note end -->

                            <div class="h-[1125px]">
                                <div class="flex justify-center">
                                    <div class="flex mt-4">
                                        <textarea id="body_end" name="body_end" class="ml-1 w-[721px] outline-none text-sm" rows="1">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
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
                                        <input class="ml-1 text-sm text-black flex font-semibold" id="user_name"
                                            name="user_name" value="{{ auth()->user()->name }}" type="text">
                                    </div>
                                </div>
                                <div class="flex justify-center">
                                    <div class="w-[725px]">
                                        <input class="ml-1 text-sm text-black flex" id="user_position"
                                            name="user_position" value="{{ auth()->user()->position }}" type="text">
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
    <!-- Quotation Videotron end -->
    <script src="/js/createvideotronquotation.js"></script>
@endsection
