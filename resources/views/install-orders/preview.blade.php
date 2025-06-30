@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        ];
        $spkDate = date('d') . ' ' . $bulan[(int) date('m')] . ' ' . date('Y');
        $product = json_decode($install_order->product);
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex border-b">
                <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-primary mb-2" title="Create PDF"
                    type="button">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path
                            d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                    </svg>
                    <span class="mx-1">Save PDF</span>
                </button>
                <a class="flex justify-center items-center mx-1 btn-danger"
                    href="/install-orders/index/{{ $company->id }}">
                    <svg class="fill-white w-4 m-auto hover:fill-red-600" xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24">
                        <path
                            d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm6 16.094l-4.157-4.104 4.1-4.141-1.849-1.849-4.105 4.159-4.156-4.102-1.833 1.834 4.161 4.12-4.104 4.157 1.834 1.832 4.118-4.159 4.143 4.102 1.848-1.849z" />
                    </svg>
                    <span class="mx-1">Close</span>
                </a>
            </div>
            @if (session()->has('success'))
                <div class="mt-2 flex alert-success">
                    <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path
                            d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.25 16.518l-4.5-4.319 1.396-1.435 3.078 2.937 6.105-6.218 1.421 1.409-7.5 7.626z" />
                    </svg>
                    <span class="font-semibold mx-1">Success!</span> {{ session('success') }}
                </div>
            @endif
            <div class="flex justify-center w-full mt-2">
                <div id="pdfPreview" class="w-[950px] h-[1345px] bg-white p-4 mt-2">
                    <!-- SPK Header start-->
                    @include('install-orders.spk-header')
                    <!-- SPK Header end-->

                    <!-- SPK Body start-->
                    <div class="h-[520px] mt-2">
                        <div class="flex w-full items-center px-10">
                            <div class="w-[950px]">
                                <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK PEMASANGAN
                                        GAMBAR</u></label>
                                <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                    {{ $install_order->number }}
                                </label>
                                <div class="flex justify-center w-full mt-2">
                                    <div class="w-[500px] h-[440px] border p-2">
                                        <div class="flex">
                                            <div class="w-[240px] border rounded-md p-1">
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Tgl. SPK</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ date('d', strtotime($install_order->created_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($install_order->created_at))] }}
                                                        {{ date('Y', strtotime($install_order->created_at)) }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Design</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ $install_order->theme }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Ukuran</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ $product->location_size }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="w-[240px] border rounded-md p-1 ml-1">
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-20">Tipe</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">
                                                        {{ $install_order->type }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-20">Jumlah</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex w-8 ml-1 text-sm text-black border rounded-sm px-1 justify-center">{{ $product->qty }}</label>
                                                    <label class="flex ml-2 text-sm text-black">lembar</label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-20">Tgl. Tayang</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm text-black border w-[140px] rounded-sm px-1">
                                                        {{ date('d', strtotime($install_order->install_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($install_order->install_at))] }}
                                                        {{ date('Y', strtotime($install_order->install_at)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex mt-1">
                                            <label class="flex text-sm text-black w-[68px]">Catatan</label>
                                            <label class="flex text-sm text-black">:</label>
                                            <label
                                                class="flex h-12 w-[400px] ml-1 text-sm text-black border rounded-sm px-1">
                                                {{ $install_order->notes }}
                                            </label>
                                        </div>
                                        <div class="flex mt-1">
                                            <label class="flex text-sm text-black w-[68px]">Lokasi</label>
                                            <label class="flex text-sm text-black">:</label>
                                            <label
                                                class="flex w-[400px] ml-1 text-sm text-black px-1">{{ $product->location_address }}</label>
                                        </div>
                                        @if ($product->location_side == 2)
                                            @if ($product->side_left == true && $product->side_right == true)
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-[68px]"></label>
                                                    <label class="flex ml-1 text-sm text-black px-1">-> Sisi Kiri dan
                                                        Kanan</label>
                                                </div>
                                            @else
                                                @if ($product->side_left == true)
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-[68px]"></label>
                                                        <label class="flex ml-1 text-sm text-black px-1">-> Sisi
                                                            Kiri</label>
                                                    </div>
                                                @elseif ($product->side_right == true)
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-[68px]"></label>
                                                        <label class="flex ml-1 text-sm text-black px-1">-> Sisi
                                                            Kanan</label>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                        <!-- SPK Sign start-->
                                        <div class="flex justify-center mt-1">
                                            <div class="flex justify-center w-[790px] h-44">
                                                <table class="table-sign">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-black font-semibold text-sm border w-[260px]">
                                                                Kode Lokasi :
                                                                {{ $product->location_code }}-{{ $product->city_code }}
                                                            </th>
                                                            <th class="text-black font-semibold text-sm border">Google Maps
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="border p-1 text-center">
                                                                <div
                                                                    class="flex justify-center items-center border mt-1 p-1">
                                                                    <img class="m-auto flex items-center justify-center max-w-[260px]"
                                                                        src="{{ asset('storage/' . $product->location_photo) }}">
                                                                </div>
                                                            </td>
                                                            <td class="border p-1 text-center">
                                                                <div class="flex w-full justify-center items-center">
                                                                    {{ QrCode::size(100)->generate('https://www.google.co.id/maps/place/' . $product->location_lat . ',' . $product->location_lng . '/@' . $product->location_lat . ',' . $product->location_lng . ',16z') }}
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- SPK Sign end-->
                                    </div>
                                    <div class="w-[280px] border ml-2 p-1">
                                        <label
                                            class="flex text-sm text-black justify-center w-full px-1 font-semibold">Design</label>
                                        <div class="flex justify-center items-center border mt-2 p-1">
                                            @if ($install_order->design)
                                                <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                    src="{{ asset('storage/' . $install_order->design) }}">
                                            @else
                                                <div
                                                    class="flex justify-center items-center text-red-700 max-w-[260px] h-[120px]">
                                                    <label>~~ kosong ~~</label>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- SPK Sign start-->
                                        <div class="flex justify-center h-40 mt-2">
                                            <table class="w-[280px]">
                                                <thead>
                                                    <tr class="h-6">
                                                        <th class="text-black font-semibold text-xs border" colspan="2">
                                                            Mengetahui :</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-black font-semibold text-xs border w-[90px]">Tim
                                                            Marketing</th>
                                                        <th class="text-black font-semibold text-xs border w-[90px]">Tim
                                                            Produksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            class="text-center align-bottom text-xs font-semibold text-black border p-1">
                                                            (______________________)</td>
                                                        <td
                                                            class="text-center align-bottom text-xs font-semibold text-black border p-1">
                                                            (______________________)</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- SPK Sign end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-500 text-xs ml-20 mt-2">
                            <i>* Lembar untuk Tim Produksi</i>
                        </div>
                    </div>
                    <!-- SPK Body end-->

                    <div class="flex w-full justify-center items-center pt-4">
                        <div class="border-t h-2 border-slate-500 border-dashed w-full mt-2">
                        </div>
                        <svg class="fill-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M14.686 13.646l-6.597 3.181c-1.438.692-2.755-1.124-2.755-1.124l6.813-3.287 2.539 1.23zm6.168 5.354c-.533 0-1.083-.119-1.605-.373-1.511-.731-2.296-2.333-1.943-3.774.203-.822-.23-.934-.891-1.253l-11.036-5.341s1.322-1.812 2.759-1.117c.881.427 4.423 2.136 7.477 3.617l.766-.368c.662-.319 1.094-.43.895-1.252-.351-1.442.439-3.043 1.952-3.77.521-.251 1.068-.369 1.596-.369 1.799 0 3.147 1.32 3.147 2.956 0 1.23-.766 2.454-2.032 3.091-1.266.634-2.15.14-3.406.75l-.394.19.431.21c1.254.614 2.142.122 3.404.759 1.262.638 2.026 1.861 2.026 3.088 0 1.64-1.352 2.956-3.146 2.956zm-1.987-9.967c.381.795 1.459 1.072 2.406.617.945-.455 1.405-1.472 1.027-2.267-.381-.796-1.46-1.073-2.406-.618-.946.455-1.408 1.472-1.027 2.268zm-2.834 2.819c0-.322-.261-.583-.583-.583-.321 0-.583.261-.583.583s.262.583.583.583c.322.001.583-.261.583-.583zm5.272 2.499c-.945-.457-2.025-.183-2.408.611-.381.795.078 1.814 1.022 2.271.945.458 2.024.184 2.406-.611.382-.795-.075-1.814-1.02-2.271zm-18.305-3.351h-3v2h3v-2zm4 0h-3v2h3v-2z" />
                        </svg>
                    </div>

                    <!-- SPK Header start-->
                    @include('install-orders.spk-header')
                    <!-- SPK Header end-->

                    <!-- SPK Body start-->
                    <div class="mt-2">
                        <div class="flex w-full px-10">
                            <div class="w-[950px]">
                                <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK PEMASANGAN
                                        GAMBAR</u></label>
                                <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                    {{ $install_order->number }} </label>
                                <div class="flex justify-center w-full">
                                    <div class="w-[500px] h-[460px] border p-2">
                                        <div class="flex">
                                            <div class="w-[240px] border rounded-md p-1">
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Tgl. SPK</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ date('d', strtotime($install_order->created_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($install_order->created_at))] }}
                                                        {{ date('Y', strtotime($install_order->created_at)) }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Design</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ $install_order->theme }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Ukuran</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ $product->location_size }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-16">Status</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
                                                        {{ $product->status }}
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="w-[240px] border rounded-md p-1 ml-1">
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-20">Tipe</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">
                                                        {{ $install_order->type }}
                                                    </label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-20">Jumlah</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex w-8 ml-1 text-sm text-black border rounded-sm px-1 justify-center">{{ $product->qty }}</label>
                                                    <label class="flex ml-2 text-sm text-black">lembar</label>
                                                </div>
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-20">Tgl. Tayang</label>
                                                    <label class="flex text-sm text-black">:</label>
                                                    <label
                                                        class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">
                                                        {{ date('d', strtotime($install_order->install_at)) }}
                                                        {{ $bulan[(int) date('m', strtotime($install_order->install_at))] }}
                                                        {{ date('Y', strtotime($install_order->install_at)) }}
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex mt-1">
                                            <label class="flex text-sm text-black w-[68px]">Catatan</label>
                                            <label class="flex text-sm text-black">:</label>
                                            <label
                                                class="flex h-12 w-[400px] ml-1 text-sm text-black border rounded-sm px-1">
                                                {{ $install_order->notes }}
                                            </label>
                                        </div>
                                        <div class="flex mt-1">
                                            <label class="flex text-sm text-black w-[68px]">Lokasi</label>
                                            <label class="flex text-sm text-black">:</label>
                                            <label
                                                class="flex w-[400px] ml-1 text-sm text-black px-1">{{ $product->location_address }}</label>
                                        </div>
                                        @if ($product->location_side == 2)
                                            @if ($product->side_left == true && $product->side_right == true)
                                                <div class="flex mt-1">
                                                    <label class="flex text-sm text-black w-[68px]"></label>
                                                    <label class="flex ml-1 text-sm text-black px-1">-> Sisi Kiri dan
                                                        Kanan</label>
                                                </div>
                                            @else
                                                @if ($product->side_left == true)
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-[68px]"></label>
                                                        <label class="flex ml-1 text-sm text-black px-1">-> Sisi
                                                            Kiri</label>
                                                    </div>
                                                @elseif ($product->side_right == true)
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-[68px]"></label>
                                                        <label class="flex ml-1 text-sm text-black px-1">-> Sisi
                                                            Kanan</label>
                                                    </div>
                                                @endif
                                            @endif
                                        @endif
                                        <!-- SPK location start-->
                                        <div class="flex justify-center">
                                            <div class="flex justify-center w-[790px] h-44">
                                                <table class="table-sign">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-black font-semibold text-sm border w-[260px]">
                                                                Kode Lokasi :
                                                                {{ $product->location_code }}-{{ $product->city_code }}
                                                            </th>
                                                            @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                <th class="text-black text-sm font-semibold border">Data
                                                                    Penjualan</th>
                                                            @else
                                                                <th class="text-black font-semibold text-sm border">Data
                                                                    Lokasi</th>
                                                            @endif
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="border p-1 text-center">
                                                                <div
                                                                    class="flex justify-center items-center border mt-1 p-1">
                                                                    <img class="m-auto flex items-center justify-center max-w-[260px]"
                                                                        src="{{ asset('storage/' . $product->location_photo) }}">
                                                                </div>
                                                            </td>
                                                            <td class="border p-1 text-center">
                                                                @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                    <label
                                                                        class="flex justify-center text-sm text-black">No.
                                                                        Penjualan</label>
                                                                    <label
                                                                        class="flex justify-center text-sm text-black">{{ $install_order->sale->number }}</label>
                                                                @else
                                                                    <label
                                                                        class="hidden justify-center text-sm text-black"></label>
                                                                @endif
                                                                <div class="flex w-full justify-center items-center mt-4">
                                                                    @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                        {{ QrCode::size(100)->generate('https://' . $company->website . '/marketing/sales/' . $install_order->sale->id) }}
                                                                    @else
                                                                        {{ QrCode::size(100)->generate('https://' . $company->website . '/media/locations/' . $product->location_id) }}
                                                                    @endif
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- SPK location end-->
                                    </div>
                                    <div class="w-[280px] border ml-2 p-1">
                                        <label
                                            class="flex text-sm text-black justify-center w-full px-1 font-semibold">Design</label>
                                        <div class="flex justify-center items-center border mt-2 p-1">
                                            @if ($install_order->design)
                                                <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                    src="{{ asset('storage/' . $install_order->design) }}">
                                            @else
                                                <div
                                                    class="flex justify-center items-center text-red-700 max-w-[260px] h-[120px]">
                                                    <label>~~ kosong ~~</label>
                                                </div>
                                            @endif
                                        </div>
                                        <!-- SPK Sign start-->
                                        <div class="flex justify-center h-40 mt-2">
                                            <table class="w-[280px]">
                                                <thead>
                                                    <tr class="h-6">
                                                        <th class="text-black font-semibold text-xs border"
                                                            colspan="2">Mengetahui :</th>
                                                    </tr>
                                                    <tr>
                                                        <th class="text-black font-semibold text-xs border w-[90px]">Tim
                                                            Marketing</th>
                                                        <th class="text-black font-semibold text-xs border w-[90px]">Tim
                                                            Produksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td
                                                            class="text-center align-bottom text-xs font-semibold text-black border p-1">
                                                            (______________________)</td>
                                                        <td
                                                            class="text-center align-bottom text-xs font-semibold text-black border p-1">
                                                            (______________________)</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- SPK Sign end-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-slate-500 text-xs ml-20 mt-2">
                            <i>* Lembar untuk Tim Marketing</i>
                        </div>
                    </div>
                    <!-- SPK Body end-->
                </div>
            </div>
        </div>
        <input id="saveName" type="text"
            value="{{ substr($install_order->number, 0, 4) }}-SPK Pasang-{{ $product->location_address }}" hidden>
    </div>

    <!-- Script start-->
    <script src="/js/html2canvas.min.js"></script>
    <script src="/js/html2pdf.bundle.min.js"></script>
    <script src="/js/qrcode.min.js"></script>

    <script>
        const saveName = document.getElementById("saveName");
        document.getElementById("btnCreatePdf").onclick = function() {
            var element = document.getElementById('pdfPreview');
            var opt = {
                margin: 0,
                filename: saveName.value + '.pdf',
                image: {
                    type: 'jpeg',
                    quality: 1
                },
                pagebreak: {
                    mode: ['avoid-all', 'css', 'legacy']
                },
                html2canvas: {
                    dpi: 192,
                    scale: 2,
                    letterRendering: true,
                    useCORS: true
                },
                jsPDF: {
                    unit: 'px',
                    format: [950, 1365],
                    orientation: 'portrait',
                    putTotalPages: true
                }
            };
            // html2pdf(element, opt);
            html2pdf().set(opt).from(element).save();
        };
    </script>
    <!-- Script end-->
@endsection
