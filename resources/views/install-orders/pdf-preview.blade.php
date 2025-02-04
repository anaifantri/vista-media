<div id="modalPdfPreview" class="absolute justify-center top-0 w-full bg-black bg-opacity-90 z-50  p-10 hidden">
    <?php
    if (fmod(count($data_installs), 35) == 0) {
        $pageQty = count($data_installs) / 35;
    } else {
        $pageQty = (count($data_installs) - fmod(count($data_installs), 35)) / 35 + 1;
    }
    ?>
    <div class="flex justify-center w-full">
        <div>
            <div class="flex w-full justify-end">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-success" title="Simpan PDF"
                    type="button" onclick="savePdf()">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <button class="flex justify-center items-center mx-1 btn-danger" title="Close" type="button"
                    onclick="btnClosePreview()">
                    <svg class="fill-current w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="mx-1">CLose</span>
                </button>
            </div>
            <div id="pdfPreview">
                @if (count($data_installs) == 0)
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1080px]">
                            <label class="flex text-md font-semibold justify-center w-full mt-6"><u>DAFTAR SPK
                                    PEMASANGAN
                                    GAMBAR</u></label>
                            <label class="flex text-md justify-center w-full">
                                <b class="ml-2">
                                    @if (
                                        (request('days') &&
                                            request('days') != 'All' &&
                                            (request('month') && request('month') != 'All') &&
                                            request('year')) ||
                                            request('todays'))
                                        Jadwal Tayang : {{ $periode }}
                                    @else
                                        Periode : {{ $periode }}
                                    @endif
                                </b>
                            </label>
                            <div class="flex justify-center w-full mt-4">
                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                    ~~ Tidak ada data SPK pemasangan gambar untuk periode {{ $periode }} ~~
                                </label>
                            </div>
                        </div>
                        <!-- Body start -->
                        <!-- Footer start -->
                        @include('dashboard.layouts.letter-footer')
                        <!-- Footer end -->
                    </div>
                @else
                    @for ($i = 0; $i < $pageQty; $i++)
                        <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                            <!-- Header start -->
                            @include('dashboard.layouts.letter-header')
                            <!-- Header end -->
                            <!-- Body start -->
                            <div class="h-[1080px]">
                                <label class="flex text-md font-semibold justify-center w-full mt-6"><u>DAFTAR SPK
                                        PEMASANGAN
                                        GAMBAR</u></label>
                                <label class="flex text-md justify-center w-full">
                                    <b class="ml-2">
                                        @if (
                                            (request('days') &&
                                                request('days') != 'All' &&
                                                (request('month') && request('month') != 'All') &&
                                                request('year')) ||
                                                request('todays'))
                                            Jadwal Tayang : {{ $periode }}
                                        @else
                                            Periode : {{ $periode }}
                                        @endif
                                    </b>
                                </label>
                                <div class="flex justify-center w-full mt-4">
                                    <div class="w-[850px]">
                                        <table class="table-auto w-full">
                                            <thead>
                                                <tr>
                                                    <th class="text-stone-900 border border-stone-900 text-[0.7rem] w-8 text-center"
                                                        rowspan="2">
                                                        No.</th>
                                                    <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-20"
                                                        rowspan="2">
                                                        No. SPK
                                                    </th>
                                                    <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-[72px]"
                                                        rowspan="2">Tgl. Tayang</th>
                                                    {{-- <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-24"
                                                        rowspan="2">
                                                        Klien</th> --}}
                                                    <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-32"
                                                        rowspan="2">
                                                        Tema/Design
                                                    </th>
                                                    <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-8"
                                                        rowspan="2">
                                                        Jml.
                                                    </th>
                                                    <th class="text-stone-900 border border-stone-900 text-[0.7rem] text-center"
                                                        colspan="4">Data Lokasi</th>
                                                </tr>
                                                <tr>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] w-16 text-center">
                                                        Kode
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center">
                                                        Lokasi
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-16">
                                                        Ukuran
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-10">
                                                        Jenis
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_installs as $order)
                                                    @php
                                                        $client = '-';
                                                        $product = json_decode($order->product);
                                                        if ($order->sale) {
                                                            $client = json_decode($order->sale->quotation->clients);
                                                        }
                                                    @endphp
                                                    @if ($i == 0)
                                                        @if ($loop->iteration <= 35)
                                                            <tr>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]  text-center">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ substr($order->number, 0, 8) }}..
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ date('d', strtotime($order->install_at)) }}-{{ $bulan[(int) date('m', strtotime($order->install_at))] }}-{{ date('Y', strtotime($order->install_at)) }}
                                                                </td>
                                                                {{-- <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if ($order->sale)
                                                                        @if (strlen($client->name) > 15)
                                                                            {{ substr($client->name, 0, 15) }}..
                                                                        @else
                                                                            {{ $client->name }}
                                                                        @endif
                                                                    @else
                                                                        {{ $client }}
                                                                    @endif
                                                                </td> --}}
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($order->theme) > 20)
                                                                        {{ substr($order->theme, 0, 20) }}..
                                                                    @else
                                                                        {{ $order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->qty }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->location_code }}-{{ $product->city_code }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]">
                                                                    @if (strlen($order->location->address) > 55)
                                                                        {{ substr($order->location->address, 0, 55) }}..
                                                                    @else
                                                                        {{ $order->location->address }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]  text-center">
                                                                    {{ $product->location_size }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if ($order->type == 'Frontlight')
                                                                        FL
                                                                    @elseif ($order->type == 'Backlight')
                                                                        BL
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @else
                                                        @if ($loop->iteration > $i * 35 && $loop->iteration < ($i + 1) * 35 + 1)
                                                            <tr>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]  text-center">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ substr($order->number, 0, 8) }}..
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if ($order->sale)
                                                                        @if (strlen($client->name) > 15)
                                                                            {{ substr($client->name, 0, 15) }}..
                                                                        @else
                                                                            {{ $client->name }}
                                                                        @endif
                                                                    @else
                                                                        {{ $client }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($order->theme) > 20)
                                                                        {{ substr($order->theme, 0, 20) }}..
                                                                    @else
                                                                        {{ $order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->qty }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->location_code }}-{{ $product->city_code }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]">
                                                                    @if (strlen($order->location->address) > 55)
                                                                        {{ substr($order->location->address, 0, 55) }}..
                                                                    @else
                                                                        {{ $order->location->address }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem]  text-center">
                                                                    {{ $product->location_size }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 px-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if ($order->type == 'Frontlight')
                                                                        FL
                                                                    @elseif ($order->type == 'Backlight')
                                                                        BL
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                            </tbody>
                                        </table>
                                        @if ($i == $pageQty - 1)
                                            <div class="mt-3">
                                                <div class="flex justify-center">
                                                    <div class="w-[725px]">
                                                        <label class="text-sm text-black flex font-semibold">Denpasar,
                                                            {{ date('d') }}
                                                            {{ $bulan_full[(int) date('m')] }}
                                                            {{ date('Y') }}
                                                        </label>
                                                        <label
                                                            class="text-sm text-black flex font-semibold">{{ $company->name }}</label>
                                                        <label class="mt-10 text-sm text-black flex font-semibold">
                                                            <u>{{ auth()->user()->name }}</u>
                                                        </label>
                                                        <label
                                                            class="text-xs text-black flex">{{ auth()->user()->position }}</label>
                                                        <label class="text-xs text-black flex">Hp.
                                                            {{ auth()->user()->phone }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <!-- Body start -->
                            <!-- Footer start -->
                            @include('dashboard.layouts.letter-footer')
                            <div class="flex w-full justify-end px-10 text-xs text-stone-700">
                                <span>Halaman ke {{ $i + 1 }} dari {{ $pageQty }}</span>
                            </div>
                            <!-- Footer end -->
                        </div>
                    @endfor
                @endif
            </div>
        </div>
    </div>
</div>
