@extends('dashboard.layouts.main');

@section('container')
    <?php
    $dataProducts = [];
    foreach ($locations as $location) {
        $dataProduct = new stdClass();
        $dataProduct->id = $location->id;
        $dataProduct->code = $location->code;
        $dataProduct->category = $location->media_category->name;
        $dataProduct->area = $location->area->area;
        $dataProduct->city = $location->city->city;
        $dataProduct->city_code = $location->city->code;
        $dataProduct->address = $location->address;
        foreach ($locationPhotos as $photo) {
            if ($photo->location_id == $location->id && $photo->set_default == true) {
                $dataProduct->location_photo = $photo->photo;
            }
        }
        $dataProduct->description = $location->description;
        $dataProduct->size = $location->media_size->size;
        $dataProduct->width = $location->media_size->width;
        $dataProduct->height = $location->media_size->height;
        $dataProduct->side = $location->side;
        $dataProduct->orientation = $location->orientation;
        $dataProduct->road_segment = $location->road_segment;
        $dataProduct->max_distance = $location->max_distance;
        $dataProduct->speed_average = $location->speed_average;
        $dataProduct->sector = $location->sector;
        array_push($dataProducts, $dataProduct);
    }
    $products = new stdClass();
    $products = $dataProducts;
    
    $created_by = new stdClass();
    $created_by->id = auth()->user()->id;
    $created_by->name = auth()->user()->name;
    $created_by->position = auth()->user()->position;
    
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $romawi = [1 => 'I', 'II', 'III', 'IV', 'V', 'VI', 'VII', 'VII', 'IX', 'X', 'XI', 'XII'];
    ?>
    <!-- Quotation start -->
    <div class="p-10 z-0 bg-black">
        <div class="flex w-full justify-center">
            <div class="flex w-[950px]">
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
                    href="/quotations/select-location/{{ $category }}">
                    <svg class="fill-current w-4 xl:w-5 2xl:w-6 ml-1 xl:mx-2" xmlns="http://www.w3.org/2000/svg"
                        width="24" height="24" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                    </svg>
                    <span class="ml-1 xl:mx-2 text-sm">Cancel</span>
                </a>
            </div>
        </div>
        <div class="flex justify-center w-full">
            <div class="w-[950px] h-[1345px] bg-white mb-10 mt-1">
                <!-- Header start -->
                @include('dashboard.layouts.letter-header')
                <!-- Header end -->
                <!-- Body start -->
                <div class="h-[1125px]">
                    <div class="flex justify-center">
                        <div class="w-[725px] mt-2">
                            <div class="flex">
                                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                                <label class="ml-1 text-sm text-black">:</label>
                                <input type="number" id="createNumber" name="createNumber"
                                    class="flex text-sm text-black w-14 text-center px-1 in-out-spin-none outline-none @error('number') is-invalid @enderror"
                                    min="0" value="{{ old('number') }}" autofocus>
                                <label id="labelNumber"
                                    class="ml-1 text-sm text-slate-500">/SPH/VM/{{ $romawi[(int) date('m')] }}-{{ date('Y') }}</label>
                            </div>
                            @error('number')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
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
                                    Reklame {{ $category }}</label>
                            </div>
                            <div class="flex mt-4">
                                <div class="flex">
                                    <label class="ml-1 text-sm text-teal-700 flex w-12">Klien</label>
                                    <label class="ml-1 text-sm text-teal-700 flex">:</label>
                                    <div>
                                        <div id="selectClient" class="flex" onclick="selectClientAction(event)">
                                            <input
                                                class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-tl-lg w-40 px-2 hover:cursor-default"
                                                type="text" id="dataClient" name="dataClient" placeholder="Pilih Klien"
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
                                                                id="{{ $client->id }}"
                                                                title="{{ $client->company }}-{{ $client->type }}-{{ $client->name }}-{{ $client->phone }}-{{ $client->email }}-{{ $client->address }}"
                                                                onclick="getSelect(this)">
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
                                <label id="createContactEmail"
                                    class="ml-1 text-sm text-black font-semibold flex">-</label>
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
                                @if ($area != 'All')
                                    @if ($city != 'All')
                                        <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame {{ $category }} area {{ $area }}  kota {{ $city }}  dengan spesifikasi sebagai berikut :</textarea>
                                    @else
                                        <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame {{ $category }} area  {{ $area }} dengan spesifikasi sebagai berikut :</textarea>
                                    @endif
                                @else
                                    <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran penggunaan media reklame {{ $category }} dengan rincian sebagai berikut :</textarea>
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- table start -->
                    <div class="flex justify-center ml-2">
                        @if ($category == 'Videotron')
                            @include('quotations.vt-quot-table')
                        @elseif ($category == 'Signage')
                            @php
                                $dataDescription = json_decode($locations[0]->description);
                            @endphp
                            @if ($dataDescription->type == 'Videotron')
                                @include('quotations.vt-quot-table')
                            @else
                                @include('quotations.bb-quot-table')
                            @endif
                        @else
                            @include('quotations.bb-quot-table')
                        @endif
                    </div>
                    <!-- table end -->

                    <!-- notes start -->
                    @if ($category == 'Videotron')
                        @include('quotations.led-notes')
                    @elseif ($category == 'Signage')
                        @php
                            $dataDescription = json_decode($locations[0]->description);
                        @endphp
                        @if ($dataDescription->type == 'Videotron')
                            @include('quotations.led-notes')
                        @else
                            @include('quotations.billboard-notes')
                        @endif
                    @else
                        @include('quotations.billboard-notes')
                    @endif
                    <!-- notes end -->

                    <div>
                        <div class="flex justify-center">
                            <div class="flex mt-2">
                                <textarea id="createBodyEnd" class="ml-1 w-[721px] outline-none text-sm" rows="1">Demikian surat penawaran ini kami sampaikan, atas perhatian dan kerjasamanya kami ucapkan terima kasih.</textarea>
                            </div>
                        </div>
                        <div class="flex justify-center">
                            <div class="w-[725px] mt-2">
                                <label class="ml-1 text-sm text-black flex">Denpasar, {{ date('d') }}
                                    {{ $bulan[(int) date('m')] }}
                                    {{ date('Y') }}</label>
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
        @include('quotations.locations-view')
        <!-- View Location end -->
    </div>

    <!-- Modal Preview start -->
    @include('quotations.create-preview')
    <!-- Modal Preview end -->
    <!-- Quotation end -->
    <script src="/js/createquotation.js"></script>
@endsection
