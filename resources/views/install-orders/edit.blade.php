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
        $updated_by = new stdClass();
        $updated_by->id = auth()->user()->id;
        $updated_by->name = auth()->user()->name;
        $updated_by->position = auth()->user()->position;
        $photo = $install_order->location->location_photos->where('set_default', true)->last();
    @endphp
    <form method="post" action="/marketing/install-orders/{{ $install_order->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($updated_by) }}" hidden>
        <div class="flex justify-center w-full bg-black">
            <div class="mt-10">
                <div class="flex items-center w-[950px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[800px]">EDIT DATA SPK PASANG GAMBAR</h1>
                    <!-- Title end -->
                    <div class="flex w-[130px] justify-end items-center p-1">
                        <button class="flex justify-center items-center mx-1 btn-success" title="Preview" type="submit"
                            onclick="return fillData()">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="ml-2 text-white">save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/install-orders/index/{{ $company->id }}">
                            <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                                height="24" viewBox="0 0 24 24">
                                <path
                                    d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                            </svg>
                            <span class="mx-1">Cancel</span>
                        </a>
                    </div>
                </div>
                <div class="flex justify-center w-full">
                    <div class="w-[950px] h-[1345px] bg-white mb-10 p-2">
                        <!-- SPK Header start-->
                        @include('install-orders.spk-header')
                        <!-- SPK Header end-->

                        <!-- SPK Body start-->
                        <div class="h-[500px]">
                            <div class="flex w-full items-center px-10">
                                <div class="w-[950px]">
                                    <label class="flex text-md font-semibold justify-center w-full mt-2"><u>SPK PEMASANGAN
                                            GAMBAR</u>
                                    </label>
                                    <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                        {{ $install_order->number }}</label>
                                    <div class="flex justify-center w-full">
                                        <div class="w-[500px] border p-2">
                                            <div class="flex">
                                                <div class="w-[240px] border rounded-md p-1">
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Tgl. SPK</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input type="text"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            value="{{ $spkDate }}" readonly>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Design</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="theme" type="text" name="theme"
                                                            placeholder="Input Tema Design"
                                                            value="{{ $install_order->theme }}" onkeyup="getTheme(this)"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1 @error('area') is-invalid @enderror"
                                                            required>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Ukuran</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="size" type="text"
                                                            value="{{ $product->location_size }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="w-[240px] border rounded-md p-1 ml-1">
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-20">Tipe</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <label id="type"
                                                            class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">{{ $install_order->type }}</label>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <input id="sizeWidth" type="number"
                                                            value="{{ $product->location_width }}" hidden>
                                                        <input id="sizeHeight" type="number"
                                                            value="{{ $product->location_height }}" hidden>
                                                        <label class="flex text-sm text-black w-20">Jumlah</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="qty" type="number" value="{{ $product->qty }}"
                                                            class="flex w-8 ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                        <label class="flex ml-2 text-sm text-black">lembar</label>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-20">Tgl. Tayang</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="install_at" name="install_at" type="date"
                                                            value="{{ $install_order->install_at }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            onchange="getInstallAt(this)">
                                                    </div>
                                                    @if ($product->location_side == 2)
                                                        <div class="flex mt-1">
                                                            <input id="cbRight" class="outline-none" type="checkbox"
                                                                onclick="cbRightAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                                            <input id="cbLeft" class="ml-2 outline-none"
                                                                type="checkbox" onclick="cbLeftAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex mt-1">
                                                <label class="flex text-sm text-black w-14">Catatan</label>
                                                <label class="flex text-sm text-black">:</label>
                                                <textarea name="notes" placeholder="Input Catatan"
                                                    class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="3"
                                                    onkeyup="getNotes(this)">{{ $install_order->notes }}</textarea>
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
                                                                <th
                                                                    class="text-black font-semibold text-sm border w-[260px]">
                                                                    Kode Lokasi :
                                                                    {{ $product->location_code }}-{{ $product->city_code }}
                                                                </th>
                                                                <th class="text-black font-semibold text-sm border">
                                                                    Google Maps</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="border p-1 text-center">
                                                                    <div
                                                                        class="flex justify-center items-center border mt-1 p-1">
                                                                        <img class="m-auto flex items-center justify-center max-w-[260px]"
                                                                            src="{{ asset('storage/' . $photo->photo) }}">
                                                                    </div>
                                                                </td>
                                                                <td class="border p-1 text-center">
                                                                    <div class="flex w-full justify-center items-center">
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
                                                class="flex text-sm text-black justify-center w-full px-1 font-semibold">
                                                @if ($install_order->design)
                                                    Ganti Design
                                                @else
                                                    Tambah Design
                                                @endif
                                            </label>
                                            <input type="text" name="oldDesign" value="{{ $install_order->design }}"
                                                hidden>
                                            <input id="design" name="design"
                                                class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full"
                                                type="file" onchange="previewImage(this)">
                                            @error('design')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="flex justify-center items-center border mt-3 p-1">
                                                @if ($install_order->design)
                                                    <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                        src="{{ asset('storage/' . $install_order->design) }}">
                                                @else
                                                    <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                        src="">
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
                                                            <th class="text-black font-semibold text-xs border w-[90px]">
                                                                Tim Marketing</th>
                                                            <th class="text-black font-semibold text-xs border w-[90px]">
                                                                Tim Produksi</th>
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
                        <div class="h-[500px] mt-4">
                            <div class="flex w-full px-10">
                                <div class="w-[950px]">
                                    <label class="flex text-md font-semibold justify-center w-full"><u>SPK PEMASANGAN
                                            GAMBAR</u></label>
                                    <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                        {{ $install_order->number }}</label>
                                    <div class="flex justify-center w-full">
                                        <div class="w-[500px] h-[430px] border p-2">
                                            <div class="flex">
                                                <div class="w-[240px] border rounded-md p-1">
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Tgl. SPK</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input type="text"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            value="{{ $spkDate }}" readonly>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Design</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="themeCopy" type="text"
                                                            placeholder="Terisi otomatis"
                                                            value="{{ $install_order->theme }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Ukuran</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="size" type="text"
                                                            value="{{ $product->location_size }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Status</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="orderStatus" type="text"
                                                            value="{{ $product->status }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                    </div>
                                                    @if ($product->location_side == 2)
                                                        <div class="flex mt-1">
                                                            <input id="cbRight" class="outline-none" type="checkbox"
                                                                onclick="cbRightAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                                            <input id="cbLeft" class="ml-2 outline-none"
                                                                type="checkbox" onclick="cbLeftAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="w-[240px] border rounded-md p-1 ml-1">
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-14">Tipe</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <label
                                                            class="flex ml-1 text-sm text-black border rounded-sm w-[175px] px-1">{{ $install_order->type }}</label>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-14">Jumlah</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input type="number" value="{{ $product->qty }}"
                                                            class="flex w-8 ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                        <label class="flex ml-2 text-sm text-black">lembar</label>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-20">Tgl. Tayang</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="installAt" type="date"
                                                            value="{{ $install_order->install_at }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                    </div>
                                                    @if ($product->location_side == 2)
                                                        <div class="flex mt-1">
                                                            <input id="cbRight" class="outline-none" type="checkbox"
                                                                onclick="cbRightAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                                            <input id="cbLeft" class="ml-2 outline-none"
                                                                type="checkbox" onclick="cbLeftAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex mt-1">
                                                <label class="flex text-sm text-black w-14">Catatan</label>
                                                <label class="flex text-sm text-black">:</label>
                                                <textarea id="notesCopy" placeholder="Terisi otomatis"
                                                    class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="2" readonly>{{ $install_order->notes }}</textarea>
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
                                                                <th
                                                                    class="text-black font-semibold text-sm border w-[260px]">
                                                                    Kode Lokasi :
                                                                    {{ $product->location_code }}-{{ $product->city_code }}
                                                                </th>
                                                                @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                    <th class="text-black text-sm font-semibold border">
                                                                        Data Penjualan</th>
                                                                @else
                                                                    <th class="text-black font-semibold text-sm border">
                                                                        Data Lokasi</th>
                                                                @endif
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td class="border p-1 text-center">
                                                                    <div
                                                                        class="flex justify-center items-center border mt-1 p-1">
                                                                        <img class="m-auto flex items-center justify-center max-w-[260px]"
                                                                            src="{{ asset('storage/' . $photo->photo) }}">
                                                                    </div>
                                                                </td>
                                                                <td class="border p-1 text-center">
                                                                    @if ($product->order_type == 'sales' || $product->order_type == 'free')
                                                                        <label
                                                                            class="flex justify-center text-sm text-black">No.
                                                                            Penjualan</label>
                                                                        <label id="saleNumber"
                                                                            class="flex justify-center text-sm text-black">{{ $install_order->sale->number }}</label>
                                                                    @else
                                                                        <label id="saleNumber"
                                                                            class="hidden justify-center text-sm text-black"></label>
                                                                    @endif
                                                                    <div
                                                                        class="flex w-full justify-center items-center mt-4">
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
                                                    <img class="m-auto img-preview-copy flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                        src="{{ asset('storage/' . $install_order->design) }}">
                                                @else
                                                    <img class="m-auto img-preview-copy flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                        src="">
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
                                                            <th class="text-black font-semibold text-xs border w-[90px]">
                                                                Tim Marketing</th>
                                                            <th class="text-black font-semibold text-xs border w-[90px]">
                                                                Tim Produksi</th>
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
        </div>
    </form>

    <!-- Script Preview Image start-->
    <script src="/js/editinstallorders.js"></script>
    <!-- Script Preview Image end-->
@endsection
