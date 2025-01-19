<div class="h-[1100px]">
    <div class="flex justify-center">
        <div class="w-[725px] mt-2">
            <div class="flex">
                <label class="ml-1 text-sm text-black flex w-20">Nomor</label>
                <label class="ml-1 text-sm text-black">:</label>
                <label class="ml-1 text-sm text-slate-500">Penomoran otomatis</label>
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
                <label id="createSubject" class="ml-1 text-sm text-black flex">Penawaran Perpanjangan Penggunaan Media
                    Reklame {{ $category }}</label>
            </div>
            <div class="flex mt-4">
                <div class="hidden">
                    <label class="ml-1 text-sm text-teal-700 flex w-20">Ganti Klien</label>
                    <label class="ml-1 text-sm text-teal-700 flex">:</label>
                    <div>
                        <div id="selectClient" class="flex" onclick="selectClientAction(event)">
                            <input
                                class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-tl-lg w-40 px-2 hover:cursor-default"
                                type="text" id="dataClient" name="dataClient" value="{{ $dataClient->name }}"
                                readonly>
                            <svg class="flex items-center justify-center w-5 p-1 border rounded-tr-lg"
                                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M12 21l-12-18h24z" />
                            </svg>
                        </div>
                        <div id="clientList" class="absolute bg-white w-[180px] border rounded-b-lg ml-1 p-2 hidden"
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
                @if ($dataClient->type == 'Perusahaan')
                    <div id="divContact" class="flex p-1">
                        <label class="text-sm text-teal-700 flex w-20">Ganti Kontak</label>
                        <label class="ml-1 text-sm text-teal-700 flex">:</label>
                        <select
                            class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-lg w-40"
                            name="contact_id" id="contact_id" onchange="getContact(this)">
                            @foreach ($contacts as $contact)
                                @if ($contact->client_id == $dataClient->id)
                                    @if ($contact->name == $dataClient->contact_name)
                                        <option id="{{ $contact }}" value="{{ $contact->id }}" selected>
                                            {{ $contact->name }}
                                        </option>
                                    @else
                                        <option id="{{ $contact }}" value="{{ $contact->id }}">
                                            {{ $contact->name }}
                                        </option>
                                    @endif
                                @endif
                            @endforeach
                        </select>
                    </div>
                @else
                    <div id="divContact" class="hidden p-1">
                        <label class="text-sm text-teal-700 flex w-20">Ganti Kontak</label>
                        <label class="ml-1 text-sm text-teal-700 flex">:</label>
                        <select
                            class="ml-1 text-sm text-teal-700 flex font-semibold outline-none border rounded-lg w-40"
                            name="contact_id" id="contact_id" onchange="getContact(this)">
                            @foreach ($contacts as $contact)
                                @if ($contact->client_id == $dataClient->id)
                                    <option id="{{ $contact }}" value="{{ $contact->id }}">{{ $contact->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif
            </div>
            <div class="flex mt-4">
                <div>
                    <label class="ml-1 text-sm text-black flex w-20">Kepada Yth</label>
                    @if ($dataClient->type == 'Perusahaan')
                        <label id="clientCompany"
                            class="ml-1 text-sm text-black font-semibold flex">{{ $dataClient->company }}</label>
                        <input type="text" id="contactName" value="{{ $dataClient->contact_name }}" hidden>
                        @if ($dataClient->contact_gender == 'Male')
                            <label id="createClientContact" class="ml-1 text-sm text-black font-semibold flex">UP. Bapak
                                {{ $dataClient->contact_name }}</label>
                        @else
                            <label id="createClientContact" class="ml-1 text-sm text-black font-semibold flex">UP. Ibu
                                {{ $dataClient->contact_name }}</label>
                        @endif
                    @else
                        <label id="clientCompany"
                            class="ml-1 text-sm text-black font-semibold flex">{{ $dataClient->name }}</label>
                    @endif
                    <label class="ml-1 text-sm text-black flex">Di -</label>
                    <label class="ml-6 text-sm text-black flex">Tempat</label>
                </div>
            </div>
            <div class="flex mt-4">
                <label class="ml-1 text-sm text-black flex w-20">Email</label>
                <label class="ml-1 text-sm text-black flex">:</label>
                @if ($dataClient->type == 'Perusahaan')
                    <label id="createContactEmail"
                        class="ml-1 text-sm text-black font-semibold flex">{{ $dataClient->contact_email }}</label>
                @else
                    <label id="createContactEmail"
                        class="ml-1 text-sm text-black font-semibold flex">{{ $dataClient->email }}</label>
                @endif
            </div>
            <div class="flex">
                <label class="ml-1 text-sm text-black flex w-20">No. Telp.</label>
                <label class="ml-1 text-sm text-black flex">:</label>
                @if ($dataClient->type == 'Perusahaan')
                    <label id="createContactPhone"
                        class="ml-1 text-sm text-black font-semibold flex">{{ $dataClient->contact_phone }}</label>
                @else
                    <label id="createContactPhone"
                        class="ml-1 text-sm text-black font-semibold flex">{{ $dataClient->phone }}</label>
                @endif
            </div>
            <div class="flex mt-4">
                <label class="ml-1 text-sm text-black flex">Dengan hormat,</label>
            </div>
            @error('body_top')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="flex mt-2">
                @if ($area != 'All')
                    @if ($city != 'All')
                        <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran perpanjangan penggunaan media reklame {{ $category }} area {{ $area }}  kota {{ $city }}  dengan spesifikasi sebagai berikut :</textarea>
                    @else
                        <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran perpanjangan penggunaan media reklame {{ $category }} area {{ $area }} dengan spesifikasi sebagai berikut :</textarea>
                    @endif
                @else
                    <textarea id="createBodyTop" class="ml-1 w-[721px] outline-none text-sm">Bersama ini kami menyampaikan surat penawaran perpanjangan penggunaan media reklame {{ $category }} dengan rincian sebagai berikut : </textarea>
                @endif
            </div>
        </div>
    </div>
    <!-- table start -->
    @if (count($products) == 1)
        <div class="flex justify-center mt-2">
            <div class="flex w-[725px]">
                <input id="cbIncludeInstall" class="text-xs" type="checkbox" onclick="cbIncludeInstallAction(this)">
                <label class="text-xs ml-2">Include Biaya Pasang</label>
                <input id="cbIncludePrint" class="text-xs ml-4" type="checkbox"
                    onclick="cbIncludePrintAction(this)">
                <label class="text-xs ml-2">Include Biaya Cetak</label>
            </div>
        </div>
    @endif
    <div class="flex justify-center ml-2">
        @if ($category == 'Videotron' || ($category == 'Signage' && $dataDescription->type == 'Videotron'))
            @include('quotations.vt-extend-table')
        @else
            @include('quotations.bb-extend-table')
        @endif
    </div>
    <!-- table end -->

    <!-- notes start -->
    @if ($category == 'Videotron')
        @include('quotations.led-notes')
    @elseif ($category == 'Signage')
        @php
            $dataDescription = json_decode($products[0]->description);
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
            <div class="w-[725px] mt-6">
                <label id="salesUser"
                    class="ml-1 text-sm text-black flex font-semibold"><u>{{ auth()->user()->name }}</u></label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px]">
                <label id="salesPotition" class="ml-1 text-xs text-black flex">{{ auth()->user()->position }}</label>
            </div>
        </div>
        <div class="flex justify-center">
            <div class="w-[725px]">
                <label id="salesPhone" class="ml-1 text-xs text-black flex">Hp. {{ auth()->user()->phone }}</label>
            </div>
        </div>
    </div>
</div>
