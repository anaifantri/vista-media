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
        $product = json_decode($takedown_order->product);
        $description = $product->description;
        if ($product->category == 'Signage') {
            $location_lat = $description->lat[0];
            $location_lng = $description->lng[0];
        } else {
            $location_lat = $description->lat;
            $location_lng = $description->lng;
        }
        $updated_by = new stdClass();
        $updated_by->id = auth()->user()->id;
        $updated_by->name = auth()->user()->name;
        $updated_by->position = auth()->user()->position;
    @endphp
    <form method="post" action="/marketing/takedown-orders/{{ $takedown_order->id }}" enctype="multipart/form-data">
        @method('put')
        @csrf
        <input type="text" name="updated_by" id="updated_by" value="{{ json_encode($updated_by) }}" hidden>
        <div class="flex justify-center w-full bg-black">
            <div class="mt-10">
                <div class="flex items-center w-[950px] border-b px-2">
                    <!-- Title start -->
                    <h1 class="index-h1 w-[800px]">EDIT DATA SPK PENURUNAN GAMBAR</h1>
                    <!-- Title end -->
                    <div class="flex w-[130px] justify-end items-center p-1">
                        <button class="flex justify-center items-center mx-1 btn-success" title="Save" type="submit">
                            <svg class="fill-current w-5 ml-1 xl:ml-2 2xl:ml-3" xmlns="http://www.w3.org/2000/svg"
                                width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.003 3h2.997v5h-2.997v-5zm8.997 1v20h-24v-24h20l4 4zm-19 5h14v-7h-14v7zm16 4h-18v9h18v-9z" />
                            </svg>
                            <span class="ml-2 text-white">save</span>
                        </button>
                        <a class="flex justify-center items-center mx-1 btn-danger"
                            href="/takedown-orders/index/{{ $company->id }}">
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
                    <div class="w-[950px] h-[1345px] bg-white mb-10 p-2 mt-2">
                        <!-- SPK Header start-->
                        @include('takedown-orders.spk-header')
                        <!-- SPK Header end-->

                        <!-- SPK Body start-->
                        <div class="h-[520px]">
                            <div class="flex w-full items-center px-10">
                                <div class="w-[950px]">
                                    <label class="flex text-md font-semibold justify-center w-full mt-2">
                                        <u>SPK PENURUNAN GAMBAR</u>
                                    </label>
                                    <label class="flex text-md text-slate-500 justify-center w-full">Nomor :
                                        {{ $takedown_order->number }}</label>
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
                                                            value="{{ $takedown_order->theme }}" onkeyup="getTheme(this)"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1 @error('area') is-invalid @enderror"
                                                            required>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-24">Ukuran</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="size" type="text" value="{{ $product->size }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            readonly>
                                                    </div>
                                                </div>
                                                <div class="w-[240px] border rounded-md p-1 ml-1">
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-20">Tipe</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <label id="type"
                                                            class="flex ml-1 text-sm text-black border rounded-sm w-[140px] px-1">{{ $product->category }}</label>
                                                    </div>
                                                    <div class="flex mt-1">
                                                        <label class="flex text-sm text-black w-20">Tgl. Turun</label>
                                                        <label class="flex text-sm text-black">:</label>
                                                        <input id="takedown_at" name="takedown_at" type="date"
                                                            value="{{ $takedown_order->takedown_at }}"
                                                            class="flex ml-1 text-sm text-black border rounded-sm outline-none px-1"
                                                            required>
                                                    </div>
                                                    @if ((int) filter_var($product->side, FILTER_SANITIZE_NUMBER_INT) == 2)
                                                        <div class="flex mt-1">
                                                            <input id="cbRight" class="outline-none" type="checkbox"
                                                                onclick="cbRightAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kanan</label>
                                                            <input id="cbLeft" class="ml-2 outline-none" type="checkbox"
                                                                onclick="cbLeftAction(this)" checked>
                                                            <label class="flex ml-1 text-sm text-black w-16">Kiri</label>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="flex mt-1">
                                                <label class="flex text-sm text-black w-14">Catatan</label>
                                                <label class="flex text-sm text-black">:</label>
                                                <textarea name="notes" placeholder="Input Catatan"
                                                    class="flex w-[425px] ml-1 text-sm text-black border rounded-sm outline-none px-1" rows="3">{{ $takedown_order->notes }}</textarea>
                                            </div>
                                            <div class="flex mt-1">
                                                <label class="flex text-sm text-black w-14">Lokasi</label>
                                                <label class="flex text-sm text-black">:</label>
                                                <label
                                                    class="flex w-[350px] ml-1 text-sm text-black px-1">{{ $product->address }}</label>
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
                                                                    {{ $product->code }}-{{ $product->city_code }}
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
                                                                            src="{{ asset('storage/' . $product->photo) }}">
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
                                                @if ($takedown_order->design)
                                                    Ganti Design
                                                @else
                                                    Tambah Design
                                                @endif
                                            </label>
                                            <input type="text" name="oldDesign" value="{{ $takedown_order->design }}"
                                                hidden>
                                            <input id="design" name="design"
                                                class="flex border-t border-b border-r rounded-r-lg cursor-pointer text-gray-500 w-full"
                                                type="file" onchange="previewImage(this)">
                                            @error('design')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                            <div class="flex justify-center items-center border mt-3 p-1 h-[200px]">
                                                @if ($takedown_order->design)
                                                    <img class="m-auto img-preview flex items-center justify-center max-w-[260px] max-h-[180px]"
                                                        src="{{ asset('storage/' . $takedown_order->design) }}">
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
                        </div>
                        <!-- SPK Body end-->
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script src="/js/previewimage.js"></script>
@endsection
