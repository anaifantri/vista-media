<div id="modalPdfPreview" class="absolute justify-center top-0 w-full bg-black bg-opacity-90 z-50  p-10 hidden">
    <?php
    if (fmod(count($data_prints), 40) == 0) {
        $pageQty = count($data_prints) / 40;
    } else {
        $pageQty = (count($data_prints) - fmod(count($data_prints), 40)) / 40 + 1;
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
                @if (count($data_prints) == 0)
                    <div class="w-[950px] h-[1345px] mt-1 bg-white p-4">
                        <!-- Header start -->
                        @include('dashboard.layouts.letter-header')
                        <!-- Header end -->
                        <!-- Body start -->
                        <div class="h-[1080px]">
                            <label class="flex text-md font-semibold justify-center w-full mt-6"><u>DAFTAR SPK
                                    CETAK</u></label>
                            <label class="flex text-md justify-center w-full">
                                Periode : {{ $periode }}
                            </label>
                            <div class="flex justify-center w-full mt-4">
                                <label class="flex text-base text-red-600 font-serif tracking-wider">
                                    ~~ Tidak ada data SPK cetak untuk periode {{ $periode }} ~~
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
                                <label class="flex text-md font-semibold justify-center w-full mt-4"><u>DAFTAR SPK CETAK
                                        GAMBAR</u></label>
                                <label class="flex text-md justify-center w-full">
                                    <b class="ml-2">
                                        Periode : {{ $periode }}
                                    </b>
                                </label>
                                <div class="flex justify-center w-full mt-4">
                                    <div class="w-[850px]">
                                        <table class="table-auto w-full">
                                            <thead>
                                                <tr class="h-8">
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] w-8 text-center">
                                                        No.</th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-16">
                                                        No. SPK</th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-16">
                                                        Vendor
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-[72px]">
                                                        Lokasi
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-24">
                                                        Klien
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-16">
                                                        Status
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center">
                                                        Tema/Design
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-[88px]">
                                                        Bahan
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-16">
                                                        Ukuran
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-8">
                                                        Qty
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-12">
                                                        Harga
                                                    </th>
                                                    <th
                                                        class="text-stone-900 border border-stone-900 text-[0.7rem] text-center w-20">
                                                        Total
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_prints as $order)
                                                    @php
                                                        $client = '-';
                                                        $product = json_decode($order->product);
                                                        $created_by = json_decode($order->created_by);
                                                        $notes = json_decode($order->notes);
                                                        if ($order->sale) {
                                                            $client = json_decode($order->sale->quotation->clients);
                                                        }
                                                    @endphp
                                                    @if ($i == 0)
                                                        @if ($loop->iteration <= 40)
                                                            <tr>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem]  text-center">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ substr($order->number, 0, 8) }}..
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($order->vendor->name) > 8)
                                                                        {{ substr($order->vendor->name, 0, 8) }}..
                                                                    @else
                                                                        {{ $order->vendor->name }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->location_code }} -
                                                                    {{ $product->city_code }}
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
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($product->status) > 10)
                                                                        {{ substr($product->status, 0, 10) }}..
                                                                    @else
                                                                        {{ $product->status }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($order->theme) > 25)
                                                                        {{ substr($order->theme, 0, 25) }}..
                                                                    @else
                                                                        {{ $order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($product->product_name) > 12)
                                                                        {{ substr($product->product_name, 0, 12) }}..
                                                                    @else
                                                                        {{ $product->product_name }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->location_size }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->qty }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ number_format($product->product_price) }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-right">
                                                                    {{ number_format($order->price) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @else
                                                        @if ($loop->iteration > $i * 40 && $loop->iteration < ($i + 1) * 40 + 1)
                                                            <tr>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem]  text-center">
                                                                    {{ $loop->iteration }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ substr($order->number, 0, 10) }}..
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($order->vendor->name) > 10)
                                                                        {{ substr($order->vendor->name, 0, 10) }}..
                                                                    @else
                                                                        {{ $order->vendor->name }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->location_code }} -
                                                                    {{ $product->city_code }}
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
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($product->status) > 10)
                                                                        {{ substr($product->status, 0, 10) }}..
                                                                    @else
                                                                        {{ $product->status }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($order->theme) > 25)
                                                                        {{ substr($order->theme, 0, 25) }}..
                                                                    @else
                                                                        {{ $order->theme }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    @if (strlen($product->product_name) > 15)
                                                                        {{ substr($product->product_name, 0, 15) }}..
                                                                    @else
                                                                        {{ $product->product_name }}
                                                                    @endif
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->location_size }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ $product->qty }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-center">
                                                                    {{ number_format($product->product_price) }}
                                                                </td>
                                                                <td
                                                                    class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] text-right">
                                                                    {{ number_format($order->price) }}
                                                                </td>
                                                            </tr>
                                                        @endif
                                                    @endif
                                                @endforeach
                                                @if ($i == $pageQty - 1)
                                                    <tr>
                                                        <td class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] font-semibold text-right"
                                                            colspan="11">Total</td>
                                                        <td
                                                            class="text-stone-900 p-1 border border-stone-900 text-[0.7rem] font-semibold text-right">
                                                            {{ number_format($amount) }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                        {{-- <div class="mt-8">
                                    <div class="flex justify-center">
                                        <div class="w-[725px]">
                                            <label class="text-sm text-black flex font-semibold">Denpasar,
                                                {{ date('d') }}
                                                {{ $bulan_full[(int) date('m')] }}
                                                {{ date('Y') }}
                                            </label>
                                            <label class="text-sm text-black flex font-semibold">PT. Vista Media</label>
                                            <label class="mt-12 text-sm text-black flex font-semibold">
                                                <u>{{ auth()->user()->name }}</u>
                                            </label>
                                            <label
                                                class="text-xs text-black flex">{{ auth()->user()->position }}</label>
                                            <label class="text-xs text-black flex">Hp.
                                                {{ auth()->user()->phone }}</label>
                                        </div>
                                    </div>
                                </div> --}}
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
