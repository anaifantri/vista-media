@extends('dashboard.layouts.main');

@section('container')
    <!-- Quotation Videotron start -->
    <?php
    $products = new stdClass();
    $products->code = $videotron->code;
    $products->area = $videotron->area->area;
    $products->city = $videotron->city->city;
    $products->city_code = $videotron->city->code;
    $products->address = $videotron->address;
    $products->photo = $videotron_photo->photo;
    $products->lat = $videotron->lat;
    $products->lng = $videotron->lng;
    $products->size = $videotron->size->size;
    $products->slots = $videotron->slots;
    $products->orientation = $videotron->orientation;
    $products->duration = $videotron->duration;
    $products->start_at = $videotron->start_at;
    $products->end_at = $videotron->end_at;
    $products->road_segment = $videotron->road_segment;
    $products->max_distance = $videotron->max_distance;
    $products->speed_average = $videotron->speed_average;
    $products->sector = $videotron->sector;
    $products->screen_w = $videotron->screen_w;
    $products->screen_h = $videotron->screen_h;
    $products->pixel_pitch = $videotron->led->pixel_pitch;
    $products->pixel_density = $videotron->led->pixel_density;
    $products->view_distancing = $videotron->led->view_distancing;
    $products->view_angle_v = $videotron->led->view_angle_v;
    $products->view_angle_h = $videotron->led->view_angle_h;
    $products->brightness = $videotron->led->brightness;
    $products->type = $videotron->led->type;
    $products->refresh_rate = $videotron->led->refresh_rate;
    $products->pixel_configuration = $videotron->led->pixel_configuration;
    
    $created_by = new stdClass();
    $created_by->id = auth()->user()->id;
    $created_by->name = auth()->user()->name;
    $created_by->position = auth()->user()->position;
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
                                <label class="ml-1 text-sm text-slate-500">Auto Numbering</label>
                                {{-- <input class="ml-1 text-sm text-black flex outline-none border rounded-lg w-56 px-2"
                                    id="createNumber" name="createNumber" type="text" autofocus> --}}
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
                                                class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-tl-lg w-40 px-2 hover:cursor-default"
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
                                <label id="createContactPhone" class="ml-1 text-sm text-black font-semibold flex">-</label>
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
                                        <th class="text-sm text-black border w-52">Deskripsi
                                        </th>
                                        <th class="text-sm text-black border w-[512px]" colspan="4">
                                            Spesifikasi
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="videotronTBody">
                                    <tr>
                                        <td class="px-4 text-sm text-black border">Lokasi</td>
                                        <td class="px-4 text-sm text-black border" colspan="4">
                                            {{ $videotron->address }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Ukuran (Screen Size) - Orientasi</td>
                                        <td class="px-4 text-xs text-black border" colspan="4">
                                            {{ $videotron->size->size }} ({{ $videotron->screen_w }} pixel x
                                            {{ $videotron->screen_h }} pixel)
                                            -
                                            {{ $videotron->orientation }}</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Ukuran - Konfigurasi Pixel</td>
                                        <td class="px-4 text-xs text-black border" colspan="4">
                                            {{ $videotron->led->pixel_pitch }} -
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
                                            {{ $videotron->duration }} detik /
                                            slot</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Jumlah Slot</td>
                                        <td class="px-4 text-xs text-black border" colspan="4">{{ $videotron->slots }}
                                            slot</td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border">Jumlah Spot</td>
                                        <td class="px-4 text-xs text-black border" colspan="4">
                                            {{ $duration_second / $videotron->duration / $videotron->slots }} spot / slot /
                                            hari
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border" rowspan="2">
                                            <div class="flex items-center">
                                                <input type="checkbox" onclick="sharingPrice(this)" checked>
                                                <span class="flex ml-2">Harga Sharing (per slot)</span>
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-2 w-12 outline-none bg-transparent"
                                                    type="text" value="1 Bulan">
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-2 w-12 outline-none bg-transparent"
                                                    type="text" value="3 Bulan">
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-1 w-16 outline-none bg-transparent"
                                                    type="text" value="6 Bulan">
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-1 w-16 outline-none bg-transparent"
                                                    type="text" value="1 Tahun">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0"
                                                    value="{{ ($videotron->price * (27.5 / 100)) / 10 }}">
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0"
                                                    value="{{ $videotron->price * (27.5 / 100) * (27.5 / 100) }}">
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0"
                                                    value="{{ $videotron->price * (27.5 / 100) * (52.5 / 100) }}">
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0"
                                                    value="{{ $videotron->price * (27.5 / 100) }}">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="px-4 text-xs text-black border" rowspan="2">
                                            <div class="flex items-center">
                                                <input type="checkbox" onclick="exclusivePrice(this)" checked>
                                                <span class="flex ml-2">Harga eksklusif (4 slot)</span>
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                    type="text" id="exmonth-title" value="1 Bulan">
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                    type="text" id="exquarter-title" value="3 Bulan">
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                    type="text" id="exhalf-title" value="6 Bulan">
                                            </div>
                                        </td>
                                        <td class="border bg-slate-100">
                                            <div class="flex w-28 justify-center items-center">
                                                <input type="checkbox" checked>
                                                <input class="text-xs text-black  ml-1 w-12 outline-none bg-transparent"
                                                    type="text" id="exyear-title" value="1 Tahun">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0" value="{{ $videotron->price / 10 }}">
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0"
                                                    value="{{ $videotron->price * (27.5 / 100) }}">
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0"
                                                    value="{{ $videotron->price * (52.5 / 100) }}">
                                            </div>
                                        </td>
                                        <td class="border">
                                            <div class="flex w-28 justify-center items-center">
                                                <input
                                                    class="flex text-center text-xs text-black w-[112px] outline-none font-semibold"
                                                    type="number" min="0" value="{{ $videotron->price }}">
                                            </div>
                                        </td>
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
                                    <input class="ml-1 text-xs text-black outline-none w-full"
                                        value="- Biaya di atas belum termasuk PPN dan tidak termasuk desain materi iklan">
                                </div>
                                <div class="flex">
                                    <input class="ml-1 text-xs text-black outline-none w-full"
                                        value="- Harga tersebut termasuk :" readonly></input>
                                </div>
                                <div class="flex">
                                    <input class="ml-1 text-xs text-black outline-none w-full"
                                        value="   • Penggantian (upload / take out) materi iklan.">
                                </div>
                                <div class="flex">
                                    <input class="ml-1 text-xs text-black outline-none w-full"
                                        value="   • Sewa Lokasi, konsumsi listrik selama kontrak, maintenance selama kontrak.">
                                </div>
                                <div class="flex">
                                    <input class="ml-1 text-xs text-black outline-none w-full"
                                        value="- Harga & lokasi tidak mengikat, sewaktu-waktu dapat berubah sebelum ada persetujuan tertulis">
                                </div>
                                <div class="flex">
                                    <input class="ml-1 text-xs text-black outline-none w-full font-semibold"
                                        value="- OOH Premium milik kami tersebar di Area Lombok, Bali, Jawa Timur dan Kalimantan">
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
        <input type="text" name="notes" id="notes" hidden>
        <input type="text" name="payment_terms" id="payment_terms" hidden>
        <input type="text" name="price" id="price" hidden>
        <input type="text" name="products" id="products" value="{{ json_encode($products) }}" hidden>
        <input type="text" name="client_id" id="client_id" hidden>
        <input type="text" name="videotron_id" id="videotron_id" value="{{ $videotron->id }}" hidden>
        <input type="text" name="client_contact" id="client_contact" hidden>
        {{-- <input type="text" id="number" name="number" hidden> --}}
        <input type="text" id="attachment" name="attachment" hidden>
        <input type="text" id="subject" name="subject" hidden>
        <input type="text" id="contact_email" name="contact_email" hidden>
        <input type="text" id="contact_phone" name="contact_phone" hidden>
        <input type="text" id="created_by" name="created_by" value="{{ json_encode($created_by) }}" hidden>
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
                                        <label class="ml-1 text-sm text-black w-20">Nomor</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label class="ml-1 text-sm text-slate-500">Auto
                                            Numbering</label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Lampiran</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label id="previewAttachment" class="ml-1 text-sm text-black"></label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">Perihal</label>
                                        <label class="ml-1 text-sm text-black">:</label>
                                        <label id="previewSubject" class="ml-1 text-sm text-black"></label>
                                    </div>
                                    <div class="mt-4">
                                        <label class="flex ml-1 text-sm text-black w-20">Kepada Yth</label>
                                        <label class="flex ml-1 text-sm text-black font-semibold"
                                            id="previewClientCompany"></label>
                                        <label class="flex ml-1 text-sm text-black font-semibold"
                                            id="previewClientContact"></label>
                                        <label class="flex ml-1 text-sm text-black">Di -</label>
                                        <label class="flex ml-6 text-sm text-black">Tempat</label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black w-20">Email</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label id="previewEmail" class="ml-1 text-sm text-black "></label>
                                    </div>
                                    <div class="flex">
                                        <label class="ml-1 text-sm text-black w-20">No. Telp.</label>
                                        <label class="ml-1 text-sm text-black ">:</label>
                                        <label id="previewPhone" class="ml-1 text-sm text-black "></label>
                                    </div>
                                    <div class="flex mt-4">
                                        <label class="ml-1 text-sm text-black">Dengan hormat,</label>
                                    </div>
                                    <div class="flex mt-2">
                                        <textarea id="body_top" name="body_top" class="ml-1 w-[721px] outline-none text-sm" readonly>Bersama ini kami menyampaikan surat penawaran penggunaan media reklame Videotron area {{ $videotron->area->area }} kota {{ $videotron->city->city }} dengan spesifikasi sebagai berikut :</textarea>
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
                                            <tr>
                                                <td class="px-4 text-xs text-black border" rowspan="2">Harga Sharing
                                                    (per slot)</td>
                                                <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                                <td class="border bg-slate-100 text-center text-xs text-black"></td>
                                            </tr>
                                            <tr>
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
                                            <tr>
                                                <td class="px-4 text-xs text-black border" rowspan="2">Harga eksklusif
                                                    (4 slot)</td>
                                                <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                                <td class="border bg-slate-100 text-xs text-black text-center"></td>
                                            </tr>
                                            <tr>
                                                <td class="border text-center text-xs text-black font-semibold"></td>
                                                <td class="border text-center text-xs text-black font-semibold"></td>
                                                <td class="border text-center text-xs text-black font-semibold"></td>
                                                <td class="border text-center text-xs text-black font-semibold"></td>
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
                                    <div id="previewNotesQty"></div>
                                    <div class="flex mt-2">
                                        <label class="ml-1 text-sm text-black flex">Sistem pembayaran :</label>
                                    </div>
                                    <div id="previewPaymentTerms"></div>
                                </div>
                            </div>
                            <!-- quotation note end -->

                            <div class="h-[1125px]">
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
    <!-- Quotation Videotron end -->
    <script src="/js/createvideotronquotation.js"></script>
@endsection
