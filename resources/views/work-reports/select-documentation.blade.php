@extends('dashboard.layouts.main');

@section('container')
    @php
        $bulan = [1 => 'Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
        $fullMonth = [
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

        if (count($sale->quotation->quotation_revisions) != 0) {
            $quotationDeal = $sale->quotation->quotation_revisions->last();
            $price = json_decode($quotationDeal->price);
        } else {
            $quotationDeal = $sale->quotation;
            $price = json_decode($quotationDeal->price);
        }
        $getService = '';

        if ($sale->media_category->name == 'Service') {
            if ($price->objServiceType->print == true && $price->objServiceType->install == true) {
                $getService = 'Cetak dan Pasang';
            } elseif ($price->objServiceType->print == true && $price->objServiceType->install == false) {
                $getService = 'Cetak';
            } elseif ($price->objServiceType->print == false && $price->objServiceType->install == true) {
                $getService = 'Pasang';
            }
        }

        $product = json_decode($sale->product);
        $description = json_decode($product->description);
        $client = json_decode($sale->quotation->clients);

        $dayDisable = false;
        $nightDisable = false;

        if (count($installation_photos) > 0) {
            if (count($first_photos) == 0) {
                $dayDisable = true;
                $first_photos = $second_photos;
            }

            if (count($second_photos) == 0) {
                $nightDisable = true;
                $second_photos = $first_photos;
            }
        } else {
            $nightDisable = true;
            $dayDisable = true;
        }

        $firstPhotoId = '';
        $firstTitle = '';
        $secondPhotoId = '';
        $secondTitle = '';

        $created_by = new stdClass();
        $created_by->id = auth()->user()->id;
        $created_by->name = auth()->user()->name;
        $created_by->position = auth()->user()->position;
    @endphp
    <div class="flex justify-center pl-14 py-10 bg-stone-800">
        <div class="z-0 mb-8 bg-stone-700 p-2 border rounded-md">
            <div class="flex items-center w-[1200px] border-b px-2">
                <!-- Title start -->
                <h1 class="index-h1 w-[1200px]">Membuat BAST</h1>
                <!-- Title end -->
                <div>
                    <a href="/work-reports/index/{{ $company->id }}" class="flex justify-center items-center mx-1 btn-danger"
                        title="Cancel">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 2c5.514 0 10 4.486 10 10s-4.486 10-10 10-10-4.486-10-10 4.486-10 10-10zm0-2c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm5 15.538l-3.592-3.548 3.546-3.587-1.416-1.403-3.545 3.589-3.588-3.543-1.405 1.405 3.593 3.552-3.547 3.592 1.405 1.405 3.555-3.596 3.591 3.55 1.403-1.416z" />
                        </svg>
                        <span class="mx-1 text-white">Cancel</span>
                    </a>
                </div>
            </div>
            <div id="selectDocumentation">
                <div class="flex w-full justify-center">
                    <div class="w-[580px] bg-stone-200 border rounded-lg border-stone-400 my-2 p-2">
                        <div class="flex w-full bg-stone-400 rounded-xl items-center px-10 pt-2 border-b pb-2">
                            <span class="text-center w-full text-md font-semibold">Informasi Detail Penjualan</span>
                        </div>
                        <div class="w-[560px] text-sm border rounded-lg border-stone-900 mt-2 p-2">
                            <div class="flex">
                                <label class="w-32">No. Penjualan</label>
                                <label>:</label>
                                <label class="ml-2">{{ $sale->number }}</label>
                            </div>
                            <div class="flex">
                                <label class="w-32">Tgl. Penjualan</label>
                                <label>:</label>
                                <label class="ml-2">
                                    {{ date('d', strtotime($sale->created_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($sale->created_at))] }}
                                    {{ date('Y', strtotime($sale->created_at)) }}
                                </label>
                            </div>
                            <div class="flex">
                                <label class="w-32">Jenis</label>
                                <label>:</label>
                                <label class="ml-2">
                                    @if ($sale->media_category->name == 'Service')
                                        {{ $getService }} Visual
                                    @else
                                        {{ $sale->media_category->name }}
                                    @endif
                                </label>
                            </div>
                            <div class="flex">
                                <label class="w-32">Lokasi</label>
                                <label>:</label>
                                <label class="ml-2">
                                    {{ $product->address }}
                                </label>
                            </div>
                        </div>
                        <div class="w-[560px] text-sm border rounded-lg border-stone-900 mt-2 p-2">
                            <div class="flex">
                                <label class="w-32">No. Penawaran</label>
                                <label>:</label>
                                <label class="ml-2">
                                    {{ $quotationDeal->number }}
                                </label>
                            </div>
                            <div class="flex">
                                <label class="w-32">Tgl. Penawaran</label>
                                <label>:</label>
                                <label class="ml-2">
                                    {{ date('d', strtotime($quotationDeal->created_at)) }}
                                    {{ $bulan[(int) date('m', strtotime($quotationDeal->created_at))] }}
                                    {{ date('Y', strtotime($quotationDeal->created_at)) }}
                                </label>
                            </div>
                            <div class="flex">
                                <label class="w-32">Nama Klien</label>
                                <label>:</label>
                                <label class="ml-2">
                                    {{ $client->name }}
                                </label>
                            </div>
                            <div class="flex">
                                <label class="w-32">Nama Perusahaan</label>
                                <label>:</label>
                                <label class="ml-2">
                                    {{ $client->company }}
                                </label>
                            </div>
                        </div>
                        <div class="flex w-full bg-stone-400 rounded-xl items-center mt-2 px-10 pt-2 border-b pb-2">
                            <span class="text-center w-full text-md font-semibold">Pilih Tema/Design</span>
                        </div>
                        <form
                            action="/work-reports/select-documentation/{{ $sale->id }}/{{ $main_sale_id }}/{{ $bast_category }}">
                            <div class="flex w-full justify-center items-center p-2">
                                <table class="table-auto mt-2 w-full">
                                    <thead>
                                        <tr class="text-sm h-8">
                                            <th class="w-8 border border-black">No.</th>
                                            <th class="border border-black">Tema</th>
                                            <th class="w-24 border border-black">Tgl. Tayang</th>
                                            <th class="w-16 border border-black">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($install_orders as $order)
                                            <tr class="text-sm">
                                                <td class="border border-black px-1 text-center">{{ $loop->iteration }}
                                                </td>
                                                <td class="border border-black px-1">{{ $order->theme }}</td>
                                                <td class="border border-black px-1 text-center">
                                                    {{ date('d', strtotime($order->install_at)) }}
                                                    {{ $bulan[(int) date('m', strtotime($order->install_at))] }}
                                                    {{ date('Y', strtotime($order->install_at)) }}
                                                </td>
                                                <td class="border border-black px-1">
                                                    <div class="flex justify-center w-full">
                                                        @if (request('rb_install_order'))
                                                            @if ($order->id == request('rb_install_order'))
                                                                <input id="{{ $order->id }}" type="radio"
                                                                    name="rb_install_order" value="{{ $order->id }}"
                                                                    onclick="submit()" checked>
                                                            @else
                                                                <input id="{{ $order->id }}" type="radio"
                                                                    name="rb_install_order" value="{{ $order->id }}"
                                                                    onclick="submit()">
                                                            @endif
                                                        @else
                                                            @if ($loop->iteration == 1)
                                                                <input id="{{ $order->id }}" type="radio"
                                                                    name="rb_install_order" value="{{ $order->id }}"
                                                                    onclick="submit()" checked>
                                                            @else
                                                                <input id="{{ $order->id }}" type="radio"
                                                                    name="rb_install_order" value="{{ $order->id }}"
                                                                    onclick="submit()">
                                                            @endif
                                                        @endif
                                                        <span class="ml-2">pilih</span>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="w-[580px] bg-stone-200 border rounded-lg border-stone-400 ml-2 my-2 p-2">
                        <div class="flex w-full bg-stone-400 rounded-xl items-center p-2 border-b">
                            <span class="text-center w-full text-md font-semibold">Pilih Foto</span>
                        </div>
                        <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                            <div class="flex items-center justify-center w-full">
                                <label class="flex text-sm font-semibold mr-1">Judul Foto :</label>
                                @if ($dayDisable == true)
                                    <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Siang"
                                        onclick="rbFirstTitle(this)" disabled>
                                @else
                                    @if ($work_category != 'Service')
                                        <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Siang"
                                            onclick="rbFirstTitle(this)" checked>
                                    @else
                                        <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Siang"
                                            onclick="rbFirstTitle(this)">
                                    @endif
                                @endif
                                <label class="flex text-sm font-semibold ml-2">Foto Siang</label>
                                @if ($nightDisable == true)
                                    <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Malam"
                                        onclick="rbFirstTitle(this)" disabled>
                                @else
                                    <input type="radio" name="rbFirstTitle" class="outline-none ml-4" id="Foto Malam"
                                        onclick="rbFirstTitle(this)">
                                @endif
                                <label class="flex text-sm font-semibold ml-2">Foto Malam</label>
                                @if ($work_category == 'Service')
                                    <input id="rbManualDay" type="radio" name="rbFirstTitle" class="outline-none ml-4"
                                        onclick="rbManualTitle(this)" checked>
                                    <input id="inputFirstTitle" type="text"
                                        class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                                        placeholder="input judul foto" onchange="inputFirstTitleAction(this)">
                                @else
                                    <input id="rbManualDay" type="radio" name="rbFirstTitle" class="outline-none ml-4"
                                        onclick="rbManualTitle(this)">
                                    <input id="inputFirstTitle" type="text"
                                        class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                                        placeholder="input judul foto" onchange="inputFirstTitleAction(this)" disabled>
                                @endif
                            </div>
                            <div class="relative m-auto w-[540px] h-max mt-2">
                                @if (count($first_photos) > 0)
                                    <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                        <button
                                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            type="button" onclick="buttonFirstPrev()">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                        <button type="button"
                                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            onclick="buttonFirstNext()">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                @else
                                    <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                        <button
                                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            type="button">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                        <button type="button"
                                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                                @if (count($first_photos) > 0)
                                    @foreach ($first_photos as $photo)
                                        @if (count($first_photos) > 2)
                                            @if ($loop->iteration - 1 == intdiv(count($first_photos), 2))
                                                <div
                                                    class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                    @php
                                                        $firstPhotoId = $photo->id;
                                                        if ($photo->type == 'day') {
                                                            $firstTitle = 'Foto Siang';
                                                        } else {
                                                            $firstTitle = 'Foto Malam';
                                                        }
                                                    @endphp
                                                </div>
                                            @else
                                                <div class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                                    hidden>
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                </div>
                                            @endif
                                        @else
                                            @if ($loop->iteration == 1)
                                                <div
                                                    class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                    @php
                                                        $firstPhotoId = $photo->id;
                                                        if ($photo->type == 'day') {
                                                            $firstTitle = 'Foto Siang';
                                                        } else {
                                                            $firstTitle = 'Foto Malam';
                                                        }
                                                    @endphp
                                                </div>
                                            @else
                                                <div class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                                    hidden>
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <div
                                        class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                        <img src="{{ asset('/img/product-image.png') }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="w-[560px] border rounded-lg border-stone-900 mt-2 p-2">
                            <div class="flex items-center justify-center w-full">
                                <label class="flex text-sm font-semibold mr-1">Judul Foto :</label>
                                @if ($dayDisable == true)
                                    <input id="Foto Siang" name="rbSecond" type="radio" class="outline-none ml-4"
                                        onclick="rbSecondTitle(this)" value="Foto Siang" disabled>
                                @else
                                    <input id="Foto Siang" name="rbSecond" type="radio" class="outline-none ml-4"
                                        onclick="rbSecondTitle(this)" value="Foto Siang">
                                @endif
                                <label class="flex text-sm font-semibold ml-2">Foto Siang</label>
                                @if ($nightDisable == true)
                                    <input id="Foto Malam" name="rbSecond" type="radio" class="outline-none ml-4"
                                        onclick="rbSecondTitle(this)" value="Foto Malam" disabled>
                                @else
                                    @if ($work_category != 'Service')
                                        <input id="Foto Malam" name="rbSecond" type="radio" class="outline-none ml-4"
                                            onclick="rbSecondTitle(this)" value="Foto Malam" checked>
                                    @else
                                        <input id="Foto Malam" name="rbSecond" type="radio" class="outline-none ml-4"
                                            onclick="rbSecondTitle(this)" value="Foto Malam">
                                    @endif
                                @endif
                                <label class="flex text-sm font-semibold ml-2">Foto Malam</label>
                                @if ($work_category == 'Service')
                                    <input id="rbManualNight" name="rbSecond" type="radio" class="outline-none ml-4"
                                        onclick="rbManualTitle(this)" checked>
                                    <input id="inputSecondTitle" type="text"
                                        class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                                        placeholder="input judul foto" onchange="inputSecondTitleAction(this)">
                                @else
                                    <input id="rbManualNight" name="rbSecond" type="radio" class="outline-none ml-4"
                                        onclick="rbManualTitle(this)">
                                    <input id="inputSecondTitle" type="text"
                                        class="ml-2 text-sm outline-none bg-white rounded-md px-2 w-40"
                                        placeholder="input judul foto" onchange="inputSecondTitleAction(this)" disabled>
                                @endif
                            </div>
                            <div class="relative m-auto w-[540px] h-max mt-2">
                                @if (count($second_photos) > 0)
                                    <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto">
                                        <button
                                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            type="button" onclick="buttonSecondPrev()">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto">
                                        <button type="button"
                                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            onclick="buttonSecondNext()">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                @else
                                    <div class="absolute inset-y-0 left-0 w-7 h-12 m-auto" hidden>
                                        <button
                                            class="flex items-center justify-center rounded-r-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer"
                                            type="button">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M16.67 0l2.83 2.829-9.339 9.175 9.339 9.167-2.83 2.829-12.17-11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="absolute inset-y-0 right-0 w-7 h-12 m-auto" hidden>
                                        <button type="button"
                                            class="flex items-center justify-center rounded-l-lg w-7 h-12 bg-slate-700 bg-opacity-30 hover:bg-opacity-75 transition duration-500 ease-in-out cursor-pointer">
                                            <svg class="fill-white w-5" xmlns="http://www.w3.org/2000/svg"
                                                fill-rule="evenodd" clip-rule="evenodd" viewBox="0 0 24 24">
                                                <path
                                                    d="M7.33 24l-2.83-2.829 9.339-9.175-9.339-9.167 2.83-2.829 12.17 11.996z" />
                                            </svg>
                                        </button>
                                    </div>
                                @endif
                                @if (count($second_photos) > 0)
                                    @foreach ($second_photos as $photo)
                                        @if (count($second_photos) > 2)
                                            @if ($loop->iteration - 1 == intdiv(count($second_photos), 2))
                                                <div
                                                    class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                    @php
                                                        $secondPhotoId = $photo->id;
                                                        if ($photo->type == 'day') {
                                                            $secondTitle = 'Foto Siang';
                                                        } else {
                                                            $secondTitle = 'Foto Malam';
                                                        }
                                                    @endphp
                                                </div>
                                            @else
                                                <div class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                                    hidden>
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                </div>
                                            @endif
                                        @else
                                            @if ($loop->iteration == 1)
                                                <div
                                                    class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                    @php
                                                        $secondPhotoId = $photo->id;
                                                        if ($photo->type == 'day') {
                                                            $secondTitle = 'Foto Siang';
                                                        } else {
                                                            $secondTitle = 'Foto Malam';
                                                        }
                                                    @endphp
                                                </div>
                                            @else
                                                <div class="divSecondPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1"
                                                    hidden>
                                                    <img src="{{ asset('storage/' . $photo->image) }}" alt=""
                                                        class="h-[250px] w-[420px] rounded-lg">
                                                </div>
                                            @endif
                                        @endif
                                    @endforeach
                                @else
                                    <div
                                        class="divFirstPhoto border rounded-lg border-stone-900 mx-[84px] h-[260px] mt-4 p-1">
                                        <img src="{{ asset('/img/product-image.png') }}" alt=""
                                            class="h-[250px] w-[420px] rounded-lg">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex w-full items-end bg-stone-400 rounded-lg justify-end px-4 pt-2 border-b pb-2">
                    <a href="/work-reports/create/{{ $bast_category }}/{{ $company->id }}"
                        class="flex justify-center items-center mx-1 btn-primary" title="Back">
                        <svg class="fill-current w-5 mx-1 rotate-180" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                        <span class="mx-1 text-white">Back</span>
                    </a>
                    <button class="flex justify-center items-center mx-1 btn-success" title="Next" type="button"
                        onclick="documentationNext()">
                        <span class="mx-1 text-white">Next</span>
                        <svg class="fill-current w-5 mx-1" xmlns="http://www.w3.org/2000/svg" width="24"
                            height="24" viewBox="0 0 24 24">
                            <path
                                d="M12 0c-6.627 0-12 5.373-12 12s5.373 12 12 12 12-5.373 12-12-5.373-12-12-12zm-1.568 18.005l-1.414-1.415 4.574-4.59-4.574-4.579 1.414-1.416 5.988 5.995-5.988 6.005z" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <form id="formSelectFormat">
    </form>

    <script>
        let firstPhotoId = @json($firstPhotoId);
        let firstTitle = @json($firstTitle);
        let secondPhotoId = @json($secondPhotoId);
        let secondTitle = @json($secondTitle);
        let firstImages = @json($first_photos);
        let secondImages = @json($second_photos);
        var sale = @json($sale);
        var bastCategory = @json($bast_category);
        var installOrder = @json($install_order);
        const previewFirstPhoto = document.getElementById("previewFirstPhoto");
        const previewSecondPhoto = document.getElementById("previewSecondPhoto");
        const imageSecondViews = document.querySelectorAll(".divSecondPhoto");
        const imageFirstViews = document.querySelectorAll(".divFirstPhoto");
        const formSelectFormat = document.getElementById("formSelectFormat");

        if (document.querySelectorAll(".divSecondPhoto").length > 2) {
            var indexSecond = Math.floor(document.querySelectorAll(".divSecondPhoto").length / 2);
            secondPhotoId = secondImages[indexSecond].id;
            if (secondImages[indexSecond].type == "day") {
                secondTitle = "Foto Siang";
            } else {
                secondTitle = "Foto Malam";
            }
            formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0].id +
                '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' + bastCategory);
        } else {
            var indexSecond = 0;
            if (Object.keys(secondImages).length != 0) {
                secondPhotoId = secondImages[indexSecond].id;
                if (secondImages[indexSecond].type == "day") {
                    secondTitle = "Foto Siang";
                } else {
                    secondTitle = "Foto Malam";
                }
            }
            formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0].id +
                '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' + bastCategory);
        }

        if (document.querySelectorAll(".divFirstPhoto").length > 2) {
            var indexFirst = Math.floor(document.querySelectorAll(".divFirstPhoto").length / 2);
            firstPhotoId = firstImages[indexSecond].id;
            if (firstImages[indexFirst].type == "day") {
                firstTitle = "Foto Siang";
            } else {
                firstTitle = "Foto Malam";
            }
            formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0].id +
                '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' + bastCategory);
        } else {
            var indexFirst = 0;
            if (Object.keys(firstImages).length != 0) {
                firstPhotoId = firstImages[indexSecond].id;
                if (firstImages[indexFirst].type == "day") {
                    firstTitle = "Foto Siang";
                } else {
                    firstTitle = "Foto Malam";
                }
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' + bastCategory
                );
            }
        }

        buttonSecondNext = () => {
            if (indexSecond == imageSecondViews.length - 1) {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[0].removeAttribute('hidden');
                indexSecond = 0;
                secondPhotoId = secondImages[indexSecond].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            } else {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[indexSecond + 1].removeAttribute('hidden');
                indexSecond = indexSecond + 1;
                secondPhotoId = secondImages[indexSecond].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            }
        }
        buttonFirstNext = () => {
            if (indexFirst == imageFirstViews.length - 1) {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[0].removeAttribute('hidden');
                indexFirst = 0;
                firstPhotoId = firstImages[indexFirst].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            } else {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[indexFirst + 1].removeAttribute('hidden');
                indexFirst = indexFirst + 1;
                firstPhotoId = firstImages[indexFirst].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            }
        }
        buttonSecondPrev = () => {
            if (indexSecond == 0) {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[imageSecondViews.length - 1].removeAttribute('hidden');
                indexSecond = imageSecondViews.length - 1;
                secondPhotoId = secondImages[indexSecond].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            } else {
                imageSecondViews[indexSecond].setAttribute('hidden', 'hidden');
                imageSecondViews[indexSecond - 1].removeAttribute('hidden');
                indexSecond = indexSecond - 1;
                secondPhotoId = secondImages[indexSecond].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            }
        }
        buttonFirstPrev = () => {
            if (indexFirst == 0) {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[imageFirstViews.length - 1].removeAttribute('hidden');
                indexFirst = imageFirstViews.length - 1;
                firstPhotoId = firstImages[indexFirst].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            } else {
                imageFirstViews[indexFirst].setAttribute('hidden', 'hidden');
                imageFirstViews[indexFirst - 1].removeAttribute('hidden');
                indexFirst = indexFirst - 1;
                firstPhotoId = firstImages[indexFirst].id;
                formSelectFormat.setAttribute('action', '/work-reports/select-format/' + sale.id + '/' + installOrder[0]
                    .id +
                    '/' + firstPhotoId + '/' + firstTitle + '/' + secondPhotoId + '/' + secondTitle + '/' +
                    bastCategory);
            }
        }
        rbFirstTitle = (sel) => {
            document.getElementById("firstPhotoTitle").innerHTML = sel.id;
            firstTitle = sel.id;
            document.getElementById("inputFirstTitle").setAttribute('disabled', 'disabled');
        }
        rbSecondTitle = (sel) => {
            document.getElementById("secondPhotoTitle").innerHTML = sel.id;
            secondTitle = sel.id;
            document.getElementById("inputSecondTitle").setAttribute('disabled', 'disabled');
        }
        inputFirstTitleAction = (sel) => {
            document.getElementById("firstPhotoTitle").innerHTML = sel.value;
            firstTitle = sel.value;
        }
        inputSecondTitleAction = (sel) => {
            document.getElementById("secondPhotoTitle").innerHTML = sel.value;
            secondTitle = sel.value;
        }
        rbManualTitle = (sel) => {
            if (sel.id == "rbManualDay") {
                document.getElementById("inputFirstTitle").removeAttribute('disabled');
                document.getElementById("inputFirstTitle").focus();
            } else if (sel.id == "rbManualNight") {
                document.getElementById("inputSecondTitle").removeAttribute('disabled');
                document.getElementById("inputSecondTitle").focus();
            }
        }

        documentationNext = () => {
            if (firstPhotoId == '' && secondPhotoId == '') {
                alert("Belum ada foto/dokumentasi pekerjaan..!!")
            } else {
                formSelectFormat.submit();
            }
        }
    </script>
@endsection
