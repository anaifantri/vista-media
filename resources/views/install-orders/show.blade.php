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
            <div class="flex w-[950px] items-center border-b p-1">
                <h1 class="flex text-xl text-stone-100 font-bold tracking-wider w-[800px]">DATA SPK PASANG</h1>
                <div class="flex w-full justify-end items-center">
                    <a href="/install-orders/index/{{ $company->id }}"
                        class="flex items-center justify-center btn-primary mx-1">
                        <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.017 1.995c5.517 0 9.997 4.48 9.997 9.998s-4.48 9.998-9.997 9.998c-5.518 0-9.998-4.48-9.998-9.998s4.48-9.998 9.998-9.998zm0 1.5c-4.69 0-8.498 3.808-8.498 8.498s3.808 8.498 8.498 8.498 8.497-3.808 8.497-8.498-3.807-8.498-8.497-8.498zm-1.528 4.715s-1.502 1.505-3.255 3.259c-.147.147-.22.339-.22.531s.073.383.22.53c1.753 1.754 3.254 3.258 3.254 3.258.145.145.335.217.526.217.192-.001.384-.074.531-.221.292-.293.294-.766.003-1.057l-1.977-1.977h6.693c.414 0 .75-.336.75-.75s-.336-.75-.75-.75h-6.693l1.978-1.979c.29-.289.287-.762-.006-1.054-.147-.147-.339-.221-.53-.222-.19 0-.38.071-.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                        <span class="mx-1"> Back</span>
                    </a>
                    <button id="btnCreatePdf" class="flex justify-center items-center mx-1 btn-success" title="Create PDF"
                        type="button">
                        <svg class="fill-current w-4 mx-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                            viewBox="0 0 24 24">
                            <path
                                d="M14 3h2.997v5h-2.997v-5zm9 1v20h-22v-24h17.997l4.003 4zm-17 5h12v-7h-12v7zm14 4h-16v9h16v-9z" />
                        </svg>
                        <span class="mx-1">Save PDF</span>
                    </button>
                    @canany(['isAdmin', 'isMarketing'])
                        @can('isOrder')
                            @can('isMarketingEdit')
                                <a href="/marketing/install-orders/{{ $install_order->id }}/edit"
                                    class="flex items-center justify-center btn-warning mx-1">
                                    <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                        stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="m11.25 6c.398 0 .75.352.75.75 0 .414-.336.75-.75.75-1.505 0-7.75 0-7.75 0v12h17v-8.749c0-.414.336-.75.75-.75s.75.336.75.75v9.249c0 .621-.522 1-1 1h-18c-.48 0-1-.379-1-1v-13c0-.481.38-1 1-1zm1.521 9.689 9.012-9.012c.133-.133.217-.329.217-.532 0-.179-.065-.363-.218-.515l-2.423-2.415c-.143-.143-.333-.215-.522-.215s-.378.072-.523.215l-9.027 8.996c-.442 1.371-1.158 3.586-1.264 3.952-.126.433.198.834.572.834.41 0 .696-.099 4.176-1.308zm-2.258-2.392 1.17 1.171c-.704.232-1.274.418-1.729.566zm.968-1.154 7.356-7.331 1.347 1.342-7.346 7.347z"
                                            fill-rule="nonzero" />
                                    </svg>
                                    <span class="mx-1"> Edit </span>
                                </a>
                            @endcan
                        @endcan
                    @endcanany
                    @can('isAdmin')
                        <form action="/marketing/install-orders/{{ $install_order->id }}" method="post" class="d-inline my-1">
                            @method('delete')
                            @csrf
                            <button class="flex items-center justify-center btn-danger mx-1"
                                onclick="return confirm('Apakah anda yakin ingin menghapus data SPK pasang dengan nomor {{ $install_order->number }} ?')">
                                <svg class="fill-current w-5" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.002 2.005c5.518 0 9.998 4.48 9.998 9.997 0 5.518-4.48 9.998-9.998 9.998-5.517 0-9.997-4.48-9.997-9.998 0-5.517 4.48-9.997 9.997-9.997zm0 1.5c-4.69 0-8.497 3.807-8.497 8.497s3.807 8.498 8.497 8.498 8.498-3.808 8.498-8.498-3.808-8.497-8.498-8.497zm0 7.425 2.717-2.718c.146-.146.339-.219.531-.219.404 0 .75.325.75.75 0 .193-.073.384-.219.531l-2.717 2.717 2.727 2.728c.147.147.22.339.22.531 0 .427-.349.75-.75.75-.192 0-.384-.073-.53-.219l-2.729-2.728-2.728 2.728c-.146.146-.338.219-.53.219-.401 0-.751-.323-.751-.75 0-.192.073-.384.22-.531l2.728-2.728-2.722-2.722c-.146-.147-.219-.338-.219-.531 0-.425.346-.749.75-.749.192 0 .385.073.531.219z"
                                        fill-rule="nonzero" />
                                </svg>
                                <span class="mx-1"> Delete </span>
                            </button>
                        </form>
                    @endcan
                </div>
            </div>
            <div id="pdfPreview" class="w-[950px] h-[1345px] bg-white p-4 mt-2">
                <!-- SPK Header start-->
                @include('install-orders.spk-header')
                <!-- SPK Header end-->

                <!-- SPK Body start-->
                <div class="h-[490px] mt-4">
                    <div class="flex w-full items-center px-10">
                        <div class="w-[950px]">
                            <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK PEMASANGAN
                                    GAMBAR</u></label>
                            <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                {{ $install_order->number }}
                            </label>
                            <div class="flex justify-center w-full mt-4">
                                <div class="w-[500px] h-[400px] border p-2">
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
                                        <label class="flex text-sm text-black w-14">Catatan</label>
                                        <label class="flex text-sm text-black">:</label>
                                        <label class="flex h-12 w-[425px] ml-1 text-sm text-black border rounded-sm px-1">
                                            {{ $install_order->notes }}
                                        </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="flex text-sm text-black w-[68px]">Lokasi</label>
                                        <label class="flex text-sm text-black">:</label>
                                        <label
                                            class="flex w-[400px] ml-1 text-sm text-black px-1">{{ $product->location_address }}</label>
                                    </div>
                                    <!-- SPK Sign start-->
                                    <div class="flex justify-center mt-1">
                                        <div class="flex justify-center w-[790px] h-44">
                                            <table class="table-sign">
                                                <thead>
                                                    <tr>
                                                        <th class="text-black font-semibold text-sm border w-[260px]">
                                                            Kode Lokasi : {{ $product->location_code }}</th>
                                                        <th class="text-black font-semibold text-sm border">Google
                                                            Maps</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border p-1 text-center">
                                                            <div class="flex justify-center items-center border mt-1 p-1">
                                                                <img class="m-auto flex items-center justify-center max-w-[260px]"
                                                                    src="{{ asset('storage/' . $product->location_photo) }}">
                                                            </div>
                                                        </td>
                                                        <td class="border p-1 text-center">
                                                            <div class="flex w-full justify-center items-center">
                                                                {{ QrCode::size(100)->generate('https://vistamedia.co.id/') }}
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
                                    <div class="flex justify-center items-center border mt-3 p-1">
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
                <div class="h-[490px] mt-4">
                    <div class="flex w-full px-10">
                        <div class="w-[950px]">
                            <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK PEMASANGAN
                                    GAMBAR</u></label>
                            <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                {{ $install_order->number }} </label>
                            <div class="flex justify-center w-full">
                                <div class="w-[500px] h-[430px] border p-2">
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
                                            <div class="flex mt-1">
                                                <label class="flex text-sm text-black w-16">Status</label>
                                                <label class="flex text-sm text-black">:</label>
                                                <label class="flex ml-1 text-sm w-40 text-black border rounded-sm px-1">
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
                                        <label class="flex text-sm text-black w-14">Catatan</label>
                                        <label class="flex text-sm text-black">:</label>
                                        <label class="flex h-12 w-[425px] ml-1 text-sm text-black border rounded-sm px-1">
                                            {{ $install_order->notes }}
                                        </label>
                                    </div>
                                    <div class="flex mt-1">
                                        <label class="flex text-sm text-black w-[68px]">Lokasi</label>
                                        <label class="flex text-sm text-black">:</label>
                                        <label
                                            class="flex w-[400px] ml-1 text-sm text-black px-1">{{ $product->location_address }}</label>
                                    </div>
                                    <!-- SPK location start-->
                                    <div class="flex justify-center mt-1">
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
                                                            <th class="text-black font-semibold text-sm border">Data Lokasi
                                                            </th>
                                                        @endif
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="border p-1 text-center">
                                                            <div class="flex justify-center items-center border mt-1 p-1">
                                                                <img class="m-auto flex items-center justify-center max-w-[260px]"
                                                                    src="{{ asset('storage/' . $product->location_photo) }}">
                                                            </div>
                                                        </td>
                                                        <td class="border p-1 text-center">
                                                            @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                <label class="flex justify-center text-sm text-black">No.
                                                                    Penjualan</label>
                                                                <label
                                                                    class="flex justify-center text-sm text-black">{{ $install_order->sale->number }}</label>
                                                            @else
                                                                <label
                                                                    class="hidden justify-center text-sm text-black"></label>
                                                            @endif
                                                            <div class="flex w-full justify-center items-center mt-4">
                                                                @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                    {{ QrCode::size(100)->generate('vista-app.test/marketing/sales/' . $install_order->sale->id) }}
                                                                @else
                                                                    {{ QrCode::size(100)->generate('vista-app.test/media/locations/' . $product->location_id) }}
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
                                    <div class="flex justify-center items-center border mt-3 p-1">
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
                        <i>* Lembar untuk Tim Marketing</i>
                    </div>
                </div>
                <!-- SPK Body end-->
            </div>
        </div>
        <input id="saveName" type="text"
            value="{{ substr($install_order->number, 0, 4) }}-SPK Pasang-{{ $install_order->location->address }}" hidden>
    </div>

    <!-- Script start -->
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
    <!-- Script end -->
@endsection
